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

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            "status" => ["required", "string", "in:pending,processing,shipped,delivered,cancelled"],
        ]);

        // Update Customer Order
        $order->customerOrder()->update([
            "status" => $request->status
        ]);

        // Update Seller Order
        $order->update($request->all());

        return redirect()->back()->with('status-updated', 'Order status updated!');
    }

    public function makeOrder(Request $request)
    {
        $user = auth()->user();
        $cartProducts = $user->cart->products();

        if ($user->wallet < $request->total) {
            return redirect()->back()->with('checkout-error', 'Insufficient funds!');
        }

        // Make order for customer
        $customerOrder = Order::create([
            "user_id" => $user->id,
            "role" => "customer",
        ]);
        $cartProducts->each(function ($cartProduct) use ($customerOrder) {
            $cartProduct->product->decrement('stocks', $cartProduct->quantity);

            OrderProduct::create([
                "order_id" => $customerOrder->id,
                "product_id" => $cartProduct->product_id,
                "quantity" => $cartProduct->quantity,
                "price" => $cartProduct->product->price,
            ]);
        });

        // Make order for seller
        $cartProducts->get()->pluck('product.seller_id')->unique()->each(function ($sellerId) use ($customerOrder, $cartProducts) {
            $sellerOrder = Order::create([
                "user_id" => $sellerId,
                "role" => "seller",
                "customer_order_id" => $customerOrder->id,
            ]);

            $sellerProducts = $cartProducts->get()->pluck('product')->where('seller_id', $sellerId);

            $cartProducts->each(function ($cartProduct) use ($sellerProducts, $sellerOrder) {
                if ($sellerProducts->contains($cartProduct->product)) {
                    OrderProduct::create([
                        "order_id" => $sellerOrder->id,
                        "product_id" => $cartProduct->product->id,
                        "quantity" => $cartProduct->quantity,
                        "price" => $cartProduct->product->price,
                    ]);

                    $cartProduct->delete();
                }
            });
        });

        $user->wallet -= $request->total;
        $user->save();

        $cartProducts->delete();

        return redirect()->route('cart.index')->with('checkout-success', 'Checkout successful!');
    }
}
