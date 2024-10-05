<?php
namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Models\ServiceRequestImages;

use App\Models\Channel;
use App\Models\Rating;
use App\Models\Bid;
use App\Models\Employee;
use App\Models\EmployeeTaskAssignment;
use App\Models\User;
use App\Models\Agency;
use App\Models\AgencyUser;
use App\Models\ProviderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChannelController extends Controller
{

public function cancelRequest(Request $request, Channel $channel)
{
    $user = Auth::user();

    // Ensure the user is a seeker (role 3 is assumed to be a seeker)
    if ($user->role != 3) {
        return redirect()->back()->with('error', 'Unauthorized action.');
    }

    // Check if the task has already started
    if ($channel->is_task_started === 'true') {
        return redirect()->back()->with('error', 'You cannot cancel a task that has already started.');
    }

    // Proceed with cancellation
    $channel->cancel_reason = $request->input('cancel_reason'); // Set the cancellation reason
    $channel->is_cancelled = 'pending';
    $channel->save();

    // Optionally notify the agency user about the pending cancellation
    // You can implement a notification system here

    return redirect()->back()->with('success', 'Cancellation requested. Awaiting confirmation from the agency.');
}      


public function confirmCancellation(Request $request)
{
    // Retrieve channel by ID from the request
    $channel = Channel::findOrFail($request->channel_id);

    // Get the currently authenticated agency user
    $agencyUser = Auth::guard('agency_users')->user();

    // Ensure the cancellation is in 'pending' status
    if ($channel->is_cancelled !== 'pending') {
        return redirect()->back()->with('error', 'Cancellation is not in pending state.');
    }

    // Confirm cancellation
    $channel->status = 'cancelled';
    $channel->is_cancelled = 'true';
    $channel->save();

    // Update the associated service request status to 'cancelled'
    $serviceRequest = $channel->serviceRequest; // Assuming there's a relationship defined in the Channel model
    if ($serviceRequest) {
        $serviceRequest->status = 'cancelled'; // Set the service request status to 'cancelled'
        $serviceRequest->save();
    }

        // Update only the employees with status 'assigned'
        $assignments = EmployeeTaskAssignment::where('channel_id', $channel->id)
        ->where('status', 'assigned')
        ->get();

    foreach ($assignments as $assignment) {
        // Update the assignment status and completion time
        $assignment->status = 'cancelled';
        $assignment->completed_at = now();
        $assignment->save();

        // Update the employee's availability to 'available'
        $employee = $assignment->employee; // Assuming there's a relationship defined in EmployeeTaskAssignment model
        if ($employee) {
            $employee->availability = 'available';
            $employee->save();
        }
    }

    return redirect()->back()->with('success', 'Task cancelled and employees released.')->with('showModal', false);
}
   
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

        // Fetch assigned employees for the specific channel
        $assignedEmployeeIds = EmployeeTaskAssignment::where('channel_id', $channel->id)
            ->where('status', 'assigned') // Filter by 'assigned' status
            ->pluck('employee_id');

        $assignedEmployees = Employee::whereIn('id', $assignedEmployeeIds)->get();

    } catch (\Exception $e) {
        Log::error('Channel not found: ' . $e->getMessage());
        abort(404, 'Channel not found.');
    }

    return view('seekerChannel', compact('channel', 'serviceRequestImages', 'assignedEmployees'));
}

    
    


    public function agencyChannel($serviceRequestId)
    {

        $agencyUser = Auth::guard('agency_users')->user(); // Get the currently authenticated agency user
    
        try {
            // Fetch the channel based on service request ID and provider ID
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
    
        // Fetch all available employees
        $employees = Employee::all(); // Fetch all employees; modify as needed to filter or sort
    
        // Fetch assigned employees for the specific channel
        $assignedEmployeeIds = EmployeeTaskAssignment::where('channel_id', $channel->id)
        ->where('status', 'assigned') // Filter by 'assigned' status
        ->pluck('employee_id');
$assignedEmployees = Employee::whereIn('id', $assignedEmployeeIds)->get();
    
            // Check if there are any assigned employees
    $isEmployeeAssigned = $assignedEmployees->isNotEmpty();

        // Pass agency ID to the view
        $agencyId = $agencyUser->agency_id; // Adjust this according to your schema
    
        return view('agencyuser.agency-channel', compact('serviceRequest', 'channel', 'seeker', 'employees', 'assignedEmployees', 'agencyId','isEmployeeAssigned'));
    }
    
   
    
     public function unassignEmployee(Request $request, $channelId, $employeeId)
{
    try {
        // Find the assignment entry
        $assignment = EmployeeTaskAssignment::where('channel_id', $channelId)
                                           ->where('employee_id', $employeeId)
                                           ->first();
        
        if (!$assignment) {
            return redirect()->back()->with('error', 'No assignment found.');
        }

        // Delete the assignment
        $assignment->delete();

        // Update the employee's availability
        $employee = Employee::find($employeeId);
        if ($employee) {
            $employee->availability = 'available';
            $employee->save();
        }

        // Redirect with success message
        return redirect()->back()->with('success', 'Employee successfully unassigned.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to unassign employee: ' . $e->getMessage());
    }
}





    
    

    

    public function informSeekerOnTheWay(Channel $channel)
    {
        $agencyUser = Auth::guard('agency_users')->user();

        // Update the is_on_the_way column
        $channel->is_on_the_way = 1;
        $channel->save();

        return response()->json(['message' => 'Seeker has been informed that the provider is on the way.']);
    }

    public function setArrived(Channel $channel)
    {
        $agencyUser = Auth::guard('agency_users')->user();

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
        $agencyUser = Auth::guard('agency_users')->user();

        Log::info('Start Task called', ['channel_id' => $channel->id, 'agency_users' => $agencyUser->id]);

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
        // Use the agency_users guard to authenticate the user
        $agencyUser = Auth::guard('agency_users')->user();

        if (!$agencyUser) {
            Log::error('Unauthorized action.', ['agency_user' => null]);
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }

        // Update the channel's status and completion time
        $channel->status = 'completed';
        $channel->is_task_completed = 'true';
        $channel->completion_time = now();
        $channel->save();

        // Update the status of the associated service request
        $serviceRequest = $channel->serviceRequest; // Assuming there's a relationship defined in the Channel model
        if ($serviceRequest) {
            $serviceRequest->status = 'completed';
            $serviceRequest->save();
        }

        // Update only the employees with status 'assigned'
        $assignments = EmployeeTaskAssignment::where('channel_id', $channel->id)
            ->where('status', 'assigned')
            ->get();

        foreach ($assignments as $assignment) {
            // Update the assignment status and completion time
            $assignment->status = 'completed';
            $assignment->completed_at = now();
            $assignment->save();

            // Update the employee's availability to 'available'
            $employee = $assignment->employee; // Assuming there's a relationship defined in EmployeeTaskAssignment model
            if ($employee) {
                $employee->availability = 'available';
                $employee->save();
            }
        }

        return response()->json(['message' => 'Task and service request have been confirmed as completed.']);
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


