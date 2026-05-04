<?php

namespace Firelink\Http\Controllers;

class HomeController
{
    public function index()
    {
        ember('welcome');
    }
}