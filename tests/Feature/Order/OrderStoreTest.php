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

test('user can place an order', function () {
    for($i = 0; $i < 3; $i++) {
        Cart::add(
            $this->game[$i]->id,
            $this->game[$i]->game,
            5,
            $this->game[$i]->price,
            0,
            ['category_name' => $this->game[$i]->category->name, 'description' => $this->game[$i]->description]
        );
    }

    $user = User::find(1);

    Laravel\be($user)
        ->postJson(route('orders.store'), ['user_id' => 1])
        ->assertRedirect(route('cart.index'));

    $this->assertDatabaseHas('orders', [
        'id' => 1,
        'user_id' => 1
    ]);

    for($i = 0; $i < 3; $i++) {
        $this->assertDatabaseHas('order_rows', [
            'order_id' => 1,
            'game_id' => $this->game[$i]->id,
            'quantity' => 5
        ]);
    }

    Cart::destroy();

})->group('Order', 'OrderStore');

test('guest can not place an order', function () {

    $this->postJson(route('orders.store'))
    ->assertRedirect(route('login'));

})->group('Order', 'OrderStore');
