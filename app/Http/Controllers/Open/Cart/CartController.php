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
        $quantity = $request->input('quantity');
        $max = 9;

        foreach (Cart::content() as $row)
        {
            if($row->id == $game->id) {
                if($quantity + $row->qty > $max) {
                    $quantity = $max - $row->qty;
                }
            }
        }

        if ($quantity == 0) {
            return redirect()->route('cart.index');
        } else {
            Cart::add(
                $game->id,
                $game->game,
                $quantity,
                $game->price,
                0,
                ['category_name' => $game->category->name, 'description' => $game->description]
            );

            return redirect()->route('cart.index');
        }
    }

    public function update(Request $request) {
        $rowId = $request->input('rowId');
        $newQty = $request->input('newQty');

        Cart::update($rowId, $newQty);

        return redirect()->route('cart.index');
    }

    public function delete(Request $request) {
        $rowId = $request->input('rowId');

        Cart::remove($rowId);

        return redirect()->route('cart.index');
    }
}
