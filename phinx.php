<?php

return [
    "paths" => [
        "migrations" => "database/migrations",
        "seeds" => "database/seeds"
    ],
    "environments" => [
        "default_migration_table" => "migrations",
        "default_database" => "dev",
        "default_environment" => "dev",
        "dev" => [
            'adapter' => 'mysql',
            'host' => '127.0.0.1',
            'name' => 'webman',
            'user' => 'root',
            'pass' => 12345678,
            'port' => 3307,
            'charset' => 'utf8mb4',
        ]
    ]
];