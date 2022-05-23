<?php

namespace App\Http\Controllers\Open\Cart;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::content();
        $cart_totalPrice = Cart::priceTotal();

        return view('open.cart', compact('cart', 'cart_totalPrice'));
    }

    public function store(Request $request) {

        $game = Game::findOrFail($request->input('game_id'));
        Cart::add(
            $game->id,
            $game->game,
            $request->input('quantity'),
            $game->price,
            0,
            ['category_name' => $game->category->name, 'description' => $game->description]
        );

        return redirect()->route('cart.index');
    }

    public function delete(Request $request) {
        $rowId = $request->input('rowId');

        Cart::remove($rowId);

        return redirect()->route('cart.index');
    }
}
