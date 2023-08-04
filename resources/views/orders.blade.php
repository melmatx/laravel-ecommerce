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
                        <x-order.item-list :orders="$orders"/>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div id="latest" class="py-6"></div>
</x-app-layout>
