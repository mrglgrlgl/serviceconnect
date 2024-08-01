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
                @elseif ($serviceRequests->isEmpty())
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
                                || (filter === 'completed' && '{{ $serviceRequest->status }}' === 'completed')">
                            
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
                                        <x-service-status :status="$serviceRequest->status"/>
                                        <div class="flex items-center p-2">
                                            <span class="material-symbols-outlined">work</span>
                                            {{ $serviceRequest->job_type }}
                                        </div>

                                        @if ($serviceRequest->job_type == 'hourly_rate')
                                            <div class="flex items-center p-2">
                                                <span class="material-symbols-outlined">request_quote</span>
                                                Hourly Rate: {{ $serviceRequest->hourly_rate }} -
                                                {{ $serviceRequest->hourly_rate_max }}
                                            </div>
                                        @elseif ($serviceRequest->job_type == 'project_based')
                                            <div class="flex items-center p-2">
                                                <span class="material-symbols-outlined">request_quote</span>
                                                Expected Price: {{ $serviceRequest->expected_price }} -
                                                {{ $serviceRequest->expected_price_max }}
                                            </div>
                                        @endif

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

                            <div class="flex justify-end items-center space-x-2 mt-4">
                                @if ($userBid)
                                    @if ($userBid->status == 'accepted')
                                        <span class="text-green-500 font-semibold">Bid Accepted</span>
                                        <a href="{{ route('provider-channel', ['serviceRequestId' => $serviceRequest->id]) }}">View Channel</a>
                                    @elseif ($userBid->status == 'rejected')
                                        <span class="text-red-500 font-semibold">Bid Closed</span>
                                    @else
                                        <span class="text-gray-500 font-semibold">Bid Sent</span>
                                        <button type="button"
                                            class="border-2 border-custom-light-blue text-custom-light-blue hover:text-white hover:border-cyan-700 font-semibold px-4 py-2 rounded hover:bg-cyan-700 flex items-center space-x-2"
                                            @click="showModal = true">
                                            <span class="material-symbols-outlined">edit</span>
                                            <span>Edit Bid</span>
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
