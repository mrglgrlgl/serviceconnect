<x-guest-layout>
    <div class="text-2xl text-center text-custom-header">Register As</div>
    <div class="flex justify-center mt-4">
        <!-- Provider Registration -->
        <a href="{{ route('register.provider') }}">
            <x-primary-button class="h-12 w-48 mx-2 justify-center text-white text-xl">
                {{ __('Provider') }}
            </x-primary-button>
        </a>
        <!-- Seeker Registration -->
        <a href="{{ route('register') }}">
            <x-primary-button class="h-12 w-48 mx-2 justify-center text-white text-xl">
                {{ __('Seeker') }}
            </x-primary-button>
        </a>
    </div>
</x-guest-layout>
