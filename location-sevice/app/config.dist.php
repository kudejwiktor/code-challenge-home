<?php
if (!function_exists('config')) {
    function config($type)
    {
        $config = [
            'company' => [
                'name' => 'home.pl'
            ],
            'db' => [
                'user' => 'root',
                'password' => 'password',
                'host' => 'mysql',
                'dbname' => 'locations'
            ],
            'google' => [
                'place' => [
                    'uri' => 'https://maps.googleapis.com',
                    'key' => '',
                    'timeout' => 10,
                    'cache' => [
                        'lifeTime' => 900, //in seconds,
                        'savePath' => '/tmp'
                    ]
                ]
            ]
        ];

        return $config[$type];
    }
}