@props(['title' => 'Success!', 'type' => 'success'])

<x-modal name="alert" show="true">
    <div
        role="alert"
        class="rounded-xl border border-gray-100 bg-white p-4 shadow-xl"
    >
        <div class="flex items-start gap-4">

            @switch($type)
                @case('success')
                    <span class="text-green-600">
                      <svg
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke-width="1.5"
                          stroke="currentColor"
                          class="h-6 w-6">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                      </svg>
                    </span>
                    @break
                @case('warning')
                    <span class="text-orange-600">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                            class="h-6 w-6">
                          <path
                              fill-rule="evenodd"
                              d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
                              clip-rule="evenodd"
                          />
                        </svg>
                    </span>
                    @break
            @endswitch

            <div class="flex-1">
                <strong class="block font-medium text-gray-900"> {{ $title }} </strong>

                <p class="mt-1 text-sm text-gray-700">
                    {{ $slot }}
                </p>
            </div>

            <button class="text-gray-500 transition hover:text-gray-600" x-on:click="$dispatch('close')">
                <span class="sr-only">Dismiss popup</span>

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="h-6 w-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>
        </div>
    </div>
</x-modal>
