<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgencyUpdate;
use App\Models\AgencyService;
use App\Models\AgencyServiceUpdate;
use App\Models\Agency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\PsaJob;


class AdminAgencyReviewController extends Controller
{

    public function showServiceUpdate($id)
    {
        // Fetch the service update based on the ID
        $serviceUpdate = AgencyServiceUpdate::findOrFail($id);
    
        // Return the existing view instead
        return view('admin.agencies.agency-service-updates', compact('serviceUpdate'));
    }
    
    
    public function show(Agency $agency)
    {
        try {
            return view('admin.agencies.agency-detail', compact('agency'));
        } catch (\Exception $e) {
            Log::error('Error in show method: ' . $e->getMessage());
            return response()->view('errors.custom', [], 500); // Render a custom error view
        }
    }
    
    



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

    return redirect()->route('admin.agency.service.updates')->with('success', 'Service update approved successfully!');
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


public function approveServiceUpdate($id)
{
    // Find the service update request by ID
    $serviceUpdate = AgencyServiceUpdate::find($id);

    if (!$serviceUpdate) {
        return redirect()->route('admin.agency.updates')->with('error', 'Service update request not found!');
    }

    // Determine the action to take based on the `action` field
    switch ($serviceUpdate->action) {
        case 'created':
            // Create a new service record in agency_services
            $agencyService = new AgencyService();
            $agencyService->agency_id = $serviceUpdate->agency_id;
            $agencyService->service_name = $serviceUpdate->service_name;
            $agencyService->description = $serviceUpdate->description;
            $agencyService->created_by = Auth::guard('admin_user')->user()->id; // Set created_by to the admin ID
            $agencyService->save(); // Save the new service record
            break;



            case 'updated':
                // Attempt to find the existing agency service record by its unique service_id
                $agencyService = AgencyService::find($serviceUpdate->service_id); // Fetch by service_id from update record
                
                // Check if the agency service was found
                if (!$agencyService) {
                    return redirect()->route('admin.agency.updates')->with('error', 'Service not found for update.');
                }
            
     
            
                // Update the service fields from the service update
                $agencyService->service_name = $serviceUpdate->service_name; // Update service name
                $agencyService->description = $serviceUpdate->description;   // Update description
            
                // Set the updated timestamp (handled automatically by Eloquent but we set explicitly for clarity)
                $agencyService->updated_at = now();
            
                // Attempt to save the updated service record
                if ($agencyService->save()) {
                    // Success message
                        // Optionally mark the service update request as approved
    $serviceUpdate->status = 'approved'; // Change status to approved
    $serviceUpdate->reviewed_by = Auth::guard('admin_user')->user()->id; // Set who approved
    $serviceUpdate->save(); // Save the update
                    return redirect()->route('admin.agency.updates')->with('success', 'Service updated successfully!');
                } else {
                    // Failure message
                    return redirect()->route('admin.agency.updates')->with('error', 'Failed to update service.');
                }
                break;
            
            

        case 'deleted':
            // Delete the corresponding service record from agency_services
            $agencyService = AgencyService::where('agency_id', $serviceUpdate->agency_id)
                                          ->where('service_name', $serviceUpdate->service_name)
                                          ->first();

            if ($agencyService) {
                $agencyService->delete(); // Delete the service record
            }
            break;

        default:
            return redirect()->route('admin.agency.updates')->with('error', 'Invalid action specified!');
    }

    // Optionally mark the service update request as approved
    $serviceUpdate->status = 'approved'; // Change status to approved
    $serviceUpdate->reviewed_by = Auth::guard('admin_user')->user()->id; // Set who approved
    $serviceUpdate->save(); // Save the update

    return redirect()->route('admin.agency.updates')->with('success', 'Service update approved successfully!');
}


public function rejectServiceUpdate($id)
{
    $serviceUpdate = AgencyServiceUpdate::find($id);

    if (!$serviceUpdate || $serviceUpdate->status != 'pending') {
        return redirect()->route('admin.agency.updates')->with('success', 'Service update approved successfully!');

        }

    // Mark the service update as rejected
    $serviceUpdate->status = 'rejected';
    $serviceUpdate->reviewed_by = Auth::guard('admin_user')->user()->id; // Update reviewed_by
    $serviceUpdate->save(); // Save the update status

    return redirect()->route('admin.agency.updates')->with('success', 'Service update approved successfully!');

}
}

