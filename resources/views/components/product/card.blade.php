<a href="{{ route("product.show", $product) }}" class="group relative block overflow-hidden">
    <x-wishlist.main-button
        class="absolute end-4 top-4 z-10 rounded-full bg-white p-1.5 text-gray-900 transition hover:text-gray-900/75"
        :isSaved="$savedToWishlist"
        :productId="$product->id"
    />

    <x-product.image
        :src="$product->image_url"
        :alt="$product->name"
        class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72"
    />

    <div class="relative border border-gray-100 bg-white p-6">
        <h3 class="mt-4 text-lg font-medium text-gray-900">{{ $product->name }}</h3>

        <p class="mt-1.5 text-sm text-gray-700">₱{{ $product->price }}</p>

        <x-cart.main-button class="mt-4" :isSaved="$savedToCart" :productId="$product->id"/>
    </div>
</a>
