<?php

use Firelink\Http\Request;
use Firelink\Route\Route;
use \Firelink\Controller\HomeController;

require __DIR__ . '/../vendor/autoload.php';

$request = new Request();

Route::get('/', [HomeController::class, 'index']);

Route::dispatch($request);