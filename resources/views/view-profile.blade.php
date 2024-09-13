@extends('layouts.app')

@section('content')
        <h1>Agency Profile</h1>

        <!-- Display agency name and logo -->
        <div class="flex items-center text-xl pb-4">
            @if($agency)
                <div class="flex items-center">
                    @if($agency->logo_path)
                        <img src="{{ asset('storage/' . $agency->logo_path) }}" alt="Agency Logo" class="w-16 h-16 object-cover rounded-full">
                    @else
                        <span class="text-gray-400">No logo available</span>
                    @endif
                    <span class="ml-4">{{ $agency->name }}</span>
                </div>
            @else
                <span class="text-gray-400">No agency information available</span>
            @endif
        </div>

        <!-- Display agency services -->
        <div class="pb-4">
            <h2 class="text-lg font-semibold">Services Offered</h2>
            @forelse($services as $service)
                <div class="border p-4 rounded-md mb-4">
                    <h3 class="text-md font-semibold">{{ $service->service_name }}</h3>
                    <p class="text-gray-600">{{ $service->description }}</p>
                    <p class="text-gray-400">Created by: {{ $service->creator->name ?? 'Unknown' }}</p>
                </div>
            @empty
                <p class="text-gray-400">No services available for this agency.</p>
            @endforelse
        </div>
    </div>
@endsection