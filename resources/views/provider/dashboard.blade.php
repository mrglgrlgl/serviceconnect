<x-app-layout>
    <div class="py-12">
        <div class="w-full md:w-10/12 lg:w-8/12 xl:w-8/12 2xl:w-7/12 mx-auto">
            <div class="flex justify-center text-center w-full mb-6">
                <div
                    class="flex items-center space-x-4 sm:space-x-12 md:space-x-20 lg:space-x-28 xl:space-x-28 2xl:space-x-28 overflow-x-auto md:overflow-hidden">
                    <x-nav-link href="{{ route('provider.dashboard') }}" :active="request()->routeIs('provider.dashboard')">
                        {{ __('Open Requests') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('provider.myrequests') }}" :active="request()->routeIs('provider.myrequests')">
                        {{ __('My Requests') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="border-t w-full text-center border-custom-cat-border pb-4"></div>
            </div>

            @if (Auth::check() && Auth::user()->role == 2)
                @if (isset(Auth::user()->philID) && Auth::user()->philID->status === 'Accepted')
                    <!-- PhilID is verified, main content -->
                @else
                    <!-- Profile completeness message -->
                    @if (!isset(Auth::user()->providerDetails))
                        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                            Please complete your profile to view service requests.
                            <a href="{{ route('create-profile') }}" class="text-blue-500 underline">Build Profile</a>
                        </div>
                    @else
                        <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
                            Your profile is complete.
                        </div>
                    @endif

                    <!-- Certifications message -->
                    @if ($certificationsCount === 0)
                        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                            Add your certifications if there are any.
                            <a href="{{ route('certifications') }}" class="text-blue-500 underline">Upload</a>
                        </div>
                    @else
                        <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
                            Certifications are added.
                            <a href="{{ route('certifications') }}" class="text-blue-500 underline">Add another.</a>
                        </div>
                    @endif

                    <!-- PhilID message -->
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                        Your PhilID must be verified to access service requests.
                        <a href="{{ route('philid.index') }}" class="text-blue-500 underline">Submit or Check PhilID Status</a>
                    </div>
                @endif

                @if (isset(Auth::user()->philID) && Auth::user()->philID->status === 'Accepted')
                    @if ($serviceRequests->isEmpty())
                        <div class="bg-blue-100 text-blue-700 p-4 rounded mb-6">
                            No service requests found. <a href="{{ route('service-requests.create') }}" class="text-blue-500">Create one now!</a>
                        </div>
                    @else
                        @foreach ($serviceRequests as $serviceRequest)
                            @php
                                $userBid = $serviceRequest->bids->where('bidder_id', auth()->user()->id)->first();
                            @endphp
                            @if (!$userBid && $serviceRequest->status === 'open')
                                <div class="p-4 border border-gray-300 bg-white shadow-sm rounded-lg md:mb-4">
                                    <div class="flex justify-between items-center mb-4">
                                        <div class="flex items-center space-x-2">
                                            <x-category :category="$serviceRequest->category" class="mr-2 text-gray-900" />
                                            <span class="text-gray-900 font-semibold">{{ $serviceRequest->title }}</span>
                                            <span class="text-gray-900">- {{ $serviceRequest->user->name }}</span>
                                        </div>
                                        <div class="text-sm text-gray-600 md:mt-2">
                                            @if (\Carbon\Carbon::parse($serviceRequest->start_date)->isSameDay(\Carbon\Carbon::parse($serviceRequest->end_date)))
                                            {{ \Carbon\Carbon::parse($serviceRequest->start_date)->format('F j, Y') }},
                                            {{ \Carbon\Carbon::parse($serviceRequest->start_time)->format('h:i A') }} -
                                            {{ \Carbon\Carbon::parse($serviceRequest->end_time)->format('h:i A') }}
                                        @else
                                            {{ \Carbon\Carbon::parse($serviceRequest->start_date . ' ' . $serviceRequest->start_time)->format('F j, Y h:i A') }}
                                            - {{ \Carbon\Carbon::parse($serviceRequest->end_date . ' ' . $serviceRequest->end_time)->format('F j, Y h:i A') }}
                                        @endif
                                        </div>
                                    </div>

                                    @if ($serviceRequest->status !== 'in_progress' && isset($conflictingRequests[$serviceRequest->id]))
                                    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                                        Warning: This service request may have a conflict with your current in-progress tasks.
                                    </div>
                                    @endif

                                    <div class="flex items-start px-8">
                                        <div class="flex-1">
                                            <div class="flex text-gray-700 items-center space-x-4">
                                                <div class="flex items-center p-2">
                                                    <span class="material-symbols-outlined text-gray-500">work</span>
                                                    {{ $serviceRequest->job_type }}
                                                </div>
                                                <div class="flex items-center p-2">
                                                    <span class="material-symbols-outlined text-gray-500">request_quote</span>
                                                    Price: 
                                                    @if ($serviceRequest->min_price)
                                                        {{ $serviceRequest->min_price }} -
                                                    @endif
                                                    {{ $serviceRequest->max_price }}
                                                </div>
                                                <div class="flex items-center p-2">
                                                    Estimated Duration: {{ $serviceRequest->estimated_duration }} {{ 'hours'}}
                                                </div>
                                            </div>
                                            <div class="flex items-center p-2">
                                                <span class="material-symbols-outlined text-red-500">location_on</span>
                                                {{ $serviceRequest->location }}
                                            </div>
                                            <div class="pl-3">Description: {{ $serviceRequest->description }}</div>
                                        </div>
                                    </div>

                                    <div x-data="{ showModal: false, selectedServiceRequestId: null, maxBudget: '', showConfirmationModal: false }">
                                        <div class="flex justify-end items-center space-x-2 mt-4">
                                            <button type="button"
                                                class="bg-custom-light-blue text-white px-4 py-2 rounded hover:bg-cyan-700"
                                                @click="showModal = true; selectedServiceRequestId = {{ $serviceRequest->id }}; maxBudget = '{{ $serviceRequest->max_price }}'">
                                                Place Bid
                                            </button>
                                        </div>

                                        <!-- Bid Modal -->
                                        <div x-show="showModal" x-cloak
                                            class="fixed inset-0 z-40 flex items-center justify-center bg-black bg-opacity-50"
                                            @click.away="showModal = false">
                                            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                                                <div class="bg-white p-4">
                                                    <div class="flex justify-between items-center pb-2">
                                                        <h5 class="text-lg font-semibold text-custom-header">Place Bid</h5>
                                                        <button type="button" class="text-gray-400 hover:text-gray-600"
                                                            aria-label="Close" @click="showModal = false">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('bids.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="service_request_id" :value="selectedServiceRequestId">
                                                        <div class="mb-4">
                                                            <label for="bid_amount" class="block text-sm font-medium text-gray-700">Bid Amount</label>
                                                            <x-text-input type="number" step="0.01"
                                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                                id="bid_amount" name="bid_amount" required />
                                                            <p class="text-sm text-gray-600">Max Budget: <span x-text="maxBudget"></span></p>
                                                            <p id="bid_warning" class="text-red-500 text-sm" style="display: none;">Your bid exceeds the maximum budget!</p>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="bid_description" class="block text-sm font-medium text-gray-700">Work Plan</label>
                                                            <textarea
                                                                class="h-16 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                                                                id="bid_description" name="bid_description" required></textarea>
                                                        </div>

                                                        <!-- Terms and Conditions Checkbox -->
                                                        <div class="mb-4">
                                                            <label class="flex items-center">
                                                                <input type="checkbox" name="agreed_to_terms" value="1" required class="mr-2">
                                                                <span class="text-sm text-gray-700">I agree to the <a href="/terms" target="_blank" class="text-blue-500 underline">terms and conditions</a>.</span>
                                                            </label>
                                                        </div>

                                                        <div class="flex justify-center">
                                                            <button type="submit"
                                                                class="bg-green-500 text-white font-semibold px-4 py-2 rounded hover:bg-green-400">Submit Bid</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                @endif
            @endif
    
        </div>
    </div>



</x-app-layout>