@props(['wishlistProducts'])

<ul class="space-y-5">
    @forelse($wishlistProducts->pluck('product') as $product)
        <x-wishlist.item :product="$product"/>
    @empty
        <p class="text-center">No products in here.</p>
    @endforelse
</ul>
