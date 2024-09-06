@extends('layouts.agency-dashboard')

@section('content')
    <div class="container mx-auto mt-5 p-4">
        <h1 class="text-3xl font-semibold mb-6">Agency Settings</h1>

        @if(isset($agency))
            <div class="agency-details border border-gray-300 p-6 rounded-lg bg-gray-50 ">
                <h2 class="text-2xl font-bold mb-4">{{ $agency->name }}</h2>
                <p class="mb-2 text-gray-700"><strong class="font-medium">Email:</strong> {{ $agency->email }}</p>
                <p class="mb-2 text-gray-700"><strong class="font-medium">Phone:</strong> {{ $agency->phone }}</p>
                <p class="mb-2 text-gray-700"><strong class="font-medium">Address:</strong> {{ $agency->address }}</p>
                @if($agency->logo_path)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $agency->logo_path) }}" alt="{{ $agency->name }} Logo" class="max-w-xs rounded-lg shadow-sm">
                    </div>
                @endif

            <!-- Status Indicator for Pending Updates -->
            @if($pendingUpdate)
                <div class="alert alert-info mt-4 border border-blue-300 p-4 rounded-lg bg-blue-50 text-blue-800">
                    <strong class="font-semibold">Notice:</strong> You have a pending update awaiting admin approval.
                    <p class="mt-2">Pending changes will be reviewed by an admin before being applied.</p>
                </div>
            @else
                <div class="mt-3">
                    <a href="{{ route('agency.settings.edit') }}" class="inline-block bg-custom-agency-secondary hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow  transition duration-200">
                        Edit Agency
                    </a>
                </div>
            @endif
            </div>



            <!-- Services Section -->
            <div class="mt-5">
                <h3 class="text-xl font-semibold mb-4">Services Offered</h3>
                <a href="{{ route('agencies.services.create', $agency->id) }}" class="inline-block bg-custom-agency-secondary hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow transition duration-200 mb-3">Add New Service</a>

                @if($agency->services->isEmpty())
                    <p class="text-gray-500">No services found for this agency.</p>
                @else
                    <table class="w-full border-collapse border border-gray-200 mt-4 rounded-md">
                        <thead>
                            <tr class="bg-custom-agency-bg text-white rounded-md">
                                <th class="border p-2 text-left">Service Name</th>
                                <th class="border p-2 text-left">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agency->services as $service)
                                <tr>
                                    <td class="border p-2">{{ $service->service_name }}</td>
                                    <td class="border p-2">{{ $service->description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        @else
            <p class="text-red-500">No agency data found.</p>
        @endif
    </div>
@endsection
