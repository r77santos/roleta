<?php

namespace App\Middleware;

class Authorization
{
    protected $Container = null;

    public function __construct($container)
    {
        $this->Container = $container;
    }

    public function valueOf($key)
    {
        if($token = $this->decode()) {
            return $token->$key;
        }
    }

    public function validation()
    {
        if( !$person = $this->person() ) {
            $this->unauthorized();
        }
        return $this;
    }

    protected function unauthorized()
    {
        $this->Container->response()->json([
            'errors'  => [],
            'message' => 'Acesso negado',
        ], 401);
    }

    public function authorization()
    {
        return $this->Container->request()
                               ->header()
                               ->get('Authorization');
    }

    public function response()
    {
        if( $person = $this->validation()->person() ) {
            $this->Container->response()->json(
                $person, 200
            );
        }
    }

    public function person()
    {
        $sub = $this->valueOf('sub');

        return $this->Container->database('mysql')
                               ->select([ 'id', 'token' ])
                               ->from('accounts')
                               ->where('token', '=', $sub)
                               ->andWhere('enable', '=', 1)
                               ->first();
    }

    public function decode()
    {
        if($token = $this->token()) {
            return  $this->Container->jwt()->decode($token);
        }
    }

    public function token()
    {
        $bearer = $this->authorization();
        if( !$token = str_replace('Bearer ', '', $bearer) ) {
            $this->unauthorized();
        }
        return trim($token);
    }
}
