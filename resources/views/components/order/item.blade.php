@props(['product', 'quantity'])

<li class="flex items-center gap-4 hover:bg-gray-100 rounded-md">
    <a href="{{ route("product.show", $product) }}">
        <img
            src="{{ $product->image_url }}"
            alt="{{ $product->name }}"
            class="h-16 w-16 rounded object-cover m-3"
        />
    </a>

    <a href="{{ route("product.show", $product) }}">
        <div>
            <h3 class="text-gray-900">{{ $product->name }}</h3>

            <dl class="mt-0.5 space-y-px text-sm text-gray-600">
                <div>
                    <dt class="inline">Price:</dt>
                    <dd class="inline">₱{{ $product->price }}</dd>
                </div>

                <div>
                    <dt class="inline">Description:</dt>
                    <dd class="inline">{{ $product->description }}</dd>
                </div>
            </dl>
        </div>
    </a>

    <div class="flex flex-1 items-center justify-end gap-2 mr-3">
        <label for="Quantity" class="sr-only"> Quantity </label>

        <div class="items-center">
            <input
                disabled=""
                type="number"
                id="Quantity"
                value="{{ $quantity }}"
                class="h-10 w-16 rounded border-gray-200 bg-gray-50 text-center [-moz-appearance:_textfield] sm:text-sm [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none"
            />
        </div>
    </div>
</li>
