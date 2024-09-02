<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTaskAssignment;
use App\Models\Employee;
use App\Models\Channel;
use App\Models\AgencyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EmployeeTaskAssignmentController extends Controller
{

    public function showAssignmentPage ($serviceRequestId)
    {
        $agencyUser = Auth::guard('agency_users')->user(); // Get the currently authenticated agency user
    
        try {
            $channel = Channel::where('service_request_id', $serviceRequestId)
                              ->where('provider_id', $agencyUser->id)
                              ->with(['serviceRequest', 'bid', 'seeker'])
                              ->firstOrFail();
        } catch (\Exception $e) {
            Log::error('Channel not found: ' . $e->getMessage());
            abort(404, 'Channel not found.');
        }
    
        // Store channel ID in session
        session(['current_channel_id' => $channel->id]);
    
        // Debug: Log the stored channel ID
    
        return view('agencyuser.employee-task', [
            'channel' => $channel,
            'agencyId' => $agencyUser->id,
            'employees' => Employee::where('availability', 'available')->get()
        ]);
    }
    
    



    public function assign(Request $request, $channelId)
    {
        // Debug: Log the retrieved channel ID     
        Log::info('Received Channel ID:', ['channel_id' => $channelId]);
    
        $validatedData = $request->validate([
            'employee_ids' => 'required|array',
            'employee_ids.*' => 'integer|exists:employees,id',
        ]);
    
        $agencyId = auth()->user()->agency_id;
        $assignedBy = auth()->id();
    
        foreach ($validatedData['employee_ids'] as $employeeId) {
            // Update the employee's availability
            Employee::where('id', $employeeId)
                ->update(['availability' => 'assigned']);
    
            // Create an entry in the EmployeeTaskAssignment table
            EmployeeTaskAssignment::create([
                'channel_id' => $channelId,
                'employee_id' => $employeeId,
                'agency_id' => $agencyId,
                'status' => 'assigned',
                'assigned_at' => now(),
                'assigned_by' => $assignedBy,
            ]);
        }
    
        return redirect()->back()->with('status', 'Employees have been successfully assigned and their availability status updated.');

    }
    
    
    


    
    
    
    
    

    
    
    
    

    

    // // Method to mark a task as completed
    // public function complete($id)
    // {
    //     $assignment = EmployeeTaskAssignment::findOrFail($id);
    //     $assignment->status = 'completed';
    //     $assignment->completed_at = now();
    //     $assignment->save();

    //     // Update employee status to available
    //     $assignment->employee->update(['status' => 'available']);

    //     return response()->json($assignment);
    // }

    // Method to remove an employee from a task
public function remove($id)
{
    // Log the ID for debugging
    Log::info('Removing assignment with ID: ' . $id);

    // Find the task assignment or fail
    $assignment = EmployeeTaskAssignment::findOrFail($id);

    // Update the task assignment using the update method
    $assignment->update([
        'status' => 'removed',
        'completed_at' => now(),
    ]);

    // Ensure the employee exists before updating
    if ($assignment->employee) {
        $assignment->employee->update(['status' => 'available']);
    } else {
        return response()->json([
            'message' => 'Employee not found for this assignment.'
        ], 404);
    }

    return response()->json([
        'message' => 'Employee unassigned successfully.',
        'assignment' => $assignment
    ]);
}

    

    


    // Additional methods for listing, updating assignments, etc.
}
