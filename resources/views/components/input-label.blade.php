@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-normal text-sm font-open-sans text-custom-dark-blue md:pb-1']) }}>
    {{ $value ?? $slot }}
</label>
