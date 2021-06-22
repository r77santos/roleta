<?php 

namespace App\Core\Utils;

class Server
{
    public static function has($key)
    {
        return isset($_SERVER[$key]);
    }

    public static function get($key)
    {
        if(self::has($key)) {
            return $_SERVER[$key];
        }
    }

    public static function checkHttps($value)
    {
        return self::get('HTTPS') == $value;
    }

    public static function checkPort($value)
    {
        return self::port() == ((int) $value);
    }

    public static function port()
    {
        return self::get('SERVER_PORT');
    }

    public static function hostname()
    {
        return self::get('SERVER_NAME');
    }

    public static function address()
    {
        $port = '';
        $protocol = 'http';
        $hostname = self::hostname();

        if(self::checkHttps('on')) {
            $protocol = 'https';
        }

        if(!self::checkPort(80)) {
            $port = ':' . self::port();
        }

        return "{$protocol}://{$hostname}{$port}";
    }
}
