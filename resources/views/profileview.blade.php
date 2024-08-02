<x-app-layout class="font-open-sans">
    <div class="mt-3 md:px-12 py-6 bg-white shadow-md sm:rounded-lg w-full md:w-3/5 mx-auto">
        <div class="flex flex-col md:flex-row w-10/12 mx-auto">

            {{-- User Profile Picture --}}
            {{-- <div class="flex justify-center md:justify-start mb-4 md:mb-0">
                @if($providerDetails->profilePicture)
                    <img class="inline-block h-40 w-40 rounded-full ring-2 ring-white"
                        src="{{ Storage::url($providerDetails->profilePicture) }}" alt="Profile Picture">
                @else
                    <img class="inline-block h-40 w-40 rounded-full ring-2 ring-white"
                        src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                        alt="">
                @endif
            </div> --}}

            {{-- User's Name and Details --}}
            <div class="md:ml-6 w-full">
                <div class="text-custom-dark-blue font-bold text-2xl md:text-4xl text-center md:text-left">{{ $user->name }}</div>

                {{-- Service Category --}}
                <div class="text-gray-900 text-lg md:text-xl mt-2 text-center md:text-left">
                    {{ __('Service Category') }}: {{ $providerDetails->serviceCategory ?? 'N/A' }}
                </div>

                {{-- Placeholder - Ratings --}}
                <div class="flex flex-col md:flex-row items-center justify-between mt-2">
                    <div class="text-gray-900 text-lg md:text-xl">
                        {{ __('Ratings:') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="border-t my-4 w-full mx-8"></div>
        </div>

        {{-- Provider Details --}}
        <div class="providerservices w-10/12 mx-auto">
            <div class="flex flex-col md:flex-row justify-start space-y-2 md:space-y-0 md:space-x-4">
                <div class="text-md font-bold text-custom-light-blue">{{ __('Services Offered:') }}</div>
                <div class="border border-custom-light-blue p-2 rounded-3xl">{{ $providerDetails->serviceCategory ?? 'N/A' }}</div>
            </div>
        </div>

        {{-- Provider Information Description --}}
        <div class="providerdescription w-10/12 mx-auto mt-4">
            <div class="font-normal">
                {{ $providerDetails->description ?? 'No description available.' }}
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 w-10/12 mx-auto pb-6 md:pt-2">

            {{-- Provider Overview --}}
            <div class="w-full md:col-span-1 rounded-t-lg md:rounded-r-none md:pt-12">
                <div class="provideroverview">
                    <div class="text-2xl font-bold text-custom-light-blue">{{ __('Overview:') }}</div>

                    {{-- Verifications, years worked, has equipment, etc --}}
                    <div class="flex pt-1">
                        <span class="material-symbols-outlined pr-2">pin_drop</span>
                        <div class="text-base text-custom-dark-text">{{ __('Hired') }} {{ $completedJobsCount ?? '0' }} {{ __('times') }}</div>
                    </div>

                    <div class="flex pt-1">
                        <span class="material-symbols-outlined pr-2">history_edu</span>
                        <div class="text-base text-custom-dark-text">{{ __('Years working') }}: {{ $providerDetails->years_of_experience ?? 'N/A' }}</div>
                    </div>

                    <x-overview/>

                    {{-- Provider Address --}}
                    <div class="flex pt-1">
                        <span class="material-symbols-outlined pr-2">pin_drop</span>
                        <div class="text-base text-custom-dark-text">{{ $providerDetails->address ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            {{-- Provider Availability --}}
            <div class="w-full md:col-span-2 bg-white flex md:justify-end md:mt-4">
                <div class="md:w-4/5">
                    <div class="provideroverview pt-8">
                        <div class="text-2xl font-bold text-custom-light-blue md:mb-2">{{ __('Availability') }}</div>
                    </div>
                    <div class="md:border md:border-custom-light-text md:rounded-2xl md:p-4 ml-auto">
                        <div class="space-y-4 md:space-y-0 md:grid md:grid-cols-2 md:gap-4">
                            @foreach (explode(',', $providerDetails->availability_days ?? '') as $day)
                                <div class="flex justify-between items-center">
                                    <div>{{ $day }}</div>
                                    <div>{{ $providerDetails->availability_time ?? 'N/A' }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="text-2xl font-bold text-custom-light-blue pt-2 md:mb-2">{{ __('Contact') }}</div>
                    <div class="md:border md:border-custom-light-text md:rounded-2xl p-4 ml-auto">
                        <div>
                            <p><strong>Phone:</strong> {{ $user->cell_no ?? 'N/A' }}</p>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Work Email:</strong> {{ $providerDetails->work_email ?? 'N/A' }}</p>
                            <p><strong>Address:</strong> {{ $user->address ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="border-t my-4 w-full mx-8"></div>
        </div>

        {{-- Photos Section --}}
        <div class="w-10/12 mx-auto">
            <div class="text-2xl font-bold text-custom-light-blue md:mb-2">{{ __('Photos') }}</div>
            <x-ratings-stars/>
        </div>

        {{-- Certifications Section --}}
        <div class="w-10/12 mx-auto mt-4">
            <div class="text-2xl font-bold text-custom-light-blue md:mb-2">{{ __('Certifications') }}</div>
            <ul>
                @forelse ($certifications as $certification)
                    <li class="border border-custom-light-blue p-2 rounded-3xl mb-2">
                        {{ $certification->name }} - {{ $certification->issuing_organization }}
                        <a href="{{ Storage::url($certification->file_path) }}" target="_blank" class="text-blue-500">View File</a>
                    </li>
                @empty
                    <li>No certifications found.</li>
                @endforelse
            </ul>
        </div>

        {{-- Ratings Section --}}
        <div class="w-10/12 mx-auto mt-4">
            <div class="text-2xl font-bold text-custom-light-blue md:mb-2">{{ __('Ratings') }}</div>
            @forelse($ratings as $rating)
                <div class="mb-4 border rounded-lg shadow-sm p-4">
                    <h5 class="text-lg font-semibold mb-2">Rating by User ID: {{ $rating->rated_by_id }}</h5>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p><strong>Quality of Service:</strong> {{ $rating->quality_of_service }}/10</p>
                            <p><strong>Professionalism:</strong> {{ $rating->professionalism }}/10</p>
                        </div>
                        <div>
                            <p><strong>Cleanliness & Tidiness:</strong> {{ $rating->cleanliness_tidiness }}/10</p>
                            <p><strong>Value for Money:</strong> {{ $rating->value_for_money }}/10</p>
                        </div>
                    </div>
                    
                    @if($rating->additional_feedback)
                        <p class="mt-2"><strong>Additional Feedback:</strong> {{ $rating->additional_feedback }}</p>
                    @endif

                    <div class="text-gray-600 mt-4">
                        Rated on: {{ $rating->created_at->format('F j, Y, g:i a') }}
                    </div>
                </div>
            @empty
                <p>No ratings available.</p>
            @endforelse
        </div>

        {{-- PhilID Status Section --}}
        <div class="w-10/12 mx-auto mt-4">
            <div class="text-2xl font-bold text-custom-light-blue md:mb-2">{{ __('PhilID Cards') }}</div>
            <ul>
                @foreach($philidCards as $philidCard)
                    <li>
                        @if($philidCard->status === 'Accepted')
                            <span class="text-green-500">Verified</span>
                        @else
                            <span class="text-red-500">Not Verified</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
