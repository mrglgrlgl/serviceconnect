<x-app-layout>
    <div class="py-12">
        <div class="w-full md:w-10/12 lg:w-8/12 xl:w-8/12 2xl:w-7/12 mx-auto">
            @if (Auth::check() && Auth::user()->role == 2)

                <!-- Start with PhilID check -->
                @if (isset(Auth::user()->philID) && Auth::user()->philID->status === 'Accepted')
                    <!-- PhilID is verified, you can load the main content or skip displaying other messages -->
                @else
                    <!-- Profile completeness message -->
                    @if (!isset(Auth::user()->providerDetails))
                        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                            Please complete your profile to view service requests.
                            <a href="{{ route('create-profile') }}" class="text-blue-500">Build Profile</a>
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
                            <a href="{{ route('certifications') }}" class="text-blue-500">Upload</a>
                        </div>
                    @else
                        <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
                            Certifications are added.
                        </div>
                    @endif

                    <!-- PhilID message -->
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                        Your PhilID must be verified to access service requests.
                        <a href="{{ route('philid.index') }}" class="text-blue-500">Submit or Check PhilID Status</a>
                    </div>
                @endif

                <!-- Display Service Requests if PhilID is verified -->
                @if (isset(Auth::user()->philID) && Auth::user()->philID->status === 'Accepted')
                    @if ($serviceRequests->isEmpty())
                        <div class="bg-blue-100 text-blue-700 p-4 rounded mb-6">
                            No service requests found. <a href="{{ route('service-requests.create') }}"
                                class="text-blue-500">Create one now!</a>
                        </div>
                    @else
                        @foreach ($serviceRequests as $serviceRequest)
                            <div class="p-4 border border-gray-300 shadow-sm rounded-lg md:mb-4">
                                <div class="flex justify-between items-center mb-4">
                                    <div class="flex items-center space-x-2">
                                        <x-category :category="$serviceRequest->category" class="mr-2 text-gray-900" />
                                        <span class="text-gray-900 font-semibold">{{ $serviceRequest->title }}</span>
                                        <span class="text-gray-900">- {{ $serviceRequest->user->name }}</span>
                                    </div>

                                    <div class="text-sm text-gray-600 md:mt-2">
                                        {{ \Carbon\Carbon::parse($serviceRequest->start_date)->format('F j, Y') }}
                                        {{ \Carbon\Carbon::parse($serviceRequest->start_time)->format('h:i A') }} -
                                        {{ \Carbon\Carbon::parse($serviceRequest->end_date)->format('F j, Y') }}
                                        {{ \Carbon\Carbon::parse($serviceRequest->end_time)->format('h:i A') }}
                                    </div>
                                </div>

                               <div class="flex items-start px-8">
                                    <div class="flex-1">
                                        <div class="flex text-gray-700 items-center space-x-4">
                                            <div class="flex items-center p-2">
                                                <span class="material-symbols-outlined mr-1">work</span>
                                                {{ $serviceRequest->job_type }}
                                            </div>

                                            <div class="flex items-center p-2">
                                                <span class="material-symbols-outlined mr-1">request_quote</span>
                                                Price Range: {{ $serviceRequest->min_price }} - {{ $serviceRequest->max_price }}
                                            </div>

                                            <div class="flex items-center p-2">
                                                Estimated Duration: {{ $serviceRequest->estimated_duration }}
                                            </div>
                                        </div>

                                        <div class="flex items-center p-2">
                                            <span class="material-symbols-outlined mr-1 text-red-500">location_on</span>
                                            {{ $serviceRequest->location }}
                                        </div>
                                        <div class="pl-3">Description: {{ $serviceRequest->description }}</div>
                                    </div>
                                </div>
                                <!-- Display Service Request Status Here -->
                                <div class="pl-3 text-sm text-gray-600">
                                    Status: {{ ucfirst($serviceRequest->status) }}
                                </div>
                                <div class="flex justify-end items-center space-x-2 mt-4">
                                    @php
                                        $userBid = $serviceRequest->bids
                                            ->where('bidder_id', auth()->user()->id)
                                            ->first();
                                        $acceptedBidsCount = $serviceRequest->bids
                                            ->where('status', 'accepted')
                                            ->where('bidder_id', '!=', auth()->user()->id)
                                            ->count();
                                    @endphp

                                    @if ($userBid)
                                        <span class="bid-indicator text-slate-500 font-semibold">
                                            @if ($userBid->status == 'accepted')
                                                <span class="text-green-500 font-semibold">Bid Accepted</span>
                                            @elseif ($userBid->status == 'rejected')
                                                <span class="text-red-500 font-semibold">Bid Closed</span>
                                            @else
                                                Bid Sent <i class="fas fa-check"></i>
                                            @endif
                                        </span>
                                    @endif

                                    <div x-data="{ showModal: false, showConfirmationModal: false }">
                                        @if ($userBid)
                                            @if ($userBid->status == 'accepted')
                                                <a href="#" class="text-blue-500 underline ml-3"
                                                    @click.prevent="showConfirmationModal = true">
                                                    Go to chat
                                                </a>
                                                @if (!$serviceRequest->isCompleted())
                                                    <a
                                                        href="{{ route('provider-channel', ['serviceRequestId' => $serviceRequest->id]) }}">View
                                                        Channel</a>
                                                @else
                                                    <span class="text-gray-500 ml-4">This service request is completed
                                                        and no
                                                        longer available.</span>
                                                @endif
                                            @elseif ($userBid->status == 'rejected')
                                                <span class="text-red-500 font-semibold">Bid Closed</span>
                                            @else
                                                <button type="button"
                                                    class="border-2 border-custom-light-blue text-custom-light-blue hover:text-white hover:border-cyan-700 font-semibold px-4 py-2 rounded hover:bg-cyan-700 flex items-center space-x-2"
                                                    @click="showModal = true">
                                                    <span class="material-symbols-outlined">edit</span>
                                                    <span>Edit Bid</span>
                                                </button>
                                            @endif
                                        @elseif ($serviceRequest->status === 'open' && $acceptedBidsCount == 0)
                                            <button type="button"
                                                class="bg-custom-light-blue text-white px-4 py-2 rounded hover:bg-cyan-700"
                                                @click="showModal = true">
                                                Place Bid
                                            </button>
                                        @else
                                            <span class="text-gray-500">This service request is no longer open for
                                                bids.</span>
                                        @endif

                                        <!-- Bid Modal -->
                                        <div x-show="showModal" x-cloak
                                            class="fixed inset-0 z-40 flex items-center justify-center bg-black bg-opacity-50"
                                            @click.away="showModal = false">
                                            <div
                                                class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                                                <div class="bg-white p-4">
                                                    <div class="flex justify-between items-center pb-2">
                                                        <h5 class="text-lg font-semibold text-custom-header">Place Bid
                                                        </h5>
                                                        <button type="button" class="text-gray-400 hover:text-gray-600"
                                                            aria-label="Close" @click="showModal = false">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('bids.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="service_request_id"
                                                            value="{{ $serviceRequest->id }}">
                                                        <div class="mb-4">
                                                            <label for="bid_amount"
                                                                class="block text-sm font-medium text-gray-700">Bid
                                                                Amount</label>
                                                            <x-text-input type="number" step="0.01"
                                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                                id="bid_amount" name="bid_amount" required />
                                                            <p class="text-sm text-gray-600">Max Budget:
                                                                {{ $serviceRequest->job_type === 'hourly_rate' ? $serviceRequest->max_price : $serviceRequest->expected_price_max }}
                                                            </p>
                                                            <p id="bid_warning" class="text-red-500 text-sm"
                                                                style="display: none;">
                                                                Your bid exceeds the maximum budget!</p>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="bid_description"
                                                                class="block text-sm font-medium text-gray-700">Work
                                                                Plan</label>
                                                            <textarea
                                                                class="h-16 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                                id="bid_description" name="bid_description" required></textarea>
                                                        </div>

                                                        <!-- Terms and Conditions Checkbox -->
                                                        <div class="mb-4">
                                                            <label class="flex items-center">
                                                                <input type="checkbox" name="agreed_to_terms"
                                                                    value="1" required class="mr-2">
                                                                <span class="text-sm text-gray-700">I agree to the <a
                                                                        href="/terms" target="_blank"
                                                                        class="text-blue-500 underline">terms and
                                                                        conditions</a>.</span>
                                                            </label>
                                                        </div>


                                                        <div class="flex justify-center">
                                                            <button type="submit"
                                                                class="bg-green-500 text-white font-semibold px-4 py-2 rounded hover:bg-green-400">Submit
                                                                Bid</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Confirmation Modal -->
                                        <div x-show="showConfirmationModal" x-cloak
                                            class="fixed inset-0 z-40 flex items-center justify-center bg-black bg-opacity-50"
                                            @click.away="showConfirmationModal = false">
                                            <div
                                                class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                                                <div class="bg-white p-4">
                                                    <div class="flex justify-between items-center pb-2">
                                                        <h5 class="text-lg font-semibold text-custom-header">Bid
                                                            Accepted</h5>
                                                        <button type="button"
                                                            class="text-gray-400 hover:text-gray-600"
                                                            aria-label="Close" @click="showConfirmationModal = false">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="text-center">
                                                        <p class="mb-4"
                                                            x-text="'Bid accepted from: ' + providerName + ', bid: ' + bidAmount">
                                                        </p>
                                                        <div class="flex justify-center space-x-4">
                                                            <a href="{{ route('chat') }}"
                                                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Proceed
                                                                to Chat</a>
                                                            <button type="button"
                                                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
                                                                @click="showConfirmationModal = false">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endif
            @else
                <!-- Logic for other user roles -->
            @endif
        </div>
    </div>
</x-app-layout>
