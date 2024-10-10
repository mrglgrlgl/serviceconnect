@extends('layouts.dashboard')

@section('content')
    <div class="max-w-4xl mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4 text-white">Service Update Details</h2>

        <div class="bg-custom-admin-secondary text-white rounded-lg shadow-lg p-5 mb-5">
            <div class="space-y-2 text-gray-200">
                <p><strong>Service Name:</strong> {{ $serviceUpdate->service_name }}</p>
                <p><strong>Description:</strong> {{ $serviceUpdate->description }}</p>
                <p><strong>Action:</strong> {{ $serviceUpdate->action }}</p>
                <p><strong>Status:</strong> {{ $serviceUpdate->status }}</p>
                <p><strong>Created At:</strong> {{ $serviceUpdate->created_at->format('Y-m-d H:i:s') }}</p>
                <p><strong>Updated At:</strong> {{ $serviceUpdate->updated_at->format('Y-m-d H:i:s') }}</p>
            </div>
        </div>

  <div class="flex space-x-4">
<!-- Approve Button -->
<form action="{{ route('admin.agency.service.update.approve', $serviceUpdate->id) }}" method="POST">
    @csrf
    <button type="submit" class="px-4 py-2 bg-green-600 text-white font-bold rounded-md hover:bg-green-700">Approve</button>
</form>

<!-- Reject Button -->
<form action="{{ route('admin.agency.service.update.reject', $serviceUpdate->id) }}" method="POST">
    @csrf
    <button type="submit" class="px-4 py-2 bg-red-600 text-white font-bold rounded-md hover:bg-red-700">Reject</button>
</form>


        <a href="{{ route('admin.agency.updates') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600">
            Back to Agency Updates
        </a>

        
    </div>
@endsection
