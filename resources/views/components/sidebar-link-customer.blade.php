@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex flex-col items-center justify-center text-blue-500 w-full h-full transition-colors duration-200' // <-- Class untuk link aktif
            : 'flex flex-col items-center justify-center text-gray-500 hover:text-primary w-full h-full transition-colors duration-200'; // <-- Class untuk link non-aktif
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

