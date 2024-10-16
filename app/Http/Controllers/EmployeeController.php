<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\AgencyService;
use App\Models\Channel;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve the agency ID of the currently logged-in user
        $agency = auth()->user()->agency;
        
        // Get the filters
        $nameFilter = $request->input('name');
        $serviceFilter = $request->input('service');
        $showArchived = $request->input('show_archived'); // New filter for archived employees
        
        // Retrieve all employees belonging to the user's agency
        $employees = Employee::where('agency_id', $agency->id)->with('services');
        
        // By default, exclude archived employees unless 'show_archived' is true
        if (!$showArchived) {
            $employees->where('is_archived', false); // Exclude archived employees by default
        } else {
            $employees->where('is_archived', true); // Show only archived employees when filtered
        }
    
        // Apply name filter if provided
        if (!empty($nameFilter)) {
            $employees->where('name', 'like', '%' . $nameFilter . '%');
        }
    
        // Apply service filter if provided
        if (!empty($serviceFilter)) {
            $employees->whereHas('services', function ($query) use ($serviceFilter) {
                $query->where('agency_services.id', $serviceFilter);
            });
        }
    
        // Get filtered employees
        $employees = $employees->get();
    
        // Retrieve all services for the agency
        $services = AgencyService::where('agency_id', $agency->id)->get();
    
        // Pass the employees, services, and agency to the view
        return view('agencyuser.employee-list', compact('employees', 'services', 'agency'));
    }
    

    public function show(Employee $employee)
    {
        // Eager load ratings and their associated channels
        $employee->load('ratings.channel');
    
        // Count the number of completed service requests through ratings and channels
        $completedServicesCount = $employee->ratings->filter(function ($rating) {
            // Check if the channel exists and if is_task_completed is true
            return $rating->channel && $rating->channel->is_task_completed;
        })->count();
    
        // Log for debugging
        Log::info("Employee ID: {$employee->id}, Completed Services Count: {$completedServicesCount}");
    
        // Pass the data to the view
        return view('agencyuser.view-employee-profile', compact('employee', 'completedServicesCount'));
    }
    

    
    

    public function create()
    {
        // Retrieve the agency ID of the currently logged-in user
        $agency = auth()->user()->agency;

        // Return the view to create a new employee
        return view('agencyuser.create-employee', compact('agency'));
    }

    public function store(Request $request)
    {
        // Retrieve the agency ID of the currently logged-in user
        $agency = auth()->user()->agency;

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees',
            'phone' => 'required|string|max:15',
            'position' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'birthdate' => 'required|date',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle file upload if a photo is provided
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        } else {
            $photoPath = null;
        }

        // Create a new employee associated with the agency
        Employee::create([
            'agency_id' => $agency->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'position' => $request->position,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'photo' => $photoPath,
        ]);

        // Redirect back to the employee list with a success message
        return redirect()->route('agency.employees')->with('success', 'Employee added successfully.');
    }


    public function edit(Employee $employee)
    {
        // Ensure the employee belongs to the logged-in user's agency
        $agency = auth()->user()->agency;
    
        // Retrieve the list of services for the agency
        $services = AgencyService::where('agency_id', $agency->id)->get();
    
        // Pass the employee, services, and agency to the view
        return view('agencyuser.edit-employee', compact('employee', 'services', 'agency'));
    }
    
    public function update(Request $request, Employee $employee)
    {
        // Validate the request data
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255',
            'phone' => 'string|max:20',
            'position' => 'string|max:255',
            'gender' => 'string|in:male,female,other',
            'birthdate' => 'date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'availability' => 'in:available,unavailable', // Only available or unavailable
        ]);
    
        // Initialize an array to hold updates
        $updates = [];
    
        // If the revert checkbox is checked
        if ($request->has('revert')) {
            // Restore employee's availability and mark as not archived
            $updates = [
                'availability' => 'available', // Set to available
                'is_archived' => false, // Set is_archived to false
                'archived_at' => null // Clear archived_at timestamp
            ];
    
            $employee->update($updates);
            return redirect()->route('agency.employees')->with('success', 'Employee restored from archive.');
        }
    
        // Check if the archive checkbox is checked
        if ($request->has('is_archived')) {
            // Archive employee
            $updates = [
                'availability' => 'unavailable', // Set availability to unavailable
                'is_archived' => true, // Set is_archived to true
                'archived_at' => now() // Set the current timestamp for archived_at
            ];
    
            $employee->update($updates);
        } else {
            // Prepare updates for other fields without altering is_archived
            $updates = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'position' => $request->position,
                'gender' => $request->gender,
                'birthdate' => $request->birthdate,
                'availability' => $request->availability, // Set availability if not archived
            ];
    
            // Only add photo if it exists
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('photos', 'public');
                $updates['photo'] = $photoPath; // Update photo path
            }
        // Ensure $request->services is an array, even if it's empty
        $services = $request->input('services', []);
    
        // Retrieve the agency ID of the currently logged-in user
        $agencyId = auth()->user()->agency_id;
    
        // Sync services with the assigned_at timestamp and agency_id
        $servicesWithTimestamps = [];
        foreach ($services as $serviceId) {
            $servicesWithTimestamps[$serviceId] = [
                'assigned_at' => now(),
                'agency_id' => $agencyId  // Ensure agency_id is included
            ];
        }
        $employee->services()->sync($servicesWithTimestamps);
            // Only update if there are changes
            $employee->update(array_filter($updates)); // This will ignore null values
        }
    
        return redirect()->route('agency.employees')->with('success', 'Employee updated successfully.');
    }
    
    

    

    public function destroy(Employee $employee)
    {
        // Set the employee to archived instead of deleting
        $employee->is_archived = true; // Mark as archived
        $employee->availability = 'unavailable'; // Set availability to inactive
        $employee->archived_at = now(); // Set the current timestamp for archived_at
        $employee->save(); // Save the changes to the database
    
        return redirect()->route('agency.employees')->with('success', 'Employee archived successfully.');
    }
    


}
