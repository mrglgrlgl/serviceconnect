@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
    <h1>Review Agency Update</h1>

    @if(isset($agencyUpdate))
        <div class="card mt-4">
            <div class="card-header">
                <h4>Update for {{ $agencyUpdate->agency->name }}</h4>
            </div>
            <div class="card-body">
                <p><strong>Submitted By:</strong> {{ $agencyUpdate->submittedBy->name }}</p>
                <p><strong>Submitted At:</strong> {{ $agencyUpdate->created_at->format('Y-m-d H:i:s') }}</p>

                <hr>

                <h5>Proposed Changes</h5>
                <p><strong>New Name:</strong> {{ $agencyUpdate->name }}</p>
                <p><strong>New Email:</strong> {{ $agencyUpdate->email }}</p>
                <p><strong>New Phone:</strong> {{ $agencyUpdate->phone }}</p>
                <p><strong>New Address:</strong> {{ $agencyUpdate->address }}</p>

                @if($agencyUpdate->logo_path)
                    <p><strong>New Logo:</strong></p>
                    <img src="{{ asset('storage/' . $agencyUpdate->logo_path) }}" alt="New Logo" class="img-thumbnail" style="max-width: 200px;">
                @endif

                <hr>

                <div class="d-flex">
                    <form action="{{ route('admin.agency.update.approve', $agencyUpdate->id) }}" method="POST" class="mr-3">
                        @csrf
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>

                    <form action="{{ route('admin.agency.update.reject', $agencyUpdate->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <p>No update data available.</p>
    @endif
</div>
@endsection
