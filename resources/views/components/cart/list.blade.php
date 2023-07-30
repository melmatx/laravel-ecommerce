@props(['cartProducts'])

<ul class="space-y-4">
    @forelse($cartProducts as $cartProduct)
        <x-cart.item :product="$cartProduct->product" :quantity="$cartProduct->quantity"/>
    @empty
        <p class="text-center">No products in here.</p>
    @endforelse
</ul>
