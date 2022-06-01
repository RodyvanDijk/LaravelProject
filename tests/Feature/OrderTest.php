<?php

use App\Models\Order;
use App\Models\OrderRow;
use App\Models\User;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->seed('CategorySeeder');
    $this->seed('GameSeeder');
    $this->seed('OrderSeeder');
    $this->order = Order::factory()->create();
    $this->orderrow = OrderRow::factory()->create();
});

//test('has cart page', function () {
//    $this->withoutExceptionHandling();
//    $response = $this->get('/cart');
//
//    $response->assertStatus(200);
//})->group('CartAndOrderTest');

test('can be added to order', function () {
    $user = User::find(1);
    $order = Order::factory()->make(['user_id' => 1]);

    Laravel\be($user)
        ->postJson(route('orders.store'), $order->toArray())
        ->assertRedirect(route('cart.index'));

    $this->assertDatabaseHas('orders',[
        'user_id' => 1
    ]);
})->group('CartAndOrderTest');

test('can be added to orderrow', function () {
    $user = User::find(1);
//    $order = Order::factory()->make(['user_id' => 1]);
    $orderrow = OrderRow::factory()->make(['order_id' => 1,'game_id' => 1, 'quantity' => 5]);

    Laravel\be($user)
        ->postJson(route('orders.store'), $orderrow->toArray())
        ->assertRedirect(route('cart.index'));

    $this->assertDatabaseHas('order_rows',[
        'order_id' => 1,
        'game_id' =>  1,
        'quantity' => 5
    ]);
//    $this->assertDatabaseHas('orders',[
//        'user_id' => 1
//    ]);
})->group('CartAndOrderTest');
