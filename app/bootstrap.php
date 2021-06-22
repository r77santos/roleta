<?php

session_start();

include_once __DIR__ . '/vendor/autoload.php';

if(!function_exists('now')) {
  function now()
  {
    return date('Y-m-d H:i:s');
  }
}

 if(!function_exists('view')) {
  function view($path, $variables)
  {
    if(!is_null($variables)) {
      extract($variables);
    }
    ob_start();
    include $path;
    return ob_get_clean();
  }
}

if(!function_exists('mailer')) {
  function mailer($settings, $key = 'provider')
  {
    return object_build($settings, $key);
  }
}

if(!function_exists('isset_default')) {
  function isset_default(&$variable, $default)
  {
    if(isset($variable) && !is_null($variable)) {
      return $variable;
    }
    return $default;
  }
}

if(!function_exists('db_connect')) {
  function db_connect($settings, $key = 'provider')
  {
    $object = object_build($settings, $key);
    return new \PDO (
      $object->__toString(),
      $object->Username, 
      $object->Password, $object->Parameters
    );
  }
}

if(!function_exists('object_configure')) {
  function object_configure($object, $configuration)
  {
    if(is_array($configuration)) {
      foreach($configuration as $name => $value) {
        if(property_exists($object, $name)) {
          $object->$name = $value;
        } elseif (method_exists($object, $name)) {
          object_method($object, $name, $value);
        }
      }
      return $object;
    }
    throw new \Exception("Invalid configuration");
  }
}

if(!function_exists('object_build')) {
  function object_build($settings, $key = 'provider')
  {
    $provider   = @$settings[$key];
    $reflection = new ReflectionClass($provider);
    if($object  = $reflection->newInstance()) {
      object_configure($object, $settings);
    }
    return $object;
  }
}

if(!function_exists('object_method')) {
  function object_method($object, $name, $params)
  {
    if(method_exists($object, $name)) {
      $multiple = false;
      if(is_array($params)) {
        $key = array_keys($params)[0];
        $multiple = is_array($params[$key]);
      }
      if(is_array($params) && $multiple) {
        foreach($params as $param) {
          call_user_func_array ([ $object, $name ], $param);
        }
      } else {
        call_user_func_array([ $object, $name ], $params);
      }
    }
  }
}

if(!function_exists('dd')) {
  function dd(...$variables)
  {
    echo '<pre style="background-color:#f1f1f1;border:1px solid #ddd;padding:10px;">';
    foreach($variables as $variable) {
      echo var_dump($variable);
    }
    die('</pre>');
  }
}
