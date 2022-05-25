<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Open as Open;
use App\Http\Controllers\Admin as Admin;

use App\Http\Controllers\Admin;
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
Route::get('admin/category/{category}/delete', [Admin\Category\CategoryController::class, 'delete'])
    ->name('category.delete');
Route::resource('/admin/category', Admin\Category\CategoryController::class);

Route::post('/', [Open\Cart\CartController::class, 'store'])
    ->name('cart.store');

Route::post('/cart/{rowId}/update', [Open\Cart\CartController::class, 'update'])
    ->name('cart.update');

Route::post('/cart/{rowId}/delete', [Open\Cart\CartController::class, 'delete'])
    ->name('cart.delete');

Route::get('admin/games/{game}/delete', [Admin\Game\GameController::class, 'delete'])
    ->name('games.delete');
Route::resource('/admin/games', Admin\Game\GameController::class);
Route::resource('/admin/category', Admin\Category\CategoryController::class);
Route::resource('/admin/order', Admin\Order\OrderController::class);

Route::get('/games', [Open\Game\GameController::class, 'index'])
    ->name('open.games.index');

Route::get('/categories', [Open\Category\CategoryController::class, 'index'])
    ->name('open.categories.index');

Route::get('/cart', [Open\Cart\CartController::class, 'index'])
    ->name('cart.index');

Route::group(['middleware' => ['role:user|salesperson|admin']], function () {
    Route::resource('/orders', Admin\Order\OrderController::class);
});

Route::get('/login', function () {
    return view('auth.login');
});


Route::get('/dashboard', function () {
    return view('open.homepage');
})->middleware(['auth'])->name('dashboard');

Route::get('/user/create', [Admin\User\UserController::class, 'create']) ->
name('admin.users.create');
Route::get('/user', [Admin\User\UserController::class, 'index']) ->
    name('admin.users.index');
Route::get('/user/show', [Admin\User\UserController::class, 'show']) ->
name('admin.users.show');
Route::get('/user/update', [Admin\User\UserController::class, 'update']) ->
name('admin.users.edit');
Route::get('/user/{user}/delete', [Admin\User\UserController::class, 'delete']) ->
name('admin.users.delete');


Route::resource('admin/user', Admin\User\UserController::class);

require __DIR__.'/auth.php';
