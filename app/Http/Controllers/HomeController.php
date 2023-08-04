<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function browse() {
        $category = Category::active()->get();
        $products = Product::active()->get()
            ->where('stocks', '>', 0)
            ->sortBy('id');

        if ($products->isNotEmpty()) {
            $product = $products->random();
            $category = $category->random();
        }

        return view('browse', [
            'products' => $products,
            'featuredProduct' => $product ?? null,
            'featuredCategory' => $category ?? null,
        ]);
    }

    public function categories() {
        return view('categories', [
            'categories' => Category::active()->get(),
        ]);
    }
}
