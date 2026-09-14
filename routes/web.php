<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [Home::class, 'form']);

Route::get('/dashboard', [Dashboard::class, 'form']);

Route::resource('/rooms', RoomController::class);

Route::resource('/users', UserController::class)->except(['create', 'edit', 'show']);
