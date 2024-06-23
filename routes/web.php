<?php

use App\Http\Controllers\Order\CartController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/sign-up', 'sign-up')->name('sign-up');
Route::view('/sign-in', 'sign-in')->name('sign-in');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::post('/auth/login', [UserController::class, 'login'])->name('auth.login');

Route::get('/', [ProductController::class, 'indexPage'])->name('product.index');
Route::get('/products', [ProductController::class, 'index']);
Route::get('/{product:slug}', [ProductController::class, 'show'])->name('product.show');

Route::middleware('auth')->group(function () {
    Route::get('/cart/products', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/products', [CartController::class, 'addToCart']);
    Route::delete('/cart/products/{product:slug}', [CartController::class, 'removeFromCart']);

    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/order', [OrderController::class, 'store']);
});

