<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\WishlistProduct;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistProducts = auth()->user()->wishlist->products;

        return view("wishlist", [
            "wishlistProducts" => $wishlistProducts->sortByDesc('id'),
        ]);
    }

    public function addToWishlist(int $productId)
    {
        $wishlist = auth()->user()->wishlist;
        $product = Product::find($productId);
        $wishlistProduct = $wishlist->products()->where('product_id', $productId);

        if ($wishlistProduct->exists()) {
            return redirect()->back()->with('wishlist-added', 'Product already to wishlist!');
        }

        WishlistProduct::create([
            "wishlist_id" => $wishlist->id,
            "product_id" => $productId,
            "price" => $product->price,
        ]);

        return redirect()->back()->with('wishlist-added', 'Product added to wishlist!');
    }

    public function removeFromWishlist(int $productId)
    {
        $wishlist = auth()->user()->wishlist;
        $wishlistProduct = $wishlist->products()->where('product_id', $productId);

        $wishlistProduct->delete();

        return redirect()->back();
    }
}
