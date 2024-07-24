<x-seekerhome>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ asset('js/map.js') }}"></script>

    <form method="GET" action="{{ route('provider.search') }}" class="grid items-center justify-center sm:pt-0 w-full">
        @csrf

        <div class="flex justify-center items-center md:py-4 md:pt-8">
            <div class="text-3xl text-custom-light-blue font-semibold">Browse Providers</div>
        </div>

        {{-- Filter Section --}}
        <div class="bg-custom-light-blue rounded-t-lg w-full md:w-10/12 mx-auto flex flex-wrap items-center justify-center p-4 space-y-4 md:space-y-0 md:space-x-8">
            {{-- Existing filters (Category, Subcategory, etc.) --}}
            {{-- Add a new search input --}}
            <div class="flex flex-col items-center text-white md:pl-4 w-full md:w-auto">
                <label for="search">Search by Name or Category:</label>
                <input type="text" name="search" id="search" class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter provider name or category">
            </div>
            
            <div class="flex justify-center items-center w-full md:w-auto">
                <button type="submit" class="h-11 w-full md:w-auto justify-center text-sm rounded-lg border text-white font-bold border-white hover:text-white hover:border-custom-lightestblue-accent hover:border-3xl bg-none hover:bg-custom-lightestblue-accent md:px-8">
                    {{ __('Filter') }}
                </button>
            </div>
        </div>

        {{-- Other components (Map and Provider List) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 w-10/12 mx-auto pb-6">
            <!-- Map -->
            <div id="map" class="h-80 md:h-144 w-full md:shadow-md md:col-span-1 order-1 md:order-2 rounded-t-lg md:rounded-none">
            </div>

            <!-- Provider List -->
            <div class="p-4 bg-white shadow-md md:col-span-2 order-2 md:order-1 rounded-b-lg md:rounded-none overflow-y-auto">
                {{-- Provider list component --}}
                <div class="h-96">
                    @if(isset($providers))
                        <h3 class="text-xl font-bold mb-4">Search Results</h3>
                        @if($providers->isEmpty())
                            <div class="bg-red-100 text-red-800 p-4 rounded mb-6">
                                No providers found.
                            </div>
                        @else
                            <ul class="list-disc pl-5">
                                @foreach($providers as $provider)
                                    <li class="mb-2">
                                        <span class="font-semibold">{{ $provider->user->name }}</span> - {{ $provider->serviceCategory }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    @else
                        <x-provider-list></x-provider-list>
                        <x-provider-list></x-provider-list>
                    @endif
                </div>
            </div>
        </div>
    </form>
</x-seekerhome>