<x-app-layout>
    <div class="py-12">
        <div class="w-full md:w-10/12 lg:w-8/12 xl:w-8/12 2xl:w-7/12 mx-auto">
            <!-- Navigation Links -->
            <div class="flex justify-center text-center w-full mb-6">
                <div class="flex items-center space-x-4 sm:space-x-12 md:space-x-20 lg:space-x-28 xl:space-x-28 2xl:space-x-28 overflow-x-auto md:overflow-hidden">
                    <x-nav-link href="{{ route('provider.dashboard') }}" :active="request()->routeIs('provider.dashboard')">
                        {{ __('Open Requests') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('provider.myrequests') }}" :active="request()->routeIs('provider.myrequests')">
                        {{ __('My Requests') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="border-t w-full text-center border-custom-cat-border"></div>
            </div>

            <div class="pt-6 pb-6 bg-gray-100" x-data="{ filter: 'all' }">
                <div class="w-full mx-auto flex justify-end pb-4">
                    <div class="relative inline-block">
                        <select x-model="filter" class="form-select block w-full md:w-40 pl-10 pr-4 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500">
                            <option value="all">All Requests</option>
                            <option value="sent_bids">Sent Bids</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="direct_hire">Direct Hire Requests</option>
                        </select>
                        <span class="material-icons absolute left-3 top-2.5 text-gray-400">filter_list</span>
                    </div>
                </div>

                @if (Auth::user()->role == 2 && !Auth::user()->providerDetails)
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                        Please complete your profile to view service requests.
                        <a href="{{ route('create-profile') }}" class="text-blue-500">Build Profile</a>
                    </div>
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                        Add your certifications if there are any
                        <a href="{{ route('certifications') }}" class="text-blue-500">Upload</a>
                    </div>
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                        Upload Government ID for final verification
                        <a href="{{ route('philid.index') }}" class="text-blue-500">Upload Government ID</a>
                    </div>
                @elseif ($serviceRequests->isEmpty() && Auth::user()->philID->status === 'Pending')
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                        You must first be verified before you can receive service requests.
                    </div>
                @elseif ($serviceRequests->isEmpty())
                    <div class="bg-blue-100 text-blue-700 p-4 rounded mb-6">
                        No service requests found.
                    </div>
                @else
                    @foreach ($serviceRequests as $serviceRequest)
                        @php
                            $userBid = $serviceRequest->bids->where('bidder_id', auth()->user()->id)->first();
                            $reportExists = $serviceRequest->reports->where('reported_by', auth()->id())->isNotEmpty();
                        @endphp

                        <div class="p-4 border border-gray-300 bg-white shadow-sm rounded-lg md:mb-4"
                             x-show="filter === 'all' 
                                || (filter === 'sent_bids' && {{ $userBid ? 'true' : 'false' }} && '{{ $serviceRequest->status }}' === 'open')
                                || (filter === 'in_progress' && '{{ $serviceRequest->status }}' === 'in_progress')
                                || (filter === 'completed' && '{{ $serviceRequest->status }}' === 'completed')
                                || (filter === 'direct_hire' && {{ $serviceRequest->is_direct_hire ? 'true' : 'false' }})">
                            
                            <div class="flex justify-between items-center mb-4 {{ $serviceRequest->is_direct_hire ? 'bg-yellow-100' : '' }}">
                                <div class="flex items-center space-x-2">
                                    <x-category :category="$serviceRequest->category" class="mr-2 text-gray-900" />
                                    <span class="text-gray-900 font-semibold">{{ $serviceRequest->title }}</span>
                                    <span class="text-gray-900">- {{ $serviceRequest->user->name }}</span>
                                </div>

                                <div class="text-sm text-gray-600 md:mt-2">
                                    @if (\Carbon\Carbon::parse($serviceRequest->start_date)->isSameDay(\Carbon\Carbon::parse($serviceRequest->end_date)))
                                        {{ \Carbon\Carbon::parse($serviceRequest->start_date)->format('F j, Y') }},
                                        {{ \Carbon\Carbon::parse($serviceRequest->start_time)->format('h:i A') }}
                                        -
                                        {{ \Carbon\Carbon::parse($serviceRequest->end_time)->format('h:i A') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($serviceRequest->start_date . ' ' . $serviceRequest->start_time)->format('F j, Y h:i A') }}
                                        -
                                        {{ \Carbon\Carbon::parse($serviceRequest->end_date . ' ' . $serviceRequest->end_time)->format('F j, Y h:i A') }}
                                    @endif
                                </div>
                            </div>

                            @if ($serviceRequest->is_direct_hire)
                                <div class="flex items-center p-2 bg-yellow-100 border-t-2 border-yellow-400">
                                    Direct Hire Request
                                </div>
                            @endif

                            <div class="flex items-start px-8">
                                <div class="flex-1">
                                    <div class="flex text-gray-700 items-center space-x-4">
                                        <x-service-status :status="$serviceRequest->status"/>
                                        <div class="flex items-center p-2">
                                            <span class="material-symbols-outlined">work</span>
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
                                            Estimated Duration: {{ $serviceRequest->estimated_duration }} hours
                                        </div>
                                    </div>

                                    <div class="flex items-center p-2">
                                        <span class="material-symbols-outlined mr-1 text-red-500">location_on</span>
                                        {{ $serviceRequest->location }}
                                    </div>
                                    <div class="pl-3">Description: {{ $serviceRequest->description }}</div>
                                </div>
                            </div>

                            <div class="flex justify-end items-center space-x-2 mt-4">
                                @if ($userBid)
                                    @if ($userBid->status == 'accepted')
                                        <span class="text-green-500 font-semibold">Bid Accepted</span>
                                        <a href="{{ route('provider-channel', ['serviceRequestId' => $serviceRequest->id]) }}">View Channel</a>
                                    @elseif ($userBid->status == 'rejected')
                                        <span class="text-red-500 font-semibold">Bid Closed</span>
                                    @else
                                        <span class="text-gray-500 font-semibold">Bid Sent</span>
                                        <a href="#"
                                            class="border-2 border-custom-light-blue text-custom-light-blue hover:text-white hover:border-cyan-700 font-semibold px-4 py-2 rounded hover:bg-cyan-700 flex items-center space-x-2"
                                            @click.prevent="showModal = true; selectedServiceRequestId = {{ $serviceRequest->id }}; maxBudget = '{{ $serviceRequest->max_price }}'">
                                            <span class="material-symbols-outlined">edit</span>
                                            <span>Edit Bid</span>
                                        </a>
                                    @endif

                                    @if ($serviceRequest->status == 'completed')
                                        <!-- Display Report Link or Label -->
                                        @if ($reportExists)
                                            <span class="text-red-500 ml-4">Report submitted</span>
                                        @else
                                            <a href="#" class="text-red-500 underline ml-3 font-semibold" onclick="showReportModal({{ $serviceRequest->id }})">Report</a>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div x-data="{ showModal: false, selectedServiceRequestId: null, maxBudget: '' }">
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

        <!-- Report Modal -->
        <div id="report-modal" class="fixed inset-0 z-40 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-white p-4">
                    <div class="flex justify-between items-center pb-2">
                        <h5 class="text-lg font-semibold text-custom-header">Report an Issue</h5>
                        <button type="button" class="text-gray-400 hover:text-gray-600" aria-label="Close" onclick="closeReportModal()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('report.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="service_request_id" id="service_request_id">

                        <label for="issue_type" class="block text-sm font-medium text-gray-700">Issue Type:</label>
                        <select name="issue_type" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="non_payment">Non Payment</option>
                            <option value="illegal_activity">Illegal Activity</option>
                            <option value="unprofessional_behavior">Unprofessional Behavior</option>
                            <option value="poor_quality_work">Poor Quality Work</option>
                            <option value="other">Other</option>
                        </select>

                        <label for="details" class="block text-sm font-medium text-gray-700 mt-4">Details:</label>
                        <textarea name="details" required class="h-16 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"></textarea>

                        <div class="flex justify-center mt-4">
                            <button type="submit" class="bg-green-500 text-white font-semibold px-4 py-2 rounded hover:bg-green-400">Submit Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function showReportModal(serviceRequestId) {
                document.getElementById('service_request_id').value = serviceRequestId;
                document.getElementById('report-modal').classList.remove('hidden');
            }

            function closeReportModal() {
                document.getElementById('report-modal').classList.add('hidden');
            }
        </script>
    </div>
</x-app-layout>
