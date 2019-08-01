<?php
require_once __DIR__ . '/app/config.php';

return [
    "paths" => [
        "migrations" => __DIR__ . "/database/migrations",
        "seeds" => __DIR__ . "/database/seeds",
    ],
    "environments" => [
        "default_migration_table" => "phinxlog",
        "default_database" => 'development',
        'development' => [
            "adapter"=>"mysql",
            "host"=> config('db')['host'],
            "name" => config('db')['dbname'],
            "user" => config('db')['user'],
            "pass"=> config('db')['password'],
        ]
    ]
];