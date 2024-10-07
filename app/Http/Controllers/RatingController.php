<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\User;
use App\Models\Rating;
use App\Models\Employee;
use App\Models\EmployeeTaskAssignment;
use App\Models\ServiceRequest; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class RatingController extends Controller
{
     public function store(Request $request)
     {
         $validated = $request->validate([
             'channel_id' => 'required|exists:channel,id',
             'rated_for_id' => 'required|exists:users,id',
             'rating_communication' => 'nullable|integer|min:0|max:10',
             'rating_fairness' => 'nullable|integer|min:0|max:10',
             'rating_respectfulness' => 'nullable|integer|min:0|max:10',
             'rating_preparation' => 'nullable|integer|min:0|max:10',
             'rating_responsiveness' => 'nullable|integer|min:0|max:10',
             'feedback' => 'nullable|string|max:255',
         ]);
    
         $existingRating = Rating::where('channel_id', $validated['channel_id'])
                                 ->where('rated_by_id', Auth::id())
                                 ->first();
    
         if ($existingRating) {
             return redirect()->back()->with('error', 'You have already rated this channel.');
         }
    
         Rating::create([
             'channel_id' => $validated['channel_id'],
             'rated_by_id' => Auth::id(),
            'rated_for_id' => $validated['rated_for_id'],
             'communication' => $validated['rating_communication'],
             'fairness' => $validated['rating_fairness'],
             'respectfulness' => $validated['rating_respectfulness'],
             'preparation' => $validated['rating_preparation'],
             'responsiveness' => $validated['rating_responsiveness'],
             'additional_feedback' => $validated['feedback'],
         ]);
    
         return redirect()->route('provider.dashboard')->with('success', 'Rating submitted successfully.');
     }
    
    
    // New method for storing the seeker's rating of the provider
    public function storeSeekerRating(Request $request)
    {
        $validated = $request->validate([
            'channel_id' => 'required|exists:channel,id',
            'rating_quality_of_service' => 'nullable|integer|min:0|max:10',
            'rating_communication' => 'nullable|integer|min:0|max:10',
            'rating_professionalism' => 'nullable|integer|min:0|max:10',
            'rating_cleanliness_tidiness' => 'nullable|integer|min:0|max:10',
            'rating_value_for_money' => 'nullable|integer|min:0|max:10',
            'feedback' => 'nullable|string|max:255',
        ]);
    
        // Retrieve the channel with related agency user
        $channel = Channel::with('agencyuser.agency')->find($validated['channel_id']);
    
        if (!$channel || !$channel->agencyuser || !$channel->agencyuser->agency) {
            return redirect()->back()->with('error', 'Channel or related agency not found.');
        }
    
        // Check if the user has already rated this channel
        $existingRating = Rating::where('channel_id', $validated['channel_id'])
                                ->where('seeker_id', Auth::id())
                                ->first();
    
        if ($existingRating) {
            return redirect()->back()->with('error', 'You have already rated this channel.');
        }
    
        // Create the new rating
        Rating::create([
            'channel_id' => $validated['channel_id'],
            'agency_id' => $channel->agencyuser->agency->id, // Retrieve agency_id through provider
            'seeker_id' => Auth::id(),
            'quality_of_service' => $validated['rating_quality_of_service'],
            'communication' => $validated['rating_communication'],
            'professionalism' => $validated['rating_professionalism'],
            'cleanliness_tidiness' => $validated['rating_cleanliness_tidiness'],
            'value_for_money' => $validated['rating_value_for_money'],
            'additional_feedback' => $validated['feedback'],
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Rating submitted successfully.');
    }
    
    
        public function getJobTitles()
    {
        return DB::table('psa_jobs')->pluck('Job_Title');
    }
    
    
public function index(Request $request)
{
    // Retrieve job titles from psa_jobs table
    $jobTitles = $this->getJobTitles();

    // Default to showing all ratings for the logged-in user's agency
    $ratingsQuery = Rating::with(['seeker', 'channel.serviceRequest'])
                          ->whereHas('channel.serviceRequest.agencyuser', function ($query) {
                              $query->where('agency_id', Auth::user()->agency_id);
                          });

    // Apply job title filter if present
    if ($request->filled('job_title')) {
        $ratingsQuery->whereHas('channel.serviceRequest', function ($query) use ($request) {
            $query->where('category', $request->job_title);
        });
    }

    $ratings = $ratingsQuery->orderBy('created_at', 'desc')->get();

    return view('agencyuser.feedback', compact('ratings', 'jobTitles'));
}

public function showEmployeeProfile($employeeId)
{
    // Retrieve employee and related ratings
    $employee = Employee::with('ratings.seeker')->findOrFail($employeeId);

    // Calculate the average rating for the employee
    $averageRating = $employee->ratings()->avg(
        DB::raw('(communication + quality_of_service + professionalism + cleanliness_tidiness + value_for_money) / 5')
    );

    // Retrieve the total number of completed service requests
    $totalServiceRequestsCompleted = EmployeeTaskAssignment::where('employee_id', $employeeId)
        ->whereNotNull('completed_at') // Ensures only completed tasks are counted
        ->count();

    return view('employee.profile', compact('employee', 'averageRating', 'totalServiceRequestsCompleted'));
}
public function show($id)
{
    // Assuming you are fetching the employee by their ID
    $employee = User::findOrFail($id);
    
    // Get all service requests assigned to this employee
    $serviceRequests = ServiceRequest::where('provider_id', $employee->id)->get();
    
    // Calculate the total number of services completed
    $totalServicesCompleted = $serviceRequests->where('status', 'completed')->count();

    // Calculate the average rating
    $averageRating = Rating::where('rated_for_id', $employee->id)
                           ->avg(DB::raw('(
                               communication + fairness + respectfulness + preparation + responsiveness
                           ) / 5'));

    return view('employee-profile', compact('employee', 'totalServicesCompleted', 'averageRating'));
}


}

