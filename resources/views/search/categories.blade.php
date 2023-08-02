<x-app-layout>
    <x-slot name="header">
        <x-search type="categories"/>
    </x-slot>

    <x-category.item-list :categories="$categories">
        <h2 class="flex font-bold text-xl text-gray-800 leading-tight items-center">
            <a href="{{ url()->previous() }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     class="h-6 w-6 inline-block align-text-top mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            {{ __('Category Results') }}
        </h2>
    </x-category.item-list>

    <x-footer/>
</x-app-layout>
