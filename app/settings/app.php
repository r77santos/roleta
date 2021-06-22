<?php

return [
    
    'define' => [],

    'error_reporting' => E_ALL,

    'ini_set' => [
        [ 'log_errors', 0 ],
        [ 'display_errors', 1 ],
        [ 'error_reporting',  E_ALL ],
    ],

    'setlocale' => [
        [ LC_ALL, 'pt_BR.UTF-8' ],
    ],

    'date_default_timezone_set' => 'America/Sao_Paulo',

    'define' => [
        [ 'JWT_ALG', 'HS256' ],
        [ 'APP_NAME', 'http://localhost' ],
        [ 'JWT_KEY', '110383249ba646cd4c8710da89e348b3' ],
    ],

];