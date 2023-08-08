@props(['label' => "Placeholder"])

<div class="flex items-center gap-4 h-20">
    <div class="rounded-full bg-blue-100 p-3 text-blue-600">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-8 w-8"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
        >
            @if (isset($svgPath))
                {{ $svgPath }}
            @endif
        </svg>
    </div>

    <div class="mr-10">
        <p class="text-2xl font-medium text-gray-900">{{ $slot }}</p>

        <p class="text-sm text-gray-500">{{ $label }}</p>
    </div>
</div>
