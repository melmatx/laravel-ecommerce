<x-app-layout>
    @if(session('success'))
        <x-alert title="Success">
            {{ session('success') }}
        </x-alert>
    @elseif(session('error'))
        <x-alert title="Error" type="error">
            {{ session('error') }}
        </x-alert>
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Products') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-12 py-6">
                <div class="p-4">
                    <form method="GET" action="{{ route('product.create') }}">
                        <x-primary-button>
                            {{ __('Add New Product') }}
                        </x-primary-button>
                    </form>
                </div>

                <div class="px-6 py-6 overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="text-gray-700 text-lg border-b">
                        <tr>
                            <th class="p-4">ID</th>
                            <th class="p-4">Product</th>
                            <th class="p-4">Category</th>
                            <th class="p-4">Price</th>
                            <th class="p-4 text-center">Stocks</th>
                            <th class="p-4 text-center">Sales</th>
                            <th class="p-4 text-center pl-12">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr class="hover:bg-gray-100 transition ease-out">
                                <td class="w-1/5 p-4">{{ $product->id }}</td>
                                <td class="w-2/5 p-4">{{ $product->name }}</td>
                                <td class="w-2/5 p-4">{{ $product->category->name }}</td>
                                <td class="w-2/5 p-4">₱{{ $product->price }}</td>
                                <td class="w-1/5 p-4 text-center">{{ $product->stocks }}</td>
                                <td class="w-1/5 p-4 text-center">{{ $product->sales }}</td>
                                <td class="p-4 flex justify-center space-x-2 ml-3 pl-12">
                                    <form method="GET" action="{{ route('product.show', $product) }}">
                                        <x-primary-button>
                                            {{ __('View') }}
                                        </x-primary-button>
                                    </form>

                                    @can('update', $product)
                                        <form method="GET" action="{{ route('product.edit', $product) }}">
                                            <x-secondary-button type="submit">
                                                {{ __('Edit') }}
                                            </x-secondary-button>
                                        </form>
                                    @endcan

                                    @can('delete', $product)
                                        <form method="POST" action="{{ route('product.destroy', $product) }}"
                                              class="inline-flex">
                                            @csrf
                                            @method('DELETE')

                                            <x-danger-button>
                                                {{ __('Delete') }}
                                            </x-danger-button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @if($products->isEmpty())
                    <div class="p-6">
                        <p class="text-center">No products in here.</p>
                    </div>
                @endif
            </section>
        </div>
    </div>
</x-app-layout>
