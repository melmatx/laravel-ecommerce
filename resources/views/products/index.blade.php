<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Products') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-12 py-6">
                <div class="p-4">
                    <x-primary-button type="button" onclick="window.location.href='{{ route('product.create') }}'">
                        {{ __('Add New Product') }}
                    </x-primary-button>
                </div>

                <div class="px-6 py-6">
                    <table class="w-full text-left">
                        <thead class="text-gray-700 text-lg border-b">
                        <tr>
                            <th class="py-2">ID</th>
                            <th class="py-2">Product</th>
                            <th class="py-2">Category</th>
                            <th class="py-2">Price</th>
                            <th class="py-2 text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr class="hover:bg-gray-100">
                                <td class="py-4">{{ $product->id }}</td>
                                <td class="py-4">{{ $product->name }}</td>
                                <td class="py-4">{{ $product->category->name }}</td>
                                <td class="py-4">₱{{ $product->price }}</td>
                                <td class="py-4 flex justify-center space-x-2 ml-3">
                                    <x-primary-button type="button"
                                                      onclick="window.location.href='{{ route('product.show', $product) }}'">
                                        {{ __('View') }}
                                    </x-primary-button>

                                    <x-secondary-button type="button"
                                                        onclick="window.location.href='{{ route('product.edit', $product) }}'">
                                        {{ __('Edit') }}
                                    </x-secondary-button>

                                    <form method="POST" action="{{ route('product.destroy', $product) }}"
                                          class="inline-flex">
                                        @csrf
                                        @method('DELETE')

                                        <x-danger-button>
                                            {{ __('Delete') }}
                                        </x-danger-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
