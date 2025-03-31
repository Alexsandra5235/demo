<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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
    Route::get('/profile/{id}/info',[ProfileController::class,'info'])->name('info');
    Route::get('/profile/{id}/products',[ProfileController::class,'showProducts'])->name('product.show');
    Route::get('/search',[HomeController::class,'search'])->name('search');

});

Route::middleware(AuthMiddleware::class)->group(function () {

    Route::get('/profile/{id}', [ProfileController::class, 'profile'])->name('profile');
    Route::put('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}/edit/avatar', [ProfileController::class, 'editAvatar'])->name('profile.edit.avatar');
    Route::get('/product/add', [ProductController::class, 'add'])->name('product.add');
    Route::post('/product/add', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{id}/edit', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}/delete', [ProductController::class, 'delete'])->name('product.delete');
    Route::delete('/profile/{id}/delete', [ProfileController::class, 'delete'])->name('profile.delete');

});

