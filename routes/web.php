<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/register', [ProfileController::class,'register'])->name('register');

Route::get('/sign',[ProfileController::class,'sign'])->name('sign');

Route::post('/register',[ProfileController::class,'store'])->name('store.register');

Route::middleware('auth')->group(function () {
    Route::get('/profile/{id}', [ProfileController::class, 'profile'])->name('profile');
});
