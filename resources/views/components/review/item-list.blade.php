@props(['reviews'])

<section class="bg-gray-100">
    <div class="mx-auto max-w-screen-2xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($reviews as $review)
                <x-review.item :review="$review"/>
            @endforeach
        </div>
    </div>
</section>
