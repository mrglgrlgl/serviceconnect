<?php
namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Models\Channel;
use App\Models\Bid;
use App\Models\User;
use App\Models\ProviderDetail;
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
            // Retrieve the channel with associated service request, bid, provider, and seeker
            $channel = Channel::where('service_request_id', $serviceRequestId)
                ->with(['serviceRequest', 'provider.providerDetails', 'seeker', 'bid'])
                ->firstOrFail();
        } catch (\Exception $e) {
            \Log::error('Channel not found: ' . $e->getMessage());
            abort(404, 'Channel not found.');
        }

        return view('seekerChannel', compact('channel'));
    }
    public function providerChannel($serviceRequestId)
    {
        $user = Auth::user();

        // Ensure the user has the correct role
        if ($user->role != 2) { // Assuming role 2 is the provider role
            abort(403, 'Unauthorized action.');
        }

        try {
            // Retrieve the channel where the provider is involved
            $channel = Channel::where('service_request_id', $serviceRequestId)
                              ->where('provider_id', $user->id)
                              ->with(['serviceRequest', 'bid', 'seeker'])
                              ->firstOrFail();
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

}public function confirmPayment(Channel $channel)
{
    try {
        $user = Auth::user();

        if ($user->role != 2) { // Assuming role 2 is the provider role
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }

        $channel->is_paid = 'true';
        $channel->save();

        return response()->json(['message' => 'Payment confirmed.']);
    } catch (\Exception $e) {
        Log::error('Error confirming payment: ' . $e->getMessage(), ['exception' => $e]);
        return response()->json(['message' => 'Error confirming payment.'], 500);
    }
}

    
}



// public function startTask($channelId)
// {
//     $channel = Channel::findOrFail($channelId);
//     $channel->start_time = now();
//     $channel->status = 'in_progress';
//     $channel->save();

//     return response()->json(['message' => 'Task started successfully']);
// }

// public function completeTask($channelId)
// {
//     $channel = Channel::findOrFail($channelId);
//     $channel->completion_time = now();
//     $channel->status = 'completed';
//     $channel->save();

//     return response()->json(['message' => 'Task completed successfully']);
// }

// public function confirmPayment($channelId)
// {
//     $channel = Channel::findOrFail($channelId);
//     $channel->amount_paid = $channel->bid->bid_amount;
//     $channel->status = 'completed';
//     $channel->save();

//     return response()->json(['message' => 'Payment confirmed successfully']);
// }



