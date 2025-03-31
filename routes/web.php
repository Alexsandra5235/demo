<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;



Route::middleware(UserMiddleware::class)->group(function () {

Route::get('/logout', [ProfileController::class, 'logout'])->name('logout');

Route::get('/sign',[ProfileController::class,'sign'])->name('sign');

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::post('/sign',[ProfileController::class,'login'])->name('login');

Route::get('/register', [ProfileController::class,'register'])->name('register');

Route::post('/register',[ProfileController::class,'store'])->name('store.register');

});

Route::middleware(AuthMiddleware::class)->group(function () {

    Route::get('/profile/{id}', [ProfileController::class, 'profile'])->name('profile');

    Route::put('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');

});

