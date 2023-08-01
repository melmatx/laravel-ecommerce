<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,customer']);
    }

    public function index()
    {
        $cartProducts = auth()->user()->cart->products;

        return view('cart', [
            "cartProducts" => $cartProducts->sortByDesc('id'),
            "total" => $this->getTotal(),
        ]);
    }

    public function addToCart(int $productId)
    {
        $cart = auth()->user()->cart;
        $product = Product::find($productId);
        $cartProduct = $cart->products()->where('product_id', $productId);

        if ($product->quantity <= 0) {
            return redirect()->back()->with('cart-error', 'Product is out of stock!');
        }

        if ($cartProduct->exists()) {
            return redirect()->back()->with('cart-added', 'Product already in cart!');
        }

        $cart->products()->create(["product_id" => $productId]);

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

    public function clearCart()
    {
        $cart = auth()->user()->cart;

        $cart->products()->delete();

        return redirect()->back();
    }

    public function getTotal()
    {
        $cartProducts = auth()->user()->cart->products;

        $total = 0;
        foreach ($cartProducts as $cartProduct) {
            $total += $cartProduct->product->price * $cartProduct->quantity;
        }

        return $total;
    }

    public function checkout()
    {
        $cartProducts = auth()->user()->cart->products;

        if ($cartProducts->isEmpty()) {
            return redirect()->route('cart.index')->with('checkout-error', 'Cart is empty!');
        }

        return redirect()->route('order.make', [
            "total" => $this->getTotal(),
        ]);
    }
}
