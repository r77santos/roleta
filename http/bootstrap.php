<?php 

use App\Core\Facade\Settings;
use App\Core\Utils\Collection;
use App\Core\Rules\UniqueRule;

include_once realpath(__DIR__ . '/../app/bootstrap.php');

/*
 | Configurando o caminho das configurações e Criando o alias das classes */

Settings::$Path = __DIR__ . '/../app/settings/';


if( $collection = new Collection(Settings::build('alias')->load()) ) {
    $collection->each(function($class, $alias) {
        class_alias($class, $alias);
    });
    unset($collection);
}

/*
 | Configurando os caminhos dos templates e response  */

Template::$Path = __DIR__ . '/../app/template/';
Response::$Path = __DIR__ . '/../app/template/';

/*
 | Build do container da aplicação */

$container = new Container();

$container->jwt = function() {
    return new JWToken();
};

$container->request  = function() {
    return Request::build();
};

$container->response = function() {
    return Response::build();
};

$container->settings = function($file) {
    return Settings::build($file);
};

$container->collection = function($elements) {
    return (new Collection($elements));
};

$container->now = function($days) {
    return Carbon\Carbon::now()->add($days, 'days');
};

$container->template = function($path, $request) {
    return Template::build()->render($path, $request);
};

$container->connection = function($key) {
    $settings = Settings::build('database')->find($key);
    if( $connection = db_connect($settings) ) {
        return $connection;
    }
};

$container->forEach = function($elements, $callback) {
    return (new Collection($elements))->each($callback);
};

$container->database = function($key) {
    $settings = Settings::build('database')->find($key);
    if( $connection = db_connect($settings) ) {
        return Database::build($connection);
    }
};

$container->authorization = function() use ($container) {
    return new Authorization($container);
};

$container->configure = function() {
    $inicialize = new PHPInicialize();
    $collection = new Collection(Settings::build('app')->load());
    $collection->each(function($params, $function) use (&$inicialize) {
        if(is_array($params)) {
            foreach($params as $values) {
                $inicialize->add($function, $values);
            }
        } else {
            $inicialize->add($function, $params);
        }
    });
    $inicialize->execute();
};

$container->count = function($table, $column, $value) use($container) {
    return $container->database('mysql')
                     ->select('*')
                     ->from($table)
                     ->where($column, '=', $value)
                     ->count();
};

$container->validation = function($lang, $request, $validation, $database = 'mysql') use ($container) {
    $translate  = Settings::build("validations/{$lang}")->all();
    $connection = $container->database($database)->getConnection();
    return Validator::build($translate, ['unique' => new UniqueRule($connection)])->validate($request, $validation);
};

if( $container->exists('configure') ) {
    $container->configure();
}
