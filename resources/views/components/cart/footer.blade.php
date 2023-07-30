@props(['cartProducts', 'total'])

<div class="mt-8 flex justify-end border-t border-gray-100 pt-4">
    <div class="w-full space-y-4">
        <dl class="space-y-0.5 text-gray-700">
            <div class="flex justify-between !text-base font-medium">
                <dt>Total</dt>
                <dd>₱{{ $total }}</dd>
            </div>
        </dl>

        @if($cartProducts->isNotEmpty())
            <div class="flex justify-end">
                <x-primary-button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-checkout')"
                >{{ __('Checkout') }}</x-primary-button>
            </div>
        @endif
    </div>
</div>
