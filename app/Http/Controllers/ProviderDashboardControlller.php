<?php

namespace App\Http\Controllers;
use App\Models\PhilID;
use App\Models\User;
use App\Models\Certification;
use App\Models\ProviderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $providerDetails = $user->providerDetails;
        $certificationsCount = $user->certifications ? $user->certifications->count() : 0;
        $philID = $user->philID;

        $serviceRequests = $user->philID && $user->philID->status === 'Accepted' ? ServiceRequest::all() : collect();

        return view('provider.dashboard', compact('providerDetails', 'certificationsCount', 'philID', 'serviceRequests'));
    }
}
