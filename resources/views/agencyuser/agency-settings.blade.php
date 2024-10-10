@extends('layouts.agency-dashboard')

@section('content')
<div class="container w-4/5 mx-auto mt-5 p-4">
    <h1 class="text-3xl font-semibold mb-6">Agency Settings</h1>

    @if(isset($agency))
        <div class="agency-details border border-gray-300 p-6 rounded-lg bg-gray-50">
            <h2 class="text-2xl font-bold mb-4">{{ $agency->name }}</h2>
            <p class="mb-2 text-gray-700 flex items-center">
                <span class="material-icons-round mr-2 text-gray-500">email</span>
                <strong class="font-medium">Email:</strong> {{ $agency->email }}
            </p>
            <p class="mb-2 text-gray-700 flex items-center">
                <span class="material-icons-round mr-2 text-gray-500">phone</span>
                <strong class="font-medium">Phone:</strong> {{ $agency->phone }}
            </p>
            <p class="mb-2 text-gray-700 flex items-center">
                <span class="material-icons-round mr-2 text-gray-500">home</span>
                <strong class="font-medium">Address:</strong> {{ $agency->address }}
            </p>
            @if($agency->logo_path)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $agency->logo_path) }}" alt="{{ $agency->name }} Logo" class="max-w-xs rounded-lg shadow-sm">
                </div>
            @endif

            @if(isset($pendingUpdate) && $pendingUpdate)
                <div class="alert alert-info mt-4 border border-blue-300 p-4 rounded-lg bg-blue-50 text-blue-800">
                    <strong class="font-semibold">Notice:</strong> You have a pending update awaiting admin approval.
                    <p class="mt-2">Pending changes will be reviewed by an admin before being applied.</p>
                </div>
            @else
                <div class="mt-3 text-start">
                    <a href="{{ route('agency.settings.edit') }}" class="inline-flex items-center bg-custom-agency-secondary hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow transition duration-200">
                        <span class="material-icons-round mr-2">edit</span> Edit Agency
                    </a>
                </div>
            @endif
        </div>

        <!-- Service Management -->

@if($pendingServiceCreations)
    <div class="alert alert-info mt-4 border border-blue-300 p-4 rounded-lg bg-blue-50 text-blue-800">
        <strong class="font-semibold">Notice:</strong> You have a pending service creation awaiting admin approval.
        <p class="mt-2">Pending service creations will be reviewed by an admin before being applied.</p>
    </div>
@endif



        <h3 class="text-xl font-semibold mb-4 pt-4">Services Offered</h3>
        <a href="{{ route('agencies.services.create', $agency->id) }}" class="bg-custom-agency-secondary text-white px-4 py-2 rounded-lg">Add New Service</a>

        @if($agency->services->isEmpty())
            <p class="text-gray-500 mt-4">No services found for this agency.</p>
        @else
            <table class="w-full border-collapse border mt-4">
                <thead>
                    <tr class="bg-custom-agency-bg text-white">
                        <th class="border p-2">Service Name</th>
                        <th class="border p-2">Description</th>
                        <th class="border p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($agency->services as $service)
                        <tr>
                            <td class="border p-2">{{ $service->service_name }}</td>
                            <td class="border p-2">{{ $service->description }}</td>
                            <td class="border p-2 flex space-x-2">
                                <button onclick="location.href='{{ route('agencies.services.edit', [$agency->id, $service->id]) }}'" class="text-gray-500 transform transition-transform duration-300 hover:scale-105 hover:shadow-xl">
                                    <span class="material-icons-round">edit</span>
                                </button>
                           <button onclick="confirmDelete('{{ route('agencies.services.destroy', [$agency->id, $service->id]) }}')" class="text-red-500 transform transition-transform duration-300 hover:scale-105 hover:shadow-xl">
    <span class="material-icons-round">delete</span>
</button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @else
        <p>No agency data found.</p>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden bg-gray-500 bg-opacity-75 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-xs w-full">
        <h3 class="text-lg font-semibold mb-4">Confirm Deletion</h3>
        <p class="mb-4">Are you sure you want to delete this service?</p>
   <form id="deleteForm" action="" method="POST">
    @csrf
    @method('DELETE')
    <div class="flex justify-between">
        <button type="button" id="cancelBtn" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Cancel</button>
        <button type="submit" id="deleteBtn" class="bg-red-500 text-white px-4 py-2 rounded-lg">Delete</button>
    </div>
</form>

    </div>
</div>

<script>
    function confirmDelete(url) {
        document.getElementById('deleteForm').action = url; // Set the form action to the delete URL
        document.getElementById('deleteModal').classList.remove('hidden'); // Show the modal
    }

    document.getElementById('cancelBtn').addEventListener('click', function() {
        document.getElementById('deleteModal').classList.add('hidden'); // Hide modal on cancel
    });

    // Prevent form submission if delete modal is closed
    window.addEventListener('click', function(event) {
        if (event.target === document.getElementById('deleteModal')) {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    });
</script>


@endsection
