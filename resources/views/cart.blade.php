<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    @if(session('checkout-success'))
        <x-alert title="Checkout Success">
            {{ session('checkout-success') }}
        </x-alert>
    @elseif(session('checkout-error'))
        <x-alert title="Checkout Error" type="error">
            {{ session('checkout-error') }}
        </x-alert>
    @endif

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">

                    <div class="mx-auto max-w-3xl">
                        <x-cart.item-list :cart-products="$cartProducts"/>

                        <div class="mt-8 flex justify-end border-t border-gray-100 pt-4">
                            <div class="w-full space-y-4">
                                <dl class="space-y-0.5 text-gray-700">
                                    <div class="flex justify-between !text-base font-medium">
                                        <dt>Total</dt>
                                        <dd>₱{{ $total }}</dd>
                                    </div>
                                </dl>

                                @if($cartProducts->isNotEmpty())
                                    <div class="flex justify-end space-x-2">
                                        <x-secondary-button
                                            x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirmClearCart')"
                                        >{{ __('Clear Cart') }}</x-secondary-button>
                                        <x-primary-button
                                            x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirmCheckout')"
                                        >{{ __('Checkout') }}</x-primary-button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <x-modal name="confirmCheckout">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Confirm Checkout?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once you checkout, all the cart products will be cleared.') }}
            </p>

            <p class="mt-4 text-sm text-gray-400">
                {{ __('Balance: ₱') . auth()->user()->wallet }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <form method="GET" action="{{ route('cart.checkout') }}">
                    @csrf
                    <x-primary-button class="ml-3">
                        {{ __('Confirm Checkout') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </x-modal>

    <x-modal name="confirmClearCart">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Clear the Cart?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('All the products in your cart will be cleared.') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <form method="GET" action="{{ route('cart.clear') }}">
                    @csrf
                    <x-danger-button class="ml-3">
                        {{ __('Clear Cart') }}
                    </x-danger-button>
                </form>
            </div>
        </div>
    </x-modal>
</x-app-layout>
