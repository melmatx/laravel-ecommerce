@props(['cartProducts'])

<ul class="space-y-4 overflow-x-auto">
    @forelse($cartProducts as $cartProduct)
        <x-cart.item :product="$cartProduct->product" :quantity="$cartProduct->quantity"/>
    @empty
        <p class="text-center">No products added to cart.</p>
    @endforelse
</ul>
