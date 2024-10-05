@extends('layouts.agency-dashboard')

@section('content')
    <div class="font-poppins bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-8">
            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ route('agency.employees') }}" class="inline-block bg-custom-agency-secondary text-white rounded px-4 py-2 transform transition-transform duration-300 hover:scale-105 hover:shadow-xl">
                    Back
                </a>
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mb-6">Employee Profile</h1>

            <div class="flex items-center mb-8">
                <!-- Display Employee Photo -->
                @if($employee->photo)
                    <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}" class="w-24 h-24 rounded-full shadow-md object-cover mr-8">
                @else
                    <span class="text-gray-500">No photo available</span>
                @endif

                <div class="ml-4">
                    <h2 class="text-2xl font-semibold mb-2">{{ $employee->name }}</h2>
                    <p class="text-gray-600 mb-1">Phone: {{ $employee->phone }}</p>
                    <p class="text-gray-600 mb-1">Position: {{ $employee->position }}</p>
                    <p class="text-gray-600 mb-1">Gender: {{ ucfirst($employee->gender) }}</p>
                    <p class="text-gray-600">
                        Availability: 
                        <span class="px-2 py-1 rounded-full 
                            @if($employee->availability === 'available') bg-green-500 text-white 
                            @elseif($employee->availability === 'assigned') bg-yellow-500 text-white 
                            @else bg-red-500 text-white 
                            @endif">
                            {{ ucfirst($employee->availability) }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="mt-4">
                <h3 class="text-xl font-bold mb-2">Services Assigned:</h3>
                @if($employee->services->isEmpty())
                    <p class="text-gray-500">No services assigned.</p>
                @else
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($employee->services as $service)
                            <li class="text-gray-700">{{ $service->service_name }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection
