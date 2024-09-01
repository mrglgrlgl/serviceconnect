<?php
namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Models\ServiceRequestImages;

use App\Models\Channel;
use App\Models\Rating;
use App\Models\Bid;
use App\Models\User;
use App\Models\Agency;
use App\Models\AgencyUser;
use App\Models\ProviderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChannelController extends Controller
{


    // In ChannelController.php
    public function seekerChannel($serviceRequestId)
    {
        $user = Auth::user();
    
        // Ensure the user has the correct role
        if ($user->role != 3) { // Assuming role 3 is the seeker role
            abort(403, 'Unauthorized action.');
        }
    
        try {
            // Retrieve the channel with associated service request, agency user, and agency details
            $channel = Channel::where('service_request_id', $serviceRequestId)
                ->with([
                    'serviceRequest',
                    'agencyuser', // Eager-load the agency user
                    'agencyuser.agency', // Eager-load the agency associated with the agency user
                    'seeker',
                    'bid'
                ])
                ->firstOrFail();
    
            $serviceRequestImages = ServiceRequestImages::where('service_request_id', $serviceRequestId)->get();
        } catch (\Exception $e) {
            Log::error('Channel not found: ' . $e->getMessage());
            abort(404, 'Channel not found.');
        }
    
        return view('seekerChannel', compact('channel', 'serviceRequestImages'));
    }
    
    


    public function agencyChannel($serviceRequestId)
    {
        $agencyUser = Auth::guard('agency_users')->user(); // Use the correct guard for AgencyUser
    
        try {
            $channel = Channel::where('service_request_id', $serviceRequestId)
                              ->where('provider_id', $agencyUser->id)
                              ->with(['serviceRequest', 'bid', 'seeker'])
                              ->firstOrFail();
        } catch (\Exception $e) {
            Log::error('Channel not found: ' . $e->getMessage());
            abort(404, 'Channel not found.');
        }
    
        $serviceRequest = $channel->serviceRequest;
        $seeker = $channel->seeker;
    
        return view('agencyuser.agency-channel', compact('serviceRequest', 'channel', 'seeker'));
    }
    
    

    

    public function informSeekerOnTheWay(Channel $channel)
    {
        $user = Auth::user();

        // Ensure the user has the correct role
        if ($user->role != 2) { // Assuming role 2 is the provider role
            abort(403, 'Unauthorized action.');
        }

        // Update the is_on_the_way column
        $channel->is_on_the_way = 1;
        $channel->save();

        return response()->json(['message' => 'Seeker has been informed that the provider is on the way.']);
    }

    public function setArrived(Channel $channel)
    {
        $user = Auth::user();

        // Ensure the user has the correct role
        if ($user->role != 2) { // Assuming role 2 is the provider role
            abort(403, 'Unauthorized action.');
        }

        // Update the is_arrived column to "pending"
        $channel->is_arrived = 'pending';
        $channel->save();

        return response()->json(['message' => 'Seeker has been notified that the provider has arrived.']);
    }
    public function confirmArrival(Channel $channel)
    {
        $user = Auth::user();

        // Ensure the user has the correct role
        if ($user->role != 3) { // Assuming role 1 is the seeker role
            Log::error('Unauthorized action.', ['user_id' => $user->id, 'role' => $user->role]);
            abort(403, 'Unauthorized action.');
        }

        // Log to ensure method is called
        Log::info('Confirm Arrival called', ['channel_id' => $channel->id, 'user_id' => $user->id]);

        // Update the is_arrived column to "true"
        $channel->is_arrived = 'true';
        $channel->save();

        Log::info('Provider arrival confirmed', ['channel_id' => $channel->id, 'is_arrived' => $channel->is_arrived]);

        return response()->json(['message' => 'Provider arrival confirmed.']);
    }

    public function startTask(Channel $channel)
    {
        $user = Auth::user();

        if ($user->role != 2) {
            Log::error('Unauthorized action.', ['user_id' => $user->id, 'role' => $user->role]);
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }

        Log::info('Start Task called', ['channel_id' => $channel->id, 'user_id' => $user->id]);

        $channel->is_task_started = 'pending';
        $channel->save();

        Log::info('Task start set to pending', ['channel_id' => $channel->id, 'is_task_started' => $channel->is_task_started]);

        return response()->json(['message' => 'Seeker has been notified to confirm task start.']);
    }

    public function confirmTaskStart(Channel $channel)
    {
        $user = Auth::user();

        if ($user->role != 3) { // Assuming role 3 is the seeker role
            Log::error('Unauthorized action.', ['user_id' => $user->id, 'role' => $user->role]);
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }

        Log::info('Confirm Task Start called', ['channel_id' => $channel->id, 'user_id' => $user->id]);

        $channel->is_task_started = 'true';
        $channel->save();

        $channel->start_time = now(); 
        $channel->save();

        Log::info('Task started confirmed', ['channel_id' => $channel->id, 'is_task_started' => $channel->is_task_started]);

        return response()->json(['message' => 'Task has been started successfully.']);
    }

    public function completeTask(Channel $channel)
{
    // Assuming the provider can notify the completion
    $channel->is_task_completed = 'pending'; // Set to 'pending' until seeker confirms
    $channel->save();

    return response()->json(['message' => 'Task completion notified. Waiting for confirmation.']);
}
public function confirmTaskCompletion(Channel $channel)
{
    try {
        $user = Auth::user();

        if ($user->role != 3) { // Assuming role 3 is the seeker role
            Log::error('Unauthorized action.', ['user_id' => $user->id, 'role' => $user->role]);
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }

        Log::info('Confirm Task Completion called', ['channel_id' => $channel->id, 'user_id' => $user->id]);

        $channel->is_task_completed = 'true';
        $channel->completion_time = now(); // Update the completion_time to the current time

        Log::info('Before saving', ['is_task_completed' => $channel->is_task_completed, 'completion_time' => $channel->completion_time]);

        $channel->save();

        Log::info('After saving', ['is_task_completed' => $channel->is_task_completed, 'completion_time' => $channel->completion_time]);

        return response()->json(['message' => 'Task has been confirmed as completed.']);
    } catch (\Exception $e) {
        Log::error('Error confirming task completion: ' . $e->getMessage(), ['exception' => $e]);
        return response()->json(['message' => 'Error confirming task completion.'], 500);
    }

}




public function editBid(Request $request, $bidId)
{
    $user = Auth::user();

    // Ensure the user has the correct role
    if ($user->role != 2) { // Assuming role 2 is the provider role
        abort(403, 'Unauthorized action.');
    }

    // Validate the request
    $request->validate([
        'bid_amount' => 'required|numeric',
        'bid_description' => 'required|string',
    ]);

    try {
        // Retrieve the bid
        $bid = Bid::findOrFail($bidId);

        // Check if the bid belongs to the authenticated provider
        if ($bid->provider_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        // Update the bid details
        $bid->bid_amount = $request->input('bid_amount');
        $bid->bid_description = $request->input('bid_description');
        $bid->save();

        return response()->json(['message' => 'Bid updated successfully.']);
    } catch (\Exception $e) {
        Log::error('Error updating bid: ' . $e->getMessage());
        return response()->json(['message' => 'Error updating bid.'], 500);
    }
}
}


