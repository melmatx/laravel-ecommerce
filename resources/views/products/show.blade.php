<x-app-layout>
    @if(session('cart-error'))
        <x-alert title="Cart Error" type="warning">
            {{ session('cart-error') }}
        </x-alert>
    @endif

    <x-slot name="header">
        <ol class="flex items-center gap-1 text-sm text-gray-600 ml-5">
            <li>
                <a href="{{ route("browse") }}" class="block transition hover:text-gray-700">
                    <span class="sr-only"> Home </span>

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                        />
                    </svg>
                </a>
            </li>

            <li class="rtl:rotate-180">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"
                    />
                </svg>
            </li>

            <li>
                <a href="{{ route('category.show', $product->category) }}"
                   class="block transition hover:text-gray-700"> {{ $product->category->name }} </a>
            </li>

            <li class="rtl:rotate-180">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"
                    />
                </svg>
            </li>

            <li>
                {{ $product->name }}
            </li>
        </ol>
    </x-slot>

    <section class="text-gray-700 body-font overflow-hidden bg-white">
        <div class="pb-6 py-1 px-12 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <x-product.image :src="$product->image_url" :alt="$product->name"/>

                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <h2 class="text-sm title-font text-gray-500 tracking-widest uppercase pb-1">{{ $product->category->name }}</h2>
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $product->name }}</h1>

                    <div class="flex mb-4">
                      <span class="flex items-center pt-2">
                          @for($i = 0; $i < 4; $i++)
                              <x-product.rating-star :filled="true"/>
                          @endfor
                              <x-product.rating-star :filled="false"/>
                        <span class="text-gray-600 ml-3">{{ $reviews?->count() ?? 4 }} Reviews</span>
                      </span>
                    </div>

                    <p class="leading-relaxed">{{ $product->description }}</p>

                    <div class="flex items-center pb-5 border-b-2 border-gray-200 mb-5"></div>

                    <div class="flex">
                        <span class="title-font font-medium text-2xl text-gray-900">P{{ $product->price }}</span>

                        <x-cart.main-button :productId="$product->id" :isSaved="$savedToCart"/>

                        <x-wishlist.main-button :productId="$product->id" :isSaved="$savedToWishlist"/>
                    </div>
                    <p class="text-gray-400 text-sm py-2">Stocks: {{ $product->quantity }}</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
