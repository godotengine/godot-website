<?php

// See https://github.com/octobercms/october/blob/v1.0.474/config/database.php

return [

    'fetch' => PDO::FETCH_CLASS,
    'default' => 'mysql',

    'connections' => [

        'sqlite' => [
            'driver'   => 'sqlite',
            'database' => 'storage/database.sqlite',
            'prefix'   => '',
        ],

        // Overridden.
        'mysql' => [
            'driver'     => 'mysql',
            'engine'     => 'InnoDB',
            'host'       => 'mariadb',
            'port'       => 3306,
            'database'   => 'october',
            'username'   => 'godot',
            'password'   => 'godot',
            'charset'    => 'utf8mb4',
            'collation'  => 'utf8mb4_unicode_ci',
            'prefix'     => '',
            'varcharmax' => 191,
        ],

    ],

    'migrations' => 'migrations',

    'redis' => [

        'cluster' => false,

        'default' => [
            'host'     => '127.0.0.1',
            'password' => null,
            'port'     => 6379,
            'database' => 0,
        ],

    ],

    'useConfigForTesting' => false,
];
