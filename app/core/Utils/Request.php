<?php 

namespace App\Core\Utils;

class Request
{
    public static function get($keys)
    {
        return self::check($_GET, $keys);
    }

    public static function post($keys)
    {
        return self::check($_POST, $keys);
    }

    public static function request($keys)
    {
        return self::check($_REQUEST, $keys);
    }

    public static function json($keys)
    {
        if($input  = self::buffer()) {
           $input = (array) $input; 
        }
        return self::check($input, $keys);
    }

    public static function exists(&$variable)
    {
        return isset($variable) === true;
    }

    public static function nullable(&$variable)
    {
        return !self::exists($variable) || empty($variable);
    }

    public static function buffer()
    {
        return json_decode(file_get_contents('php://input'));
    }

    public static function valueOf(&$variable, $default)
    {
        return !self::nullable($variable) ? $variable : $default;
    }

    public static function check(&$variable, $keys)
    {
        $request = [];
        foreach ($keys as $key) {
            $request[$key] = self::valueOf($variable[$key], null);
        }
        return $request;
    }

}
