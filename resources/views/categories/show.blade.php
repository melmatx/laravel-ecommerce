<x-app-layout>
    @if(session('cart-added'))
        <x-alert title="Added to cart">
            {{ session('cart-added') }}
        </x-alert>
    @elseif (session('wishlist-added'))
        <x-alert title="Added to wishlist">
            {{ session('wishlist-added') }}
        </x-alert>
    @elseif(session('error'))
        <x-alert title="Error" type="error">
            {{ session('error') }}
        </x-alert>
    @endif

    @php
        $prevUrl = url()->previous();

        if ($prevUrl == route("category.index")) {
            $label = "All Categories";
        } elseif ($prevUrl == route("browse")) {
            $label = "Browse Products";
        } else {
            $prevUrl = route("categories");
            $label = $category->name;
        }
    @endphp

    <x-slot name="header">
        <h2 class="flex font-bold text-xl text-gray-800 leading-tight items-center">
            <a href="{{ $prevUrl }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     class="h-6 w-6 inline-block align-text-top mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            {{ $label }}
        </h2>
    </x-slot>

    <x-product.card-list :products="$categoryProducts"/>
</x-app-layout>
