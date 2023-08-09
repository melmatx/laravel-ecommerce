<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function browse() {
        $categories = Category::active()->get();
        $products = Product::active()->get()
            ->where('stocks', '>', 0)
            ->sortBy('id');

        if ($products->isNotEmpty()) {
            $product = $products->random();
        }

        if ($categories->isNotEmpty()) {
            $category = $categories->random();
        }

        if (auth()->check() && in_array(auth()->user()->role, ["admin", "seller"])) {
            $seller = auth()->user();
        }

        return view('browse', [
            'products' => $products,
            'featuredProduct' => $product ?? null,
            'featuredCategory' => $category ?? null,
            'seller' => $seller ?? null,
        ]);
    }

    public function categories() {
        return view('categories', [
            'categories' => Category::active()->get(),
        ]);
    }
}
