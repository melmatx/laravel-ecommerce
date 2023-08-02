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

    <x-slot name="header">
        <x-search type="product"/>
    </x-slot>

    <x-featured-section :product="$featuredProduct" :category="$featuredCategory"/>

    <x-product.card-list :products="$products">
        <p class="text-2xl lg:text-3xl font-bold">
            {{ __('All Products') }}
        </p>
    </x-product.card-list>

    <x-footer/>
</x-app-layout>
