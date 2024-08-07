<div class="h-full overflow-y-auto p-4">
    @if(isset($providers))
        <h3 class="text-xl font-bold mb-4">Search Results</h3>
        @if($providers->isEmpty())
            <div class="bg-red-100 text-red-800 p-4 rounded mb-6">No providers found.</div>
        @else
            <ul class="list-none space-y-4">
                @foreach($providers as $provider)
                    <li class="mb-4">
                        @if ($provider->user)
                            <div class="flex flex-col md:flex-row md:items-start">
                                <x-category :category="$provider->serviceCategory" />
                                <div class="ml-0 md:ml-4 flex-1">
                                    <div class="flex flex-col md:flex-row justify-between md:items-center">
                                        <div class="flex items-center mb-2 md:mb-0">
                                            <div class="font-medium text-lg">{{ $provider->user->name }}</div>
                                            <div class="ml-2 font-normal text-custom-default-text">
                                                @php
                                                    $ratings = $providerRatings[$provider->user->id];
                                                    $totalRatings = $ratings->count();
                                                    $sumRatings = $ratings->sum(function ($rating) {
                                                        return ($rating->quality_of_service + $rating->professionalism + $rating->cleanliness_tidiness + $rating->value_for_money + $rating->communication) / 5;
                                                    });

                                                    $overallRating = $totalRatings > 0 ? $sumRatings / $totalRatings : 0;
                                                    $overallStars = $overallRating / 2; // Convert to star rating scale
                                                @endphp

                                                @if($totalRatings > 0)
                                                    <div class="flex justify-between items-center mb-4">
                                                        <div class="text-xl font-semibold pr-2">Overall Rating</div>
                                                        <div class="flex items-center">
                                                            <div class="flex items-center">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= floor($overallStars))
                                                                        <span class="material-icons text-yellow-500">star</span>
                                                                    @elseif ($i - $overallStars < 1)
                                                                        <span class="material-icons text-yellow-500">star_half</span>
                                                                    @else
                                                                        <span class="material-icons text-gray-300">star</span>
                                                                    @endif
                                                                @endfor
                                                            </div>
                                                            <div class="ml-2 text-gray-600">({{ number_format($overallStars * 2, 1) }}/10)</div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="font-normal text-custom-default-text">
                                            {{ $provider->user->completed_service_requests_count ?? 0 }} hires
                                        </div>
                                    </div>
                                    <div class="w-full font-normal text-custom-default-text">
                                        {{ strlen($provider->description) > 225 ? substr($provider->description, 0, 225) . '...' : $provider->description }}
                                    </div>
                                    <div class="flex justify-end items-center mt-2">
                                        <a href="{{ url('/view-profile/' . $provider->user->id) }}" class="text-base h-8 w-38 rounded-md bg-white hover:text-custom-light-blue text-custom-lightest-blue">
                                            {{ __('View Profile') }}
                                        </a>
                                    </div>
                                    <div class="flex justify-end items-center mt-2">
                                        <button type="button" onclick="showConfirmationModal({{ $provider->user->id }})" class="text-base h-8 w-38 rounded-md bg-green-500 hover:bg-green-700 text-white">
                                            {{ __('Direct Hire') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="border-t my-4"></div>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    @else
        {{-- display all providers --}}
        <h3 class="text-xl font-bold mb-4">All Providers</h3>
        @foreach($providers as $provider)
            <li class="mb-4">
                @if ($provider->user)
                    <div class="flex flex-col md:flex-row md:items-start">
                        <x-category :category="$provider->serviceCategory" />
                        <div class="ml-0 md:ml-4 flex-1">
                            <div class="flex flex-col md:flex-row justify-between md:items-center">
                                <div class="flex items-center mb-2 md:mb-0">
                                    <div class="font-medium text-lg">{{ $provider->user->name }}</div>
                                    <div class="ml-2 font-normal text-custom-default-text">
                                        <div class="text-gray-900 text-lg md:text-xl">
                                            @php
                                            $ratings = $providerRatings[$provider->user->id];
                                            $totalRatings = $ratings->count();
                                            $sumRatings = $ratings->sum(function ($rating) {
                                                return ($rating->quality_of_service + $rating->professionalism + $rating->cleanliness_tidiness + $rating->value_for_money + $rating->communication) / 5;
                                            });
                                
                                            $overallRating = $totalRatings > 0 ? $sumRatings / $totalRatings : 0;
                                            $overallStars = $overallRating / 2; // Convert to star rating scale
                                        @endphp
                                
                                        @if($totalRatings > 0)
                                            <div class="flex justify-between items-center mb-4">
                                                <div class="text-xl font-semibold pr-2">Overall Rating</div>
                                                <div class="flex items-center">
                                                    <div class="flex items-center">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= floor($overallStars))
                                                                <span class="material-icons text-yellow-500">star</span>
                                                            @elseif ($i - $overallStars < 1)
                                                                <span class="material-icons text-yellow-500">star_half</span>
                                                            @else
                                                                <span class="material-icons text-gray-300">star</span>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <div class="ml-2 text-gray-600">({{ number_format($overallStars * 2, 1) }}/10)</div>
                                                </div>
                                            </div>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="font-normal text-custom-default-text">
                                    {{ $provider->user->completed_service_requests_count ?? 0 }} hires
                                </div>
                            </div>
                            <div class="w-full font-normal text-custom-default-text">
                                {{ strlen($provider->description) > 225 ? substr($provider->description, 0, 225) . '...' : $provider->description }}
                            </div>
                            <div class="flex justify-end items-center mt-2">
                                <a href="{{ url('/view-profile/' . $provider->user->id) }}" class="text-base h-8 w-38 rounded-md bg-white hover:text-custom-light-blue text-custom-lightest-blue">
                                    {{ __('View Profile') }}
                                </a>
                            </div>
                            <div class="flex justify-end items-center mt-2">
                                <button type="button" onclick="showConfirmationModal({{ $provider->user->id }})" class="text-base h-8 w-38 rounded-md bg-green-500 hover:bg-green-700 text-white">
                                    {{ __('Direct Hire') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="border-t my-4"></div>
                @endif
            </li>
        @endforeach
    @endif
</div>
