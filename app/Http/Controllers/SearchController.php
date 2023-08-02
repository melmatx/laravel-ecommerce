<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchProducts(Request $request)
    {
        $products = Product::where('name', 'LIKE', "%{$request->search}%")->get();

        return view('search.products', ['products' => $products]);
    }

    public function searchCategories(Request $request)
    {
        $categories = Category::where('name', 'LIKE', "%{$request->search}%")->get();

        return view('search.categories', ['categories' => $categories]);
    }
}
