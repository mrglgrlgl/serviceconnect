<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Routing\Controller;  // Correct import for the base controller
use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\User;
use App\Models\ProviderDetail;
use App\Models\ServiceRequest;
use App\Notifications\BidPlacedNotification;
use App\Notifications\BidConfirmed;
use Illuminate\Support\Facades\Notification;
use App\Models\Channel;

class BidController extends Controller
{


    
    public function store(Request $request)
    {
        $request->validate([
            'service_request_id' => 'required|exists:service_requests,id',
            'bid_amount' => 'required|numeric',
            'bid_description' => 'required|string',
            'agreed_to_terms' => 'accepted',  // Validates the checkbox

        ]);

        $bid = Bid::create([
            'service_request_id' => $request->service_request_id,
            'bidder_id' => auth()->user()->id,
            'bid_amount' => $request->bid_amount,
            'bid_description' => $request->bid_description,
            'status' => 'pending', // Default status for new bids
            'agreed_to_terms' => $request['agreed_to_terms'],  // Include this field

        ]);

        // Increment number_of_bids for the corresponding service request
        $serviceRequest = ServiceRequest::findOrFail($request->service_request_id);
        $serviceRequest->increment('number_of_bids');
        $seeker = $serviceRequest->user; // Assuming a user relationship exists on the ServiceRequest model
        $seeker->notify(new BidPlacedNotification($bid, $serviceRequest));

        return redirect()->back()->with('success', 'Bid placed successfully.');
    }

    public function index($serviceRequestId)
    {
        $bids = Bid::where('service_request_id', $serviceRequestId)
            ->with('bidder')
            ->get();
        return response()->json($bids);
    }

    public function confirm(Request $request, $bidId)
{
    try {
        $bid = Bid::findOrFail($bidId);

        if ($bid->status == 'accepted') {
            return response()->json(['success' => false, 'message' => 'This bid is already accepted.']);
        }

        $bid->status = 'accepted';
        $bid->save();

        // Retrieve the service request associated with the bid
        $serviceRequest = ServiceRequest::findOrFail($bid->service_request_id);

        // Update the provider_id with the ID of the bidder (provider)
        $serviceRequest->provider_id = $bid->bidder_id;
        $serviceRequest->status ="in_progress";

        $serviceRequest->save();
        $provider = $bid->bidder;
        Notification::send($provider, new BidConfirmed($bid, $serviceRequest));
        // Reject other bids for the same service request
        Bid::where('service_request_id', $bid->service_request_id)
            ->where('id', '!=', $bidId)
            ->update(['status' => 'rejected']);

        return response()->json(['success' => true, 'message' => 'Bid accepted successfully.']);
    } catch (\Exception $e) {
        \Log::error('Error confirming bid: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'An unexpected error occurred.'], 500);
    }
}

public function complete()
{
    return view('profile.complete');
}

    

    public function update(Request $request, $id)
    {
        $request->validate([
            'bid_amount' => 'required|numeric',
            'bid_description' => 'required|string',
        ]);

        $bid = Bid::findOrFail($id);

        // Ensure the authenticated user is the owner of the bid
        if ($bid->bidder_id != auth()->user()->id) {
            return redirect()->back()->withErrors('You are not authorized to edit this bid.');
        }

        $bid->update([
            'bid_amount' => $request->bid_amount,
            'bid_description' => $request->bid_description,
        ]);

        return redirect()->back()->with('success', 'Bid updated successfully.');
    }


public function getProviderProfile($bidderId)
{
    // Fetch the user along with their provider details
    $user = User::with('providerDetails')->findOrFail($bidderId);

    // Prepare the response data
    $profileData = [
        'name' => $user->name,
        'providerDetails' => $user->providerDetails
    ];

    // Return the response as JSON
    return response()->json($profileData);
}



}