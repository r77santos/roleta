<?php

namespace App\Core\Facade;

use App\Core\Utils\Response as ServerResponse;

class Response
{
    public static $Path = '';

    public static function build()
    {
        return new static();
    }
    
    private function output()
    {
        return new ServerResponse();
    }

    public function download($path)
    {
        $this->output()->download($path);
    }

    public function view($template, $variables = [], $code = 200)
    {
        \extract($variables);
        \ob_start();
        include self::$Path .
                      $template . '.php';
        $this->text(ob_get_clean(), $code);
    }

    public function json($payload, $code = 200)
    {
        $this->output()->status($code)
                       ->header('Content-Type', 'application/json')
                       ->printText(\json_encode($payload));
    }

    public function text($payload, $code = 200)
    {
        $this->output()->status($code)
                       ->header('Content-Type', 'text/html; charset=utf-8')
                       ->printText($payload);
    }
}
