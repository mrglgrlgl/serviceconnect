<?php
namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\AgencyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CreateAgencyUserController extends Controller
{
    public function index(Agency $agency)
    {
        // List all users for a specific agency
        $users = $agency->users;
        return view('admin.agencies.agency-detail', compact('agency', 'users'));
    }

    public function create(Agency $agency)
    {
        // Show form to create a new user for the agency
        return view('admin.agencies.create-agency-user', compact('agency'));
    }

    public function store(Request $request, Agency $agency)
    {
        // Validate the input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:agency_users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create a new agency user and associate it with the current agency
        $agency->users()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('agencies.show', $agency->id)->with('success', 'Agency User created successfully.');
    }

    public function edit(Agency $agency, AgencyUser $user)
    {
        return view('admin.agencies.edit-agency-user', compact('agency', 'user'));
    }
    

    public function update(Request $request, Agency $agency, AgencyUser $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:agency_users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);
    
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->filled('password') ? Hash::make($request->input('password')) : $user->password,
        ]);
    
        return redirect()->route('agencies.show', $agency->id)->with('success', 'Agency User updated successfully.');
    }
    


    public function destroy(Agency $agency, AgencyUser $agencyUser)
    {
        // Delete the user
        $agencyUser->delete();

        return redirect()->route('agencies.show', $agency->id)->with('success', 'Agency User deleted successfully.');
    }
}
