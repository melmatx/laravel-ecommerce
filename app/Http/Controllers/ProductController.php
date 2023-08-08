<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Service\CustomerService;
use App\Service\ExampleClass;
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
    public function show(Product $product, CustomerService $customerService, ExampleClass $exampleClass)
    {
        $this->authorize('view', $product);

        return view("products.show", [
            "product" => $product,
            "reviews" => $customerService->rating($product),
            "savedToCart" => $customerService->productExist($product->id),
            "savedToWishlist" => $customerService->saveProductToWishlist($product->id),
            "userReview" => $customerService->checkProductReview($product),
            "avgRating" => $exampleClass->averageRating($product),
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
