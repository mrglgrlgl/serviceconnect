@props(['id' => null, 'name' => '', 'value' => null, 'disabled' => false])

@php
    $attributes = $attributes->merge([
        'class' => 'inline-flex items-center px-4 py-2 bg-white border border-custom-fields rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:ring-custom-light-blue focus:ring-1 disabled:opacity-25 transition ease-in-out duration-150 w-full focus:border-custom-light-blue',
        'id' => $id,
        'name' => $name,
        'disabled' => $disabled ? 'disabled' : null,
    ]);
@endphp

<select {{ $attributes }}>
    {{ $slot }}
</select>