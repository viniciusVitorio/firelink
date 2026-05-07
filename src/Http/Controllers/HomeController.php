<?php

namespace Firelink\Http\Controllers;

use Firelink\Http\Request;
use Firelink\Http\Response;

class HomeController
{
    public function index(Request $request, Response $response)
    {
        ember('welcome');
    }
}