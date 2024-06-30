<!-- resources/views/components/different-links.blade.php -->
@props(['href'])

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-custom-light-blue border rounded-full font-open-sans font-semibold tracking-widest text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none transition ease-in-out duration-150']) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-custom-light-blue border rounded-full font-open-sans font-semibold tracking-widest text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none transition ease-in-out duration-150']) }}>
        {{ $slot }}
    </button>
@endif