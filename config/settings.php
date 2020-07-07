<?php
return [
    'app' => [
        'name' => getenv('APP_NAME')
    ],
    'db' => [
        'driver' => 'postgresql',
        'host' => 'localhost',
        'database' => 'database',
        'username' => 'group5',
        'password' => 'pswd',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ]
];
