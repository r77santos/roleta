<?php

namespace App\Core\Utils;

class Header
{
    public $Content;

    public function __construct()
    {
        $this->Content = self::all();
    }

    public function get($key)
    {
        if($this->has($key)) {
            return $this->Content[$key];
        }
    }

    public function has($key)
    {
        return self::check($this->Content, $key);
    }

    protected static function all()
    {
        if(function_exists('getallheaders')) {
            return \getallheaders();
        }
    }

    protected static function check($headers, $key)
    {
        return !empty($key) && isset($headers[$key]);
    }
}
