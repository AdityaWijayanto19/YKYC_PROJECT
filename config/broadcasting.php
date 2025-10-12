<?php

return [

    'default' => env('BROADCAST_CONNECTION', 'reverb'),

    'connections' => [
        'reverb' => [
            'driver' => 'reverb',
            'key' => env('REVERB_APP_KEY'),
            'secret' => env('REVERB_APP_SECRET'),
            'app_id' => env('REVERB_APP_ID'),
            'options' => [
                'host' => env('VITE_REVERB_HOST', '127.0.0.1'),
                'port' => env('VITE_REVERB_PORT', 8081),
                'scheme' => env('VITE_REVERB_SCHEME', 'ws'),
            ],
        ],
        'log' => ['driver' => 'log'],
        'null' => ['driver' => 'null'],
    ],

];
