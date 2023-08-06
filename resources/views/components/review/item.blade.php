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
        <span class="@if($review->user->id == Auth::user()?->id) font-bold @endif">
            {{ $review->user->name }}
        </span>

        {{ $review->user->id == Auth::user()?->id ? '(You)' : '' }}
    </footer>
</blockquote>
