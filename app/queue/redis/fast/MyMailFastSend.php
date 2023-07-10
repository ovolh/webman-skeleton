<?php

namespace app\queue\redis\fast;

use Webman\RedisQueue\Consumer;

class MyMailFastSend implements Consumer
{
    // 要消费的队列名
    public $queue = 'send-mail';

    // 连接名，对应 plugin/webman/redis-queue/redis.php 里的连接`
    public $connection = 'fast';

    // 消费
    public function consume($data)
    {

        // 无需反序列化
        var_export(1); // 输出 ['to' => 'tom@gmail.com', 'content' => 'hello']
        var_export($data); // 输出 ['to' => 'tom@gmail.com', 'content' => 'hello']
    }
}