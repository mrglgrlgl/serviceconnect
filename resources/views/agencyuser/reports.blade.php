<x-agency-dashboard>
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Reports</h2>
    <p>Generate and view reports related to your agency's operations.</p>
    <!-- Reports content will go here -->
</div>
</x-agency-dashboard>
@extends('layouts.agencyuser-navigation')

@section('content')
<x-app-layout>
    <div class="container mx-auto py-12">
        <h1 class="text-2xl font-bold mb-4">Reports</h1>

        @if($reports->isEmpty())
            <p>No reports found.</p>
        @else
            @foreach ($reports as $report)
                <div class="p-4 mb-4 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold">Report ID: {{ $report->id }}</h3>
                    <p><strong>Service Request ID:</strong> {{ $report->service_request_id }}</p>
                    <p><strong>Reported By:</strong> {{ $report->reportedBy->name }}</p>
                    <p><strong>Reported User:</strong> {{ $report->reportedUser->name }}</p>
                    <p><strong>Issue Type:</strong> {{ ucfirst(str_replace('_', ' ', $report->issue_type)) }}</p>
                    <p><strong>Details:</strong> {{ $report->details }}</p>
                    <p><strong>Date Reported:</strong> {{ $report->created_at->format('F j, Y, g:i a') }}</p>
                </div>
            @endforeach
        @endif
    </div>
</x-app-layout>
