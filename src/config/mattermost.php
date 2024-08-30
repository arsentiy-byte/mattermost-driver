<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Default Mattermost Server Name
    |--------------------------------------------------------------------------
    |
    | Here you cam specify which server you wish to use as your
    | default Mattermost server.
    |
    */

    'default' => env('MATTERMOST_SERVER', 'default'),

    /*
    |--------------------------------------------------------------------------
    | Mattermost Servers
    |--------------------------------------------------------------------------
    |
    | Here you can configure a list of different Mattermost servers
    | to use within your application.
    |
    | You can authenticate in two ways: passing a Bearer Token or
    | passing Username and Password. The allowed values for the "auth"
    | option are: "default", "bearer".
    |
    */

    'servers' => [
        'default' => [
            'auth' => env('MATTERMOST_AUTH', 'default'),
            'host' => env('MATTERMOST_HOST', 'localhost'),
            'login' => env('MATTERMOST_LOGIN', 'login'),
            'password' => env('MATTERMOST_PASSWORD', 'password'),
            'api' => env('MATTERMOST_API', '/api/v4'),
            'timeout' => env('MATTERMOST_TIMEOUT', 5),
        ],

        'token' => [
            'auth' => env('MATTERMOST_AUTH', 'bearer'),
            'host' => env('MATTERMOST_HOST', 'localhost'),
            'token' => env('MATTERMOST_TOKEN', 'token'),
            'api' => env('MATTERMOST_API', '/api/v4'),
            'timeout' => env('MATTERMOST_TIMEOUT', 5),
        ],
    ],
];
