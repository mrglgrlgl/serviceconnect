<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\ServiceRequestImages;
use App\Models\ProviderDetail;
use App\Models\Certification;
use App\Models\PhilID;
use App\Models\PsaJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Category;
use Illuminate\Support\Facades\DB;


class ServiceRequestController extends Controller
{

    public function retrieveByUserRole()
    {
        $user = Auth::user();
    
        // Ensure the user is authenticated and has a role
        if (!$user) {
            return redirect()->route('login');
        }
    
        // Determine if the user is a provider
        if ($user->role == 2) {
            $providerDetail = ProviderDetail::where('provider_id', $user->id)->first();
            $providerCategory = $providerDetail ? $providerDetail->serviceCategory : null;
    
            // Retrieve service requests for the provider's category and direct hire requests for the provider
            $serviceRequests = ServiceRequest::where(function ($query) use ($providerCategory, $user) {
                $query->whereRaw('LOWER(category) = ?', [strtolower($providerCategory)])
                      ->orWhere(function ($query) use ($user) {
                          $query->where('provider_id', $user->id)
                                ->where('is_direct_hire', true);
                      });
            })
            ->with('images') // Eager load images
            ->get();
    
            // Get the count of certifications
            $certificationsCount = $user->certifications()->count();
    
            // Find in-progress requests
            $inProgressRequests = ServiceRequest::where('provider_id', $user->id)
                ->where('status', 'in_progress')
                ->get();
    
            $conflictingRequests = [];
            $psaJobs = DB::table('psa_jobs')->pluck('average_occupational_wage_per_hour', 'job_title')->toArray();
            $serviceRequests = ServiceRequest::with(['bids', 'user'])->get(); // Assuming you need service requests with bids and user info

            // Check for conflicts
            foreach ($serviceRequests as $serviceRequest) {
                foreach ($inProgressRequests as $inProgressRequest) {
                    if ($serviceRequest->id !== $inProgressRequest->id &&
                        (
                            ($serviceRequest->start_date <= $inProgressRequest->end_date && $serviceRequest->end_date >= $inProgressRequest->start_date) ||
                            ($serviceRequest->start_date <= $inProgressRequest->start_date && $serviceRequest->end_date >= $inProgressRequest->start_date)
                        )) {
                        $conflictingRequests[$serviceRequest->id] = true;
                        break;
                    }
                }
            }
        } else {
            $serviceRequests = ServiceRequest::with('images')->get(); // Eager load images
            $certificationsCount = 0; // Default value or handle accordingly
            $conflictingRequests = []; // Default value or handle accordingly
        }
    
        // Pass data to the view
        return view('provider.dashboard', compact('serviceRequests', 'certificationsCount', 'conflictingRequests','psaJobs'));
    }
    

    
    public function checkForConflict($serviceRequest, $userId)
    {
        $conflictingRequests = ServiceRequest::where('provider_id', $userId)
            ->where('id', '!=', $serviceRequest->id) // Exclude the current task
            ->where('status', '!=', 'completed')
            ->where(function ($query) use ($serviceRequest) {
                $query->where(function ($query) use ($serviceRequest) {
                    $query->where('start_date', '<=', $serviceRequest->end_date)
                        ->where('end_date', '>=', $serviceRequest->start_date);
                })->orWhere(function ($query) use ($serviceRequest) {
                    $query->where('start_time', '<=', $serviceRequest->end_time)
                        ->where('end_time', '>=', $serviceRequest->start_time);
                });
            })
            ->exists();
    
        return $conflictingRequests;
    }
    
    
    

public function create()
{
    // Fetch all categories
    $categories = Category::all();

    // Fetch average hourly rates from PSA Jobs, keyed by job title
    $psaJobs = PsaJob::pluck('Average_Occupational_Wage_per_Hour', 'Job_Title')->toArray();

    // Pass categories and PSA job rates to the view
    return view('layouts.modal', compact('categories', 'psaJobs'));
}

    public function index()
    {
        // Retrieve service requests created by the authenticated user
        $serviceRequests = ServiceRequest::where('user_id', Auth::id())
        ->with('bids.bidder',) // Eager load bids and the user who made each bid (bidder)
        ->get();
        return view('dashboard', compact('serviceRequests'));
    }

    public function store(Request $request)
    {
        // dd($request->file('attach_media'));
        // dd($request->all());
        // Log::info('ServiceRequestController@store: Request data', $request->all());

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
            // 'skill_tags' => 'required|string|max:255',
            'provider_gender' => 'nullable|in:male,female',
            'job_type' => 'required|in:project_based,hourly_rate',
            // 'price_type' => 'required|in:fixed,range',
            // 'fixed_price' => 'nullable|numeric|min:0',
            // 'min_price' => 'required|numeric|min:0',
            // 'max_price' => 'required|numeric|min:0|gte:min_price',
            // 'price_type' => 'required|in:fixed,range',
            'max_price' => 'required|numeric|min:0', // Use the same field for both fixed and max price
            'min_price' => 'nullable|numeric|min:0', // Ensure min_price is not required when nulls set
    'estimated_duration' => 'required|integer|min:0',
            'attach_media1' => 'nullable|image|max:2048',
            'attach_media2' => 'nullable|image|max:2048',
            'attach_media3' => 'nullable|image|max:2048',
            'attach_media4' => 'nullable|image|max:2048',
            'agreed_to_terms' => 'accepted',  // Validates the checkbox

      
        ]);
        // dd($validatedData);  // Dump and Die


               // Create new service request instance
               $serviceRequest = new ServiceRequest();
               $serviceRequest->category = $validatedData['category'];
               $serviceRequest->title = $validatedData['title'];
               $serviceRequest->description = $validatedData['description'];
               $serviceRequest->location = $validatedData['location'];
               $serviceRequest->start_date = $validatedData['start_date'];
               $serviceRequest->end_date = $validatedData['end_date'];
               $serviceRequest->start_time = $validatedData['start_time'];
               $serviceRequest->end_time = $validatedData['end_time'];
            //    $serviceRequest->skill_tags = $validatedData['skill_tags'];
               $serviceRequest->provider_gender = $validatedData['provider_gender'];
               $serviceRequest->job_type = $validatedData['job_type'];
               $serviceRequest->is_direct_hire = false;
               $serviceRequest->min_price = $validatedData['min_price'];
               $serviceRequest->max_price = $validatedData['max_price'];
               $serviceRequest->estimated_duration = $validatedData['estimated_duration'];
               $serviceRequest->status = 'open'; // Default status
               $serviceRequest->user_id = auth()->id();
               $serviceRequest->agreed_to_terms = $validatedData['agreed_to_terms'];  // Include this field
            //    if ($validatedData['price_type'] === 'fixed') {
            //     $serviceRequest->min_price = null;
            //     $serviceRequest->max_price = $validatedData['max_price'];
            // } else {
                $serviceRequest->min_price = $validatedData['min_price'];
                $serviceRequest->max_price = $validatedData['max_price'];
            
            //    $fileCount = count($request->file('attach_media', []));
            //    dd($fileCount);
               // Handling the file uploads
               Log::info('ServiceRequest model data:', $serviceRequest->toArray());

               $serviceRequest->save();

           // Handle each file upload separately
    $mediaFields = ['attach_media1', 'attach_media2', 'attach_media3', 'attach_media4'];

    foreach ($mediaFields as $field) {
        if ($request->hasFile($field)) {
            $file = $request->file($field);
            $path = $file->store('service_requests/documents', 'public');
            ServiceRequestImages::create([
                'service_request_id' => $serviceRequest->id,
                'file_path' => $path,
            ]);
        }
    }
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
        // 'skill_tags' => 'required|string|max:255',
        'provider_gender' => 'nullable|in:male,female',
        'job_type' => 'required|in:project_based,hourly_rate',
        'hourly_rate' => 'required|numeric|min:0',
        'hourly_rate_max' => 'nullable|numeric|min:0',
        'expected_price' => 'required|numeric|min:0',
        'expected_price_max' => 'nullable|numeric|min:0',
        'estimated_duration' => 'required|integer|min:0',
        'attach_media' => 'nullable|file|mimes:jpg,jpeg,png',
        'attach_media2' => 'nullable|file|mimes:jpg,jpeg,png',
        'attach_media3' => 'nullable|file|mimes:jpg,jpeg,png',
        'attach_media4' => 'nullable|file|mimes:jpg,jpeg,png',
    ]);

        // Convert the validated start_time and end_time to 24-hour format
        try {
            $startTime24 = \Carbon\Carbon::createFromFormat('h:i A', $validatedData['start_time'])->format('H:i');
            $endTime24 = \Carbon\Carbon::createFromFormat('h:i A', $validatedData['end_time'])->format('H:i');
        } catch (\Exception $e) {
            Log::error('Time format error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['start_time' => 'Invalid start time format', 'end_time' => 'Invalid end time format']);
        }

    // Log the converted times
    Log::info('Converted start time: ' . $startTime24);
    Log::info('Converted end time: ' . $endTime24);


    // Update the service request with validated data
    $serviceRequest->category = $validatedData['category'];
    $serviceRequest->title = $validatedData['title'];
    $serviceRequest->description = $validatedData['description'];
    $serviceRequest->location = $validatedData['location'];
    $serviceRequest->start_date = $validatedData['start_date'];
    $serviceRequest->end_date = $validatedData['end_date'];

    // $serviceRequest->start_time = $request->start_time;
    // $serviceRequest->end_time = $request->end_time;
    // $serviceRequest->skill_tags = $validatedData['skill_tags'];
    $serviceRequest->provider_gender = $validatedData['provider_gender'];
    $serviceRequest->job_type = $validatedData['job_type'];
    $serviceRequest->hourly_rate = $validatedData['hourly_rate'];
    $serviceRequest->hourly_rate_max = $validatedData['hourly_rate_max'];
    $serviceRequest->expected_price = $validatedData['expected_price'];
    $serviceRequest->expected_price_max = $validatedData['expected_price_max'];
    $serviceRequest->estimated_duration = $validatedData['estimated_duration'];


    // Save the updated service request
    $serviceRequest->save();

        // Log the saved times
        Log::info('Saved start time: ' . $serviceRequest->start_time);
        Log::info('Saved end time: ' . $serviceRequest->end_time);
        Log::info('Form Data:', $request->all());

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

public function myRequests()
{
    $serviceRequests = ServiceRequest::whereHas('bids', function ($query) {
        $query->where('bidder_id', auth()->user()->id);
    })->get();

    return view('provider.myrequests', compact('serviceRequests'));
}
}