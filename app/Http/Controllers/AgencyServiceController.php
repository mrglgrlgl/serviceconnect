<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\AgencyService;
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

    // Show form to create a new service
    public function create(Agency $agency)
    {
        return view('agencyuser.create-agency-services', compact('agency'));
    }

    // Store a new service
    public function store(Request $request, Agency $agency)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        AgencyService::create([
            'agency_id' => $agency->id,
            'service_name' => $request->input('service_name'),
            'description' => $request->input('description'),
            'created_by' => Auth::guard('agency_user')->id(),
        ]);

        return redirect()->route('agency.settings', $agency->id)->with('success', 'Service created successfully.');
    }
}

