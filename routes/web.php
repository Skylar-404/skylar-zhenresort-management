<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [Home::class, 'form']);
