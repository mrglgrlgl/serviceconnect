<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-semibold mb-6">Provider Profile</h1>

                <!-- Provider Basic Information -->
                <div class="mb-4">
                    <h2 class="text-xl font-semibold">Basic Information</h2>
                    <div class="flex items-center">
                        @if($providerDetails->profilePicture)
                            <img src="{{ Storage::url($providerDetails->profilePicture) }}" alt="Profile Picture" class="rounded-full h-20 w-20 mr-4">
                        @endif
                        <div>
                            <p><strong>Name:</strong> {{ $user->name }}</p>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Work Email:</strong> {{ $providerDetails->work_email ?? 'N/A' }}</p>
                            <p><strong>Phone:</strong> {{ $user->cell_no ?? 'N/A' }}</p>
                            <p><strong>Address:</strong> {{ $user->address ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <a href="{{ route('provider.profile.edit', $user->id) }}" class="text-blue-500">Edit Basic Information</a>
                </div>

                <!-- Service Details -->
                <div class="mb-4">
                    <h2 class="text-xl font-semibold">Service Details</h2>
                    <p><strong>Service Category:</strong> {{ $providerDetails->serviceCategory }}</p>
                    <p><strong>Subcategory:</strong> {{ $providerDetails->subcategory ?? 'N/A' }}</p>
                    <p><strong>Years of Experience:</strong> {{ $providerDetails->years_of_experience ?? 'N/A' }}</p>
                    <p><strong>Has Tools:</strong> {{ $providerDetails->have_tools }}</p>
                    <p><strong>Description:</strong> {{ $providerDetails->description }}</p>
                    <p><strong>Skills:</strong> {{ $providerDetails->skills ?? 'N/A' }}</p>
                    <p><strong>Availability Days:</strong> {{ $providerDetails->availability_days }}</p>
                    <p><strong>Availability Time:</strong> {{ $providerDetails->availability_time ?? 'N/A' }}</p>
                    <a href="{{ route('provider.profile.edit', $user->id) }}" class="text-blue-500">Edit Service Details</a>
                </div>

                <!-- Provider Certifications -->
                <div class="mb-4">
                    <h2 class="text-xl font-semibold">Certifications</h2>
                    <ul>
                        @foreach($certifications as $certification)
                            <li>
                                <strong>{{ $certification->name }}</strong> - {{ $certification->issuing_organization }}
                                @if($certification->file_path)
                                    <a href="{{ Storage::url($certification->file_path) }}" target="_blank" class="text-blue-500 ml-2">View Certificate</a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('provider.certifications.edit', $user->id) }}" class="text-blue-500">Edit Certifications</a>
                </div>

                <!-- Provider Completed Jobs -->
                <div class="mb-4">
                    <h2 class="text-xl font-semibold">Completed Jobs</h2>
                    <p>{{ $completedJobsCount }} jobs completed</p>
                </div>

                <!-- Provider Ratings -->
                <div class="mb-4">
                    <h2 class="text-xl font-semibold">Ratings</h2>
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

                <!-- Provider PhilID Status -->
                <div class="mb-4">
                    <h2 class="text-xl font-semibold">PhilID Cards</h2>
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
        </div>
    </div>
</x-app-layout>
