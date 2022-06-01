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
    $this->game = Game::factory()->create();

    Cart::add(
        $this->game->id,
        $this->game->game,
        rand(1, 9),
        $this->game->price,
        0,
        ['category_name' => $this->game->category->name, 'description' => $this->game->description]
    );

    $content = Cart::content();

    foreach ($content as $row) {
        $this->name = $row->name;
        $this->category_name = $row->options->category_name;
        $this->description = $row->options->description;
        $this->quantity = $row->qty;
        $this->price = $row->price;
    }
});

afterEach(function () {
    Cart::destroy();
});

test('anyone can see an empty cart page', function () {

    $this->get(route('cart.index'))
        ->assertViewIs('open.cart')
        ->assertSee('Winkelwagen (' . Cart::count() . ')');

})->group('Cart', 'CartIndex');

test('anyone can see a cart page with items', function () {

    $this->get(route('cart.index'))
        ->assertViewIs('open.cart')
        ->assertSee('Winkelwagen (' . Cart::count() . ')')
        ->assertSee($this->name)
        ->assertSee($this->category_name)
        ->assertSee($this->description)
        ->assertSee($this->quantity)
        ->assertSee($this->price * $this->quantity);

})->group('Cart', 'CartIndex');
