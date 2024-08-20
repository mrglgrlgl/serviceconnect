@extends('layouts.agencyuser-navigation')

@section('content')
    <div class="container mt-5">
        <h1>Agency Settings</h1>

        @if(isset($agency))
            <div class="agency-details" style="border: 1px solid #ddd; padding: 20px; border-radius: 5px; background-color: #f9f9f9;">
                <h2 style="font-weight: bold; margin-bottom: 20px;">{{ $agency->name }}</h2>
                <p style="margin-bottom: 10px;"><strong>Email:</strong> {{ $agency->email }}</p>
                <p style="margin-bottom: 10px;"><strong>Phone:</strong> {{ $agency->phone }}</p>
                <p style="margin-bottom: 10px;"><strong>Address:</strong> {{ $agency->address }}</p>
                @if($agency->logo_path)
                    <div style="margin-bottom: 20px;">
                        <img src="{{ asset('storage/' . $agency->logo_path) }}" alt="{{ $agency->name }} Logo" class="img-thumbnail" style="max-width: 200px;">
                    </div>
                @endif
            </div>

            <!-- Status Indicator for Pending Updates -->
            @if($pendingUpdate)
                <div class="alert alert-info mt-4" style="border: 1px solid blue; padding: 10px; border-radius: 5px; background-color: #e9f7fd;">
                    <strong>Notice:</strong> You have a pending update awaiting admin approval.
                    <p style="margin-top: 10px;">Pending changes will be reviewed by an admin before being applied.</p>
                </div>
            @else
                <div class="mt-3">
                    <a href="{{ route('agency.settings.edit') }}" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff;">Edit Agency</a>
                </div>
            @endif
        @else
            <p style="color: #ff0000;">No agency data found.</p>
        @endif
    </div>
@endsection
