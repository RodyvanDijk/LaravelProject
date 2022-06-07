<?php

use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use App\Models\Game;
use App\Models\OrderRow;
use Carbon\Carbon;
use \Pest\Laravel;
use Tests\TestCase;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->order = Order::factory()->create();
    $this->category = Category::factory()->create();
    $this->game = Game::factory()->create();
    $this->orderrow = OrderRow::factory()->create();
});

test('an orderrow id is an int', function() {
    expect($this->orderrow->id)->toBeInt();
})->group('Order', 'OrderRowUnit');

test('an orderrow order_id is an int', function() {
    expect($this->orderrow->order_id)->toBeInt();
})->group('Order', 'OrderRowUnit');

test('an orderrow game_id is an int', function() {
    expect($this->orderrow->game_id)->toBeInt();
})->group('Order', 'OrderRowUnit');

test('an orderrow quantity is an int', function() {
    expect($this->orderrow->quantity)->toBeInt();
})->group('Order', 'OrderRowUnit');

test('an orderrow created_at is a datetime', function() {
    expect($this->orderrow->created_at)->toBeInstanceOf(Carbon::class);
})->group('Order', 'OrderRowUnit');

test('an orderrow updated_at is a datetime', function() {
    expect($this->orderrow->updated_at)->toBeInstanceOf(Carbon::class);
})->group('Order', 'OrderRowUnit');

test('an orderrow is part of a order', function() {
    expect($this->orderrow->order)->toBeInstanceOf(Order::class);
})->group('Order', 'OrderRowUnit');
