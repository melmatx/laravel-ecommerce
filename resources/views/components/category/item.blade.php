@props(['category'])

@php
    $categoryProducts = isset($category->products) && $category->products()->active() ? $category->products()->active()->get() : null;
    $categoryImage = $categoryProducts && $categoryProducts->isNotEmpty() ? $categoryProducts->random()->image_url : null;
@endphp

<a href="{{ route("category.show", $category) }}" class="group relative block overflow-hidden">
    <img
        src="{{ $categoryProducts }}"
        alt="{{ $category->name }}"
        class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72"
    />

    <div class="relative border border-gray-100 bg-white p-6">
        <h3 class="mt-4 text-lg font-medium text-gray-900">{{ $category->name }}</h3>
    </div>
</a>
