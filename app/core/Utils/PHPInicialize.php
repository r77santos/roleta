<?php

namespace App\Core\Utils;

class PHPInicialize
{
    public $configurations = [];

    public function __get($key)
    {
        if($this->configurations[$key]) {
            return $this->configurations[$key];
        }
    }

    public function __set($key, $value)
    {
        if(!isset($this->configurations[$key])) {
            $this->configurations[$key] = array();
        }
        array_push($this->configurations[$key], $value);
    }

    public function add($key, $params)
    {
        $this->__set($key, is_array($params) ? 
                            $params : [ $params ]);
    }

    public function execute()
    {
        foreach($this->configurations as $name => $params) {
            foreach($params as $values) {
                if(is_callable($name)) {
                    call_user_func_array($name, $values);
                }
            }
        }
    }
}