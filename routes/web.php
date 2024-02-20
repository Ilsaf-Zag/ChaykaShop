<?php

use Illuminate\Auth\GenericUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');
Route::resource('products', \App\Http\Controllers\ProductController::class);
Route::resource('sizes', \App\Http\Controllers\SizeController::class);
Route::resource('messages', \App\Http\Controllers\MessageController::class);
Route::resource('chats', \App\Http\Controllers\ChatController::class);

Route::get('sizes', [\App\Http\Controllers\SizeController::class, 'index']);

Route::get('faq', [\App\Http\Controllers\FaqController::class, 'index'])->name('faq.index');

Route::post('cart/store', [\App\Http\Controllers\CartController::class, 'addProduct'])->name('cart.store');
Route::delete('cart/{cart}', [\App\Http\Controllers\CartController::class, 'removeProduct'])
    ->name('cart.destroy');

Route::name('admin.')
    ->middleware('auth')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', \App\Http\Controllers\Admin\HomeController::class)->name('home');
        Route::resource('/users', \App\Http\Controllers\UserController::class);
        Route::resource('/products', \App\Http\Controllers\ProductController::class);
        Route::resource('/chats', App\Http\Controllers\Admin\Chat\ChatController::class);

    });

Route::inertia('/signup', 'Authentication/SignupView');
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::controller(\App\Http\Controllers\AuthController::class)
    ->middleware('guest')
    ->group(function () {
        Route::get('/login', 'index');
        Route::post('/login', 'login')->name('login');

    });
