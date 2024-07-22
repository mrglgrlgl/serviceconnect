<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Category;

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
            $categories = Category::all(); // Fetch all categories
            return view('layouts.modal', compact('categories')); // Pass categories to the view
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

    // Format the existing times to H:i before merging
    $existingStartTime = \Carbon\Carbon::parse($serviceRequest->start_time)->format('H:i');
    $existingEndTime = \Carbon\Carbon::parse($serviceRequest->end_time)->format('H:i');

    // Log original times
    Log::info('Original start time: ' . $existingStartTime);
    Log::info('Original end time: ' . $existingEndTime);

    // Merge existing times if not present in the request
    $startTime = $request->input('start_time', $existingStartTime);
    $endTime = $request->input('end_time', $existingEndTime);

    // Ensure the merged times are correctly formatted
    try {
        $startTime = \Carbon\Carbon::createFromFormat('H:i', $startTime)->format('H:i');
        $endTime = \Carbon\Carbon::createFromFormat('H:i', $endTime)->format('H:i');
    } catch (\Exception $e) {
        Log::error('Time format error: ' . $e->getMessage());
        return redirect()->back()->withErrors(['start_time' => 'Invalid start time format', 'end_time' => 'Invalid end time format']);
    }

    // Log merged times for debugging
    Log::info('Merged start time: ' . $startTime);
    Log::info('Merged end time: ' . $endTime);
    

    // Validate the request data
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
        'attach_media' => 'nullable|file|mimes:jpg,jpeg,png',
        'attach_media2' => 'nullable|file|mimes:jpg,jpeg,png',
        'attach_media3' => 'nullable|file|mimes:jpg,jpeg,png',
        'attach_media4' => 'nullable|file|mimes:jpg,jpeg,png',
    ]);

   // Log final times before saving
   Log::info('Final start time before save: ' . $serviceRequest->start_time);
   Log::info('Final end time before save: ' . $serviceRequest->end_time);

    // Update the service request with validated data
    $serviceRequest->category = $validatedData['category'];
    $serviceRequest->title = $validatedData['title'];
    $serviceRequest->description = $validatedData['description'];
    $serviceRequest->location = $validatedData['location'];
    $serviceRequest->start_date = $validatedData['start_date'];
    $serviceRequest->end_date = $validatedData['end_date'];

    // $serviceRequest->start_time = $request->start_time;
    // $serviceRequest->end_time = $request->end_time;
    $serviceRequest->skill_tags = $validatedData['skill_tags'];
    $serviceRequest->provider_gender = $validatedData['provider_gender'];
    $serviceRequest->job_type = $validatedData['job_type'];
    $serviceRequest->hourly_rate = $validatedData['hourly_rate'];
    $serviceRequest->expected_price = $validatedData['expected_price'];
    $serviceRequest->estimated_duration = $validatedData['estimated_duration'];

    
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

    // Save the updated service request
    $serviceRequest->save();

        // Log the saved times
        Log::info('Saved start time: ' . $serviceRequest->start_time);
        Log::info('Saved end time: ' . $serviceRequest->end_time);
    

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