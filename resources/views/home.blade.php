<x-seekerhome>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ asset('js/map.js') }}"></script>

    <form method="GET" action="{{ route('provider.search') }}" class="w-full">
        @csrf

        {{-- Filter Section --}}
        <div class="border-2 rounded-t-lg w-full md:w-10/12 mx-auto flex flex-wrap items-center justify-center p-4 space-y-4 md:space-y-0 md:space-x-4 mt-8">
            <div class="flex justify-center items-center w-full md:py-4 md:pt-6">
                <div class="text-3xl md:text-2xl text-custom-header font-semibold">Browse Providers</div>
            </div>

            {{-- Category Filter --}}
            <div class="flex flex-col items-center text-header w-full md:w-auto">
                <x-seeker-home-filter name="category" id="category" class="mt-2 w-full md:w-auto">
                    <option class="text-gray-400" value="" disabled selected>Select category</option>
                    <option value="category1">Category 1</option>
                    <option value="category2">Category 2</option>
                    <option value="category3">Category 3</option>
                </x-seeker-home-filter>
            </div>

            {{-- SubCategory Filter --}}
            <div class="flex flex-col items-center text-header md:border-l md:border-slate-500 md:pl-4 w-full md:w-auto">
                <x-seeker-home-filter name="subcategory" id="subcategory" class="mt-2 w-full md:w-auto">
                    <option class="text-gray-400" value="" disabled selected>Select subcategory</option>
                    <option value="subcategory1">Subcategory 1</option>
                    <option value="subcategory2">Subcategory 2</option>
                    <option value="subcategory3">Subcategory 3</option>
                </x-seeker-home-filter>
            </div>

            {{-- Date Filter --}}
            <div class="flex flex-col items-center text-header md:border-l md:border-slate-500 md:pl-4 w-full md:w-auto">
                <x-seeker-home-filter name="date" id="date" class="mt-2 w-full md:w-auto">
                    <option class="text-gray-400" value="" disabled selected>Select date</option>
                    <option value="today">Today</option>
                    <option value="tomorrow">Tomorrow</option>
                    <option value="this_week">This Week</option>
                </x-seeker-home-filter>
            </div>

            {{-- Time Filter --}}
            <div class="flex flex-col items-center text-header md:border-l md:border-slate-500 md:pl-4 w-full md:w-auto">
                <x-seeker-home-filter name="time" id="time" class="mt-2 w-full md:w-auto">
                    <option class="text-gray-400" value="" disabled selected>Select time of day</option>
                    <option value="morning">Morning</option>
                    <option value="afternoon">Afternoon</option>
                    <option value="evening">Evening</option>
                </x-seeker-home-filter>
            </div>

            {{-- Ratings Filter --}}
            <div class="flex flex-col items-center text-header md:border-l md:border-slate-500 md:pl-4 w-full md:w-auto">
                <x-seeker-home-filter name="ratings" id="ratings" class="mt-2 w-full md:w-auto">
                    <option class="text-gray-400" value="" disabled selected>Select rating</option>
                    <option value="1_star">1 Star</option>
                    <option value="2_star">2 Stars</option>
                    <option value="3_star">3 Stars</option>
                    <option value="4_star">4 Stars</option>
                    <option value="5_star">5 Stars</option>
                </x-seeker-home-filter>
            </div>

            {{-- Sort By Filter --}}
            <div class="flex flex-col items-center text-header md:border-l md:border-slate-500 md:pl-4 w-full md:w-auto">
                <x-seeker-home-filter name="sort_by" id="sort_by" class="mt-2 w-full md:w-auto">
                    <option class="text-gray-400" value="" disabled selected>Select sorting</option>
                    <option value="price_asc">Price Low to High</option>
                    <option value="price_desc">Price High to Low</option>
                    <option value="rating_desc">Rating High to Low</option>
                </x-seeker-home-filter>
            </div>

            {{-- Filter Button --}}
            <div class="flex justify-center items-center w-full md:w-auto">
                <button type="submit" class="h-11 w-full md:w-auto justify-center text-sm rounded-lg border text-white font-bold border-custom-lightestblue-accent border-3xl bg-none bg-custom-lightestblue-accent md:px-8">
                    {{ __('Filter') }}
                </button>
            </div>
        </div>

        {{-- Map and Provider List --}}
        <div class="grid grid-cols-1 md:grid-cols-3 w-10/12 mx-auto pb-6" style="min-height: 60vh;">
            <!-- Map -->
            <div id="map" class="w-full h-72 md:h-full md:shadow-md md:col-span-1 order-1 md:order-2 rounded-t-lg md:rounded-none"></div>

            <!-- Provider List -->
            <div class="p-4 bg-white shadow-md md:col-span-2 order-2 md:order-1 rounded-b-lg md:rounded-none overflow-y-hidden" style="height: 60vh;">
                <!-- Search Bar -->
                <div class="pt-4">
                    <div class="relative shadow-sm">
                        <input type="text" id="provider-search" class="w-full rounded-3xl h-12 border border-custom-fields focus:border-custom-lightest-blue pl-4 pr-10" placeholder="Search...">
                        <button type="button" class="absolute right-0 top-0 h-full px-6 flex items-center justify-center bg-custom-lightest-blue text-white rounded-r-3xl rounded-l-md">
                            <span class="material-symbols-outlined">search</span>
                        </button>
                    </div>
                </div>

                {{-- Provider list --}}
                <div class="h-full overflow-y-auto p-4">
                    @if(isset($providers))
                        <h3 class="text-xl font-bold mb-4">Search Results</h3>
                        @if($providers->isEmpty())
                            <div class="bg-red-100 text-red-800 p-4 rounded mb-6">No providers found.</div>
                        @else
                            <ul class="list-none space-y-4">
                                @foreach($providers as $provider)
                                    <li class="mb-4">
                                        <div class="flex flex-col md:flex-row md:items-start">
                                            <x-category :category="$provider->serviceCategory" />
                                            <div class="ml-0 md:ml-4 flex-1">
                                                <div class="flex flex-col md:flex-row justify-between md:items-center">
                                                    <div class="flex items-center mb-2 md:mb-0">
                                                        <div class="font-medium text-lg">{{ $provider->user->name }}</div>
                                                        <div class="ml-2 font-normal text-custom-default-text">Ratings: {{ $provider->ratings }}</div>
                                                    </div>
                                                    <div class="font-normal text-custom-default-text">{{ '16 hires' }}</div>
                                                </div>
                                                <div class="w-full font-normal text-custom-default-text">
                                                    {{ strlen($provider->description) > 225 ? substr($provider->description, 0, 225) . '...' : $provider->description }}
                                                </div>
                                                <div class="flex justify-end items-center mt-2">
                                                    <a href="#" class="text-base h-8 w-38 rounded-md bg-white hover:text-custom-light-blue text-custom-lightest-blue">
                                                        {{ __('View Profile >>') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-t my-4"></div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    @else
                        <x-provider-list></x-provider-list>
                    @endif
                </div>
            </div>
        </div>
    </form>
</x-seekerhome>
