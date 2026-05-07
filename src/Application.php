<?php

namespace Firelink;

use Firelink\Facades\Route;
use Firelink\Http\Request;
use Firelink\Http\Response;

class Application
{
    public function run()
    {
        $request = new Request();
        $response = new Response();

        require __DIR__ . '/../routes/web.php';

        Route::dispatch($request, $response);
    }
}