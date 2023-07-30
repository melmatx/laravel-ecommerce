@props(['src', 'alt' => '', 'class' => 'lg:w-1/2 w-full object-cover object-center rounded border border-gray-200'])

<img
    src="{{ $src }}"
    alt="{{ $alt }}"
    class="{{ $class }}"
/>
