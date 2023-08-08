<x-app-layout>
    @if(session('cart-error'))
        <x-alert title="Cart Error" type="error">
            {{ session('cart-error') }}
        </x-alert>
    @elseif(session('review-error'))
        <x-alert title="Review Error" type="error">
            {{ session('review-error') }}
        </x-alert>
    @elseif(session('review-success'))
        <x-alert title="Review Success">
            {{ session('review-success') }}
        </x-alert>
    @endif

    @php
        $prevUrl = url()->previous();

        if ($prevUrl == route("product.index")) {
            $label = "Your Products";
        } elseif (str_contains($prevUrl, "category")) {
            $label = "Back";
        } else {
            $prevUrl = route("browse");
            $label = "Browse Products";
        }
    @endphp

    <x-slot name="header">
        <h2 class="flex font-bold text-xl text-gray-800 leading-tight items-center">
            <a href="{{ $prevUrl }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     class="h-6 w-6 inline-block align-text-top mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                {{ $label }}
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
                          <x-review.rating :rating="round($avgRating)"/>
                        <span class="text-gray-600 ml-3">{{ $reviews->count()  }} Reviews</span>
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
                    <p class="text-gray-400 text-sm py-2">Stocks: {{ $product->stocks }}</p>
                </div>
            </div>
            <div class="max-w-7xl mx-auto py-6 lg:px-8">
                <h2 class="text-2xl font-bold text-gray-800 mt-10 mb-6">
                    Reviews
                </h2>

                @if($userReview)
                    <div class="flex space-x-2">
                        @can('update', $userReview)
                            <x-primary-button
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'reviewForm')"
                            >
                                {{ __('Edit Review') }}
                            </x-primary-button>
                        @endcan

                        @can('delete', $userReview)
                            <x-danger-button
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirmDeleteReview')"
                            >
                                {{ __('Delete Review') }}
                            </x-danger-button>
                        @endcan
                    </div>
                @else
                    @can('create', [\App\Models\Review::class, $product->id])
                        <x-secondary-button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'reviewForm')"
                        >
                            {{ __('Add Review') }}
                        </x-secondary-button>
                    @endcan
                @endif

                @if($reviews->isNotEmpty())
                    <x-review.item-list :reviews="$reviews"/>
                @else
                    <p class="text-center py-3">No reviews yet.</p>
                @endif
            </div>
        </div>
    </section>

    <x-modal name="reviewForm" :show="$errors->any()">
        <div class="p-6">
            <h2 class="text-xl font-bold text-gray-800 pb-3">
                {{ $userReview ? 'Edit Review' : 'Add Review' }}
            </h2>
            <x-review.form :review="$userReview" :product="$product"/>
        </div>
    </x-modal>

    <x-modal name="confirmDeleteReview">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Delete Review?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('This action cannot be undone.') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                @if($userReview)
                    <form method="POST" action="{{ route('review.destroy', $userReview) }}">
                        @csrf
                        @method('DELETE')

                        <x-danger-button class="ml-3">
                            {{ __('Delete Review') }}
                        </x-danger-button>
                    </form>
                @endif
            </div>
        </div>
    </x-modal>
</x-app-layout>
