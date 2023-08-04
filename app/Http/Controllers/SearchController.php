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

        $products = $this->getProductsByQuery($searchQuery);

        return view('search.products', ['products' => $products, 'search' => $searchQuery]);
    }

    public function searchCategories(Request $request)
    {
        $searchQuery = $request->search;

        if (empty($searchQuery)) {
            return redirect()->route("categories");
        }

        $categories = $this->getCategoriesByQuery($searchQuery);

        return view('search.categories', ['categories' => $categories, 'search' => $searchQuery]);
    }

    private function getProductsByQuery($query)
    {
        $products = Product::active()->where('name', 'LIKE', "%{$query}%");
        $category = Category::active()->where('name', 'LIKE', "%{$query}%")->first();

        return isset($category)
            ? $products->orWhere('category_id', $category->id)->get()
            : $products->get();
    }

    private function getCategoriesByQuery($query)
    {
        $categories = Category::active()->where('name', 'LIKE', "%{$query}%");
        $product = Product::active()->where('name', 'LIKE', "%{$query}%")->first();

        return isset($product)
            ? $categories->orWhere('id', $product->category_id)->get()
            : $categories->get();
    }
}
