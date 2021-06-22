<?php

namespace App\Core\Utils;

class Settings
{
    protected $Path;

    protected $Settings;

    public function __construct($path)
    {
        $this->Path = $path;
        $this->Settings = [];
    }

    public function getRealPathFile()
    {
        return realpath($this->Path);
    }

    protected function walk($elements, $closure)
    {
		$iterator = [];
        foreach($elements as $key => $value) {
            $closure($value, $key, $iterator);
        }
		return $iterator;
    }
    
    public function check()
    {
        $pathOfFileSettings = $this->getRealPathFile();

        return \file_exists($pathOfFileSettings) &&
               \is_readable($pathOfFileSettings) &&
               \is_file($pathOfFileSettings);
    }

    public function load()
    {
        $settings = [];
        if(!$this->check()) {
            throw new \Exception("Error in File: {$this->Path}" );
        }
        return $this->Settings = require($this->getRealPathFile());
    }

    public function all()
    {
        return $this->Settings;
    }

    public function byDefault($key, $value)
    {
        if($this->exists($key)) {
            $value = $this->find($key);
        }

        return $value;
    }

    public function find($key)
    {
        $env  = $this->Settings;
        $keys = \explode('.', $key);
        $this->walk($keys, function($key) use(&$env) {
            $env = isset($env[$key]) ? $env[$key] : null;
        });
        return $env;
    }

    public function exists($key)
    {
        $exists = null;
        $env    = $this->Settings;
        $keys   = \explode('.', $key);
        $this->walk($keys, function($key) use(&$env, &$exists) {
            $exists = \in_array($key, \array_keys($env));
            $env    =  isset($env[$key]) ? $env[$key] : null;
        });
        return is_bool($exists) && $exists;
    }
}
