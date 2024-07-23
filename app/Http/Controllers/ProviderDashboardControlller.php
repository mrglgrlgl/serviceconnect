<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use App\Models\ProviderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProviderDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Retrieve provider's category
        $providerDetail = ProviderDetail::where('user_id', $user->id)->first();
        $providerCategory = $providerDetail ? $providerDetail->serviceCategory : null;

        // Log the retrieved category for debugging
        Log::info('Provider Category:', ['category' => $providerCategory]);

        // Retrieve service requests based on provider's category
        $serviceRequests = ServiceRequest::where('category', $providerCategory)->get();

        // Log the filtered service requests for debugging
        Log::info('Filtered Service Requests:', ['requests' => $serviceRequests]);

        return view('provider.dashboard', compact('serviceRequests'));
    }
}
