<?php

use Carbon\Carbon;
use App\Models\Order;
use App\Models\User;
use \Pest\Laravel;
use Tests\TestCase;

beforeEach(function (){
    $this->user = User::factory()->create();
    $this->order = Order::factory()->create();
});

test('an order id is an int', function() {
    expect($this->order->id)->toBeInt();
})->group('Order', 'OrderUnit');

test('an order user_id is an int', function() {
    expect($this->order->user_id)->toBeInt();
})->group('Order', 'OrderUnit');

test('an order created_at is a datetime', function() {
    expect($this->order->created_at)->toBeInstanceOf(Carbon::class);
})->group('Order', 'OrderUnit');

test('an order updated_at is a datetime', function() {
    expect($this->order->updated_at)->toBeInstanceOf(Carbon::class);
})->group('Order', 'OrderUnit');

