<?php
return [
    'default' => [
        'host' => 'redis://' . env('REDIS_HOST', '127.0.0.1') . ':' . env('REDIS_PORT', 6379),
        'options' => [
            'auth' => null,       // 密码，字符串类型，可选参数
            'db' => env('REDIS_QUEUE_DATABASE', 4),            // 数据库
            'prefix' => '',       // key 前缀
            'max_attempts' => 5, // 消费失败后，重试次数
            'retry_seconds' => 5, // 重试间隔，单位秒
        ]
    ],
    'fast' => [
        'host' => 'redis://' . env('REDIS_HOST', '127.0.0.1') . ':' . env('REDIS_PORT', 6379),
        'options' => [
            'auth' => null,       // 密码，字符串类型，可选参数
            'db' => env('REDIS_QUEUE_DATABASE', 5),             // 数据库
            'max_attempts' => 5, // 消费失败后，重试次数
            'retry_seconds' => 5, // 重试间隔，单位秒
        ]
    ],
];
