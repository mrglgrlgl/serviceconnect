<x-dashboard>
    <x-slot name="dashboardbar">
        <div class="relative w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 mx-auto pt-4 overflow-hidden">
            <div class="font-semibold text-3xl md:pb-4">{{ __('Service Requests') }}</div>
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

    <div class="py-12">
        <div class="w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 mx-auto">
            @if ($serviceRequests->isEmpty())
                <div class="flex flex-col items-center">
                    <div class="alert-info mb-4">
                        No service requests found. Create one now!
                    </div>
                    <a href="{{ route('service-requests.create') }}" class="h-11 w-auto px-6 justify-center text-sm rounded-lg border text-custom-dark-blue font-bold border-custom-lightest-blue hover:text-white hover:border-custom-lightestblue-accent hover:border-3xl bg-custom-lightest-blue hover:bg-custom-lightestblue-accent flex items-center">
                        {{ __('Create Service Request') }}
                    </a>
                </div>
            @else
                @foreach ($serviceRequests as $serviceRequest)
                    <div class="servicerequestindividual p-4 bg-white shadow-sm rounded-lg md:mb-4">
                        <div class="flex justify-between items-start mb-4">
                            <div id="category" class="flex flex-col items-start">
                                <div class="flex items-center">
                                    <x-category :category="$serviceRequest->category" class="mr-2" />
                                    <span class="text-gray-700"> - {{ $serviceRequest->subcategory }}</span>
                                </div>
                                <x-service-status :status="$serviceRequest->status" />
                            </div>
                            <div id="date" class="text-sm text-gray-600 md:mt-2">
                                {{ \Carbon\Carbon::parse($serviceRequest->start_date)->format('m/d/Y') }} {{ \Carbon\Carbon::parse($serviceRequest->start_time)->format('h:i A') }} to {{ \Carbon\Carbon::parse($serviceRequest->end_date)->format('m/d/Y') }} {{ \Carbon\Carbon::parse($serviceRequest->end_time)->format('h:i A') }}
                            </div>
                        </div>

                        <div class="mt-4 mx-12">
                            <div class="font-semibold text-xl mb-2">
                                {{ $serviceRequest->title }}
                            </div>

                            <div id="requestdesc" class="mb-4">
                                {{ $serviceRequest->description }}
                            </div>

                            <div id="requestimg" class="mb-4">
                                {{-- Request image here --}}
                            </div>

                            <div class="flex justify-between items-center">
                                <div>
                                    <x-outline-button href="{{ route('service-requests.edit', $serviceRequest) }}" class="flex-1 md:flex-none w-full md:w-auto">
                                        <span class="material-symbols-outlined">
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
                                <div class="flex justify-end font-semibold text-custom-light-blue">
                                    @if ($serviceRequest->hasAcceptedBid())
                                    Bid Confirmed
                                    <a href="" class="text-blue-500 underline ml-4">Service Request Details</a>
                                @else
                                    {{ $serviceRequest->bids->count() }} bids
                                    <button @click="fetchBids({{ $serviceRequest->id }})" class="ml-4 underline text-blue-500">View Bids</button>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
 
        <div x-show.transition="showBidsPanel" class="w-1/3 bg-gray-100 p-4 shadow-lg absolute right-0 top-0 h-full">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Bids</h2>
                <button @click="closeBidsPanel()" class="text-red-500">Close</button>
            </div>
            <ul>
                <template x-for="bid in bids" :key="bid.id">
                    <li x-show="!bid.rejected" class="mb-2 border-b pb-2">
                        <div class="font-semibold" x-text="bid.bidder.name"></div>
                        <div class="text-gray-600" x-text="bid.bid_amount"></div>
                        <div class="text-gray-600" x-text="bid.bid_description"></div>
                        <div class="text-gray-600" x-text="new Date(bid.created_at).toLocaleString()"></div>
                        <!-- Confirm Button -->
                        <div class="mt-2">
                            <button x-show="!bid.confirmed" @click="confirmBid(bid.id, {{ $serviceRequest->id }})" class="bg-green-500 text-white px-4 py-2 rounded">Confirm</button>
                            <span x-show="bid.confirmed">Bid Confirmed</span>
                        </div>
                    </li>
                </template>
            </ul>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('dashboard', () => ({
                showBidsPanel: false,
                bids: [],
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
                }
            }));
        });
    </script>
</x-dashboard>
