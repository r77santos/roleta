<?php

namespace App\Core\Utils;

use App\Core\Utils\Status;

class Response
{
    protected $code;

    protected $headers = [];

    public function __construct()
    {
        $this->status(200);
    }

    public function status($code)
    {
        if(Status::exists($code)) {
            $this->code = $code;
        }
        return $this;
    }

    public function header($key, $value)
    {
        $this->headers[$key] = $value;
        return $this;
    }

    protected function readFile($path)
    {
        \flush();
        \ob_clean();
        return \readfile($path);
    }

    protected function prepare()
    {
        \header(Status::header($this->code), true, $this->code);
        foreach($this->headers as $key => $value) {
            \header("{$key}:{$value}");
        }
        return $this;
    }

    public function printText($content)
    {
        $this->prepare();
        die($content);
    }
    
    public function download($path)
    {
        $ext  = '';
        $name = '';
        $size = \filesize($path);

        if($fileinfo = \pathinfo($path)) {
            $name = @$fileinfo['basename'];
            $ext  = @$fileinfo['expension'];
        }
        
        $this->header('Content-Length', $size)
             ->header('Content-Type', "application/{$ext}")
             ->header('Content-Disposition', "attachment; filename=\"{$name}\"")
             ->prepare();

        die($this->readFile($path));
    }
}
