@extends('layouts.app')

@section('content')



<div class="container w-3/5 mx-auto px-4 py-6">
                                                        <div class="flex justify-start space-x-4">
                                                <div class="mb-4">
                <a href="{{ route('agency.employees') }}" class="inline-block bg-gray-500 text-white rounded px-4 py-2 transform transition-transform duration-300 hover:scale-105 hover:shadow-xl">
                    Back
                </a>
            </div>
            </div>
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4 text-start">Agency Profile</h1>

        <!-- Display agency name and logo -->
        <div class="flex items-center justify-start text-xl pb-4">
            @if($agency)
                <div class="flex items-center">
                    @if($agency->logo_path)
                        <img src="{{ asset('storage/' . $agency->logo_path) }}" alt="Agency Logo" class="w-16 h-16 object-cover rounded-full shadow-md">
                    @else
                        <span class="text-gray-400">No logo available</span>
                    @endif
                    <span class="ml-4 font-semibold">{{ $agency->name }}</span>
                </div>
            @else
                <span class="text-gray-400">No agency information available</span>
            @endif
        </div>

        <!-- Display agency services -->
        <div class="pb-4">
            <h2 class="text-lg font-semibold mb-2">Services Offered</h2>
            @forelse($services as $service)
                <div class="border border-gray-300 p-4 rounded-md mb-4 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <h3 class="text-md font-semibold">{{ $service->service_name }}</h3>
                    <p class="text-gray-600">{{ $service->description }}</p>
                    <p class="text-gray-400">Created by: {{ $service->creator->name ?? 'Unknown' }}</p>
                </div>
            @empty
                <p class="text-gray-400 text-center">No services available for this agency.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
