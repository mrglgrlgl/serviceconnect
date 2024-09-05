<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\Agency;
use App\Models\AgencyUser;
use App\Models\AgencyService;
use App\Models\ServiceRequest;
use App\Notifications\BidPlacedNotification;
use App\Notifications\BidConfirmed;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth; // Ensure this line is present


class BidController extends Controller
{


    public function viewProfile($agencyUserId)
    {
        $agencyUser = AgencyUser::with('agency')->findOrFail($agencyUserId);

        if (!$agencyUser) {
            return redirect()->back()->withErrors('Agency profile not found.');
        }

        // Fetch services related to the agency
        $services = AgencyService::where('agency_id', $agencyUser->agency->id)->get();

        return view('view-profile', [
            'agencyUser' => $agencyUser,
            'agency' => $agencyUser->agency,
            'services' => $services
        ]);
    }

    

    public function store(Request $request)
{
    // Ensure 'agency_user' guard is used to get the authenticated user's ID
    $bidderId = Auth::guard('agency_users')->id(); // Use id() to get the authenticated user ID

    $bid = Bid::create([
        'service_request_id' => $request->service_request_id,
        'bidder_id' => $bidderId, // Set bidder_id using the correct guard
        'bid_amount' => $request->bid_amount,
        'bid_description' => $request->bid_description,
        'status' => 'pending',
    ]);

    // Increment number_of_bids
    $serviceRequest = ServiceRequest::findOrFail($request->service_request_id);
    $serviceRequest->increment('number_of_bids');

    // Notify the seeker (service request owner)
    // Add your notification code here

    // Redirect to the service requests page
    return redirect()->route('agencyuser.service-requests')->with('success', 'Bid placed successfully.');
}


    public function index($serviceRequestId)
    {
        $bids = Bid::where('service_request_id', $serviceRequestId)
            ->with('bidder.agency')
            ->get();

        return response()->json($bids);
    }

    public function create($id)
    {
        \Log::info('Create method called with ID: ' . $id);
        $serviceRequest = ServiceRequest::findOrFail($id);
        return view('agencyuser.place-bid', compact('serviceRequest'));
    }
    
    
    

    public function show($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);
        return view('agencyuser.service-requests', compact('serviceRequest'));
    }



    public function confirm(Request $request, $bidId)
{
    try {
        $bid = Bid::findOrFail($bidId);

        if ($bid->status == 'accepted') {
            return response()->json(['success' => false, 'message' => 'This bid is already accepted.']);
        }

        $bid->update(['status' => 'accepted']);
        $serviceRequest = $bid->serviceRequest;

        // Check if the service request and bid are valid
        if ($serviceRequest) {
            $serviceRequest->update(['provider_id' => $bid->bidder_id, 'status' => 'in_progress']);
        }



        // Save the service request to trigger the observer
        $serviceRequest->save();

        // Notify the bidder
        Notification::send($bid->bidder, new BidConfirmed($bid, $serviceRequest));

        // Reject other bids
        Bid::where('service_request_id', $bid->service_request_id)
            ->where('id', '!=', $bidId)
            ->update(['status' => 'rejected']);

        return response()->json(['success' => true, 'message' => 'Bid accepted successfully.']);
    } catch (\Exception $e) {
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
        if ($bid->bidder_id != auth()->user()->id) {
            return redirect()->back()->withErrors('You are not authorized to edit this bid.');
        }

        $bid->update($request->only('bid_amount', 'bid_description'));
        return redirect()->back()->with('success', 'Bid updated successfully.');
    }
}


