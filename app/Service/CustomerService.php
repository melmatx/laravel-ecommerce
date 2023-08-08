<?php

namespace App\Service;

class CustomerService
{
    public $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function productExist( $productId)
    {
        return $this->user ? $this->user->cart->products()->where('product_id', $productId)->exists() : false;
    }

    public function saveProductToWishlist($productId)
    {
        return $this->user ? $this->user->wishlist->products()->where('product_id', $productId)->exists() : false;
    }

    public function checkProductReview($product)
    {
        return $this->user ? $product->reviews()->where('user_id', $this->user->id)->first() : '';
    }

    public function rating($product)
    {
        $user = $this->user;
        return $product->reviews
            ->sortByDesc(function ($review) use ($user) {
                return $review->user_id === optional($user)->id;
            });
    }

    public function averageRating($product)
    {
        return $product->reviews()->avg('rating');
    }
}
