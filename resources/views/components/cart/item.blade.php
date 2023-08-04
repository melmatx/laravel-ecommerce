@props(['product', 'quantity'])

<li class="flex items-center gap-4 hover:bg-gray-100 transition ease-out rounded-md">
    <a href="{{ route("product.show", $product) }}">
        <img
            src="{{ $product->image_url }}"
            alt="{{ $product->name }}"
            class="h-16 w-16 rounded object-cover m-2"
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
            </dl>
        </div>
    </a>

    <div class="flex flex-1 items-center justify-end gap-2">
        <form method="POST" action="{{ route("cart.update", $product) }}">
            @csrf
            @method('PATCH')

            <div x-data="{ productQuantity: {{ $quantity }} }">
                <label for="Quantity" class="sr-only"> Quantity </label>

                <div class="flex items-center gap-1">
                    <button
                        type="button"
                        x-on:click="productQuantity--; setTimeout(() => $event.target.form.submit(), 0)"
                        :disabled="productQuantity <= 1"
                        class="w-10 h-10 leading-10 text-gray-600 transition hover:opacity-75"
                    >
                        &minus;
                    </button>

                    <input
                        type="number"
                        name="quantity"
                        id="Quantity"
                        x-model="productQuantity"
                        x-on:change="if(productQuantity <= 0) productQuantity = 1; setTimeout(() => $event.target.form.submit(), 0)"
                        class="h-10 w-16 rounded border-gray-200 text-center [-moz-appearance:_textfield] sm:text-sm [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none"
                    />

                    <button
                        type="button"
                        x-on:click="productQuantity++; setTimeout(() => $event.target.form.submit(), 0)"
                        class="w-10 h-10 leading-10 text-gray-600 transition hover:opacity-75"
                    >
                        &plus;
                    </button>
                </div>
            </div>
        </form>

        <form method="POST" action="{{ route('cart.remove', $product) }}">
            @csrf
            @method("DELETE")
            <button class="text-gray-600 transition hover:text-red-600 mr-3">
                <span class="sr-only">Remove item</span>

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="h-4 w-4"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                    />
                </svg>
            </button>
        </form>
    </div>
</li>
