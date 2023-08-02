<div class="p-6 max-w-3xl mx-auto">
    <form method="POST" action="{{ $route }}">
        @csrf
        @if($product)
            @method('PUT')
        @endif

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')"/>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                          :value="old('name', $product->name ?? null)" autofocus
                          placeholder="Enter name of product"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
        </div>

        <!-- Category -->
        <div class="mt-4">
            <x-input-label for="category_id" :value="__('Category')"/>
            <select id="category_id" class="block mt-1 w-full rounded-md border-gray-300"
                    name="category_id">
                <option value="">Please select...</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if(old('category_id', $product?->category->id) == $category->id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>

            <x-input-error :messages="$errors->get('category_id')" class="mt-2"/>
        </div>

        <!-- Price -->
        <div class="mt-4">
            <x-input-label for="price" :value="__('Price')"/>
            <x-text-input id="price" class="block mt-1 w-full" type="number" name="price"
                          :value="old('price', $product->price ?? null)" autofocus
                          placeholder="How much will the product cost?"/>
            <x-input-error :messages="$errors->get('price')" class="mt-2"/>
        </div>

        <!-- Stocks -->
        <div class="mt-4">
            <x-input-label for="stocks" :value="__('Stocks')"/>
            <x-text-input id="stocks" class="block mt-1 w-full" type="number" name="stocks"
                          :value="old('stocks', $product->stocks ?? 1)" autofocus
                          placeholder="Enter stocks available..."/>
            <x-input-error :messages="$errors->get('stocks')" class="mt-2"/>
        </div>

        <!-- Image -->
        <div class="mt-4">
            <x-input-label for="image_url" :value="__('Image Url')"/>
            <x-text-input id="image_url" class="block mt-1 w-full" type="text" name="image_url"
                          :value="old('image_url', $product->image_url ?? null)" autofocus
                          placeholder="Enter image url..."/>
            <x-input-error :messages="$errors->get('image_url')" class="mt-2"/>
        </div>

        <!-- Description -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')"/>
            <textarea id="description" class="block mt-1 w-full rounded-md border-gray-300"
                      name="description"
                      placeholder="Enter description...">{{ old("description", $product->description ?? null) }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-secondary-button type="button" onclick="window.location.href='{{ route('product.index') }}'">
                {{ __('Back') }}
            </x-secondary-button>
            <x-primary-button class="ml-4">
                {{ $product ? __('Update') : __('Add') }}
            </x-primary-button>
        </div>
    </form>
</div>
