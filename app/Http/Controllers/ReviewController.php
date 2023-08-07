<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request)
    {
        $user = $request->user();
        $productId = $request->product_id;

        $hasNotPurchased = $user->orders->where('role', 'customer')
            ->pluck('products')->flatten()->where('product.id', $productId)->isEmpty();
        if ($hasNotPurchased) {
            return redirect()->back()->with('review-error', 'You can only review products you have purchased.');
        }

        $this->authorize('create', Review::class);

        $user->reviews()->create($request->validated());

        return redirect()->back()->with('review-success', 'Review submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReviewRequest $request, Review $review)
    {
        $this->authorize('update', $review);

        $review->update($request->validated());

        return redirect()->back()->with('review-success', 'Review updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);

        $review->delete();

        return redirect()->back()->with('review-success', 'Review deleted successfully.');
    }
}
