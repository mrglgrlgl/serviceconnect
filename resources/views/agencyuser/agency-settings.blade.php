<x-agency-dashboard>
    <div class="container mt-5">
        <h1>Agency Settings</h1>

        @if(isset($agency))
            <div class="agency-details border p-4 rounded bg-gray-100">
                <h2 class="font-bold mb-4">{{ $agency->name }}</h2>
                <p class="mb-2"><strong>Email:</strong> {{ $agency->email }}</p>
                <p class="mb-2"><strong>Phone:</strong> {{ $agency->phone }}</p>
                <p class="mb-2"><strong>Address:</strong> {{ $agency->address }}</p>
                @if($agency->logo_path)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $agency->logo_path) }}" alt="{{ $agency->name }} Logo" class="max-w-xs">
                    </div>
                @endif
            </div>

            <!-- Status Indicator for Pending Updates -->
            @if($pendingUpdate)
                <div class="alert alert-info mt-4 border p-2 rounded bg-blue-100">
                    <strong>Notice:</strong> You have a pending update awaiting admin approval.
                    <p class="mt-2">Pending changes will be reviewed by an admin before being applied.</p>
                </div>
            @else
                <div class="mt-3">
                    <a href="{{ route('agency.settings.edit') }}" class="btn btn-primary bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
                        Edit Agency
                    </a>
                </div>
            @endif

          
            <!-- Services Section -->
            <div class="mt-5">
                <h3 class="font-bold">Services Offered</h3>
                <a href="{{ route('agencies.services.create', $agency->id) }}" class="btn btn-primary mb-3 bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Add New Service</a>

                @if($agency->services->isEmpty())
                    <p>No services found for this agency.</p>
                @else
                    <table class="table-auto w-full border border-gray-200 mt-4">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="border p-2">Service Name</th>
                                <th class="border p-2">Description</th>
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
</x-agency-dashboard>

