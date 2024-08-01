<x-dashboard>
    <div class="py-12">
        <div class="w-full md:w-10/12 lg:w-8/12 xl:w-8/12 2xl:w-6/12 mx-auto">
            <!-- Navigation Links -->
            <div class="flex justify-center text-center w-full">
                <div class="flex items-center space-x-4 sm:space-x-12 md:space-x-20 lg:space-x-28 xl:space-x-28 2xl:space-x-28 overflow-x-auto md:overflow-hidden">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('My Requests') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('analytics') }}" :active="request()->routeIs('provider.analytics')">
                        {{ __('Analytics') }}
                    </x-nav-link>
                </div>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="border-t w-full md:w-10/12 lg:w-8/12 xl:w-8/12 2xl:w-6/12 mx-auto text-center border-custom-cat-border"></div>
        </div>

    <div class="pt-6 pb-6 bg-gray-100 " x-data="{ filter: 'all' }">
        <div class="w-full md:w-10/12 lg:w-8/12 xl:w-8/12 2xl:w-6/12 mx-auto flex justify-end">
            <div class="relative inline-block pb-4">
                <select x-model="filter" class="form-select block w-full md:w-40 pl-10 pr-4 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500">
                    <option value="all">All Requests</option>
                    <option value="open">Open</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
                <span class="material-icons absolute left-3 top-2.5 text-gray-400">filter_list</span>
            </div>
        </div>

        <div x-data="dashboard()">
        <div class="w-full md:w-10/12 lg:w-8/12 xl:w-8/12 2xl:w-6/12 mx-auto">
            @if ($serviceRequests->isEmpty())
                <div class="flex flex-col items-center">
                    <div class="alert-info mb-4 text-custom-danger">
                        No service requests found. Create one now!
                    </div>
                    <a href="{{ route('service-requests.create') }}"
                       class="h-11 w-auto px-6 justify-center text-sm rounded-lg border text-white font-bold border-custom-lightest-blue hover:text-white hover:border-custom-lightestblue-accent bg-custom-lightest-blue hover:bg-custom-lightestblue-accent flex items-center">
                        {{ __('Create Service Request') }}
                    </a>
                </div>
            @else
                @foreach ($serviceRequests as $serviceRequest)
                    <div class="servicerequestindividual p-4 shadow-sm rounded-lg md:mb-4 border bg-white border-gray-300"
                         :class="{ 'hidden': filter !== 'all' && filter !== '{{ $serviceRequest->status }}' }"
                         x-show="filter === 'all' || filter === '{{ $serviceRequest->status }}'">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex flex-col items-start">
                                <div class="flex items-center">
                                    <x-category :category="$serviceRequest->category" class="mr-2" />
                                </div>
                                <div class="md:ml-8">
                                <x-service-status :status="$serviceRequest->status" :class="($serviceRequest->status == 'completed') ? 'text-blue-500' : ''"/>
                                </div>
                            </div>
                            <div class="text-sm text-custom-light-text md:mt-2">
                                {{ \Carbon\Carbon::parse($serviceRequest->start_date . ' ' . $serviceRequest->start_time)->format('F j, Y h:i A') }}
                                - {{ \Carbon\Carbon::parse($serviceRequest->end_date . ' ' . $serviceRequest->end_time)->format('F j, Y h:i A') }}
                            </div>
                        </div>
                
                        <div class="mt-4 mx-12">
                            <div class="font-semibold text-xl mb-2 text-custom-header">
                                {{ $serviceRequest->title }}
                            </div>
                
                            <div class="mb-4 text-custom-default-text">
                                {{ $serviceRequest->description }}
                            </div>
                
                            <div class="mb-4">
                                {{-- Request image here --}}
                            </div>
                
                            <div class="flex justify-between items-center">
                                @if ($serviceRequest->status == 'open' && !$serviceRequest->hasAcceptedBid())
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('service-requests.edit', $serviceRequest) }}" class="text-gray-500 hover:text-gray-700">
                                            <span class="material-symbols-outlined">
                                                edit
                                            </span>
                                        </a>
                                        <form action="{{ route('service-requests.destroy', $serviceRequest) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this service request?')">
                                                <span class="material-symbols-outlined">
                                                    delete
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                                <div class="flex items-center justify-end w-full">
                                    @if ($serviceRequest->hasAcceptedBid())
                                        <div class="flex items-center text-green-500 font-semibold">
                                            <span class="material-icons">
                                                check_circle
                                            </span>
                                            <span class="ml-1">Bid Confirmed</span>
                                        </div>
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
        <div x-show="showBidsPanel" x-transition class="fixed inset-0 bg-gray-800 bg-opacity-50 z-50 flex justify-end p-4" style="display: none;">
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
    </div>

    <!-- Profile Modal -->
    <div x-show="showProfileModal" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;" @click.away="showProfileModal = false">
        <div class="bg-white p-16 rounded-lg w-3/5 max-w-4xl mx-auto shadow-lg" @click.stop>
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800" x-text="profile.name"></h2>
                <button @click="closeProfileModal()" class="text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
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
                        <span class="material-symbols-outlined text-gray-600 mr-2">mail</span>
                        <span class="text-gray-600">Email: <span x-text="profile.providerDetails.work_email"></span></span>
                    </div>
                    <div class="flex items-center mb-2">
                        <span class="material-symbols-outlined text-gray-600 mr-2">call</span>
                        <span class="text-gray-600">Phone: <span x-text="profile.providerDetails.contact_number"></span></span>
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-4">
                    <button @click="confirmBid(profile.bidId, selectedRequestId)" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Confirm Bid</button>
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
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({
                                    request_id: requestId
                                })
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
                                const serviceRequest = @json($serviceRequests).find(req => req
                                    .id === requestId);
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