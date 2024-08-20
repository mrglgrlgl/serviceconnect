<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgencyUpdate;
use App\Models\Agency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminAgencyReviewController extends Controller
{
    // Display all pending updates
    public function index(Request $request)
    {
        $agencyId = $request->input('agency_id');
        
        $query = AgencyUpdate::where('status', 'pending');
        
        if ($agencyId) {
            $query->where('agency_id', $agencyId);
        }
    
        $pendingUpdates = $query->get();
    
        return view('admin.agencies.agency-updates', compact('pendingUpdates'));
    }
    
    public function review($id)
{
    $agencyUpdate = AgencyUpdate::find($id);

    if (!$agencyUpdate || $agencyUpdate->status != 'pending') {
        return redirect()->route('admin.agency.updates')->with('error', 'No pending changes found.');
    }

    return view('admin.agencies.agency-updates', compact('agencyUpdate'));
}

    
public function approve($id)
{
    $agencyUpdate = AgencyUpdate::find($id);

    if (!$agencyUpdate || $agencyUpdate->status != 'pending') {
        return redirect()->route('admin.agency.updates')->with('error', 'No pending changes found.');
    }

    // Apply changes to the actual agency record
    $agency = $agencyUpdate->agency;
    $agency->name = $agencyUpdate->name;
    $agency->email = $agencyUpdate->email;
    $agency->phone = $agencyUpdate->phone;
    $agency->address = $agencyUpdate->address;

    if ($agencyUpdate->logo_path) {
        Storage::delete('public/' . $agency->logo_path);
        $agency->logo_path = $agencyUpdate->logo_path;
    }

    $agency->save();

    // Mark the update as approved
    $agencyUpdate->status = 'approved';
    $agencyUpdate->reviewed_by = Auth::guard('admin_user')->user()->id;  // Updated guard
    $agencyUpdate->save();

    return redirect()->route('admin.agency.updates')->with('success', 'Agency changes approved.');
}

public function reject($id)
{
    $agencyUpdate = AgencyUpdate::find($id);

    if (!$agencyUpdate || $agencyUpdate->status != 'pending') {
        return redirect()->route('admin.agency.updates')->with('error', 'No pending changes found.');
    }

    // Mark the update as rejected
    $agencyUpdate->status = 'rejected';
    $agencyUpdate->reviewed_by = Auth::guard('admin_user')->user()->id;  // Updated guard
    $agencyUpdate->save();

    return redirect()->route('admin.agency.updates')->with('success', 'Agency changes rejected.');
}

    
}

