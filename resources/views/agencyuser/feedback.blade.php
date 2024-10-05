@extends('layouts.agency-dashboard')

@section('content')


<div class="w-11/12 mx-12 py-4">

<form method="GET" action="{{ route('agency.feedback') }}" class="flex justify-between items-center">
    <h2 class="text-2xl text-gray-800 font-semibold flex-grow">Feedback</h2>
    <div class="flex items-center">
        <label for="job_title" class="mr-2"></label>
        <select name="job_title" id="job_title" required class="border rounded px-2 py-1">
            <option value="">-- Select Service Category --</option>
            @foreach ($jobTitles as $title)
                <option value="{{ $title }}" {{ request('job_title') == $title ? 'selected' : '' }}>{{ $title }}</option>
            @endforeach
        </select>
        
        <button type="submit" class="ml-2 bg-custom-agency-secondary text-white rounded px-4 py-1 transform transition-transform duration-300 hover:scale-105 hover:shadow-xl">Filter</button>
    </div>
</form>

<div class="flex justify-center">
    <div class="border-t my-4 w-full"></div>
</div>
    
    @if($ratings->isEmpty())
        <p>No ratings available yet.</p>
    @else
        <div class="overflow-x-auto rounded-l-lg rounded-r-lg">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-custom-agency-bg text-white">
                        <th class="py-2 px-4 border">Seeker</th>
                        <th class="py-2 px-4 border">Service Request Title</th>
                        <th class="py-2 px-4 border">Overall Rating</th>
                        <th class="py-2 px-4 border">Quality of Service</th>
                        <th class="py-2 px-4 border">Professionalism</th>
                        <th class="py-2 px-4 border">Communication</th>
                        <th class="py-2 px-4 border">Cleanliness & Tidiness</th>
                        <th class="py-2 px-4 border">Value for Money</th>
                        <th class="py-2 px-4 border">Feedback</th>
                        <th class="py-2 px-4 border">Rated On</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ratings as $rating)
                        @php
                            $individualOverallRating =
                                ($rating->quality_of_service +
                                $rating->professionalism +
                                $rating->cleanliness_tidiness +
                                $rating->value_for_money +
                                $rating->communication) / 5 / 2; // Divide by 2 for star rating calculation
                        @endphp
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border">{{ $rating->seeker->name ?? 'User not found' }}</td>
                            <td class="py-2 px-4 border">{{ $rating->channel->serviceRequest->title ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border">
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
                                    <span class="ml-2 text-gray-600">({{ number_format($individualOverallRating * 2, 1) }}/10)</span>
                                </div>
                            </td>
                            <td class="py-2 px-4 border">{{ $rating->quality_of_service }}/10</td>
                            <td class="py-2 px-4 border">{{ $rating->professionalism }}/10</td>
                            <td class="py-2 px-4 border">{{ $rating->communication }}/10</td>
                            <td class="py-2 px-4 border">{{ $rating->cleanliness_tidiness }}/10</td>
                            <td class="py-2 px-4 border">{{ $rating->value_for_money }}/10</td>
                            <td class="py-2 px-4 border">{{ $rating->additional_feedback ?? 'No feedback' }}</td>
                            <td class="py-2 px-4 border">{{ $rating->created_at->format('F j, Y, g:i a') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
