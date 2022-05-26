<?php

namespace App\Custom;

class ApiGuard
{
    private $endpoint;
    private $key;

    public function __construct(string $end)
    {
        $this->endpoint = 'localhost:8001/api/'.$end;
        // $this->endpoint = 'https://api.deadygo.com/api/'.$end;
        $this->key = 'Bearer 22|YcA7x2NY33vESYl73wmKmrW6iyrUYI1AM5Fow0aQ';
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }
}