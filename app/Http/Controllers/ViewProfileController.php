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
        return view('profileview', compact('user', 'providerDetails', 'certifications', 'ratings', 'philidCards', 'completedJobsCount'));
    }


    public function edit()
    {
        // Ensure the logged-in user is the provider
        $user = auth()->user();
        $providerDetails = ProviderDetail::where('provider_id', $user->id)->first();
        $certifications = Certification::where('provider_id', $user->id)->get();
        $ratings = Rating::where('rated_for_id', $user->id)->get();
        $philidCards = PhilID::where('provider_id', $user->id)->get();
        $completedJobsCount = ServiceRequest::where('provider_id', $user->id)
                                             ->where('status', 'completed')
                                             ->count();

        // Pass data to the edit view
        return view('provider.profile', compact('user', 'providerDetails', 'certifications', 'ratings', 'philidCards', 'completedJobsCount'));
    }

    // Update the provider's profile
    public function update(Request $request)
    {
        // Validate the request data
        $request->validate([
            'work_email' => 'nullable|email',
            'cell_no' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'serviceCategory' => 'nullable|string|max:255',
            'subcategory' => 'nullable|string|max:255',
            'years_of_experience' => 'nullable|integer|min:0',
            'have_tools' => 'nullable|boolean',
            'description' => 'nullable|string',
            'skills' => 'nullable|string',
            'availability_days' => 'nullable|string',
            'availability_time' => 'nullable|string',
        ]);

        // Get the authenticated user
        $user = auth()->user();
        $providerDetails = ProviderDetail::where('provider_id', $user->id)->first();

        // Update the provider's details
        $providerDetails->update($request->all());
        $user->update($request->only('cell_no', 'address'));

        return redirect()->route('provider.profile.edit')->with('success', 'Profile updated successfully.');
    }
}



