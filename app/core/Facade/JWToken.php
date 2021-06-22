<?php

namespace App\Core\Facade;

use Firebase\JWT\JWT;

class JWToken
{
    protected $options = [
        'key' => JWT_KEY,
        'alg' => JWT_ALG,
    ];

    public function option($key)
    {
        return $this->__get($key);
    }

    public function __set($key, $value)
    {
        $this->options[$key] = $value;
    }

    public function __get($key)
    {
        if(isset($this->options[$key])) {
            return $this->options[$key];
        }
    }

    public function encode($decode)
    {
        $key = $this->option('key');
        return JWT::encode($decode, $key);
    }

    public function decode($encode)
    {
        $key = $this->option('key');
        $alg = $this->option('alg');
        return JWT::decode($encode, $key, [ $alg ]);
    }

}
