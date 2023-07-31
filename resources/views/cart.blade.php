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
        <x-alert title="Checkout Error" type="warning">
            {{ session('checkout-error') }}
        </x-alert>
    @endif

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">

                    <div class="mx-auto max-w-3xl">
                        <x-cart.list :cart-products="$cartProducts"/>
                        <x-cart.footer :cart-products="$cartProducts" :total="$total"/>
                    </div>
                </div>
            </section>
        </div>
    </div>


    <x-modal name="confirm-checkout">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Confirm Checkout?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once you checkout, all the cart products will be cleared.') }}
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
</x-app-layout>
