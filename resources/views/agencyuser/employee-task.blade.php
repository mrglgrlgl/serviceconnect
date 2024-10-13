@extends('layouts.agency-dashboard')

@section('content')
<div class="my-4">
    <a href="{{ route('channel.agency', ['serviceRequestId' => $channel->service_request_id]) }}" class="bg-gray-500 text-white py-2 px-4 rounded transform transition-transform duration-300 hover:scale-105 hover:shadow-xl">Return to Channel</a>
</div>

@if (session('status'))
    <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
        {{ session('status') }}
    </div>
@endif

<!-- Filter and Search Form -->
<div class="mb-4 flex items-center">
    <form method="GET" action="{{ route('show.assignment.page', ['serviceRequestId' => $channel->service_request_id]) }}" class="flex-grow mr-2">
        <div class="flex space-x-2">
            <!-- Search Bar -->
            <input type="text" name="search" placeholder="Search Employees" class="w-1/5 p-2 border rounded text-gray-900 bg-white" value="{{ request('search') }}">
            
            <!-- Filter by Service -->
            <select name="service_id" id="service_id" class="w-1/5 p-2 border rounded text-gray-900 bg-white">
                <option value="">Select a service</option>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" {{ $selectedServiceId == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition-colors duration-300">
                Filter
            </button>
        </div>
    </form>
</div>

<form method="POST" action="{{ route('assign.employees', ['channel_id' => $channel->id]) }}">
    @csrf
    <input type="hidden" name="channel_id" value="{{ $channel->id }}">
    <input type="hidden" name="agency_id" value="{{ $agencyId }}">

    <div class="bg-white rounded-lg border p-6">
        <h2 class="text-xl font-semibold mb-4">Available Employees</h2>
        <p class="pl-2 text-lg pb-4">Manpower Required: {{ $channel->serviceRequest->manpower_number }} </p>

        <!-- Two-column layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($employees as $employee)
                <div class="p-4 border rounded-lg flex items-start">
                    <!-- Employee photo -->
                    @if($employee->photo)
                        <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}" class="w-16 h-16 rounded-md shadow-sm object-cover">
                    @else
                        <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile" class="w-16 h-16 rounded-md shadow-sm object-cover">
                    @endif

                    <div class="ml-4 flex-1">
                        <span class="font-semibold">{{ $employee->name }}</span>
                        <div class="mt-1 text-sm text-gray-600">
                            <!-- Displaying the services assigned to the employee -->
                            @if($employee->services->isEmpty())
                                            <span class="text-gray-500">No services</span>
                                        @else
                                            <ul class="list-none list-inside">
                                                @foreach($employee->services as $service)
                                                    <li>{{ $service->service_name }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                        </div>

                        <!-- Highlight if service matches PSA category -->
                        @if($employee->services->contains(function ($service) use ($channel) {
                            return strtolower($service->name) === strtolower($channel->serviceRequest->category);
                        }))
                            <span class="badge bg-green-500 text-white mt-2">Matches PSA Category</span>
                        @else
                            <span class="badge bg-gray-300 text-gray-700 mt-2">No Match</span>
                        @endif
                    </div>

                    <input type="checkbox" name="employee_ids[]" value="{{ $employee->id }}" class="ml-auto">
                </div>
            @endforeach
        </div>
    </div>

    <div class="flex justify-center mt-6 items-center">
        <button type="submit" class="flex items-center bg-green-500 text-white text-lg py-2 px-4 rounded hover:bg-green-600 transition-colors duration-300">
            <span class="material-icons text-4xl mr-2">person_add</span>
            Assign Employees
        </button>
    </div>
</form>
@endsection
