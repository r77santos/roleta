<?php

return [

    'mysql' => [
        
        'Database' => 'database',
        'Username' => 'username',
        'Password' => 'secret',
        'Hostname' => 'host.database.com.br',

        'Parameters' => [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ],

        'provider' => App\Core\Database\Driver\MySqlDriver::class,
    ],
    
];