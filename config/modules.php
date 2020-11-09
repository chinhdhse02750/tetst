<?php
return [
    'admin' => [
        'folder' => 'Admin',
        'prefix_url' => 'admin',
        'router_folder' => 'admin',
        'group_middleware' => [],
        'router_file_name' => 'web.php'
    ],

    'member' => [
        'folder' => 'Member',
        'prefix_url' => '',
        'router_folder' => 'member',
        'group_middleware' => [],
        'router_file_name' => 'web.php'
    ],

    'api' => [
        'folder' => 'Api',
        'prefix_url' => 'api',
        'router_folder' => 'api',
        'group_middleware' => [],
        'router_file_name' => 'api.php'
    ]
];
