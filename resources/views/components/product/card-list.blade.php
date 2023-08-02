@props(['products'])

<section class="mx-auto max-w-2xl px-4 pb-10 sm:px-6 lg:max-w-7xl lg:px-8">
    <div class="py-8 text-black">
        {{ $slot }}
    </div>

    <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
        @foreach($products as $product)
            <x-product.card :product="$product"/>
        @endforeach
    </div>
    @if($products->isEmpty())
        <p class="text-center py-8">No products found.</p>
    @endif
</section>
