<?php

namespace App\Task;


use App\TaskInterface;
use App\Util\CrontabFrequencies;

class EverySecondTask implements TaskInterface
{

    /*
    0   1   2   3   4   5
    |   |   |   |   |   |
    |   |   |   |   |   +------ day of week (0 - 6) (Sunday=0)
    |   |   |   |   +------ month (1 - 12)
    |   |   |   +-------- day of month (1 - 31)
    |   |   +---------- hour (0 - 23)
    |   +------------ min (0 - 59)
    +-------------- sec (0-59)[可省略，如果没有0位,则最小时间粒度是分钟]
    */
    /**
     *
     *
     * @var string
     */
    public $rule = '* * * * * *';


    public function __construct(CrontabFrequencies $frequencies)
    {
        $this->rule = $frequencies->everyNumSecond(3);
    }

    /**
     * 执行任务
     * @return mixed
     */
    public function execute()
    {
        echo date('Y-m-d H:i:s') . "\n";
    }
}