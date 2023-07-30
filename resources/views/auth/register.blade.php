<x-guest-layout>
    <form x-data="{ isChecked: {{ old('isChecked') ? 'true' : 'false' }} }" method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex justify-between items-center mt-4">
            <div class="flex items-center">

                <label
                    for="AcceptConditions"
                    class="relative h-6 w-10 cursor-pointer"
                >
                    <input
                        x-model="isChecked"
                        name="isChecked"
                        type="checkbox"
                        id="AcceptConditions"
                        class="peer sr-only"
                    />

                    <span
                        :class="{ 'bg-gray-300': !isChecked, 'bg-green-500': isChecked }"
                        class="absolute inset-0 rounded-full transition"
                    ></span>

                    <span
                        :class="{ 'start-0': !isChecked, 'start-4': isChecked }"
                        class="absolute inset-y-0 m-1 h-4 w-4 rounded-full bg-white transition-all"
                    ></span>
                </label>
                <span x-text="isChecked ? 'Seller' : 'Customer'" class="text-sm text-gray-700 ml-2"></span>
            </div>

            <div class="flex items-center">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </div>
        <x-input-error :messages="$errors->get('isChecked')" class="mt-2" />

    </form>
</x-guest-layout>
