<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center w-full px-4 py-2 bg-none border justify-center text-base rounded-lg text-custom-light-blue font-bold border-2 border-custom-light-blue hover:text-white hover:border-custom-lightestblue-accent bg-none hover:bg-custom-lightestblue-accent']) }}>
    {{ $slot }}
</button>