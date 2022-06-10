<?php

namespace App\Http\Controllers\Open\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderRow;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use function auth;
use function to_route;
use function view;

class OrderController extends Controller
{
    /**
     * Display a listing of a user's placed orders
     * @return View | RedirectResponse
     */
    public function index() : View | RedirectResponse
    {
        if(isset(auth()->user()->id)) {
            $user_id = auth()->user()->id;
            $user_orders = DB::table('orders')->where('user_id', '=', $user_id)->get();

            $order_rows = [];
            foreach ($user_orders->reverse() as $order) {
                $order_rows[] = DB::table('order_rows')->where('order_id', '=', $order->id)->get();
            }

            return view('user.order.index', compact('order_rows'));
        } else {
            return to_route('login');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request) : RedirectResponse
    {
        if(isset($request->user_id)) {
            $order = new Order();
            $order->user_id = $request->user_id;
            $order->save();

            $cartContent = Cart::content();

            foreach ($cartContent as $content) {
                $orderrow = new OrderRow();
                $orderrow->order_id = $order->id;
                $orderrow->game_id = $content->id;
                $orderrow->quantity = $content->qty;
                $orderrow->save();
            }

            Cart::destroy();

            return to_route('cart.index')->with('message', 'Bestelling Geplaatst');
        } else {
            return to_route('login')->with('status', 'U moet eerst inloggen om een bestelling te plaatsen.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
