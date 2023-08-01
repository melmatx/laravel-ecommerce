<?php

namespace App\View\Components\Category;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public $category;
    public $route;
    /**
     * Create a new component instance.
     */
    public function __construct($route, $category = null)
    {
        $this->category = $category;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.category.form');
    }
}
