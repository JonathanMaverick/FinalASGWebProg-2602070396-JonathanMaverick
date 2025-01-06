<?php

use App\Events\MessageCreated;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    MessageCreated::dispatch('testing?');
    return view('welcome');
});

Route::get('/message/created', function () {
    broadcast(new MessageCreated('Hello World'));
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

// Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
