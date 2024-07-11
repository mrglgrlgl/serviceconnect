<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceRequestController extends Controller
{
    public function create()
    {
        return view('layouts.modal'); // Ensure this view file exists
    }
    public function index()
    {
        // Retrieve service requests created by the authenticated user
        $serviceRequests = ServiceRequest::where('user_id', Auth::id())->get();

        return view('dashboard', compact('serviceRequests'));
    }

    public function store(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'category' => 'required|string|max:255',
        'subcategory' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'start_time' => 'required|date',
        'end_time' => 'required|date',
        'attach_media' => 'required|image|max:2048',
        'attach_media2' => 'nullable|image|max:2048',
        'attach_media3' => 'nullable|image|max:2048',
        'attach_media4' => 'nullable|image|max:2048',
    ]);

    // Store uploaded files in 'service_requests/documents' folder
    $attachMediaPath = $request->file('attach_media')->store('service_requests/documents', 'public');
    $attachMedia2Path = $request->file('attach_media2') ? $request->file('attach_media2')->store('service_requests/documents', 'public') : null;
    $attachMedia3Path = $request->file('attach_media3') ? $request->file('attach_media3')->store('service_requests/documents', 'public') : null;
    $attachMedia4Path = $request->file('attach_media4') ? $request->file('attach_media4')->store('service_requests/documents', 'public') : null;

    // Create new service request
    $serviceRequest = new ServiceRequest();
    $serviceRequest->category = $validatedData['category'];
    $serviceRequest->subcategory = $validatedData['subcategory'];
    $serviceRequest->title = $validatedData['title'];
    $serviceRequest->location = $validatedData['location'];
    $serviceRequest->start_time = $validatedData['start_time'];
    $serviceRequest->end_time = $validatedData['end_time'];
    $serviceRequest->status = 'open'; // Default status
    $serviceRequest->user_id = auth()->id(); // Assuming the user is authenticated
    $serviceRequest->attach_media = $attachMediaPath;
    $serviceRequest->attach_media2 = $attachMedia2Path;
    $serviceRequest->attach_media3 = $attachMedia3Path;
    $serviceRequest->attach_media4 = $attachMedia4Path;

    // Save the service request
    $serviceRequest->save();

    return redirect()->route('dashboard')->with('success', 'Service request created successfully!');
}
public function showDashboard()
{
    $serviceRequests = ServiceRequest::all(); // Replace with your actual query to fetch service requests
    return view('dashboard', compact('serviceRequests'));

}


public function update(Request $request, $id)
{
    $request->validate([
        'category' => 'required|string|max:255',
        'subcategory' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'start_time' => 'required|date',
        'end_time' => 'required|date',
        'attach_media' => 'nullable|file|mimes:jpg,jpeg,png', // Adjust mime types as needed
        'attach_media2' => 'nullable|file|mimes:jpg,jpeg,png',
        'attach_media3' => 'nullable|file|mimes:jpg,jpeg,png',
        'attach_media4' => 'nullable|file|mimes:jpg,jpeg,png',
    ]);

    $serviceRequest = ServiceRequest::findOrFail($id);
    $serviceRequest->category = $request->category;
    $serviceRequest->subcategory = $request->subcategory;
    $serviceRequest->title = $request->title;
    $serviceRequest->location = $request->location;
    $serviceRequest->start_time = $request->start_time;
    $serviceRequest->end_time = $request->end_time;

    // Handle file uploads
    // if ($request->hasFile('attach_media')) {
    //     // Delete existing file if remove checkbox is checked
    //     if ($request->has('remove_attach_media')) {
    //         Storage::disk('public')->delete($serviceRequest->attach_media);
    //         $serviceRequest->attach_media = null;
    //     }

    //     // Upload new file
    //     $serviceRequest->attach_media = $request->file('attach_media')->store('service_requests/documents', 'public');
    // }

    // // Repeat similar logic for attach_media2, attach_media3, attach_media4...

    $serviceRequest->save();

    return redirect()->route('dashboard')->with('success', 'Service Request updated successfully!');
}

public function destroy($service_request = null)
{
    if ($service_request) {
        // Delete by model instance
        $serviceRequest = ServiceRequest::findOrFail($service_request);
        $serviceRequest->delete();
    } else {
        // Delete by ID
        ServiceRequest::destroy($service_request);
    }

    // Redirect back with success message
    return redirect()->route('dashboard')->with('success', 'Service Request deleted successfully!');
}


    public function edit($id)
{
    $serviceRequest = ServiceRequest::findOrFail($id); // Assuming ServiceRequest is your model
    return view('layouts.modaledit', compact('serviceRequest'));
}


}