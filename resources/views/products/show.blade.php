<x-app-layout>
    @if(session('cart-error'))
        <x-alert title="Cart Error" type="error">
            {{ session('cart-error') }}
        </x-alert>
    @endif

    <x-slot name="header">
        <h2 class="flex font-bold text-xl text-gray-800 leading-tight items-center">
            <a href="{{ url()->previous() }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     class="h-6 w-6 inline-block align-text-top mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                {{ url()->previous() === route('browse') ? 'Browse Products' : 'Back' }}
            </a>
        </h2>
    </x-slot>

    <section class="text-gray-700 body-font overflow-hidden bg-white">
        <div class="pb-6 py-1 px-12 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <x-product.image :src="$product->image_url" :alt="$product->name"/>

                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <a href="{{ route("category.show", $product->category) }}"><h2
                            class="text-sm title-font text-gray-500 tracking-widest uppercase pb-1 hover:underline">{{ $product->category->name }}</h2>
                    </a>
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

                        @can('view-cart')
                            <x-cart.main-button :productId="$product->id" :isSaved="$savedToCart"/>
                        @else
                            <div class="flex ml-auto"></div>
                        @endcan

                        <x-wishlist.main-button :productId="$product->id" :isSaved="$savedToWishlist"/>
                    </div>
                    <p class="text-gray-400 text-sm py-2">Stocks: {{ $product->quantity }}</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
