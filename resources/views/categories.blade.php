<x-app-layout>
    <x-slot name="header">
        <x-search type="category"/>
    </x-slot>

    <div class="py-6">
        <x-category.item-list :categories="$categories">
            <p class="text-2xl lg:text-3xl font-bold text-center">
                {{ __('All Categories') }}
            </p>
        </x-category.item-list>
    </div>

</x-app-layout>
