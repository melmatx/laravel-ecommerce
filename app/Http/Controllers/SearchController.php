<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchProducts(Request $request)
    {
        $searchQuery = $request->search;

        if (empty($searchQuery)) {
            return redirect()->route("browse");
        }

        $products = Product::where('name', 'LIKE', "%{$searchQuery}%");
        $category = Category::where('name', 'LIKE', "%{$searchQuery}%")->first();

        $products = isset($category)
            ? $products->orWhere('category_id', $category->id)->get()
            : $products->get();

        return view('search.products', ['products' => $products, 'search' => $searchQuery]);
    }

    public function searchCategories(Request $request)
    {
        $searchQuery = $request->search;

        if (empty($searchQuery)) {
            return redirect()->route("categories");
        }

        $categories = Category::where('name', 'LIKE', "%{$searchQuery}%");
        $product = Product::where('name', 'LIKE', "%{$searchQuery}%")->first();

        $categories = isset($product)
            ? $categories->orWhere('id', $product->category_id)->get()
            : $categories->get();

        return view('search.categories', ['categories' => $categories, 'search' => $searchQuery]);
    }
}
