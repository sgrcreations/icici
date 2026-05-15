<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IciciController;

Route::get('/', function () {
    return view('welcome');
});

Route::match(['get', 'post'], '/icici/callback', [IciciController::class, 'callback']);
