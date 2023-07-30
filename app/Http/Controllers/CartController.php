<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartProducts = auth()->user()->cart->products;

        return view('cart', [
            "cartProducts" => $cartProducts->sortByDesc('id'),
            "total" => $cartProducts->sum('product.price'),
        ]);
    }

    public function addToCart(int $productId)
    {
        $cart = auth()->user()->cart;

        $cart->products()->firstOrCreate(
            ["product_id" => $productId],
            ["cart_id" => $cart->id]
        )->increment('quantity');

        return redirect()->back()->with('cart-added', 'Product added to cart!');
    }

    public function removeFromCart(int $productId)
    {
        $cart = auth()->user()->cart;
        $cartProduct = $cart->products()->where('product_id', $productId);

        $cartProduct->delete();

        return redirect()->back();
    }

    public function updateQuantity(Request $request, int $productId)
    {
        $cart = auth()->user()->cart;
        $cartProduct = $cart->products()->where('product_id', $productId);

        $cartProduct->update([
            "quantity" => $request->quantity,
        ]);

        return redirect()->back();
    }

    public function checkout()
    {
        $cartProducts = auth()->user()->cart->products;

        if ($cartProducts->isEmpty()) {
            return redirect()->route('cart.index')->with('checkout-error', 'Cart is empty!');
        }

        return redirect()->route('order.add')->with(['cartProducts' => $cartProducts]);
    }
}
