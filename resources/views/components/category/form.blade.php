<div class="p-6 max-w-3xl mx-auto">
    <form method="POST" action="{{ $category ? route("category.update", $category) : route("category.store") }}">
        @csrf
        @if($category)
            @method('PUT')
        @endif

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')"/>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                          :value="old('name', $category->name ?? null)" autofocus
                          placeholder="Enter name of category"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-secondary-button type="button" onclick="window.location.href='{{ route('category.index') }}'">
                {{ __('Back') }}
            </x-secondary-button>
            <x-primary-button class="ml-4">
                {{ $category ? __('Update') : __('Add') }}
            </x-primary-button>
        </div>
    </form>
</div>
