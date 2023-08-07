@props(['review'])

<blockquote class="flex h-full flex-col justify-between bg-white p-12">
    <div>
        <div class="flex gap-0.5 text-green-500">
            <x-review.rating :rating="$review->rating"/>
        </div>

        <div class="mt-4">
            <p class="relative mt-4 text-gray-600 max-h-60 overflow-y-auto">
                {!! nl2br($review->content) !!}
            </p>
        </div>
    </div>

    <footer class="mt-8 text-gray-500 justify-between flex items-center">
        <div>
            {{ $review->user->name }}
            <span class="@if($review->user->id == Auth::user()?->id) font-bold @endif mx-1">
                {{ $review->user->id == Auth::user()?->id ? '(You)' : '' }}
            </span>
        </div>

        @if($review->user->id != Auth::user()?->id)
            @can('delete', $review)
                <span class="inline-flex overflow-hidden rounded-md border bg-white shadow-sm">
                <form method="POST" action="{{ route('review.destroy', $review) }}">
                    @csrf
                    @method('DELETE')

                    <button
                        class="inline-block p-3 text-gray-700 hover:bg-gray-50 focus:relative"
                        title="Delete Product"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="h-4 w-4"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                            />
                        </svg>
                    </button>
                </form>
            </span>
            @endcan
        @endif
    </footer>
</blockquote>
