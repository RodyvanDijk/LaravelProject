<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('open.homepage');
});

Route::get('/games', function () {
    return view('open.games');
});

Route::get('/categories', function () {
    return view('open.category');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/cart', function () {
    return view('open.cart');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
