<x-app-layout class="font-open-sans">
    <div class="mt-3 md:px-12 py-6 bg-white shadow-md sm:rounded-lg w-full md:w-3/5 mx-auto">
        <div class="flex flex-col md:flex-row w-10/12 mx-auto">

            {{-- User Profile Picture --}}
            <div class="flex justify-center md:justify-start mb-4 md:mb-0">
                @if ($providerDetails->profilePicture)
                    <img src="{{ Storage::url($providerDetails->profilePicture) }}" alt="Profile Picture"
                        class="rounded-full h-20 w-20 mr-4">
                @endif
            </div>

            {{-- User's Name and Details --}}
            <div class="w-full">
                <div class="flex flex-col md:flex-row items-center justify-start">
                    <div class="text-custom-dark-blue font-bold text-2xl md:text-4xl text-center md:text-left">
                        {{ $user->name }}
                    </div>
                    @foreach ($philidCards as $philidCard)
                        @if ($philidCard->status === 'Accepted')
                            <span class="text-green-500 ml-2 flex items-center">
                                <span class="material-icons">
                                    check_circle
                                </span>
                                Verified
                            </span>
                        @else
                            <span class="text-red-500 ml-2">Not Verified</span>
                        @endif
                    @endforeach
                </div>

                {{-- Service Category --}}
                <div class="text-gray-900 text-lg md:text-xl mt-2 text-center md:text-left">
                    <x-category :category="$providerDetails->serviceCategory" class="mr-2 text-gray-900" />
                </div>

                {{-- Ratings and Completed Jobs --}}
                <div class="flex flex-col md:flex-row items-center justify-between mt-2">
                    <div class="text-gray-900 text-lg md:text-xl">
                        {{ __('Ratings:') }}
                    </div>
                    <div class="text-gray-900 text-lg md:text-xl">
                        {{ $completedJobsCount }} jobs completed
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="border-t my-4 w-full mx-8"></div>
        </div>

        {{-- Provider Information Description --}}
        <div class="providerdescription w-10/12 mx-auto">
            <strong class="text-gray-800">About: </strong>{{ $providerDetails->description }}
        </div>

        {{-- Overview --}}
        <div class="w-10/12 mx-auto md:pt-2">
            <div class="provideroverview">
                <div class="flex flex-wrap gap-4 text-gray-500">
                    <div class="flex items-center">
                        <span class="material-icons pr-1">work</span>
                        <div class="">{{ $providerDetails->years_of_experience ?? 'N/A' }} Years of Service</div>
                    </div>
                    <div class="flex items-center">
                        <span class="material-icons pr-1">build</span>
                        <div class="">{{ $providerDetails->have_tools ? 'Has tools' : 'No tools' }}</div>
                    </div>
                    <div class="flex items-center">
                        <span class="material-icons pr-1">pin_drop</span>
                        <div class="">{{ $user->address ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Certifications --}}
        <div class="w-10/12 mx-auto mt-8 py-4">
            <h2 class="text-xl font-semibold pb-2">
                Certifications
            </h2>
            <div>
                @foreach ($certifications as $certification)
                    <div class="border border-gray-300 p-4 rounded-md flex justify-between">
                        <div>
                            <strong class="text-gray-800">{{ $certification->name }}</strong> -
                            {{ $certification->issuing_organization }}
                        </div>
                        @if ($certification->file_path)
                            <a href="{{ Storage::url($certification->file_path) }}" target="_blank"
                                class="text-blue-500 ml-2 underline">View Certificate</a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-center mx-8 pt-4">
            <div class="border-t my-4 w-full mx-8"></div>
        </div> 

            <div class="grid grid-cols-1 md:grid-cols-3 w-10/12 mx-auto gap-4">
                {{-- Availability --}}
                <div class="w-full text-center">
                    <div class="text-xl font-semibold text-gray-800">{{ __('Availability') }}</div>
                    <div>
                        <x-availability :providerDetails="$providerDetails" />
                    </div>
                </div>

                {{-- Contact --}}
                <div class="w-full md:border-l md:border-r text-center">
                    <div class="text-xl font-semibold text-gray-800">{{ __('Contact Details') }}</div>
                    <div class="md:rounded-2xl md:p-4 mx-auto text-custom-header">
                        <div class="block w-full justify-center text-start text-base focus:outline-none">
                            <div class="flex md:pb-2">
                                <span class="material-icons pr-2 text-gray-500">call</span>
                                <div class="pb-2">+{{ $user->cell_no ?? 'N/A' }}</div>
                            </div>
                            <div class="flex md:pb-2">
                                <span class="material-icons text-gray-500 pr-2">mail</span>
                                <div class="pb-2">{{ $user->email }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Location --}}
                <div class="w-full text-center">
                    <div class="text-xl font-semibold text-gray-800">{{ __('Location') }}</div>
                    <div class="md:rounded-2xl md:p-4 mx-auto">
                        <div class="block w-full justify-center text-start text-base focus:outline-none">
                            <div class="flex md:pb-2">
                                <span class="material-icons text-gray-500 pr-2">pin_drop</span>
                                <div class="pb-2">{{ $user->address ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           <div class="flex justify-center mx-8">
                <div class="border-t my-4 w-full mx-8"></div>
            </div> 

            {{-- Photos Section --}}
            {{-- <div class="w-10/12 mx-auto">
                <div class="text-2xl font-bold text-custom-light-blue md:mb-2">{{ __('Photos') }}</div>
            </div> --}}

            <!-- Provider Ratings -->
            <div class="w-10/12 mx-auto py-4">
            <div class="mb-4">
                <h2 class="text-2xl text-gray-800 font-semibold pt-8 pb-4">Ratings</h2>
                
                @forelse($ratings as $rating)
                    @php
                        $overallRating =
                            ($rating->quality_of_service +
                                $rating->professionalism +
                                $rating->cleanliness_tidiness +
                                $rating->value_for_money +
                                $rating->communication) /
                            5 /
                            2; // Divide by 2 for star rating calculation
                    @endphp
                    <div class="mb-4 border rounded-lg shadow-sm p-4">
                        <div class="flex justify-between items-center mb-2">
                            <div class="text-xl font-semibold">
                                {{ $rating->user->name ?? 'User not found' }}
                            </div>
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= floor($overallRating))
                                            <span class="material-icons text-yellow-500">star</span>
                                        @elseif ($i - $overallRating < 1)
                                            <span class="material-icons text-yellow-500">star_half</span>
                                        @else
                                            <span class="material-icons text-gray-300">star</span>
                                        @endif
                                    @endfor
                                </div>
                                <div class="ml-2 text-gray-600">({{ number_format($overallRating * 2, 1) }}/10)</div>
                                <!-- Multiply back by 2 for display -->
                            </div>
                            <div class="text-gray-600 ml-4">
                                Rated on: {{ $rating->created_at->format('F j, Y, g:i a') }}
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 pl-4 text-gray-800">
                            <div class="flex items-center">
                                <div class="font-semibold">Professionalism:</div>
                                <div class="ml-2">{{ $rating->professionalism }}/10</div>
                            </div>
                            <div class="flex items-center">
                                <div class="font-semibold">Communication:</div>
                                <div class="ml-2">{{ $rating->communication }}/10</div>
                            </div>
                            <div class="flex items-center">
                                <div class="font-semibold">Cleanliness & Tidiness:</div>
                                <div class="ml-2">{{ $rating->cleanliness_tidiness }}/10</div>
                            </div>
                            <div class="flex items-center">
                                <div class="font-semibold">Value for Money:</div>
                                <div class="ml-2">{{ $rating->value_for_money }}/10</div>
                            </div>
                        </div>

                        @if ($rating->additional_feedback)
                            <p class="mt-2"><strong>Additional Feedback:</strong> {{ $rating->additional_feedback }}
                            </p>
                        @endif
                    </div>
                @empty
                    <p>No ratings available.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
