<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders', [
            "orders" => auth()->user()->orders,
        ]);
    }

    public function makeOrder()
    {
        $user = auth()->user();
        $cart = $user->cart;

        $newOrder = Order::create([
            "user_id" => $user->id,
        ]);

        $cart->products->each(function ($cartProduct) use ($newOrder) {
            OrderProduct::create([
                "order_id" => $newOrder->id,
                "product_id" => $cartProduct->product_id,
                "quantity" => $cartProduct->quantity,
                "price" => $cartProduct->product->price,
            ]);
        });

        $cart->products()->delete();

        return redirect()->route('cart.index')->with('checkout-success', 'Checkout successful!');
    }
}
