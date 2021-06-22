<?php

namespace App\Core\Facade;

use App\Core\Utils\Settings as ServerSettings;

class Settings
{
    public static $Path = '';

    public static function build($file)
    {
        $settings = self::config("/{$file}.php");
        $settings->load();
        return $settings;
    }

    private static function config($file)
    {
        return new ServerSettings(self::$Path.$file);
    }
}
