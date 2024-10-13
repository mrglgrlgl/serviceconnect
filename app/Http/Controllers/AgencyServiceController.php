<?php

namespace App\Http\Controllers;
use App\Models\PsaJob;
use App\Models\Agency;
use App\Models\AgencyService;
use App\Models\AgencyServiceUpdate;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;

class AgencyServiceController extends Controller
{
    // Display services within agency settings
    public function index(Agency $agency)
    {
        // Fetch services for the agency
        $services = $agency->services()->get();
        return view('agencyuser.agency-settings', compact('agency', 'services'));
    }

    public function create($agencyId)
    {
        $agency = Agency::find($agencyId); // Fetch the agency based on the passed ID
        $psaJobs = PsaJob::all(); // Assuming you're fetching all PSA jobs
    
        return view('agencyuser.create-agency-services', compact('agency', 'psaJobs'));
    }
    

    // Store a new service request (pending approval)

    // public function store(Request $request)
    // {
    //     // Validate the incoming request
    //     $request->validate([
    //         'service_name' => 'required|string|max:255',
    //         'description' => 'nullable|string|max:1000', // If description is included
    //         'submitted_by' => 'required|exists:agency_users,id', // Assuming this is sent in request
    //         // Add any other necessary validations
    //     ]);
    
    //     // Initialize the service name with user input
    //     $serviceName = $request->input('service_name');
    
    //     // Check if the entered service name matches a PSA job title
    //     $psaJob = PSAJob::where('Job_Title', $serviceName)->first();
    
    //     // If a PSA job is found, use the PSA job title and override the service name
    //     if ($psaJob) {
    //         $serviceName = $psaJob->Job_Title;
    //     }
    
    //     // Create a new AgencyServiceUpdate instance
    //     AgencyServiceUpdate::create([
    //         'agency_id' => $request->input('agency_id'), // Ensure this is included in your form
    //         'service_name' => $serviceName,
    //         'description' => $request->input('description'), // Include if you have a description field
    //         'submitted_by' => $request->input('submitted_by'),
    //         'reviewed_by' => null, // Set as null if not applicable
    //         'service_id' => null, // If there's no direct service_id yet
    //         'action' => 'create', // or whatever action you're tracking
    //         'status' => 'pending', // or set the initial status as needed
    //     ]);
    
    //     // Redirect or respond as needed
    //     return redirect()->route('agencies.services.index', $request->input('agency_id'))
    //         ->with('success', 'Service has been created successfully!');
    // }
    


    public function store(Request $request, Agency $agency)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Save the request to the pending updates table
        AgencyServiceUpdate::create([
            'agency_id' => $agency->id,
            'service_name' => $request->input('service_name'),
            'description' => $request->input('description'),
            'submitted_by' => Auth::guard('agency_users')->id(),
            'status' => 'pending',
            'action' => 'created', // Indicate that this is a "create" request
        ]);

        return redirect()->route('agency.settings', $agency->id)->with('success', 'Service creation request submitted for approval.');
    }

    // Show form to edit an existing service
    public function edit(Agency $agency, AgencyService $service)
    {
        return view('agencyuser.edit-agency-service', compact('agency', 'service'));
    }

    // Submit an update request for a service (pending approval)
   // Submit an update request for a service (pending approval)
   public function update(Request $request, Agency $agency, AgencyService $service)
   {

       $request->validate([
           'service_name' => 'required|string|max:255',
           'description' => 'nullable|string',
           'service_id' => 'required|integer|exists:agency_services,id', // Validate service_id
       ]);
   
       // Debugging: Check if service_id is being passed correctly
       \Log::info('Service ID:', [$request->input('service_id')]);
   
       // Create the update request in the pending updates table
       AgencyServiceUpdate::create([
           'agency_id' => $agency->id,
           'service_id' => $request->input('service_id'), // Use the service_id from the request
           'service_name' => $request->input('service_name'),
           'description' => $request->input('description'),
           'submitted_by' => Auth::guard('agency_users')->id(),
           'status' => 'pending',
           'action' => 'updated',
       ]);
   
       return redirect()->route('agency.settings', $agency->id)->with('success', 'Service update request submitted for approval.');
   }
   


// Submit a delete request for a service (pending approval)
public function destroy(Agency $agency, AgencyService $service)
{
    \Log::info('Delete Request Received', [
        'agency_id' => $agency->id,
        'service_id' => $service->id,
        'service_name' => $service->service_name,
    ]);

    // Save the delete request to the pending updates table
    AgencyServiceUpdate::create([
        'agency_id' => $agency->id,
        'service_id' => $service->id, // Save the ID of the service being deleted
        'service_name' => $service->service_name, // Keep a record of the name before deleting
        'description' => $service->description,
        'submitted_by' => Auth::guard('agency_users')->id(),
        'status' => 'pending',
        'action' => 'deleted', // Indicate that this is a "delete" request
    ]);

    return redirect()->route('agency.settings', $agency->id)->with('success', 'Service deletion request submitted for approval.');
}



}
