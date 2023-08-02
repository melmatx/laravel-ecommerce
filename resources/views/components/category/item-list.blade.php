@props(['categories'])

<section class="mx-auto max-w-2xl px-4 pb-10 sm:px-6 lg:max-w-6xl lg:px-8">
    <div class="py-8 text-black">
        {{ $slot }}
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($categories as $category)
            <x-category.item :category="$category"/>
        @endforeach
    </div>
    @if($categories->isEmpty())
        <p class="text-center py-8">No categories found.</p>
    @endif
</section>
