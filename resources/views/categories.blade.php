<x-app-layout>
    <x-slot name="header">
        <!-- Search -->
        <div class="relative w-1/2 mx-auto">
            <label for="Search" class="sr-only"> Search </label>

            <input
                type="text"
                id="Search"
                placeholder="Search categories..."
                class="w-full rounded-md border-gray-200 py-2.5 pe-10 shadow-sm sm:text-sm"
            />

            <span class="absolute inset-y-0 end-0 grid w-10 place-content-center">
                <button type="button" class="text-gray-600 hover:text-gray-700">
                  <span class="sr-only">Search</span>

                  <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="h-4 w-4"
                  >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
                    />
                  </svg>
                </button>
            </span>
        </div>
    </x-slot>

    <div class="py-6">
        <section class="mx-auto max-w-2xl px-4 pb-10 sm:px-6 lg:max-w-6xl lg:px-8">
            <div class="py-8 text-black">
                <p class="text-2xl lg:text-3xl font-bold text-center">
                    {{ __('All Categories') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($categories as $category)
                    <a href="{{ route("category.show", $category) }}" class="group relative block overflow-hidden">
                        <img
                            src="@if($category->products->isNotEmpty()) {{ $category->products?->random()->image_url }} @endif"
                            alt="{{ $category->name }}"
                            class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72"
                        />

                        <div class="relative border border-gray-100 bg-white p-6">
                            <h3 class="mt-4 text-lg font-medium text-gray-900">{{ $category->name }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

    </div>

</x-app-layout>
