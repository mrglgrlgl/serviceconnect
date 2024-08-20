@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-normal font-open-sans text-custom-dark-blue md:pb-1']) }}>
    {{ $value ?? $slot }}
</label>
