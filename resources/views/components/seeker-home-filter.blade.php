<select {{ $attributes->merge(['class' =>  'filter mt-1 h-8 rounded-md shadow-sm focus:border-gray-300 focus:ring border-2 border-custom-lightest-blue text-custom-header']) }}>
    {{ $slot }}
</select>