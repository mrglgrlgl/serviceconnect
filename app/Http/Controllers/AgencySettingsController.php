<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Agency;
use App\Models\AgencyUpdate;

class AgencySettingsController extends Controller
{
    public function showSettings(Request $request)
    {
        $user = Auth::guard('agency_user')->user();
        $agency = $user->agency;
    
        if (!$agency) {
            return redirect()->route('agency.settings')->with('error', 'No agency data found.');
        }
    
        // Check for pending updates
        $pendingUpdate = AgencyUpdate::where('agency_id', $agency->id)
                                      ->where('status', 'pending')
                                      ->first();
    
        return view('agencyuser.agency-settings', compact('agency', 'pendingUpdate'));
    }
    

    public function editSettings(Request $request)
    {
        $user = Auth::guard('agency_user')->user();
        $agency = $user->agency;

        if (!$agency) {
            return redirect()->route('agency.settings')->with('error', 'No agency data found.');
        }

        return view('agencyuser.edit-agency', compact('agency'));
    }

    public function updateSettings(Request $request)
    {
        $user = Auth::guard('agency_user')->user();
        $agency = $user->agency;

        if (!$agency) {
            return redirect()->route('agency.settings')->with('error', 'No agency data found.');
        }

        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store changes in the agency_updates table
        $agencyUpdate = new AgencyUpdate();
        $agencyUpdate->agency_id = $agency->id;
        $agencyUpdate->name = $request->input('name');
        $agencyUpdate->email = $request->input('email');
        $agencyUpdate->phone = $request->input('phone');
        $agencyUpdate->address = $request->input('address');
        $agencyUpdate->submitted_by = $user->id;
        $agencyUpdate->status = 'pending';

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $agencyUpdate->logo_path = $logoPath;
        }

        $agencyUpdate->save();

        // Notify the admin (e.g., by sending an email or creating a notification)
        // ...

        return redirect()->route('agency.settings')->with('success', 'Your changes have been submitted for review.');
    }
}
