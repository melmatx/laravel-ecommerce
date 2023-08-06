@props(['orders'])

@forelse($orders as $order)
    <ul class="space-y-5 mb-16">
        <li class="flex items-center justify-between">
            <p class="text-lg font-bold">Order {{ $loop->index+1 }}</p>
        </li>

        <li class="flex items-center justify-between">
            @isset($order->seller)
                <p class="text-sm">
                    <b>Seller:</b> {{ $order->seller->name }}
                </p>
            @else
                <p class="text-sm">
                    <b>Customer:</b> {{ $order->customerOrder->user->name }}
                </p>
            @endisset
            <p class="text-xs pr-5">Quantity</p>
        </li>

        @foreach($order->products->sortByDesc('id') as $orderProduct)
            <x-order.item :product="$orderProduct->product" :quantity="$orderProduct->quantity"/>
        @endforeach

        <li class="mt-4 flex justify-between border-t border-gray-100 pt-4 items-center ml-1">
            <x-order.status :order="$order"/>

            <div class="w-screen max-w-sm space-y-4">
                <dl class="space-y-0.5 text-gray-700">
                    <div class="flex justify-between !text-base font-medium">
                        <dt>Total</dt>
                        <dd class="text-lg mr-4">₱{{ $order->total }}</dd>
                    </div>
                </dl>
            </div>
        </li>
    </ul>
@empty
    <p class="text-center">No orders yet.</p>
@endforelse
