<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function browse() {
        $products = Product::all()
            ->where('stocks', '>', 0)
            ->sortByDesc('id');

        if ($products->isNotEmpty()) {
            $product = $products->random();
            $category = $products->random()->category;
        }

        return view('browse', [
            'products' => $products,
            'featuredProduct' => $product ?? null,
            'featuredCategory' => $category ?? null,
        ]);
    }

    public function categories() {
        return view('categories', [
            'categories' => Category::all(),
        ]);
    }
}
