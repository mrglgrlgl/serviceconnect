<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProviderDetail;
use App\Models\Certification;
use App\Models\Rating;
use App\Models\PhilId;
use App\Models\ServiceRequest;

class ViewProfileController extends Controller
{
    public function show($providerId)
    {
        // Retrieve user data
        $user = User::findOrFail($providerId);

        // Retrieve provider details
        $providerDetails = ProviderDetail::where('provider_id', $user->id)->first();

        // Retrieve certifications for the provider
        $certifications = Certification::where('provider_id', $user->id)->get();

        // Retrieve ratings for the provider (using the correct column)
        $ratings = Rating::where('rated_for_id', $user->id)->get(); // Use 'rated_for_id' here

        // Retrieve PhilID cards for the provider
        $philidCards = PhilID::where('provider_id', $user->id)->get();

        // Calculate completed jobs count (assuming 'status' column indicates completion)
        $completedJobsCount = ServiceRequest::where('provider_id', $user->id)
                                             ->where('status', 'completed') // Adjust based on actual status indicator
                                             ->count();
        // Pass data to the view
        return view('profileview', compact('user', 'providerDetails', 'certifications', 'ratings', 'philidCards','completedJobsCount'));
    }
}
