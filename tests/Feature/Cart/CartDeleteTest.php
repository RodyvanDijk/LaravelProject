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
        rand(1, 9),
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
//test('there is a product in cart', function () {
//
//    $this->get(route('cart.index'))
//        ->assertViewIs('open.cart')
//        ->assertSee('Winkelwagen (' . Cart::count() . ')')
//        ->assertSee($this->name)
//        ->assertSee($this->category_name)
//        ->assertSee($this->description)
//        ->assertSee($this->quantity)
//        ->assertSee($this->price * $this->quantity);
//
//    Cart::destroy();
//
//})->group('Cart', 'CartDelete');

test('delete product in cart', function () {

    $this->postJson(route('cart.delete', ['rowId' => $this->rowId]), ['rowId' => $this->rowId])
        ->assertRedirect(route('cart.index'));

    $this->get(route('cart.index'))
        ->assertViewIs('open.cart')
        ->assertSee('Winkelwagen (' . Cart::count() . ')')
        ->assertDontSee($this->name)
        ->assertDontSee($this->category_name)
        ->assertDontSee($this->description)
        ->assertDontSee('Aantal' .$this->quantity)
        ->assertDontSee($this->price * $this->quantity);

})->group('Cart', 'CartDelete');
