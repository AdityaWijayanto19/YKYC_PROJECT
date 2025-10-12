@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex flex-col items-center justify-center text-primary w-full h-full transition-colors duration-200' 
            : 'flex flex-col items-center justify-center text-gray-500 hover:text-primary w-full h-full transition-colors duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

