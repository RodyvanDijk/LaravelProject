<?php

use App\Models\Category;
use App\Models\Game;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');

    $this->category = Category::factory()->create();
    $this->game = Game::factory(3)->create();
});


test('user can see order page', function () {

    $user = User::find(1);

    Laravel\be($user)
        ->get(route('orders.index'))
        ->assertSee('Bestellingen');

})->group('Order', 'OrderIndex');

test('admin can see order page', function () {

    $admin = User::find(3);

    Laravel\be($admin)
        ->get(route('orders.index'))
        ->assertSee('Bestellingen');

})->group('Order', 'OrderIndex');

test('salesperson can see order page', function () {

    $salesperson = User::find(2);

    Laravel\be($salesperson)
        ->get(route('orders.index'))
        ->assertSee('Bestellingen');

})->group('Order', 'OrderIndex');

test('guest cant see order page', function () {

        $this->get(route('orders.index'))
            ->assertRedirect('login');

})->group('Order', 'OrderIndex');
