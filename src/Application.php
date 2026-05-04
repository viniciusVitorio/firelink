<?php

namespace Firelink;

use Firelink\Facades\Route;
use Firelink\Http\Request;

class Application
{
    public function run()
    {
        $request = new Request();

        require __DIR__ . '/../routes/web.php';

        Route::dispatch($request);
    }
}