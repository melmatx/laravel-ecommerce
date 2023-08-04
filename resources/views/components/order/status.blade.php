@props(['order'])

@can('update', $order)
    <div class="mr-20">
        <form method="POST" action="{{ route("order.update", $order) }}">
            @csrf
            @method('PATCH')

            <select id="status" class="mt-1 rounded-md border-gray-300"
                    name="status">
                <option disabled>Please select...</option>
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
