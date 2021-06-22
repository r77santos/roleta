<?php

namespace App\Core\Utils;

class Container
{
    protected $methods;

    public function __construct()
    {
        $this->methods = [];
    }

    public function __set($key, $value)
    {
        $this->methods[$key] = $value;
    }

    public function isMethod($method)
    {
        return is_callable($this->__get($method));
    }

    public function __get($key)
    {
        if( isset($this->methods[$key]) ) {
            return $this->methods[$key];
        }
        throw new \Exception("{$key} don't exists");
    }

    public function exists($key)
    {
        return array_key_exists($key, $this->methods);
    }
    
    public function __call($key, $args)
    {
        if( $this->isMethod($key) ) {
            return call_user_func_array($this->__get($key), $args);
        }
    }
    
}
