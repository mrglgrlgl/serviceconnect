<x-guest-layout>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="{{ asset('js/map.js') }}"></script>

<form method="POST" action="{{ route('register') }}" class="w-full mx-auto">
        @csrf

        <div class="w-max">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" required autofocus autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />

            <!-- Map  -->
            <div id="map" style="height: 500px; width: 900px;" class="mt-4 w-full "></div>
        </div>

        <div class="mt-4 flex justify-end items-end">
            <x-primary-button class="text-white">
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>