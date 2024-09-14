<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RatingController extends Controller
{
    public function storeSeekerRating(Request $request)
{
    $validated = $request->validate([
        'channel_id' => 'required|exists:channel,id',
        'rating_quality_of_service' => 'nullable|integer|min:0|max:10',
        'rating_communication' => 'nullable|integer|min:0|max:10',
        'rating_professionalism' => 'nullable|integer|min:0|max:10',
        'rating_cleanliness_tidiness' => 'nullable|integer|min:0|max:10',
        'rating_value_for_money' => 'nullable|integer|min:0|max:10',
        'feedback' => 'nullable|string|max:255',
    ]);

    // Retrieve the channel with related agency user
    $channel = Channel::with('agencyuser.agency')->find($validated['channel_id']);

    if (!$channel || !$channel->agencyuser || !$channel->agencyuser->agency) {
        return redirect()->back()->with('error', 'Channel or related agency not found.');
    }

    // Check if the user has already rated this channel
    $existingRating = Rating::where('channel_id', $validated['channel_id'])
                            ->where('seeker_id', Auth::id())
                            ->first();

    if ($existingRating) {
        return redirect()->back()->with('error', 'You have already rated this channel.');
    }

    // Create the new rating
    Rating::create([
        'channel_id' => $validated['channel_id'],
        'agency_id' => $channel->agencyuser->agency->id, // Retrieve agency_id through provider
        'seeker_id' => Auth::id(),
        'quality_of_service' => $validated['rating_quality_of_service'],
        'communication' => $validated['rating_communication'],
        'professionalism' => $validated['rating_professionalism'],
        'cleanliness_tidiness' => $validated['rating_cleanliness_tidiness'],
        'value_for_money' => $validated['rating_value_for_money'],
        'additional_feedback' => $validated['feedback'],
    ]);

    // Store rating status in localStorage for frontend
    // Note: This is usually handled on the frontend by JavaScript, not in the controller

    return redirect()->route('dashboard')->with('success', 'Rating submitted successfully.');
}

    
}
