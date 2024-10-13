@extends('layouts.dashboard')

@section('content')
<div class="max-w-4xl mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4 text-white">Review Agency Update</h2>

    @if(isset($agencyUpdate))
        <div class="bg-custom-admin-secondary text-white rounded-lg shadow-lg p-5 mb-5">
            <div class="space-y-2 text-gray-200">
                <p><strong>Agency Name:</strong> {{ $agencyUpdate->agency->name }}</p>
                <p><strong>Submitted By:</strong> {{ $agencyUpdate->submittedBy->name }}</p>
                <p><strong>Submitted At:</strong> {{ $agencyUpdate->created_at->format('Y-m-d H:i:s') }}</p>

                <hr class="border-gray-500 my-2">

                <h5 class="text-lg font-semibold">Proposed Changes:</h5>
                <p><strong>New Name:</strong> {{ $agencyUpdate->name }}</p>
                <p><strong>New Email:</strong> {{ $agencyUpdate->email }}</p>
                <p><strong>New Phone:</strong> {{ $agencyUpdate->phone }}</p>
                <p><strong>New Address:</strong> {{ $agencyUpdate->address }}</p>

                @if($agencyUpdate->logo_path)
                    <p><strong>New Logo:</strong></p>
                    <img src="{{ asset('storage/' . $agencyUpdate->logo_path) }}" alt="New Logo" class="img-thumbnail" style="max-width: 200px;">
                @endif
            </div>
        </div>

        <div class="flex space-x-2">
            <form action="{{ route('admin.agency.update.approve', $agencyUpdate->id) }}" method="POST">
                @csrf
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-500 text-white font-bold rounded-md hover:bg-green-600">
                    Approve
                </button>
            </form>

            <form action="{{ route('admin.agency.update.reject', $agencyUpdate->id) }}" method="POST">
                @csrf
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-500 text-white font-bold rounded-md hover:bg-red-600">
                    Reject
                </button>
            </form>
        </div>

    @else
        <div class="bg-red-500 text-white rounded-lg shadow-lg p-5 mb-5">
            <strong>No update data available.</strong>
        </div>
    @endif

    <a href="{{ route('admin.agency.updates') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600 mt-4">
        Back to Agency Updates
    </a>
</div>
@endsection
