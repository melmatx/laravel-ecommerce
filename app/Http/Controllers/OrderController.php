<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('orders', [
            "orders" => auth()->user()->orders,
        ]);
    }

    public function makeOrder(Request $request)
    {
        $user = auth()->user();
        $cartProducts = $user->cart->products();

        if ($user->wallet < $request->total) {
            return redirect()->back()->with('checkout-error', 'Insufficient funds!');
        }

        $newOrder = Order::create([
            "user_id" => $user->id,
        ]);
        $cartProducts->each(function ($cartProduct) use ($newOrder) {
            $cartProduct->product->decrement('quantity', $cartProduct->quantity);

            OrderProduct::create([
                "order_id" => $newOrder->id,
                "product_id" => $cartProduct->product_id,
                "quantity" => $cartProduct->quantity,
                "price" => $cartProduct->product->price,
            ]);
        });

        $user->wallet -= $request->total;
        $user->save();

        $cartProducts->delete();

        return redirect()->route('cart.index')->with('checkout-success', 'Checkout successful!');
    }
}
