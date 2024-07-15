<!-- <button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-custom-light-blue border border-transparent rounded-full font-semibold text-white tracking-widest hover:bg-custom-light-blue focus:bg-gray-700 active:bg-custom-light-blue focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }} -->
     
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-custom-light-blue border rounded-full  font-semibold tracking-widest hover:bg-custom-light-blue focus:bg-gray-700 active:bg-custom-light-blue focus:outline-none transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
