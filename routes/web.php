<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MailController;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Controllers\MovieController;

Route::middleware([UserMiddleware::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::get('/movies/{movie}', [MovieController::class, 'movie'])->name('movies');
});

Route::middleware([GuestMiddleware::class])->group(function () {
    Route::get('/register', [RegisterController::class, 'show']);
    Route::post('/register', [RegisterController::class, 'register'])->name('register');

    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::get('/verify-email/{token}', [MailController::class, 'verifyEmail'])->name('verify-email');
