@extends('layouts.app')

@section('content')
    <div class="mt-3 md:px-12 py-6 bg-white shadow-md sm:rounded-lg w-full md:w-4/5 mx-auto">
        <div class="flex flex-col md:flex-row w-10/12 mx-auto">
            {{-- User Profile Picture --}}
            <div class="flex justify-center md:justify-start mb-4 md:mb-0">
                {{-- @if ($providerDetail->profile_picture)
                    <img src="{{ Storage::url($providerDetail->profile_picture) }}" alt="Profile Picture" class="rounded-full h-20 w-20 mr-4">
                @endif --}}
            </div>

            {{-- User's Name and Details --}}
            <div class="w-full">
                <div class="flex flex-col md:flex-row items-center justify-start">
                    <div class="text-custom-dark-blue font-bold text-2xl md:text-4xl text-center md:text-left">
                        {{ $user->name }}</div>
                    {{-- @if ($user->philidCards && $user->philidCards->status === 'Accepted')
                        <span class="text-green-500 ml-2 flex items-center">
                            <span class="material-icons">check_circle</span>
                            Verified
                        </span>
                    @else
                        <span class="text-red-500 ml-2">Not Verified</span>
                    @endif --}}
                </div>

                {{-- Ratings and Completed Jobs --}}
                <div class="flex flex-col md:flex-row items-center justify-between mt-2">
                    <div class="text-gray-900 text-lg md:text-xl">
                        @php
                            $totalRatings = $ratings->count();
                            $sumRatings = $ratings->sum(function ($rating) {
                                return ($rating->quality_of_service +
                                    $rating->professionalism +
                                    $rating->cleanliness_tidiness +
                                    $rating->value_for_money +
                                    $rating->communication) /
                                    5;
                            });

                            $overallRating = $totalRatings > 0 ? $sumRatings / $totalRatings : 0;
                            $overallStars = $overallRating / 2; // Convert to star rating scale
                        @endphp

                        @if ($totalRatings > 0)
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
        </div>

        <div class="flex justify-center">
            <div class="border-t my-4 w-full mx-8"></div>
        </div>




        <div class="flex justify-center mx-8 pt-4">
            <div class="border-t my-4 w-full mx-8"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 w-10/12 mx-auto gap-4">

            {{-- Contact --}}
            <div class="w-full md:border-r text-center">
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

        <div class="w-10/12 mx-auto py-4">
            <div class="mb-4">
                <h2 class="text-2xl text-gray-800 font-semibold pt-8 pb-4">Ratings</h2>
        @forelse($ratings as $rating)
        @php
            $individualOverallRating =
                ($rating->quality_of_service +
                $rating->professionalism +
                $rating->cleanliness_tidiness +
                $rating->value_for_money +
                $rating->communication) / 5 / 2; // Divide by 2 for star rating calculation
        @endphp
        <div class="mb-4 border rounded-lg shadow-sm p-4">
            <div class="flex justify-between items-center mb-2">
                <div class="text-xl font-semibold">
                    {{ $rating->user->name ?? 'User not found' }}
                </div>
                <div class="flex items-center">
                    <div class="flex items-center">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= floor($individualOverallRating))
                                <span class="material-icons text-yellow-500">star</span>
                            @elseif ($i - $individualOverallRating < 1)
                                <span class="material-icons text-yellow-500">star_half</span>
                            @else
                                <span class="material-icons text-gray-300">star</span>
                            @endif
                        @endfor
                    </div>
                    <div class="ml-2 text-gray-600">({{ number_format($individualOverallRating * 2, 1) }}/10)</div>
                </div>
                <div class="text-gray-600 ml-4">
                    Rated on: {{ $rating->created_at->format('F j, Y, g:i a') }}
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 pl-4 text-gray-800">
                <div class="flex items-center">
                    <div class="font-semibold">Quality of Service:</div>
                    <div class="ml-2">{{ $rating->quality_of_service }}/10</div>
                </div>
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
                <p class="mt-2"><strong>Additional Feedback:</strong> {{ $rating->additional_feedback }}</p>
            @endif
        </div>
    @empty
        <p>No ratings available.</p>
    @endforelse
</div>
</div>

    </div>
    </div>


    </div>


<script>
    function showModal() {
        document.getElementById('certificationModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('certificationModal').classList.add('hidden');
    }
</script>

<style>
    .form-control {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }
</style>
@endsection