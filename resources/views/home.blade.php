<x-seekerhome>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ asset('js/map.js') }}"></script>

    <form method="POST" action="{{ route('register') }}" class="grid grid-rows-auto items-center justify-center sm:pt-0 w-full">
        @csrf


        {{-- Category Bar --}}
        <div class="relative w-10/12 md:w-8/12 mx-auto pt-4 overflow-hidden">
            <div class="flex justify-center text-center w-full">
                <div id="categoryContainer" class="flex items-center space-x-4 overflow-x-auto md:overflow-hidden">
                    <!-- Categories -->
                    <x-category-link :href="route('home')" class="inline-block">
                        <div class="flex flex-col items-center">
                            <span class="material-symbols-outlined">local_fire_department</span>
                            <span>{{ __('Popular') }}</span>
                        </div>
                    </x-category-link>
                    <x-category-link class="inline-block">
                        <div class="flex flex-col items-center">
                            <span class="material-symbols-outlined">household_supplies</span>
                            <span>{{ __('Cleaning') }}</span>
                        </div>
                    </x-category-link>
                    <x-category-link class="inline-block">
                        <div class="flex flex-col items-center">
                            <span class="material-symbols-outlined">electric_bolt</span>
                            <span>{{ __('Category 3') }}</span>
                        </div>
                    </x-category-link>
                    <x-category-link class="inline-block">
                        <div class="flex flex-col items-center">
                            <span class="material-symbols-outlined">carpenter</span>
                            <span>{{ __('Category 4') }}</span>
                        </div>
                    </x-category-link>
                    <x-category-link class="inline-block">
                        <div class="flex flex-col items-center">
                            <span class="material-symbols-outlined">plumbing</span>
                            <span>{{ __('Category 5') }}</span>
                        </div>
                    </x-category-link>
                    <x-category-link class="inline-block">
                        <div class="flex flex-col items-center">
                            <span class="material-symbols-outlined">tv</span>
                            <span>{{ __('Category 6') }}</span>
                        </div>
                    </x-category-link>
                    <x-category-link class="inline-block">
                        <div class="flex flex-col items-center">
                            <span class="material-symbols-outlined">tv</span>
                            <span>{{ __('Category 7') }}</span>
                        </div>
                    </x-category-link>
                </div>
            </div>
        </div>
        
        <div class="border-t my-2 relative text-center"></div>

        {{-- Filter Section --}}
        <div class="h-auto md:h-28 bg-custom-light-blue rounded-t-lg w-10/12 md:w-8/12 mx-auto flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0 md:space-x-8 px-4">

            {{-- Date --}}
            <div class="flex flex-col items-start text-white">
                <label for="date">Date:</label>
                <select name="date" id="date" class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-custom-light-blue text-white">
                    <option value="today">Today</option>
                    <option value="tomorrow">Tomorrow</option>
                    <option value="this_week">This Week</option>
                </select>
            </div>

            <div class="border-l border-slate-500 h-auto my-auto hidden md:block"></div>

            {{-- Time --}}
            <div class="flex flex-col items-start text-white">
                <label for="time">Time:</label>
                <select name="time" id="time" class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-custom-light-blue text-white">
                    <option value="morning">Morning</option>
                    <option value="afternoon">Afternoon</option>
                    <option value="evening">Evening</option>
                </select>
            </div>

            <div class="border-l border-slate-500 h-auto my-auto hidden md:block"></div>

            {{-- Ratings --}}
            <div class="flex flex-col items-start text-white">
                <label for="ratings">Ratings:</label>
                <select name="ratings" id="ratings" class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-custom-light-blue text-white">
                    <option value="1_star">1 Star</option>
                    <option value="2_star">2 Stars</option>
                    <option value="3_star">3 Stars</option>
                    <option value="4_star">4 Stars</option>
                    <option value="5_star">5 Stars</option>
                </select>
            </div>

            <div class="border-l border-slate-500 h-auto my-auto hidden md:block"></div>

            {{-- Sort By --}}
            <div class="flex flex-col items-start text-white">
                <label for="sort_by">Sort By:</label>
                <select name="sort_by" id="sort_by" class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-custom-light-blue text-white">
                    <option value="price_asc">Price Low to High</option>
                    <option value="price_desc">Price High to Low</option>
                    <option value="rating_desc">Rating High to Low</option>
                </select>
            </div>
        </div>

        {{-- Other components (Map and Provider List) --}}
        <!-- Grid for providers and map -->
        <div class="grid grid-cols-1 md:grid-cols-3 w-10/12 mx-auto pb-6">
            <!-- Map -->
            <div id="map" class="h-80 md:h-144 w-full md:shadow-md shadow-none md:col-span-1 order-1 md:order-2 rounded-t-lg sm:rounded-b-none md:rounded-r-lg md:rounded-none"></div>
            <!-- Provider List -->
            <div class="p-4 bg-white shadow-md md:col-span-2 order-2 md:order-1 rounded-b-lg md:rounded-l-lg md:rounded-none overflow-y-auto">
                <div class="w-full">
                    <x-text-input id="address" class="block mt-1 w-full rounded-2xl" type="text" name="address" required autofocus autocomplete="address" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
                <div class="h-96">
                    <x-provider-list></x-provider-list>
                    <x-provider-list></x-provider-list>
                </div>
            </div>
        </div>
    </form>
</x-seekerhome>