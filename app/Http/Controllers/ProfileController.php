<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\ProviderDetail;
use App\Models\Rating;
use App\Models\Certification; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
     public function show(): View
     {
         return view('profile', [
             'user' => Auth::user(),
         ]);
     }

/**    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }**/

    /**
     * Update the user's profile information.
     */
/**    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    } **/

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function profile()
    {
        $user = Auth::user();
    
        $providerDetail = ProviderDetail::where('provider_id', $user->id)->first();
        $ratings = Rating::where('rated_for_id', $user->id)->with('user')->get();
        $certifications = Certification::where('provider_id', $user->id)->get();
    
        return view('profile.profile', compact('user', 'providerDetail', 'ratings', 'certifications'));
    }

    public function edit(Request $request): View
    {
        return view('seekerprofile-edit', [
            'user' => $request->user(),
        ]);
    }
    
        public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'cell_no' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|max:2048', // Adjust as needed
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->cell_no = $request->cell_no;
        $user->address = $request->address;

        // Handle the profile picture upload if it exists
        if ($request->hasFile('profile_picture')) {
            // Store the uploaded file and get the path
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path; // Save the path in the user's profile
        }

        // Save the user
        $user->save();

        return redirect()->route('seekerprofile')->with('success', 'Profile updated successfully.');
    }


    public function seekerProfile()
    {
        $user = Auth::user();

        $providerDetail = ProviderDetail::where('provider_id', $user->id)->first();
        $ratings = Rating::where('rated_for_id', $user->id)->with('user')->get();
        $certifications = Certification::where('provider_id', $user->id)->get();

        return view('seekerprofile', compact('user', 'providerDetail', 'ratings', 'certifications'));
    }

public function about()
{
    return view('aboutus');

}
}




