<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\AgencyService;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve the agency ID of the currently logged-in user
        $agency = auth()->user()->agency;
    
        // Get the filters
        $nameFilter = $request->input('name');
        $serviceFilter = $request->input('service');
    
        // Retrieve all employees belonging to the user's agency
        $employees = Employee::where('agency_id', $agency->id)->with('services');
    
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
    // Eager load services, taskAssignments, and channels
    $employee = $employee->load('services', 'ratings');
    return view('agencyuser.view-employee-profile', compact('employee'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:20',
            'position' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female,other',
            'birthdate' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Update employee details
        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'position' => $request->position,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
        ]);
    
        // Handle photo upload if provided
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $employee->update(['photo' => $photoPath]);
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
    
        return redirect()->route('agency.employees')->with('success', 'Employee updated successfully.');
    }
    

public function destroy(Employee $employee)
{
    $employee->delete();

    return redirect()->route('agency.employees')->with('success', 'Employee deleted successfully.');
}


}
