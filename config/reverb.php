<?php

return [

    'default' => env('REVERB_SERVER', 'reverb'),

    'servers' => [
        'reverb' => [
            'host' => env('REVERB_SERVER_HOST', '127.0.0.1'),
            'port' => env('REVERB_SERVER_PORT', 8081),
            'hostname' => env('VITE_REVERB_HOST', '127.0.0.1'),
            'options' => ['tls' => []],

            // tambahkan key scaling supaya tidak error
            'scaling' => [
                'enabled' => false,
                'channel' => 'reverb',
                'server' => [
                    'url' => null,
                    'host' => env('REDIS_HOST', '127.0.0.1'),
                    'port' => env('REDIS_PORT', 6379),
                    'username' => env('REDIS_USERNAME'),
                    'password' => env('REDIS_PASSWORD', null),
                    'database' => 0,
                    'timeout' => 60,
                ],
            ],
            'pulse_ingest_interval' => env('REVERB_PULSE_INGEST_INTERVAL', 15),
            'telescope_ingest_interval' => env('REVERB_TELESCOPE_INGEST_INTERVAL', 15),
        ],
    ],

    'apps' => [
        'provider' => 'config',
        'apps' => [
            [
                'key' => env('REVERB_APP_KEY'),
                'secret' => env('REVERB_APP_SECRET'),
                'app_id' => env('REVERB_APP_ID'),
                'options' => [
                    'host' => env('VITE_REVERB_HOST', '127.0.0.1'),
                    'port' => env('VITE_REVERB_PORT', 8081),
                    'scheme' => env('VITE_REVERB_SCHEME', 'ws'),
                    'useTLS' => env('VITE_REVERB_SCHEME', 'ws') === 'wss',
                ],
                'allowed_origins' => ['*'],
                'ping_interval' => 60,
                'activity_timeout' => 30,
            ],
        ],
    ],

];
