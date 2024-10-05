<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agency;
use App\Models\AgencyService;

class SearchController extends Controller
{
    public function index()
    {
        // Fetch all active agencies
        $agencies = Agency::with('services')
            ->where('status', 'active')
            ->get();

        // Return the view with the list of agencies
        return view('home', compact('agencies'));
    }
    public function viewAgencyProfile($agencyId)
    {
        // Fetch the agency and its related services by agency ID
        $agency = Agency::with('services')->findOrFail($agencyId);
    
        // Return the view with the agency's data
        return view('view-profile2', [
            'agency' => $agency,
            'services' => $agency->services,

        ]);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        
        // Debugging: Output search term
        // dd($searchTerm);
    
        // Fetch agencies with or without search term
        $agencies = Agency::with(['services'])
            ->where('status', 'active') // Only get agencies with 'active' status
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where('name', 'LIKE', "%{$searchTerm}%")
                      ->orWhereHas('services', function ($query) use ($searchTerm) {
                          $query->where('service_name', 'LIKE', "%{$searchTerm}%");
                      });
            })
            ->get();
    
        // Debugging: Check fetched agencies
        // dd($agencies);
    
        return view('home', compact('agencies'));
    }
    


    public function profile($id)
    {
        $agency = Agency::with(['services'])->findOrFail($id);

        return response()->json([
            'name' => $agency->name,
            'email' => $agency->email,
            'phone' => $agency->phone,
            'address' => $agency->address,
            'services' => $agency->services->map(function ($service) {
                return [
                    'service_name' => $service->service_name,
                    'description' => $service->description,
                ];
            }),
        ]);
    }
}
