<?php

use App\Events\MessageCreated;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Route::get('/message/created', function () {
//     broadcast(new MessageCreated('Hello World'));
// });

Route::get("/", [HomeController::class, 'index'])->name("home");
Route::post('logout', [HomeController::class, 'logout'])->name('logout');
Route::post('profile', [HomeController::class, 'profile'])->name('profile');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/search/hobby', [SearchController::class, 'searchHobby'])->name('search_hobby');

Route::get('/profile', [HomeController::class, 'profile'])->name('profile')->middleware('auth');

Route::post('/avatar/purchase', [AvatarController::class, 'purchase'])->name('avatar.purchase')->middleware('auth');
Route::post('/avatar/setProfile/{avatar}', [AvatarController::class, 'setProfile'])->name('avatar.setProfile');

Route::post('/topup', [UserController::class, 'topUp'])->name('user.topup');

Route::middleware('auth')->group(function () {
    Route::post('/send-request/{friendId}', [UserController::class, 'sendRequest'])->name('friend.send');
    Route::post('/friend/accept/{user}', [UserController::class, 'acceptFriend'])->name('friend.accept');
    Route::post('/remove-friend/{friendId}', [UserController::class, 'removeFriend'])->name('friend.remove');
});
