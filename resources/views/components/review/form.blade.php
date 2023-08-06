<form method="POST" action="{{ $review ? route("review.update", $review) : route("review.store") }}">
    @csrf
    @if($review)
        @method('PUT')
    @endif

    <label for="content" class="sr-only">Review</label>

    <div
        class="overflow-hidden rounded-lg border border-gray-200 shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600"
    >
        <input type="hidden" value="{{ $product->id }}" name="product_id"/>
        <x-input-error :messages="$errors->get('product_id')" class="m-2"/>

        <textarea
            id="content"
            name="content"
            class="w-full my-2 mx-1 resize-none border-none align-top focus:ring-0 sm:text-sm"
            rows="4"
            placeholder="Enter your review here..."
        >{{ old('content', $review->content ?? null) }}</textarea>

        <div class="flex justify-between gap-2 bg-white p-3">
            <div class="mr-3">
                <x-input-error :messages="$errors->get('content')" class="mt-2"/>
                <x-input-error :messages="$errors->get('stars')" class="mt-2"/>
            </div>

            <div class="flex justify-end items-center">
                <div x-data="{ stars: {{ $review->rating ?? 1 }} }"
                     class="flex justify-end items-center mr-3 space-x-4">
                    <label for="stars" x-text="`Stars: ` + stars" class="lg:w-14"></label>
                    <input id="stars" name="rating" type="range" min="1" max="5" value="1" class="range w-1/2"
                           x-model="stars"/>
                </div>

                <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                    {{ $review ? 'Update' : 'Submit' }}
                </x-primary-button>
            </div>
        </div>
    </div>
</form>
