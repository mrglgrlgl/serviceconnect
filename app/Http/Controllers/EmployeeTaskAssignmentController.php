<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTaskAssignment;
use App\Models\Employee;
use App\Models\Channel;
use App\Models\AgencyUser;
use App\Models\AgencyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class EmployeeTaskAssignmentController extends Controller
{

    public function showAssignmentPage(Request $request, $serviceRequestId) 
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
    
        // Get only the services assigned to the logged-in user's employees
        $services = AgencyService::whereHas('employees', function ($query) use ($agencyUser) {
            $query->where('employees.agency_id', $agencyUser->agency_id);
        })->get();
    
        // Filter employees by selected service and search query if present
        $serviceId = $request->input('service_id');
        $searchQuery = $request->input('search');
    
        $employeesQuery = Employee::where('availability', 'available')
                                  ->where('agency_id', $agencyUser->agency_id);
    
        // Apply service filtering
        if ($serviceId) {
            $employeesQuery->whereHas('services', function ($query) use ($serviceId) {
                $query->where('service_id', $serviceId);
            });
        }
    
        // Apply name search filtering
        if ($searchQuery) {
            $employeesQuery->where('name', 'like', '%' . $searchQuery . '%');
        }
    
        // Get the filtered employees
        $employees = $employeesQuery->get();
    
        return view('agencyuser.employee-task', [
            'channel' => $channel,
            'agencyId' => $agencyUser->id,
            'employees' => $employees,
            'services' => $services, // Pass filtered services to the view
            'selectedServiceId' => $serviceId,
            'search' => $searchQuery // Pass search query to the view
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
    public function updateEmployeeStatus(Request $request, $channelId)
    {
        $employeeId = $request->input('employee_id');
        $status = $request->input('status');
    
        // Validate the status input
        $validStatuses = ['assigned', 'completed', 'removed'];
        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->withErrors('Invalid status.');
        }
    
        // Find the channel
        $channel = Channel::find($channelId);
    
        if (!$channel) {
            return redirect()->back()->withErrors('Channel not found.');
        }
    
        // Update the status in the employee_task_assignment table
        $assignment = EmployeeTaskAssignment::where('channel_id', $channelId)
                                            ->where('employee_id', $employeeId)
                                            ->first();
    
        if (!$assignment) {
            return redirect()->back()->withErrors('Employee not found in the channel.');
        }
    
        // Update the status and other fields
        $assignment->status = $status;
        if ($status === 'completed') {
            $assignment->completed_at = now();
        } elseif ($status === 'assigned') {
            $assignment->completed_at = null; // Clear the completed_at if reassigning
        }
        $assignment->save();
    
        return redirect()->back()->with('success', 'Employee status updated.');
    }
    

    
   
    


    // Additional methods for listing, updating assignments, etc.
}
