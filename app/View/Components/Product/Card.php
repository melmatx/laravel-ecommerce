<?php

namespace App\View\Components\Product;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $product;
    public $savedToCart;
    public $savedToWishlist;

    /**
     * Create a new component instance.
     */
    public function __construct($product)
    {
        $this->product = $product;

        $user = auth()->user();

        $productExists = fn($table) => $user?->$table?->products()->where('product_id', $product->id)->exists();

        $this->savedToCart = $productExists('cart');
        $this->savedToWishlist = $productExists('wishlist');
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product.card');
    }
}
