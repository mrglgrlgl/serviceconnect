<x-agency-dashboard>
    <div class="py-12">
        <div class="w-full md:w-10/12 lg:w-8/12 xl:w-8/12 2xl:w-7/12 mx-auto">
        

            <div class="flex justify-center">
                <div class="border-t w-full text-center border-custom-cat-border"></div>
            </div>

            <div class="pt-6 pb-6 bg-gray-100">
                <div class="w-full mx-auto flex justify-end pb-4">
                  <div class="relative inline-block">
                <form id="filterForm" action="{{ route('provider.filterRequests') }}" method="GET">
                    <select name="filter" id="filter" class="form-select block w-full md:w-40 pl-10 pr-4 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500" onchange="this.form.submit()">
                        <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>All Requests</option>
                        <option value="sent_bids" {{ request('filter') == 'sent_bids' ? 'selected' : '' }}>Sent Bids</option>
                        <option value="in_progress" {{ request('filter') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ request('filter') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="direct_hire" {{ request('filter') == 'direct_hire' ? 'selected' : '' }}>Direct Hire Requests</option>
                    </select>
                    <span class="material-icons absolute left-3 top-2.5 text-gray-400">filter_list</span>
                </form>
            </div>
                </div>

                @if ($serviceRequests->isEmpty())
                    <div class="bg-blue-100 text-blue-700 p-4 rounded mb-6">
                        No service requests found.
                    </div>
                @else
                    @foreach ($serviceRequests as $serviceRequest)
                        @php
                            $userBid = $serviceRequest->bids->where('bidder_id', auth()->user()->id)->first();
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
<a href="{{ route('channel.agency', ['serviceRequestId' => $serviceRequest->id]) }}" class="text-blue-500 underline">View Channel</a>
                                    @elseif ($userBid->status == 'rejected')
                                        <span class="text-red-500 font-semibold">Bid Closed</span>
                                    @else
                                        <span class="text-gray-500 font-semibold">Bid Sent</span>
                                        <a href="#"
                                            class="border-2 border-custom-light-blue text-custom-light-blue hover:text-white hover:border-cyan-700 font-semibold px-4 py-2 rounded hover:bg-cyan-700 flex items-center space-x-2">
                                            <span class="material-symbols-outlined">visibility</span>
                                            View Bid
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('bids.create', ['id' => $serviceRequest->id]) }}"
                                        class="bg-custom-light-blue text-white px-4 py-2 rounded hover:bg-cyan-700">
                                        Place Bid
                                    </a>
                                @endif

                                {{-- @if ($serviceRequest->status == 'completed')
                                    @if ($reportExists)
                                        <span class="text-red-500 ml-4">Report submitted</span>
                                    @else
                                        <a href="#" class="text-red-500 underline ml-3 font-semibold" onclick="showReportModal({{ $serviceRequest->id }})">Report</a>
                                    @endif
                                @endif --}}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-agency-dashboard>
