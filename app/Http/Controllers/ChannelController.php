<?php
namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Models\Channel;
use App\Models\Bid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChannelController extends Controller
{


    public function seekerChannel($serviceRequestId)
    {

    $user = Auth::user();

    // Ensure the user has the correct role
    if ($user->role != 3) { // Assuming role 3 is the seeker role
        abort(403, 'Unauthorized action.');
    }

    try {
        // Retrieve the service request with associated user (seeker) and provider
        $serviceRequest = ServiceRequest::with('user', 'provider')->findOrFail($serviceRequestId);
    } catch (\Exception $e) {
        Log::error('ServiceRequest not found: ' . $e->getMessage());
        abort(404, 'Service request not found.');
    }

    try {
        // Retrieve the channel with associated bid
        $channel = Channel::where('service_request_id', $serviceRequestId)->with('bid')->firstOrFail();
    } catch (\Exception $e) {
        Log::error('Channel not found: ' . $e->getMessage());
        abort(404, 'Channel not found.');
    }

    // Retrieve the provider and seeker
    $provider = $serviceRequest->provider;
    $seeker = $serviceRequest->user;

    // Return the view with the retrieved data
    return view('seekerChannel', compact('serviceRequest', 'channel', 'provider', 'seeker'));
}


public function providerChannel()
{
    $user = Auth::user();

    // Ensure the user has the correct role
    if ($user->role != 2) { // Assuming role 2 is the provider role
        abort(403, 'Unauthorized action.');
    }

    try {
        // Retrieve the channel where the provider is involved
        $channel = Channel::where('provider_id', $user->id)->with(['serviceRequest', 'bid', 'seeker'])->firstOrFail();
    } catch (\Exception $e) {
        Log::error('Channel not found: ' . $e->getMessage());
        abort(404, 'Channel not found.');
    }

    // Retrieve the service request and seeker
    $serviceRequest = $channel->serviceRequest;
    $seeker = $channel->seeker;

    // Return the view with the retrieved data
    return view('provider.providerChannel', compact('serviceRequest', 'channel', 'seeker'));
}

    
}

