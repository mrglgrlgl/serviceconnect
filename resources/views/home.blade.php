<x-seekerhome>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ asset('js/map.js') }}"></script>

    <form method="POST" action="{{ route('register') }}" class="flex flex-col items-center justify-center sm:pt-0">
        @csrf

        <div class="h-28 bg-custom-light-blue sm:rounded-l-lg w-8/12">
            <!-- Placeholder for content or decoration -->
        </div>

        <!-- List of providers & search bar -->
        <div class="flex justify-between w-10/12 mt-4">
            <!-- Providers List -->
            <div class="w-3/5 p-4 bg-white rounded-lg shadow-md overflow-y-auto max-h-144 min-h-144">
                <div class="w-full">
                    <x-text-input id="address" class="block mt-1 w-full rounded-2xl" type="text" name="address" required autofocus autocomplete="address" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                {{-- List of provider component --}}
                {{-- diri na di ang loop ka list of providers --}}
                <div class="h-full">
                    <x-provider-list></x-provider-list>
                </div>
            </div>

            <!-- Map -->

            <div id="map" class="w-2/5 max-h-144 rounded-r-lg shadow-md"></div>
        </div>


        {{-- <div class="mt-4 flex justify-end items-end">
            <x-primary-button class="text-white">
                {{ __('Submit') }}
            </x-primary-button>
        </div> --}}

    </form>
</x-seekerhome>