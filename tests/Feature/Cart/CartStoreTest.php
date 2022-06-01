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
});

test('anyone can add a game to the cart', function () {
    $randomQty = rand(1,9);

    $this->postJson(route('cart.store'), ['game_id' => $this->game->id, 'quantity' => $randomQty])
        ->assertRedirect(route('cart.index'));

    $this->get(route('cart.index'))
        ->assertViewIs('open.cart')
        ->assertSee('Winkelwagen (' . $randomQty . ')')
        ->assertSee($this->game->game)
        ->assertSee($this->game->category->name)
        ->assertSee($this->game->description);

    Cart::destroy();

})->group('Cart', 'CartStore');
