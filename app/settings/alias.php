<?php

return [

    /*
     | Alias para Carbon/Datas
     */
    'Carbon' => Carbon\Carbon::class,

    /*
     | Container da aplicação, usado para carregar
     | as dependências do sistema
     */
    'Container' => App\Core\Utils\Container::class,
    
    /*
     | Alias para as facades dos sistema
     */ 
    'JWToken'   => App\Core\Facade\JWToken::class,
    'Request'   => App\Core\Facade\Request::class,
    'Response'  => App\Core\Facade\Response::class,
    'Database'  => App\Core\Facade\Database::class,
    'Settings'  => App\Core\Facade\Settings::class,
    'Template'  => App\Core\Facade\Template::class,
    'Validator' => App\Core\Facade\Validator::class,

    /*
     | Classe usada para adicionar as configurações do PHP
     */
    'Collection' => App\Core\Utils\Collection::class,
    'PHPInicialize' => App\Core\Utils\PHPInicialize::class,

    /*
     | Classes de middlewares
     */
    'Authorization' => App\Middleware\Authorization::class,
];