@props(['id' => null, 'name' => '', 'value' => '', 'disabled' => false])

@php
    $attributes = $attributes->class('h-12 border w-96 border-custom-fields focus:border-custom-dark-blue rounded-md shadow-sm')
                            ->merge(['id' => $id, 'name' => $name, 'value' => $value]);
@endphp

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes !!}>