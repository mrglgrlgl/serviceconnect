<x-app-layout>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <div class="max-w-screen-5xl mx-auto">
        <form method="GET" action="{{ route('provider.search') }}" class="w-full">
            @csrf

            {{-- Filter Section --}}
            <div class="border-2 rounded-t-lg w-full mx-auto flex flex-wrap items-center justify-center p-4 space-y-4 md:space-y-0 md:space-x-4 mt-8 bg-cover bg-center bg-no-repeat rounded-r-lg bg-gradient-to-b from-sky-900 to-cyan-600">
                <div class="flex justify-center items-center w-full md:py-4 md:pt-6">
                    <div class="text-3xl md:text-2xl text-white font-semibold">Browse Providers</div>
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

            {{-- Provider List Only (Map Removed) --}}
            <div class="p-4 bg-white shadow-md w-full mx-auto pb-6 rounded-lg overflow-y-hidden" style="min-height: 60vh;">
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
                                            <div class="flex flex-col md:flex-row md:items-start space-y-4 md:space-y-0">
                                                <div class="md:w-1/4">
                                                    <x-category :category="$provider->serviceCategory" />
                                                </div>
                                                <div class="md:w-3/4">
                                                    <div class="flex justify-between items-center mb-2">
                                                        <div class="font-medium text-lg">
                                                            {{ $provider->user->name }}
                                                        </div>
                                                        <div class="flex space-x-4 text-custom-default-text">
                                                            <span>Ratings: {{ round($provider->user->ratings_avg_quality_of_service ?? 0, 2) }}</span>
                                                            <span>{{ $provider->user->completed_service_requests_count ?? 0 }} hires</span>
                                                        </div>
                                                    </div>
                                                    <div class="font-normal text-custom-default-text mb-4">
                                                        {{ strlen($provider->description) > 225 ? substr($provider->description, 0, 225) . '...' : $provider->description }}
                                                    </div>
                                                    <div class="flex justify-end items-center space-x-4">
                                                        <a href="{{ url('/view-profile/' . $provider->user->id) }}" class="text-base h-10 px-4 rounded-md bg-white border border-gray-300 hover:text-custom-light-blue text-custom-lightest-blue flex items-center justify-center">
                                                            {{ __('View Profile') }}
                                                        </a>
                                                        <button type="button" onclick="showConfirmationModal({{ $provider->user->id }})" class="text-base h-10 px-4 rounded-md bg-green-500 hover:bg-green-700 text-white flex items-center justify-center">
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
                    @else
                        {{-- Display all providers if applicable --}}
                    @endif
                </div>
            </div>
        </form>
    </div>

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
</x-app-layout>
