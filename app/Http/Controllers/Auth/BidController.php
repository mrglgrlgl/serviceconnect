<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Routing\Controller;  // Correct import for the base controller
use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\User;
use App\Models\ProviderDetail;
use App\Models\ServiceRequest;


class BidController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'service_request_id' => 'required|exists:service_requests,id',
            'bid_amount' => 'required|numeric',
            'bid_description' => 'required|string',
        ]);

        Bid::create([
            'service_request_id' => $request->service_request_id,
            'bidder_id' => auth()->user()->id,
            'bid_amount' => $request->bid_amount,
            'bid_description' => $request->bid_description,
            'status' => 'pending', // Default status for new bids
        ]);

        // Increment number_of_bids for the corresponding service request
        $serviceRequest = ServiceRequest::findOrFail($request->service_request_id);
        $serviceRequest->increment('number_of_bids');

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
            // Fetch the bid
            $bid = Bid::findOrFail($bidId);

            // Check if the bid is already accepted
            if ($bid->status == 'accepted') {
                return response()->json(['success' => false, 'message' => 'This bid is already accepted.']);
            }

            // Update the bid status to accepted
            $bid->status = 'accepted';
            $bid->save();

            // Reject all other bids for the same service request
            Bid::where('service_request_id', $bid->service_request_id)
                ->where('id', '!=', $bidId)
                ->update(['status' => 'rejected']);

            return response()->json(['success' => true, 'message' => 'Bid accepted successfully.']);
        } catch (\Exception $e) {
            // Log the exception message
            \Log::error('Error confirming bid: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An unexpected error occurred.'], 500);
        }
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
}