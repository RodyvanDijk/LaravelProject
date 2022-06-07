<?php

use App\Models\Category;
use App\Models\Game;
use Gloudemans\Shoppingcart\Facades\Cart;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');

    $this->category = Category::factory()->create();
    $this->game = Game::factory()->create();

    Cart::add(
        $this->game->id,
        $this->game->game,
        1,
        $this->game->price,
        0,
        ['category_name' => $this->game->category->name, 'description' => $this->game->description]
    );

    $content = Cart::content();

    foreach ($content as $row) {
        $this->rowId = $row->rowId;
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

test('update product in cart', function () {

    $newQty = 5;

    $this->postJson(route('cart.update', ['rowId' => $this->rowId, 'newQty' => $newQty]), ['rowId' => $this->rowId, 'newQty'=> $newQty])
        ->assertRedirect(route('cart.index'));

    $this->get(route('cart.index'))
        ->assertViewIs('open.cart')
        ->assertDontSee('Winkelwagen (' . 1 . ')')
        ->assertSee('Winkelwagen (' . 5 . ')');


})->group('Cart', 'CartUpdate');
