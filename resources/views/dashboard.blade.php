<x-dashboard>
    {{-- <div class="relative w-full pt-8 mx-auto overflow-hidden bg-gray-100" style="max-width: calc(100% - 250px); margin-left: 250px;">
        <div class="flex justify-center text-center w-full">
            <div class="flex items-center space-x-4 sm:space-x-12 md:space-x-20 lg:space-x-28 xl:space-x-28 2xl:space-x-28 overflow-x-auto md:overflow-hidden">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('My Requests') }}
                </x-nav-link>
                <x-nav-link href="{{ route('analytics') }}" :active="request()->routeIs('analytics')">
                    {{ __('Analytics') }}
                </x-nav-link>
            </div>
        </div>
    </div> --}}

    <div class="flex justify-center" style="max-width: calc(100% - 250px); margin-left: 250px;">
        <div class="border-t my-2 w-full text-center border-custom-cat-border"></div>
    </div>

    <div class="pt-6 pb-6 bg-gray-100" x-data="dashboard()" style="max-width: calc(100% - 250px); margin-left: 250px;">
        <div class="w-full mx-auto flex justify-end">
            <div class="relative inline-block mb-4">
                <select x-model="filter" class="form-select block w-full md:w-40 pl-10 pr-4 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500">
                    <option value="all">All Requests</option>
                    <option value="open">Open</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
                <span class="material-icons absolute left-3 top-2.5 text-gray-400">filter_list</span>
            </div>
        </div>

        <div class="py-12 px-4 md:px-8 lg:px-16">
            <div class="w-full mx-auto">
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
                        <div class="servicerequestindividual p-6 shadow-sm rounded-lg md:mb-4 border bg-white border-gray-300 mx-4"
                             :class="{ 'hidden': filter !== 'all' && filter !== '{{ $serviceRequest->status }}' }"
                             x-show="filter === 'all' || filter === '{{ $serviceRequest->status }}'">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex flex-col items-start">
                                    <div class="flex items-center">
                                        <x-category :category="$serviceRequest->category" class="mr-2" />
                                    </div>
                                    <x-service-status :status="$serviceRequest->status" :class="($serviceRequest->status == 'completed') ? 'text-blue-500' : ''" />
                                </div>
                                <div class="text-sm text-custom-light-text md:mt-2">
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

                            <div class="mt-4 mx-12">
                                <div class="font-semibold text-xl mb-2 text-custom-header">
                                    {{ $serviceRequest->title }}
                                </div>
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

                                <div class="mb-4 text-custom-default-text">
                                    {{ $serviceRequest->description }}
                                </div>
                                <div class="flex items-center p-2">
                                    Estimated Duration: {{ $serviceRequest->estimated_duration }} {{ 'hours'}}
                                </div>
                                <div class="flex items-center p-2">
                                    <span class="material-symbols-outlined text-red-500">location_on</span>
                                    {{ $serviceRequest->location }}
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
                                            <a href="{{ route('channel.seeker', ['serviceRequestId' => $serviceRequest->id]) }}" class="text-blue-500 underline ml-4">Service Request Details</a>
                                        @else
                                            <span class="text-gray-600">{{ $serviceRequest->bids->count() }} bids</span>
                                            <button @click="fetchBids({{ $serviceRequest->id }})" class="ml-4 underline text-blue-500">View Bids >></button>
                                        @endif

                                        @if ($serviceRequest->status == 'completed')
                                            <!-- Display Report Link or Label -->
                                            @php
                                                $reportExists = $serviceRequest->reports
                                                    ->where('reported_by', auth()->id())
                                                    ->isNotEmpty();
                                            @endphp
                                            @if ($reportExists)
                                                <span class="text-gray-500 ml-4">Report submitted</span>
                                            @else
                                                <a href="#" class="text-red-500 underline ml-3" @click.prevent="openReportModal({{ $serviceRequest->id }})">Report</a>
                                            @endif
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Bids Panel -->
        <div x-show="showBidsPanel" x-transition class="fixed inset-0 bg-gray-800 bg-opacity-50 z-50 flex justify-end p-4" style="display: none;">
            <div class="bg-white p-6 shadow-lg rounded-lg w-full max-w-lg relative" @click.stop>
                <div class="pb-8">
                    <button @click="closeBidsPanel" class="absolute top-4 right-4 text-red-500 text-xl">&times;</button>
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
                                        <a :href="'/view-profile/' + bid.bidder.id" class="bg-custom-lightest-blue text-white px-4 py-2 rounded hover:bg-blue-600">
                                            View Profile
                                        </a>
                                        <button x-show="!bid.confirmed" @click="confirmBid(bid.id, selectedRequestId)" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mr-2">Accept Bid</button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>
        </div>

        <!-- Profile Modal -->
        <div x-show="showProfileModal" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;" @click.away="closeProfileModal">
            <div class="bg-white p-16 rounded-lg w-3/5 max-w-4xl mx-auto shadow-lg" @click.stop>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800" x-text="profile.name"></h2>
                    <button @click="closeProfileModal" class="text-red-500 hover:text-red-700">
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

        <!-- Report Modal -->
        <div x-show="showReportModal" x-transition class="fixed inset-0 z-40 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-white p-4">
                    <div class="flex justify-between items-center pb-2">
                        <h5 class="text-lg font-semibold text-custom-header">Report an Issue</h5>
                        <button type="button" class="text-gray-400 hover:text-gray-600" aria-label="Close" @click="showReportModal = false">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('report.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="service_request_id" x-model="serviceRequestId">

                        <label for="issue_type" class="block text-sm font-medium text-gray-700">Issue Type:</label>
                        <select name="issue_type" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="non_payment">Non Payment</option>
                            <option value="illegal_activity">Illegal Activity</option>
                            <option value="unprofessional_behavior">Unprofessional Behavior</option>
                            <option value="poor_quality_work">Poor Quality Work</option>
                            <option value="other">Other</option>
                        </select>

                        <label for="details" class="block text-sm font-medium text-gray-700 mt-4">Details:</label>
                        <textarea name="details" required class="h-16 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>

                        <div class="flex justify-center mt-4">
                            <button type="submit" class="bg-green-500 text-white font-semibold px-4 py-2 rounded hover:bg-green-400">Submit Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function dashboard() {
            return {
                filter: 'all',
                showBidsPanel: false,
                showProfileModal: false,
                showReportModal: false,
                serviceRequestId: null,
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
                        this.profile = data;
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
                            this.bids.forEach(bid => {
                                if (bid.id === bidId) {
                                    bid.confirmed = true;
                                } else {
                                    bid.rejected = true;
                                }
                            });
                            this.bids = this.bids.filter(bid => !bid.rejected);
                            const serviceRequest = @json($serviceRequests).find(req => req.id === requestId);
                            serviceRequest.bid_confirmed = true;
                        }
                    } catch (error) {
                        console.error('There was a problem with the fetch operation:', error);
                    }
                },

                openReportModal(serviceRequestId) {
                    console.log("Opening report modal for service request: " + serviceRequestId); // Debugging line
                    this.serviceRequestId = serviceRequestId;
                    this.showReportModal = true;
                },

                closeReportModal() {
                    this.showReportModal = false;
                },

                closeBidsPanel() {
                    this.showBidsPanel = false;
                },

                closeProfileModal() {
                    this.showProfileModal = false;
                }
            }
        }
    </script>
</x-dashboard>
