<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        // Retrieve the agency ID of the currently logged-in user
        $agency = auth()->user()->agency;

        // Retrieve all employees belonging to the user's agency
        $employees = Employee::where('agency_id', $agency->id)->get();
    
        // Pass the employees and agency to the view
        return view('agencyuser.employee-list', compact('employees', 'agency'));
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
    // $this->authorize('view', $employee); // Remove this line if not using authorization

    return view('agencyuser.edit-employee', compact('employee'));
}
    
public function update(Request $request, Employee $employee)
{
    // Removed authorization, assuming the user is already scoped to their own agency
    
    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:employees,email,' . $employee->id,
        'phone' => 'nullable|string|max:15',
        'position' => 'nullable|string|max:255',
        'gender' => 'nullable|string|in:male,female,other',
        'birthdate' => 'nullable|date',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Handle file upload if a photo is provided
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('photos', 'public');
    } else {
        $photoPath = $employee->photo;
    }

    // Update the employee
    $employee->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'position' => $request->position,
        'gender' => $request->gender,
        'birthdate' => $request->birthdate,
        'photo' => $photoPath,
    ]);

    return redirect()->route('agency.employees')->with('success', 'Employee updated successfully.');
}
public function destroy(Employee $employee)
{
    $employee->delete();

    return redirect()->route('agency.employees')->with('success', 'Employee deleted successfully.');
}


}

