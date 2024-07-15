<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Routing\Controller;  // Correct import for the base controller
use Illuminate\Http\Request;
use App\Models\Bid;
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
}
