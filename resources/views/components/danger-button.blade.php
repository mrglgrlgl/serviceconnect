<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center w-full px-4 py-2 bg-custom-danger border border-transparent rounded-md font-semibold text-base text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>