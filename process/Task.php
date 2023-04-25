<?php

namespace process;


use support\Container;
use Workerman\Crontab\Crontab;

class Task
{
    /**
     * 运行目录
     * @var array|mixed|string|null
     */
    public $taskDir = '';

    /**
     * 初始化
     */
    public function __construct()
    {
        $this->taskDir= config('task.task_dir');
    }

    /**
     * @return void
     */
    public function onWorkerStart()
    {
        $dir_iterator = new \RecursiveDirectoryIterator($this->taskDir);
        $iterator = new \RecursiveIteratorIterator($dir_iterator);
        foreach ($iterator as $file) {
            if (is_dir($file)) {
                continue;
            }
            $fileinfo = new \SplFileInfo($file);
            $ext = $fileinfo->getExtension();
            if ($ext === 'php') {
                $class = str_replace('/', "\\", substr(substr($file, strlen(base_path())), 0, -4));
                if (is_a($class, 'App\TaskInterface', true)) {
                    $task = Container::get($class);
                    new Crontab($task->rule, function() use ($task){
                        $task->execute();
                    });
                }
            }
        }
    }
}