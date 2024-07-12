<x-seekerhome>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ asset('js/map.js') }}"></script>

    {{-- <x-service-request-create id="serviceRequestModal" /> --}}

    <form method="POST" action="{{ route('register') }}" class="grid items-center justify-center sm:pt-0 w-full">
        @csrf

        {{-- Category Bar --}}
        {{-- <div class="relative w-10/12 md:w-8/12 mx-auto pt-4 overflow-hidden">
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
        </div> --}}

        <div class="flex justify-center items-center md:py-4 md:pt-8">
            <div class="text-3xl text-custom-light-blue font-semibold">Browse Providers</div>
        </div>

        {{-- Filter Section --}}
        <div
            class="h-auto md:h-28 bg-custom-light-blue rounded-t-lg w-10/12 md:w-8/12 mx-auto flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0 md:space-x-8 px-4">

            {{-- Category --}}
            <div class="flex flex-col items-center text-white md:border-l md:border-slate-500 md:pl-4">
                <label for="date">Category:</label>
                <x-seeker-home-filter name="date" id="date" class="mt-2 md:mt-0">
                    <option value="today">Today</option>
                    <option value="tomorrow">Tomorrow</option>
                    <option value="this_week">This Week</option>
                </x-seeker-home-filter>
            </div>

            {{-- SubCategory --}}
            <div class="flex flex-col items-center text-white md:border-l md:border-slate-500 md:pl-4">
                <label for="date">Subcategory:</label>
                <x-seeker-home-filter name="date" id="date" class="mt-2 md:mt-0">
                    <option value="today">Today</option>
                    <option value="tomorrow">Tomorrow</option>
                    <option value="this_week">This Week</option>
                </x-seeker-home-filter>
            </div>

            {{-- Date --}}
            <div class="flex flex-col items-center text-white md:border-l md:border-slate-500 md:pl-4">
                <label for="date">Date:</label>
                <x-seeker-home-filter name="date" id="date" class="mt-2 md:mt-0">
                    <option value="today">Today</option>
                    <option value="tomorrow">Tomorrow</option>
                    <option value="this_week">This Week</option>
                </x-seeker-home-filter>
            </div>

            {{-- Time --}}
            <div class="flex flex-col items-center text-white md:border-l md:border-slate-500 md:pl-4 mt-4 md:mt-0">
                <label for="time">Time:</label>
                <x-seeker-home-filter name="time" id="time" class="mt-2 md:mt-0">
                    <option value="morning">Morning</option>
                    <option value="afternoon">Afternoon</option>
                    <option value="evening">Evening</option>
                </x-seeker-home-filter>
            </div>

            {{-- Ratings --}}
            <div class="flex flex-col items-center text-white md:border-l md:border-slate-500 md:pl-4 mt-4 md:mt-0">
                <label for="ratings">Ratings:</label>
                <x-seeker-home-filter name="ratings" id="ratings" class="mt-2 md:mt-0">
                    <option value="1_star">1 Star</option>
                    <option value="2_star">2 Stars</option>
                    <option value="3_star">3 Stars</option>
                    <option value="4_star">4 Stars</option>
                    <option value="5_star">5 Stars</option>
                </x-seeker-home-filter>
            </div>

            {{-- Sort By --}}
            <div class="flex flex-col items-center text-white md:border-l md:border-slate-500 md:pl-4 mt-4 md:mt-0">
                <label for="sort_by">Sort By:</label>
                <x-seeker-home-filter name="sort_by" id="sort_by" class="mt-2 md:mt-0">
                    <option value="price_asc">Price Low to High</option>
                    <option value="price_desc">Price High to Low</option>
                    <option value="rating_desc">Rating High to Low</option>
                </x-seeker-home-filter>
            </div>

            <div class="relative justify-center pt-2 px-8">
                <button :href="route('dashboard')"
                    class="h-11 mx-4 w-full justify-center text-sm rounded-lg border text-white font-bold border-white hover:text-white hover:border-custom-lightestblue-accent hover:border-3xl bg-none hover:bg-custom-lightestblue-accent ">
                    {{ __('Filter') }}
                </button>
            </div>
        </div>

        {{-- Other components (Map and Provider List) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 w-10/12 mx-auto pb-6">
            <!-- Map -->
            <div id="map"
                class="h-80 md:h-144 w-full md:shadow-md md:col-span-1 order-1 md:order-2 rounded-t-lg md:rounded-none">
            </div>

            <!-- Provider List -->
            <div
                class="p-4 bg-white shadow-md md:col-span-2 order-2 md:order-1 rounded-b-lg md:rounded-none overflow-y-auto">
                <!-- Search Bar -->
                <div class="pt-4">
                    <div class="relative shadow-sm">
                        <input type="text" id="provider-search"
                            class="w-full rounded-3xl h-12 border border-custom-fields focus:border-custom-dark-blue pl-4 pr-10"
                            placeholder="Search...">
                        <button type="button"
                            class="absolute right-0 top-0 h-full px-6 flex items-center justify-center bg-custom-light-blue text-white rounded-r-3xl rounded-l-md">
                            <span class="material-symbols-outlined">search</span>
                        </button>
                    </div>
                </div>

                {{-- Provider list component --}}
                <div class="h-96">
                    <x-provider-list></x-provider-list>
                    <x-provider-list></x-provider-list>
                </div>
            </div>
        </div>
    </form>
    {{-- @if (Auth::check())
    <p>User Role: {{ Auth::user()->role }}</p>
@endif --}}
</x-seekerhome>
