@props(['src', 'alt' => '', 'class' => 'lg:w-1/3 w-full object-cover object-center rounded border border-gray-200 shadow'])

<img
    src="{{ $src }}"
    alt="{{ $alt }}"
    class="{{ $class }}"
/>
