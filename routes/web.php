<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Open as Open;
use App\Http\Controllers\Admin as Admin;

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

Route::resource('/admin/games', Admin\Game\GameController::class);
Route::resource('/admin/category', Admin\Category\CategoryController::class);

Route::get('/games', [Open\Game\GameController::class, 'index'])
    ->name('open.games.index');

Route::get('/categories', [Open\Category\CategoryController::class, 'index'])
    ->name('open.categories.index');

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/cart', function () {
    return view('open.cart');
});



Route::get('/dashboard', function () {
    return view('open.homepage');
})->middleware(['auth'])->name('dashboard');



require __DIR__.'/auth.php';
