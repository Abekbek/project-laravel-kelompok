@props(['active'])

@php
    $classes = $active
                ? 'inline-flex items-center px-1 pt-1 border-b-2 border-white/80 text-sm font-medium leading-5 text-white focus:outline-none focus:border-white transition'
                : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-400 hover:text-gray-300 hover:border-gray-500 focus:outline-none focus:text-gray-300 focus:border-gray-500 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
