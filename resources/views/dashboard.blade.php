<x-dashboard>
    <x-slot name="dashboardbar">
        <div class="relative w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 mx-auto pt-4 overflow-hidden">
            <div class="flex justify-center text-center w-full">
                <div class="flex items-center space-x-4 sm:space-x-12 md:space-x-20 lg:space-x-28 xl:space-x-28 2xl:space-x-28 overflow-x-auto md:overflow-hidden">
                    <x-category-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="inline-block">
                        <div class="flex flex-col items-center text-base md:text-xl">
                            {{ __('Service Requests') }}
                        </div>
                    </x-category-link>
                    <x-category-link class="inline-block">
                        <div class="flex flex-col items-center text-base md:text-xl">
                            {{ __('Analytics') }}
                        </div>
                    </x-category-link>
                </div>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="border-t my-2 w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 text-center"></div>
        </div>
    </x-slot>

    <div x-data="dashboard()" class="py-12">
        <div class="w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 mx-auto">
            @if ($serviceRequests->isEmpty())
                <div class="flex flex-col items-center">
                    <div class="alert-info mb-4">
                        No service requests found. Create one now!
                    </div>
                    <a href="{{ route('service-requests.create') }}"
                        class="h-11 w-auto px-6 justify-center text-sm rounded-lg border text-white font-bold border-custom-lightest-blue hover:text-white hover:border-custom-lightestblue-accent hover:border-3xl bg-custom-lightest-blue hover:bg-custom-lightestblue-accent flex items-center">
                        {{ __('Create Service Request') }}
                    </a>
                </div>
            @else
            @foreach ($serviceRequests as $serviceRequest)
            <div class="servicerequestindividual p-4 bg-white shadow-sm rounded-lg md:mb-4">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex flex-col items-start">
                        <div class="flex items-center">
                            <x-category :category="$serviceRequest->category" class="mr-2" />
                        </div>
                        <x-service-status :status="$serviceRequest->status" />
                    </div>
                    <div class="text-sm text-gray-600 md:mt-2">
                        {{ \Carbon\Carbon::parse($serviceRequest->start_date . ' ' . $serviceRequest->start_time)->format('F j, Y h:i A') }}
                        - {{ \Carbon\Carbon::parse($serviceRequest->end_date . ' ' . $serviceRequest->end_time)->format('F j, Y h:i A') }}
                    </div>
                </div>
        
                <div class="mt-4 mx-12">
                    <div class="font-semibold text-xl mb-2">
                        {{ $serviceRequest->title }}
                    </div>
        
                    <div class="mb-4">
                        {{ $serviceRequest->description }}
                    </div>
        
                    <div class="mb-4">
                        {{-- Request image here --}}
                    </div>
        
                    <div class="flex justify-between items-center">
                        <div>
                            <x-outline-button href="{{ route('service-requests.edit', $serviceRequest) }}" class="flex-1 md:flex-none w-full md:w-auto border-gray-500 hover:bg-gray-500 hover:border-gray-500">
                                <span class="material-symbols-outlined text-gray-500 hover:text-white">
                                    edit
                                </span>
                            </x-outline-button>
                            <form action="{{ route('service-requests.destroy', $serviceRequest) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <x-danger-button class="flex-1 md:flex-none w-full md:w-auto" onclick="return confirm('Are you sure you want to delete this service request?')">
                                    <span class="material-symbols-outlined">
                                        delete
                                    </span>
                                </x-danger-button>
                            </form>
                        </div>
                        <div class="flex items-center">
                            @if ($serviceRequest->hasAcceptedBid())
                                <span class="text-green-500 font-semibold">Bid Confirmed</span>
                                <a href="{{ route('channel.seeker', ['serviceRequest' => $serviceRequest->id]) }}" class="text-blue-500 underline ml-4">Service Request Details</a>
                            @else
                                <span class="text-gray-600">{{ $serviceRequest->bids->count() }} bids</span>
                                <button @click="fetchBids({{ $serviceRequest->id }})" class="ml-4 underline text-blue-500">View Bids >></button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
            @endif
        </div>

<!-- Bids Panel -->
<div x-show="showBidsPanel" class="fixed inset-0 bg-gray-800 bg-opacity-50 z-50 flex justify-end p-4">
    <div class="bg-white p-6 shadow-lg rounded-lg w-full max-w-lg relative" @click.stop>
        <div class="pb-8">
            <button @click="closeBidsPanel()" class="absolute top-4 right-4 text-red-500 text-xl">&times;</button>
        </div>
        <template x-if="bids.length === 0">
            <div class="text-center text-gray-600 bg-gray-100 py-4">
                No bids yet!
            </div>
        </template>
        <ul x-show="bids.length > 0" class="space-y-4">
            <template x-for="bid in bids" :key="bid.id">
                <li x-show="!bid.rejected" class="mb-4 border-b pb-4">
                    <div class="flex justify-between items-start">
                        <div class="flex-grow">
                            <div class="flex justify-between items-center mb-2">
                                <div class="font-semibold text-lg" x-text="bid.bidder.name"></div>
                                <div class="text-gray-600 ml-2" x-text="new Date(bid.created_at).toLocaleString()"></div>
                            </div>
                            <div class="text-gray-600 mb-2" x-text="'Amount: ' + bid.bid_amount"></div>
                            <div class="text-gray-600 mb-4" x-text="bid.bid_description"></div>

                            <div class="flex justify-end space-x-2">
                                <button @click="viewProfile(bid.bidder.id)" class="bg-custom-lightest-blue text-white px-4 py-2 rounded hover:bg-blue-600">View Profile</button>
                                <button x-show="!bid.confirmed" @click="confirmBid(bid.id, selectedRequestId)" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mr-2">Accept Bid</button>
                            </div>
                        </div>
                    </div>
                </li>
            </template>
        </ul>
    </div>
</div>
        {{-- <div class="servicerequestindividual p-4 bg-white shadow-sm rounded-lg md:mb-4">
            <div class="flex justify-between items-start mb-4">
                <div class="flex flex-col items-start">
                    <div class="flex items-center">
                        <x-category :category="$serviceRequest->category" class="mr-2" />
                    </div>
                    <x-service-status :status="$serviceRequest->status" />
                </div>
                <div class="text-sm text-gray-600 md:mt-2">
                    {{ \Carbon\Carbon::parse($serviceRequest->start_date)->format('F j, Y h:i A') }}
                    - {{ \Carbon\Carbon::parse($serviceRequest->end_date)->format('F j, Y h:i A') }}
                </div>
            </div> --}}

            <!-- Profile Modal -->
            <div x-show="showProfileModal"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                @click.away="showProfileModal = false">
                <div class="bg-white p-16 rounded-lg w-3/5 max-w-4xl mx-auto shadow-lg" @click.stop>
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800" x-text="profile.name"></h2>
                        <button @click="showProfileModal = false" class="text-red-500 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="grid grid-cols-1 gap-4">
                        <div class="col-span-1">
                            <div class="flex items-center justify-between mb-2">
                                <div class="font-semibold text-xl text-gray-700" x-text="profile.providerDetails.serviceCategory"></div>
                                <div class="font-semibold text-xl text-gray-700" x-text="profile.providerDetails.years_of_experience + ' years of experience'"></div>
                            </div>
                            <div class="flex justify-between">
                                <div class="text-gray-600 mb-4" x-text="profile.providerDetails.description"></div>
                            <div class="text-gray-600 mb-2" x-text="'Have Tools: ' + (profile.providerDetails.have_tools ? 'Yes' : 'No')"></div>
                            </div>
                            <div class="flex items-center mb-2">
                                <!-- Email Icon and Text Alignment -->
                                <span class="material-symbols-outlined text-gray-600 mr-2">mail</span>
                                <span class="text-gray-600">Email: <span x-text="profile.providerDetails.work_email"></span></span>
                            </div>
                            <div class="flex items-center mb-2">
                                <!-- Phone Icon and Text Alignment -->
                                <span class="material-symbols-outlined text-gray-600 mr-2">call</span>
                                <span class="text-gray-600">Phone: <span x-text="profile.providerDetails.contact_number"></span></span>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-4">
                        <button @click="confirmBid(profile.bidId, selectedRequestId)" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Confirm Bid</button>
                        {{-- <button @click="showProfileModal = false" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Close</button> --}}
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('dashboard', () => ({
                    showBidsPanel: false,
                    showProfileModal: false,
                    bids: [],
                    profile: {},
                    selectedRequestId: null,

                    async fetchBids(requestId) {
                        this.selectedRequestId = requestId;
                        try {
                            const response = await fetch(`/api/service-requests/${requestId}/bids`);
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            const data = await response.json();
                            this.bids = data;
                            this.showBidsPanel = true;
                        } catch (error) {
                            console.error('There was a problem with the fetch operation:', error);
                        }
                    },

                    async viewProfile(bidderId) {
                        try {
                            const response = await fetch(`/api/providers/${bidderId}`);
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            const data = await response.json();
                            this.profile = data; // Update profile data
                            this.showProfileModal = true;
                        } catch (error) {
                            console.error('Error fetching profile:', error);
                        }
                    },

                    async confirmBid(bidId, requestId) {
                        try {
                            const response = await fetch(`/bids/${bidId}/confirm`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({ request_id: requestId })
                            });
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            const data = await response.json();
                            alert(data.message);
                            if (data.success) {
                                // Mark the confirmed bid
                                this.bids.forEach(bid => {
                                    if (bid.id === bidId) {
                                        bid.confirmed = true;
                                    } else {
                                        bid.rejected = true;
                                    }
                                });
                                // Remove rejected bids from the view
                                this.bids = this.bids.filter(bid => !bid.rejected);
                                // Update the service request to show the link
                                const serviceRequest = @json($serviceRequests).find(req => req.id === requestId);
                                serviceRequest.bid_confirmed = true;
                            }
                        } catch (error) {
                            console.error('There was a problem with the fetch operation:', error);
                        }
                    },

                    closeBidsPanel() {
                        this.showBidsPanel = false;
                    },

                    closeProfileModal() {
                        this.showProfileModal = false;
                    }
                }));
            });
        </script>
</x-dashboard>
