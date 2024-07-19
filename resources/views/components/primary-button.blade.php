<!-- resources/views/components/primary-button.blade.php -->
@props(['href' => null, 'route' => null])

@php
    $classes = 'inline-flex items-center px-4 py-2 bg-custom-light-blue border rounded-full font-semibold tracking-widest hover:bg-custom-light-blue focus:bg-gray-700 active:bg-custom-light-blue focus:outline-none transition ease-in-out duration-150';

    if ($href || $route) {
        $classes .= ' text-white';
    } else {
        $classes .= ' text-white';
    }
@endphp

@if ($href || $route)
    <a href="{{ $href ?? ($route ? route($route) : '#') }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif