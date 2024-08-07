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
                    <option value="Plumbing">Plumbing</option>
                    <option value="Beauty Therapy">Beauty Therapy</option>
                    <option value="Food Service">Food Service</option>
                    <option value="Welding">Welding</option>
                    <option value="Hairdressing">Hairdressing</option>
                    <option value="Carpentry">Carpentry</option>
                    <option value="Stone Cutting and Masonry">Stone Cutting and Masonry</option>
                    <option value="Electrical">Electrical</option>
                    <option value="Building and Related">Building and Related</option>
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
                        <input type="text" id="provider-search" name="search" class="w-full rounded-3xl h-12 border border-custom-fields focus:border-custom-lightest-blue pl-4 pr-10" placeholder="Search...">
                        <button type="submit" class="absolute right-0 top-0 h-full px-6 flex items-center justify-center bg-custom-lightest-blue text-white rounded-r-3xl rounded-l-md">
                            <span class="material-symbols-outlined">search</span>
                        </button>
                    </div>
                </div>

                <div class="h-full overflow-y-auto p-4">
                    @if(isset($providers))
                        <h3 class="text-xl font-bold mb-4">Search Results</h3>
                        @if($providers->isEmpty())
                            <div class="bg-red-100 text-red-800 p-4 rounded mb-6">No providers found.</div>
                        @else
                            <ul class="list-none space-y-4">
                                @foreach($providers as $provider)
                                    <li class="mb-4">
                                        @if ($provider->user)
                                        <div class="flex flex-col md:flex-row md:items-start">
                                            <x-category :category="$provider->serviceCategory" />
                                            <div class="ml-0 md:ml-4 flex-1">
                                                <div class="flex flex-col md:flex-row justify-between md:items-center">
                                                    <div class="flex items-center mb-2 md:mb-0">
                                                        <div class="font-medium text-lg">{{ $provider->user->name }}</div>
                                                        <div class="ml-2 font-normal text-custom-default-text">
                                                            {{-- Ratings: {{ round($provider->user->ratings_avg_quality_of_service ?? 0, 2) }} --}}
                                                            <div class="text-gray-900 text-lg md:text-xl">
                                                                @php
                                                                $totalRatings = $ratings->count();
                                                                $sumRatings = $ratings->sum(function ($rating) {
                                                                    return ($rating->quality_of_service + $rating->professionalism + $rating->cleanliness_tidiness + $rating->value_for_money + $rating->communication) / 5;
                                                                });
                                        
                                                                $overallRating = $totalRatings > 0 ? $sumRatings / $totalRatings : 0;
                                                                $overallStars = $overallRating / 2; // Convert to star rating scale
                                                                @endphp
                                        
                                                                <div class="flex items-center">
                                                                    @if($totalRatings > 0)
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            @if ($i <= floor($overallStars))
                                                                                <span class="material-icons text-yellow-500">star</span>
                                                                            @elseif ($i - $overallStars < 1)
                                                                                <span class="material-icons text-yellow-500">star_half</span>
                                                                            @else
                                                                                <span class="material-icons text-gray-300">star</span>
                                                                            @endif
                                                                        @endfor
                                                                        <div class="ml-2 text-gray-600">({{ number_format($overallStars * 2, 1) }}/10)</div>
                                                                    @else
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            <span class="material-icons text-gray-300">star</span>
                                                                        @endfor
                                                                        <div class="ml-2 text-gray-600">(0/10)</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="font-normal text-custom-default-text">
                                                        {{ $provider->user->completed_service_requests_count ?? 0 }} hires
                                                    </div>
                                                </div>
                                                <div class="w-full font-normal text-custom-default-text mt-2">
                                                    {{ strlen($provider->description) > 225 ? substr($provider->description, 0, 225) . '...' : $provider->description }}
                                                </div>
                                                <div class="flex justify-end mt-2">
                                                    <a href="{{ url('/view-profile/' . $provider->user->id) }}" class="p-4 h-8 w-38 rounded-md bg-white hover:text-custom-light-blue text-custom-lightest-blue mr-2">
                                                        {{ __('View Profile') }}
                                                    </a>
                                                    <button type="button" onclick="showConfirmationModal({{ $provider->user->id }})" class="p-4 h-8 w-38 rounded-md bg-custom-lightest-blue hover:bg-green-700 text-white">
                                                        {{ __('Direct Hire') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                            <div class="border-t my-4"></div>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                </div>
                @else
                {{-- display all providers --}}
                @endif
                </div>
            </div>
        </div>
    </form>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-bold mb-4">Confirm Direct Hire</h2>
            <p>Are you sure you want to hire this provider?</p>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="hideConfirmationModal()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancel</button>
                <button type="button" onclick="confirmHire()" class="bg-green-500 text-white px-4 py-2 rounded">Confirm</button>
            </div>
        </div>
    </div>

    <script>
        function showConfirmationModal(providerId) {
            document.getElementById('confirmationModal').dataset.providerId = providerId;
            document.getElementById('confirmationModal').classList.remove('hidden');
        }

        function hideConfirmationModal() {
            document.getElementById('confirmationModal').classList.add('hidden');
        }

   function confirmHire() {
    var providerId = document.getElementById('confirmationModal').dataset.providerId;
    window.location.href = '/direct-hire/create/' + providerId;
}

    </script>
</x-seekerhome>
