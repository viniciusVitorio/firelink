<?php

use Firelink\Facades\Route;
use Firelink\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);