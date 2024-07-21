<select {{ $attributes->merge(['class' =>  'filter mt-1 h-8 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 border-2 border-custom-light-text text-custom-header']) }}>
    {{ $slot }}
</select>