<select {{ $attributes->merge(['class' =>  'mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-custom-light-blue text-gray-300']) }}>
    {{ $slot }}
</select>