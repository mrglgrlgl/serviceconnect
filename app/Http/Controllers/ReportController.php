<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\ServiceRequest;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'service_request_id' => 'required|exists:service_requests,id',
            'issue_type' => 'required|in:non_payment,illegal_activity,unprofessional_behavior,poor_quality_work,other',
            'details' => 'required|string|max:1000',
        ]);

        $serviceRequest = ServiceRequest::findOrFail($request->service_request_id);

        // Determine the reported user ID based on the role of the current authenticated user
        if ($serviceRequest->user_id == auth()->id()) {
            $reportedUserId = $serviceRequest->provider_id;
        } elseif ($serviceRequest->provider_id == auth()->id()) {
            $reportedUserId = $serviceRequest->user_id;
        } else {
            return back()->with('error', 'Could not identify the user being reported.');
        }

        Report::create([
            'service_request_id' => $request->service_request_id,
            'issue_type' => $request->issue_type,
            'details' => $request->details,
            'reported_by' => auth()->id(),
            'reported_user_id' => $reportedUserId,
        ]);

        return back()->with('success', 'Report submitted successfully.');
    }

//authorizer
public function index()
{
    $reports = Report::with(['reportedBy', 'reportedUser'])->get();
    return view('authorizer.reports', compact('reports'));
}
}
