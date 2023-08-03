<x-app-layout>
    @if(session('order-success'))
        <x-alert title="Order Successful">
            {{ session('order-success') }}
        </x-alert>
    @endif

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
                                    <p class="text-lg font-bold">Order {{ $loop->index+1 }}</p>
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

                                <li class="mt-4 flex justify-between border-t border-gray-100 pt-4 items-center">
                                    @can('update', $order)
                                        <div class="mr-20">
                                            <form method="POST" action="{{ route("order.update", $order) }}">
                                                @csrf
                                                @method('PATCH')

                                                <select id="status" class="mt-1 rounded-md border-gray-300"
                                                        name="status">
                                                    <option value="">Please select...</option>
                                                    @php
                                                        $statusOptions = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
                                                    @endphp
                                                    @foreach($statusOptions as $status)
                                                        <option value="{{ $status }}"
                                                                @if(old('status', $order->status) == $status) selected @endif>{{ ucfirst($status) }}</option>
                                                    @endforeach
                                                </select>

                                                <x-primary-button class="ml-1 mt-4">
                                                    {{ __('Update') }}
                                                </x-primary-button>
                                            </form>
                                            <x-input-error :messages="$errors->get('status')" class="mt-2"/>

                                            @if(session('status-updated') === $order->id)
                                                <p
                                                    x-data="{ show: true }"
                                                    x-show="show"
                                                    x-transition
                                                    x-init="setTimeout(() => show = false, 2000)"
                                                    class="text-sm text-gray-600 m-2"
                                                >Order status updated!</p>
                                            @endif
                                        </div>
                                    @else
                                        @switch($order->status)
                                            @case('pending')
                                                <span
                                                    class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-500 text-white">Pending</span>
                                                @break
                                            @case('processing')
                                                <span
                                                    class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-500 text-white">Processing</span>
                                                @break
                                            @case('shipped')
                                                <span
                                                    class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-fuchsia-500 text-white">Shipped</span>
                                                @break
                                            @case('delivered')
                                                <span
                                                    class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-500 text-white">Delivered</span>
                                                @break
                                            @case('cancelled')
                                                <span
                                                    class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-500 text-white">Cancelled</span>
                                                @break
                                        @endswitch
                                    @endcan

                                    <div class="w-screen max-w-sm space-y-4">
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
    <div id="latest" class="py-6"></div>
</x-app-layout>
