<?php

namespace App\View\Components\Product;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public $product;
    public $route;
    public $categories;
    /**
     * Create a new component instance.
     */
    public function __construct($route, $product = null)
    {
        $this->product = $product;
        $this->route = $route;
        $this->categories = Category::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product.form');
    }
}
