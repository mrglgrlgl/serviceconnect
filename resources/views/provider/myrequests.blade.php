<x-app-layout>
    <div class="py-12">
        <div class="w-full md:w-10/12 lg:w-8/12 xl:w-8/12 2xl:w-7/12 mx-auto">
            <!-- Navigation Links -->
            <div class="flex justify-center text-center w-full mb-6">
                <div class="flex items-center space-x-4 sm:space-x-12 md:space-x-20 lg:space-x-28 xl:space-x-28 2xl:space-x-28 overflow-x-auto md:overflow-hidden">
                    <a href="{{ route('provider.dashboard') }}" class="inline-block text-custom-dark-text hover:text-custom-lightest-blue">
                        <div class="flex flex-col items-center text-base md:text-xl font-open-sans">
                            {{ __('Open Requests') }}
                        </div>
                    </a>
                    <a href="{{ route('provider.myrequests') }}" class="inline-block text-custom-dark-text hover:text-custom-lightest-blue">
                        <div class="flex flex-col items-center text-base md:text-xl font-open-sans">
                            {{ __('My Requests') }}
                        </div>
                    </a>
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

                    @if ($userBid)
                        <div class="p-4 border border-gray-300 bg-white shadow-sm rounded-lg md:mb-4">
                            <!-- Display service request details similar to the previous code -->
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

                                        @if ($serviceRequest->job_type == 'hourly_rate')
                                            <div class="flex items-center p-2">
                                                <span class="material-symbols-outlined mr-1">request_quote</span>
                                                Hourly Rate: {{ $serviceRequest->hourly_rate }} -
                                                {{ $serviceRequest->hourly_rate_max }}
                                            </div>
                                        @elseif ($serviceRequest->job_type == 'project_based')
                                            <div class="flex items-center p-2">
                                                <span class="material-symbols-outlined mr-1">request_quote</span>
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
                                @if ($userBid->status == 'accepted')
                                    <span class="text-green-500 font-semibold">Bid Accepted</span>
                                    <a href="{{ route('chat') }}" class="text-blue-500 underline ml-3">Go to chat</a>
                                @elseif ($userBid->status == 'rejected')
                                    <span class="text-red-500 font-semibold">Bid Closed</span>
                                @else
                                    <span class="text-gray-500 font-semibold">Bid Sent</span>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>
