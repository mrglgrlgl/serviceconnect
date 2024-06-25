<select {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-white border border-custom-fields rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:ring-custom-dark-blue focus:ring-1 disabled:opacity-25 transition ease-in-out duration-150 w-full focus:border-custom-dark-blue']) }}>
    {{ $slot }}
</select>