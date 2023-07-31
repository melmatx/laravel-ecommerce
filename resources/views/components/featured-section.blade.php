@props(['product', 'category'])

<section>
    <div class="container mx-auto py-6 md:py-10 px-4 md:px-6">
        <div
            class="flex items-strech justify-center flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-6 lg:space-x-8">
            <div
                class="flex flex-col md:flex-row items-strech justify-between bg-gray-50 py-6 px-6 md:py-12 lg:px-12 md:w-8/12 lg:w-7/12 xl:w-8/12 2xl:w-9/12 hover:bg-black/10 cursor-pointer">
                <a href="{{ $product ? route('product.show', $product) : '#' }}" class="inline-flex justify-between">
                    <div class="flex flex-col justify-center md:w-2/3">
                        <h1 class="text-3xl lg:text-4xl font-semibold text-gray-800">{{ $product->name ?? 'Featured Product' }}</h1>
                        <p class="text-base lg:text-xl text-gray-800 mt-2"> {{ $product->description ?? 'Product Description' }}</p>
                    </div>
                    <div class="md:w-4/12 mt-8 md:mt-0 flex justify-center md:justify-end">
                        <img src="{{ $product->image_url ?? '' }}" alt="" class=""/>
                    </div>
                </a>
            </div>
            <div
                class="md:w-4/12 lg:w-5/12 xl:w-4/12 2xl:w-3/12 bg-gray-50 py-6 px-6 md:py-0 md:px-4 lg:px-6 flex flex-col justify-center relative hover:bg-black/10 cursor-pointer">
                <a href="{{ $category ? route("category.show", $category) : '#' }}" class="inline-flex justify-between">
                    <div class="flex flex-col justify-center gap-y-3">
                        <h1 class="text-3xl lg:text-4xl font-semibold text-gray-800">{{ $category->name ?? 'Featured Category' }}</h1>
                        <p class="text-base lg:text-xl text-gray-800">Save Up to <span class="font-bold">30%</span></p>
                    </div>
                    <div class="flex justify-end md:absolute md:bottom-4 md:right-4 lg:bottom-0 lg:right-0">
                        <img src="{{ $category ? $category->products->random()->image_url : '' }}" alt=""
                             class="md:w-4/12 mb-4 mr-3 p-2"/>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
