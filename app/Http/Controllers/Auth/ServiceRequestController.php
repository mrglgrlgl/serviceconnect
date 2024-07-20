<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ServiceRequestController extends Controller
{

    public function retrieveByUserRole()
    {
        // Fetch the authenticated user
        $user = Auth::user();
    
        // Check if the user role is provider (assuming role 2 is for providers)
        if ($user->role == 2) {
            // Retrieve all service requests for providers
            $serviceRequests = ServiceRequest::all();
        } else {
            // For other roles, handle accordingly (this is optional, depending on your application logic)
            $serviceRequests = ServiceRequest::all(); // or any fallback logic you may have
        }
    
        // Return the view with the retrieved service requests
        return view('provider.dashboard', compact('serviceRequests'));
    }

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
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i',
        'skill_tags' => 'required|string|max:255',
        'provider_gender' => 'nullable|in:male,female',
        'job_type' => 'required|in:project_based,hourly_rate',
        'hourly_rate' => 'required|numeric|min:0',
        'expected_price' => 'required|numeric|min:0',
        'estimated_duration' => 'required|integer|min:0',
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
    $serviceRequest->title = $validatedData['title'];
    $serviceRequest->description = $validatedData['description'];
    $serviceRequest->location = $validatedData['location'];
    $serviceRequest->start_date = $validatedData['start_date'];
    $serviceRequest->end_date = $validatedData['end_date'];
    $serviceRequest->start_time = $validatedData['start_time'];
    $serviceRequest->end_time = $validatedData['end_time'];
    $serviceRequest->skill_tags = $validatedData['skill_tags'];
    $serviceRequest->provider_gender = $validatedData['provider_gender'];
    $serviceRequest->job_type = $validatedData['job_type'];
    $serviceRequest->hourly_rate = $validatedData['hourly_rate'];
    $serviceRequest->expected_price = $validatedData['expected_price'];
    $serviceRequest->estimated_duration = $validatedData['estimated_duration'];
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
        // Find the existing service request
        $serviceRequest = ServiceRequest::findOrFail($id);

        // Set default values for start_time and end_time to existing ones if not present in the request
        $request->merge([
            'start_time' => $request->input('start_time', $serviceRequest->start_time),
            'end_time' => $request->input('end_time', $serviceRequest->end_time),
        ]);

    $validatedData = $request->validate([
        'category' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i',
        'skill_tags' => 'required|string|max:255',
        'provider_gender' => 'nullable|in:male,female',
        'job_type' => 'required|in:project_based,hourly_rate',
        'hourly_rate' => 'required|numeric|min:0',
        'expected_price' => 'required|numeric|min:0',
        'estimated_duration' => 'required|integer|min:0',
        'attach_media' => 'nullable|file|mimes:jpg,jpeg,png', // Adjust mime types as needed
        'attach_media2' => 'nullable|file|mimes:jpg,jpeg,png',
        'attach_media3' => 'nullable|file|mimes:jpg,jpeg,png',
        'attach_media4' => 'nullable|file|mimes:jpg,jpeg,png',
    ]);


    $serviceRequest->category = $request->category;
    $serviceRequest->title = $request->title;
    $serviceRequest->description = $request->description;
    $serviceRequest->location = $request->location;
    $serviceRequest->start_date = $request->start_date;
    $serviceRequest->end_date = $request->end_date;
    
    Log::info('Original start time: ' . $serviceRequest->start_time);
    Log::info('Original end time: ' . $serviceRequest->end_time);

    // Convert the time inputs to the correct format
    $serviceRequest->start_time = \Carbon\Carbon::createFromFormat('H:i', $validatedData['start_time'])->format('H:i:s');
    $serviceRequest->end_time = \Carbon\Carbon::createFromFormat('H:i', $validatedData['end_time'])->format('H:i:s');

        // Log the converted times
        Log::info('Converted start time: ' . $serviceRequest->start_time);
        Log::info('Converted end time: ' . $serviceRequest->end_time);

    // $serviceRequest->start_time = $request->start_time;
    // $serviceRequest->end_time = $request->end_time;
    $serviceRequest->skill_tags = $request->skill_tags;
    $serviceRequest->provider_gender = $request->provider_gender;
    $serviceRequest->job_type = $request->job_type;
    $serviceRequest->hourly_rate = $request->hourly_rate;
    $serviceRequest->expected_price = $request->expected_price;
    $serviceRequest->estimated_duration = $request->estimated_duration;

    
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