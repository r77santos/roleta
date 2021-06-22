<?php

namespace App\Core\Facade;

use App\Core\Utils\Header as ServerHeader;
use App\Core\Utils\Request as ServerRequest;
use App\Core\Utils\FileUpload as ServerUpload;

class Request
{
    public static function build()
    {
        return new static();
    }
    
    public function header()
    {
        return new ServerHeader();
    }

    public function upload($key)
    {
        return (new ServerUpload($key));
    }

    public function get($keys)
    {
        return ServerRequest::get($keys);
    }

    public function post($keys)
    {
        return ServerRequest::post($keys);
    }
    
    public function json($keys)
    {
        return ServerRequest::json($keys);
    }

    public function only($keys)
    {
        return ServerRequest::request($keys);
    }

    public function field($key)
    {
        return ServerRequest::request([ $key ])[$key];
    }

    public function files($key)
    {
        return $this->upload($key)->getFilesUploads();
    }

    public function exists($key)
    {
        return ServerRequest::exists($_REQUEST, $key);
    }

    public function nullable($key)
    {
        return ServerRequest::nullable($_REQUEST, $key);
    }

}
