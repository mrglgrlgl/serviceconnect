@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-2 pt-1 pb-2 border-b-4 border-custom-dark-blue text-lg font-medium leading-5 focus:outline-none focus:border-custom-yellow transition duration-150 ease-in-out'
            
            : 'inline-flex items-center px-1 pt-1 pb-2 border-b-2 border-transparent text-lg font-medium leading-5 text-gray-400 hover:text-gray-400 hover:border-custom-yellow focus:outline-none focus:text-gray-300 focus:border-custom-yellow transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>