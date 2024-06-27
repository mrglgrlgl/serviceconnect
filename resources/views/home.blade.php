<x-seekerhome>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ asset('js/map.js') }}"></script>

    <form method="POST" action="{{ route('register') }}" class="">
        @csrf

        <div class="max-w-7xl min-w-full flex flex-col items-center justify-center sm:pt-0">
    <div class="h-28 bg-custom-light-blue sm:rounded-lg w-7/12">
    </div>

            <!-- List of providers & search bar -->
            <div class="flex justify-between ">
                <div class="w-2/5 p-4 bg-white rounded-lg shadow-md ">
                    <div class="h-auto w-full ">
                        <x-text-input id="address" class="block mt-1 w-full rounded-2xl" type="text" name="address" required autofocus autocomplete="address" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />

                        <!-- Providers list -->
                    </div>
                    <div>
                        <x-provider-list>

                        </x-provider-list>
                    </div>
                </div>

                <!-- Map  -->
                <div id="map" class="h-96 w-full "></div>
            </div>

            <div class="mt-4 flex justify-end items-end">
                <x-primary-button class="text-white">
                    {{ __('Submit') }}
                </x-primary-button>
            </div>
        </div>
        </div>

    </form>
</x-seekerhome>