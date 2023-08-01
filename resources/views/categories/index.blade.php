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
            {{ __('Manage Categories') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-12 py-6">
                <div class="p-4">
                    <form method="GET" action="{{ route('category.create') }}">
                        <x-primary-button>
                            {{ __('Add New Category') }}
                        </x-primary-button>
                    </form>
                </div>

                <div class="px-6 py-6">
                    <table class="w-full text-left">
                        <thead class="text-gray-700 text-lg border-b">
                        <tr>
                            <th class="py-2">ID</th>
                            <th class="py-2">Category</th>
                            <th class="py-2 text-center">Products</th>
                            <th class="py-2 text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr class="hover:bg-gray-100">
                                <td class="w-1/5 py-4">{{ $category->id }}</td>
                                <td class="w-2/5 py-4">{{ $category->name }}</td>
                                <td class="w-2/5 py-4 text-center">{{ $category->products->count() }}</td>
                                <td class="py-4 flex justify-center space-x-2 ml-3">
                                    <form method="GET" action="{{ route('category.show', $category) }}">
                                        <x-primary-button>
                                            {{ __('View') }}
                                        </x-primary-button>
                                    </form>

                                    <form method="GET" action="{{ route('category.edit', $category) }}">
                                        <x-secondary-button type="submit">
                                            {{ __('Edit') }}
                                        </x-secondary-button>
                                    </form>

                                    <form method="POST" action="{{ route('category.destroy', $category) }}"
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
                @if($categories->isEmpty())
                    <div class="p-4">
                        <p class="text-center">No products in here.</p>
                    </div>
                @endif
            </section>
        </div>
    </div>
</x-app-layout>
