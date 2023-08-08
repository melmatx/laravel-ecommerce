<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Gate;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,seller'])->except('show');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $products = $user->role === "admin"
            ? Product::active()->get()
            : $user->products;

        return view('products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        $request->user()->products()->create($validated);

        return redirect()->route('product.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $this->authorize('view', $product);

        $user = auth()->user();

        $savedToCart = false;
        $savedToWishlist = false;
        $userReview = null;

        if ($user) {
            $savedToCart = $user->cart->products()->where('product_id', $product->id)->exists();
            $savedToWishlist = $user->wishlist->products()->where('product_id', $product->id)->exists();

            $userReview = $product->reviews()->where('user_id', $user->id)->first();
        }

        $reviews = $product->reviews
            ->sortByDesc(function ($review) use ($user) {
                return $review->user_id === optional($user)->id;
            });

        $avgRating = $product->reviews()->avg('rating');

        return view("products.show", [
            "product" => $product,
            "reviews" => $reviews,
            "savedToCart" => $savedToCart,
            "savedToWishlist" => $savedToWishlist,
            "userReview" => $userReview,
            "avgRating" => $avgRating,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        $product->update($validated);

        return redirect()->route('product.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->update(["is_deleted" => true]);

        return redirect()->route('product.index')
            ->with('success', 'Product deleted successfully');
    }
}
