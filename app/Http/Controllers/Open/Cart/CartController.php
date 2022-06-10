<?php

namespace App\Http\Controllers\Open\Cart;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Display the cart with all the items added
     * @return View
     */
    public function index() : View
    {
        $cart = Cart::content();
        $cart_totalPrice = Cart::priceTotal();

        return view('open.cart', compact('cart', 'cart_totalPrice'));
    }

    /**
     * Add an item to the cart
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request) : RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|between:1,9',
        ]);

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

    /**
     * Change the quantity of an item in the cart
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request) : RedirectResponse
    {
        $rowId = $request->input('rowId');
        $newQty = $request->input('newQty');

        Cart::update($rowId, $newQty);

        return redirect()->route('cart.index');
    }

    /**
     * Delete a row from the cart
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Request $request) : RedirectResponse
    {
        $rowId = $request->input('rowId');

        Cart::remove($rowId);

        return redirect()->route('cart.index');
    }
}
