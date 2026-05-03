<?php

namespace Firelink\Http;

class Request
{
    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}