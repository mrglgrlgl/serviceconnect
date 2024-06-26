@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'h-12 border w-96 border-custom-fields focus:border-custom-dark-blue rounded-md shadow-sm']) !!}>
