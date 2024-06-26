<?php

namespace App\View\Components\Product;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public $product;
    public $categories;
    /**
     * Create a new component instance.
     */
    public function __construct($product = null)
    {
        $this->product = $product;
        $this->categories = Category::active()->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product.form');
    }
}
