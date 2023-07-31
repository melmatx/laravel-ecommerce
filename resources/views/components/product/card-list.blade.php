@props(['products'])

<section class="mx-auto max-w-2xl px-4 pb-10 sm:px-6 lg:max-w-7xl lg:px-8">
    @if($slot->isEmpty())
        <p class="py-4"></p>
    @else
        {{ $slot }}
    @endif

    <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
        @foreach($products as $product)
            <x-product.card :product="$product"/>
        @endforeach
    </div>
    @if($products->isEmpty())
        <p class="text-center py-12">No products yet.</p>
    @endif
</section>
