<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Address Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's address information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('address.update') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="street" :value="__('Street')" />
            <x-text-input id="street" name="street" type="text" class="mt-1 block w-full" :value="old('street', $user->address?->street)" autofocus autocomplete="street" />
            <x-input-error class="mt-2" :messages="$errors->get('street')" />
        </div>

        <div>
            <x-input-label for="city" :value="__('City')" />
            <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $user->address?->city)" autocomplete="city" />
            <x-input-error class="mt-2" :messages="$errors->get('city')" />
        </div>

        <div>
            <x-input-label for="state" :value="__('State')" />
            <x-text-input id="state" name="state" type="text" class="mt-1 block w-full" :value="old('state', $user->address?->state)" autocomplete="state" />
            <x-input-error class="mt-2" :messages="$errors->get('state')" />
        </div>

        <div>
            <x-input-label for="country" :value="__('Country')" />
            <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" :value="old('country', $user->address?->country)" autocomplete="country" />
            <x-input-error class="mt-2" :messages="$errors->get('country')" />
        </div>

        <div>
            <x-input-label for="zip_code" :value="__('Zip Code')" />
            <x-text-input id="zip_code" name="zip_code" type="text" class="mt-1 block w-full" :value="old('zip_code', $user->address?->zip_code)" autocomplete="zip_code" />
            <x-input-error class="mt-2" :messages="$errors->get('zip_code')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'address-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
