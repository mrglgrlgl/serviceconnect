@extends('layouts.agency-dashboard')

@section('content')
<div class="font-poppins bg-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-8">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('agency.employees') }}" class="inline-block bg-custom-agency-secondary text-white rounded px-4 py-2 transform transition-transform duration-300 hover:scale-105 hover:shadow-xl">
                Back
            </a>
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-6">Employee Profile</h1>

        <div class="flex items-center mb-8">
            <!-- Display Employee Photo -->
            @if($employee->photo)
                <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}" class="w-30 h-30 rounded-full shadow-md object-cover mr-8">
            @else
                <span class="text-gray-500">No photo available</span>
            @endif

            @php
                // Initialize variables for rating calculation
                $totalRatings = 0;
                $ratingCount = $employee->ratings->count();

                // Calculate average rating across all categories if there are any ratings
                if ($ratingCount > 0) {
                    foreach ($employee->ratings as $rating) {
                        // Sum the ratings for different categories
                        $totalRatings += ($rating->communication + $rating->quality_of_service + 
                                          $rating->professionalism + $rating->cleanliness_tidiness + 
                                          $rating->value_for_money) / 5 / 2; // Average rating per seeker
                    }
                    $averageRating = $totalRatings / $ratingCount;
                } else {
                    $averageRating = 0; // Default if no ratings available
                }
            @endphp

            <div class="ml-4">
                <h2 class="text-2xl font-semibold mb-2 flex items-center">
                    {{ $employee->name }}
                    <!-- Star Rating System -->
                    <div class="flex items-center ml-2">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= floor($averageRating))
                                <span class="material-icons text-yellow-500">star</span>
                            @elseif ($i - $averageRating < 1)
                                <span class="material-icons text-yellow-500">star_half</span>
                            @else
                                <span class="material-icons text-gray-300">star</span>
                            @endif
                        @endfor
                        <span class="ml-2 text-gray-600">({{ number_format($averageRating * 2, 1) }}/10)</span>
                    </div>
                </h2>

                <div class="mt-4">
                    <h3 class="text-xl mb-4"><strong>Completed Service Requests:</strong> {{ $completedServicesCount }}</h3>
                </div>

                <p class="text-gray-600 mb-1"><span class="material-icons align-middle">phone</span> Phone: {{ $employee->phone }}</p>
                <p class="text-gray-600 mb-1"><span class="material-icons align-middle">work</span> Position: {{ $employee->position }}</p>
                <p class="text-gray-600 mb-1"><span class="material-icons align-middle">{{ $employee->gender === 'male' ? 'male' : 'female' }}</span> Gender: {{ ucfirst($employee->gender) }}</p>
                <p class="text-gray-600">
                    Availability: 
                    <span class="px-2 py-1 rounded-full 
                        @if($employee->availability === 'available') bg-green-500 text-white 
                        @elseif($employee->availability === 'assigned') bg-yellow-500 text-white 
                        @else bg-red-500 text-white 
                        @endif">
                        {{ ucfirst($employee->availability) }}
                    </span>
                </p>
            </div>
        </div>

        <div class="mt-4">
            <h3 class="text-xl font-bold mb-2">Services Assigned:</h3>
            @if($employee->services->isEmpty())
                <p class="text-gray-500">No services assigned.</p>
            @else
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($employee->services as $service)
                        <li class="text-gray-700">{{ $service->service_name }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="mt-8">
            <h3 class="text-xl font-bold mb-4">Seeker Ratings:</h3>
            @if($employee->ratings->isEmpty())
                <p class="text-gray-500">No ratings available.</p>
            @else
                <div class="space-y-6">
                    @foreach($employee->ratings as $rating)
                        <div class="p-4 bg-white rounded-lg border p-4">
                            <div class="flex justify-between items-center mb-8">
                                <p class="text-gray-600 font-semibold text-lg">{{ $rating->channel->serviceRequest->title ?? 'N/A' }}</p>
                                <h4 class="text-lg text-gray-800">{{ $rating->seeker->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $rating->created_at->format('F j, Y') }}</p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="text-gray-600">
                                    <strong>Communication:</strong> {{ $rating->communication }}
                                </div>
                                <div class="text-gray-600">
                                    <strong>Quality of Service:</strong> {{ $rating->quality_of_service }}
                                </div>
                                <div class="text-gray-600">
                                    <strong>Professionalism:</strong> {{ $rating->professionalism }}
                                </div>
                                <div class="text-gray-600">
                                    <strong>Cleanliness & Tidiness:</strong> {{ $rating->cleanliness_tidiness }}
                                </div>
                                <div class="text-gray-600">
                                    <strong>Value for Money:</strong> {{ $rating->value_for_money }}
                                </div>
                            </div>
                            <div class="mt-4">
                                <p class="text-gray-600">
                                    <strong>Additional Feedback:</strong> 
                                    <span class="italic">{{ $rating->additional_feedback ?: 'No additional feedback provided.' }}</span>
                                </p>
                            </div>
                            <!-- Overall Rating -->
                            <div class="mt-2 flex justify-end">
                                <strong>Overall Rating:</strong>
                                <div class="flex items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= floor(($rating->communication + $rating->quality_of_service + $rating->professionalism + $rating->cleanliness_tidiness + $rating->value_for_money) / 5 /2))
                                            <span class="material-icons text-yellow-500">star</span>
                                        @elseif ($i - (($rating->communication + $rating->quality_of_service + $rating->professionalism + $rating->cleanliness_tidiness + $rating->value_for_money) / 5 /2) < 1)
                                            <span class="material-icons text-yellow-500">star_half</span>
                                        @else
                                            <span class="material-icons text-gray-300">star</span>
                                        @endif
                                    @endfor
                                    <span class="ml-2 text-gray-600">({{ number_format(($rating->communication + $rating->quality_of_service + $rating->professionalism + $rating->cleanliness_tidiness + $rating->value_for_money) / 5 , 1) }}/10)</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
