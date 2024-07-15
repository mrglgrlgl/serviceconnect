{{-- Individual service request in the service request page --}}
@if ($serviceRequests->isEmpty())
<div class="alert-info">
    No service requests found.
</div>
@else
@foreach ($serviceRequests as $serviceRequest)
<div class="servicerequestindividual p-4 bg-white shadow-sm rounded-lg">
    <div class="flex justify-between items-start mb-4">
        <div id="category" class="flex flex-col">
            <span class="font-bold text-lg">{{ $serviceRequest->category }}</span>
            <div id="status" class="mt-2 text-sm text-gray-600">
                status
            </div>
        </div>

    <div>
        {{ $serviceRequest->user->name }}
    </div>

        <div id="date" class="text-sm text-gray-600">
            {{ $serviceRequest->start_time }} to {{ $serviceRequest->end_time }}
        </div>
    </div>

    <div class="mt-4 text-center">
        <div class="font-semibold text-xl mb-2">
            {{ $serviceRequest->title }}
        </div>

        <div id="requestdesc" class="mb-4">
            Desc
        </div>

        <div id="requestimg" class="mb-4">
            {{-- Request image here --}}
        </div>

        <div class="flex flex-col md:flex-row justify-center items-center md:space-x-2">
            <x-outline-button class="flex-1 md:flex-none w-full md:w-auto mb-2 md:mb-0">
                Edit
            </x-outline-button>
            <x-danger-button class="flex-1 md:flex-none w-full md:w-auto">
                Delete
            </x-danger-button>
        </div>
    </div>
</div>
@endforeach

{{-- <div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $serviceRequest->title }}</h5>
        <p class="card-text"><strong>Category:</strong> {{ $serviceRequest->category }}</p>
        <p class="card-text"><strong>Location:</strong> {{ $serviceRequest->location }}</p>
        <p class="card-text"><strong>Time:</strong> {{ $serviceRequest->start_time }} to {{ $serviceRequest->end_time }}</p>
        
        <!-- Display user's name who sent the request -->
        <p class="card-text"><strong>Sent By:</strong> {{ $serviceRequest->user->name }}</p>
        
        <div>
            <a href="{{ route('service-requests.edit', $serviceRequest) }}" class="btn-primary">Edit</a>
            <form action="{{ route('service-requests.destroy', $serviceRequest) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger" onclick="return confirm('Are you sure you want to delete this service request?')">Delete</button>
            </form>
        </div>
    </div>
</div> --}}