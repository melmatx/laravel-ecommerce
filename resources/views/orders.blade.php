<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
                    <div class="mx-auto max-w-4xl">

                        @forelse($orders as $order)
                            <ul class="space-y-5 mb-10">
                                <li class="flex items-center justify-between">
                                    <p class="text-lg font-bold">Order {{ $order->id }}</p>
                                    <p class="text-xs pr-2">Quantity</p>
                                </li>

                                @foreach($order->products->sortByDesc('id') as $orderProduct)
                                    @php
                                        $product = $orderProduct->product;
                                    @endphp

                                    <li class="flex items-center gap-4">
                                        <img
                                            src="{{ $product->image_url }}"
                                            alt="{{ $product->name }}"
                                            class="h-16 w-16 rounded object-cover"
                                        />

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

                                        <div class="flex flex-1 items-center justify-end gap-2">
                                            <label for="Quantity" class="sr-only"> Quantity </label>

                                            <div class="items-center">
                                                <input
                                                    disabled=""
                                                    type="number"
                                                    id="Quantity"
                                                    value="{{ $orderProduct->quantity }}"
                                                    class="h-10 w-16 rounded border-gray-200 text-center [-moz-appearance:_textfield] sm:text-sm [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none"
                                                />
                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                                <li class="mt-4 flex justify-end border-t border-gray-100 pt-4">
                                    <div class="w-screen max-w-lg space-y-4">
                                        <dl class="space-y-0.5 text-gray-700">
                                            <div class="flex justify-between !text-base font-medium">
                                                <dt>Total</dt>
                                                <dd class="text-lg">₱{{ $order->products->sum('product.price') }}</dd>
                                            </div>
                                        </dl>
                                    </div>
                                </li>
                            </ul>
                        @empty
                            <p class="text-center">No orders yet.</p>
                        @endforelse
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>

