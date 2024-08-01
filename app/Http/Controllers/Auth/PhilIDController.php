<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhilID;
use App\Notifications\PhilIDRejected;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PhilIDController extends Controller
{
    // Show a list of all PhilID entries for the authenticated user
    public function index()
    {
        $philIDs = PhilID::where('provider_id', Auth::id())->get();
        return view('auth.verify.sensitiveinfo.idform', compact('philIDs'));
    }
 
    // Show the form to submit PhilID information
    public function create()
    {
        return view('auth.verify.sensitiveinfo.idform');
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'philid_number' => 'required|string|max:255',
            'given_names' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            'blood_type' => 'nullable|string|max:3',
            'civil_status' => 'nullable|string|max:255',
            'issue_date' => 'required|date',
            'front_image' => 'required|image|max:2048',
            'back_image' => 'required|image|max:2048',
        ]);

        // Handle file uploads
        $frontImagePath = $request->file('front_image')->store('philid_images', 'public');
        $backImagePath = $request->file('back_image')->store('philid_images', 'public');

        // Save data to the database
        PhilID::create([
            'provider_id' => Auth::id(),
            'philid_number' => $request->philid_number,
            'given_names' => $request->given_names,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'place_of_birth' => $request->place_of_birth,
            'address' => $request->address,
            'gender' => $request->gender,
            'blood_type' => $request->blood_type,
            'civil_status' => $request->civil_status,
            'issue_date' => $request->issue_date,
            'front_image' => $frontImagePath,
            'back_image' => $backImagePath,
            'status' => 'pending', // Default status
        ]);

        return redirect()->route('provider.dashboard')->with('success', 'PhilID information submitted successfully!');
    }


      public function showAll()
    {
        // Eager load the 'provider' relationship to fetch related user data
        $philIDs = PhilID::with('provider')->get(); 
        
        return view('authorizer.dashboard', compact('philIDs'));
    }

    public function accept($id)
    {
        $philID = PhilID::findOrFail($id);
        $philID->status = 'Accepted';
        $philID->save();

        return redirect()->back()->with('success', 'PhilID accepted.');
    }

    public function reject($id)
    {
        $philID = PhilID::findOrFail($id);
        $philID->status = 'Rejected';
        $philID->save();
        $philID->provider->notify(new PhilIDRejected());

        return redirect()->back()->with('success', 'PhilID rejected.');
    }
}

