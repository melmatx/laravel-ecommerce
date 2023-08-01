@props(['wishlistProducts'])

<ul class="space-y-5">
    @forelse($wishlistProducts->pluck('product') as $product)
        <x-wishlist.item :product="$product"/>
    @empty
        <p class="text-center">No products added to wishlist.</p>

        <form method="GET" action="{{ route("browse") }}" class="flex justify-center py-1">
            <x-secondary-button type="submit">
                Browse products
            </x-secondary-button>
        </form>
    @endforelse
</ul>
