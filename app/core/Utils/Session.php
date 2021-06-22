<?php 

namespace App\Core\Utils;

class Session
{
    public static function start()
    {
        if(!self::check()) {
            \session_start();
        }
    }

    public static function end()
    {
        if(self::check()) {
            \session_destroy();
        }
    }

    public static function all()
    {
        if(self::check()) {
            return $_SESSION;
        }
    }

    public static function exists($key)
    {
        return self::check() && 
               isset($_SESSION[$key]);
    }

    public static function shift($key)
    {
        $value = null;
        if(self::exists($key)) {
            $value = self::get($key);
                     self::unset($key);
        }
        return $value;
    }

    public static function unset($key)
    {
        if(self::check()) {
           unset($_SESSION[$key]);
        }
    }

    public static function get($key)
    {
        if(self::exists($key)) {
            return $_SESSION[$key];
        }
    }

    public static function set($key, $value)
    {
        if(self::check()) {
            $_SESSION[$key] = $value;
        }
    }

    public static function select($keys)
    {
        $variables = array();
        if(self::check() && \is_array($keys)) {
            foreach($keys as $key) {
                $variables[$key] = self::get($key);
            }
        }
        return $variables;
    }

    public static function push($variables)
    {
        if(self::check() && \is_array($variables)) {
            foreach($variables as $key => $value) {
                self::set($key, $value);
            }
        }
    }

    public static function purges($keys)
    {
        $variables = array();
        if(self::check() && \is_array($keys))
        {
            foreach($keys as $key) {
                $variables[$key] = self::shift($key);
            }
        }
        return $variables;
    }

    public static function check()
    {
        return \session_status() == PHP_SESSION_ACTIVE;
    }
}
