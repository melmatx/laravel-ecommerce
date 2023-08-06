<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('browse') }}">
                        <x-application-logo class="w-20 h-11 fill-current text-gray-500 hover:text-gray-800"/>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex mr-12">
                    <x-nav-link :href="route('browse')" :active="request()->routeIs('browse')">
                        {{ __('Browse Products') }}
                    </x-nav-link>
                    <x-nav-link :href="route('categories')" :active="request()->routeIs('categories')">
                        {{ __('Categories') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="flex items-center">
                <!-- Icons -->
                <div class="flex space-x-3 mr-1.5">
                    @auth
                        @switch(Auth::user()->role)
                            @case('seller')
                                <span
                                    class="whitespace-nowrap rounded-full bg-yellow-100 px-2.5 py-0.5 mr-1 text-sm text-yellow-600 flex items-center">
                                    Seller
                                </span>
                                @break
                            @case('admin')
                                <span
                                    class="whitespace-nowrap rounded-full bg-green-100 px-2.5 py-0.5 mr-1 text-sm text-green-600 flex items-center">
                                    Admin
                                </span>
                                @break
                        @endswitch
                    @endauth

                    @can('manage-categories')
                        <a href="{{ route("category.index") }}" class="group -m-2 flex items-center p-2">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-6 w-6 flex-shrink-0 {{ request()->routeIs("category.index") ? 'text-gray-500' : 'text-gray-400' }} group-hover:text-gray-500"
                                 fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
                            </svg>
                            <span
                                class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">{{ $categories->count() }}</span>
                        </a>
                    @endcan

                    @can('manage-products')
                        <a href="{{ route("product.index") }}" class="group -m-2 flex items-center p-2">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-6 w-6 flex-shrink-0 {{ request()->routeIs("product.index") ? 'text-gray-500' : 'text-gray-400' }} group-hover:text-gray-500"
                                 fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"/>
                            </svg>
                            <span
                                class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">{{ Auth::user()->products->count() }}</span>
                        </a>
                    @endcan

                    @can('view-cart')
                        <a href="{{ route("cart.index") }}" class="group -m-2 flex items-center p-2">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-6 w-6 flex-shrink-0 {{ request()->routeIs("cart.index") ? 'text-gray-500' : 'text-gray-400' }} group-hover:text-gray-500"
                                 fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            @auth
                                <span
                                    class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">{{ Auth::user()->cart->products->count() }}</span>
                            @endauth
                        </a>
                    @endcan

                    <a href="{{ route("wishlist.index") }}" class="group flex items-center p-2">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-6 w-6 flex-shrink-0 {{ request()->routeIs("wishlist.index") ? 'text-gray-500' : 'text-gray-400' }} group-hover:text-gray-500"
                             fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        @auth
                            <span
                                class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">{{ Auth::user()->wishlist->products->count() }}</span>
                        @endauth
                    </a>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center">
                    @auth
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <p class="block w-full p-4 text-left text-sm leading-5 text-gray-500">
                                    {{ __('Balance: ₱') . Auth::user()->wallet }}
                                </p>

                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('order.index')">
                                    {{ __('Orders') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                                     onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <div class="px-4">
                            <a href="{{ route('login') }}"
                               class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                                in</a>

                            <a href="{{ route('register') }}"
                               class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        </div>
                    @endauth
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('browse')" :active="request()->routeIs('browse')">
                {{ __('Browse Products') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('category.index')" :active="request()->routeIs('category.index')">
                {{ __('Categories') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <p class="block w-full px-4 py-3 text-left text-sm leading-5 text-gray-500">
                        {{ __('Balance: ₱') . Auth::user()->wallet }}
                    </p>

                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('order.index')">
                        {{ __('Orders') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4">
                    <a href="{{ route('login') }}"
                       class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>

                    <a href="{{ route('register') }}"
                       class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
