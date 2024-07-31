<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RatingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'channel_id' => 'required|exists:channel,id',
            'rated_for_id' => 'required|exists:users,id',
            'rating_communication' => 'nullable|integer|min:0|max:10',
            'rating_fairness' => 'nullable|integer|min:0|max:10',
            'rating_respectfulness' => 'nullable|integer|min:0|max:10',
            'rating_preparation' => 'nullable|integer|min:0|max:10',
            'rating_responsiveness' => 'nullable|integer|min:0|max:10',
            'feedback' => 'nullable|string|max:255',
        ]);
    
        $existingRating = Rating::where('channel_id', $validated['channel_id'])
                                ->where('rated_by_id', Auth::id())
                                ->first();
    
        if ($existingRating) {
            return redirect()->back()->with('error', 'You have already rated this channel.');
        }
    
        Rating::create([
            'channel_id' => $validated['channel_id'],
            'rated_by_id' => Auth::id(),
            'rated_for_id' => $validated['rated_for_id'],
            'communication' => $validated['rating_communication'],
            'fairness' => $validated['rating_fairness'],
            'respectfulness' => $validated['rating_respectfulness'],
            'preparation' => $validated['rating_preparation'],
            'responsiveness' => $validated['rating_responsiveness'],
            'additional_feedback' => $validated['feedback'],
        ]);
    
        return redirect()->route('provider.dashboard')->with('success', 'Rating submitted successfully.');
    }
    
    // New method for storing the seeker's rating of the provider
    public function storeSeekerRating(Request $request)
    {
        $validated = $request->validate([
            'channel_id' => 'required|exists:channel,id',
            'rated_for_id' => 'required|exists:users,id',
            'rating_quality_of_service' => 'nullable|integer|min:0|max:10',
            'rating_professionalism' => 'nullable|integer|min:0|max:10',
            'rating_cleanliness_and_tidiness' => 'nullable|integer|min:0|max:10', // Updated to match form input
            'rating_value_for_money' => 'nullable|integer|min:0|max:10',
            'feedback' => 'nullable|string|max:255',
        ]);
    
        // Check if the user has already rated this channel
        $existingRating = Rating::where('channel_id', $validated['channel_id'])
                                ->where('rated_by_id', Auth::id())
                                ->first();
    
        if ($existingRating) {
            return redirect()->back()->with('error', 'You have already rated this channel.');
        }
    
        // Create the new rating
        Rating::create([
            'channel_id' => $validated['channel_id'],
            'rated_by_id' => Auth::id(),
            'rated_for_id' => $validated['rated_for_id'],
            'quality_of_service' => $validated['rating_quality_of_service'],
            'professionalism' => $validated['rating_professionalism'],
            'cleanliness_tidiness' => $validated['rating_cleanliness_and_tidiness'], // Ensure this matches form input
            'value_for_money' => $validated['rating_value_for_money'],
            'additional_feedback' => $validated['feedback'],
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Rating submitted successfully.');
    }
}
