@extends('layouts.dashboard')

@section('content')
    <div class="max-w-4xl mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4 text-white">{{ $agency->name }} Details</h2>

        <div class="bg-custom-admin-secondary text-white rounded-lg shadow-lg p-5 mb-5">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Agency Information</h3>
            </div>
            <div class="space-y-2 text-gray-200">
                <p><strong>Name:</strong> {{ $agency->name }}</p>
                <p><strong>Email:</strong> {{ $agency->email }}</p>
                <p><strong>Phone:</strong> {{ $agency->phone }}</p>
                <p><strong>Address:</strong> {{ $agency->address }}</p>
                <p>
                    <strong>Status:</strong>
                    <span class="px-3 py-1 rounded-full text-sm {{ $agency->status == 'active' ? 'bg-green-600' : 'bg-gray-600' }} text-white">
                        {{ ucfirst($agency->status) }}
                    </span>
                </p>
            </div>
            <div class="mt-4">
                <a href="{{ route('agencies.edit', $agency->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-200 text-white font-bold rounded-md hover:bg-gray-600">
                    <span class="material-icons-round mr-1">edit</span> Edit Agency
                </a>
            </div>
        </div>

        <!-- Section for managing agency users -->
        <div class="bg-custom-admin-secondary rounded-lg shadow-lg p-5 text-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Agency Users</h3>
                <a href="{{ route('agencies.users.create', $agency->id) }}" class="inline-block px-4 py-2 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600">
                    Add Agency User
                </a>
            </div>
            <div class="space-y-2">
                @if($agency->users->isEmpty())
                    <p>No agency users found.</p>
                @else
                    <ul class="space-y-2">
                        @foreach($agency->users as $user)
                            <li class="flex justify-between items-center">
                                <div>
                                    <strong>{{ $user->name }}</strong> ({{ $user->email }})
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('agencies.users.edit', [$agency->id, $user->id]) }}" class="inline-flex items-center px-3 py-2 border border-gray-200 text-white font-bold rounded-md hover:bg-gray-600 h-10">
                                        <span class="material-icons-round mr-1">edit</span>
                                        <span class="hidden md:inline">Edit</span>
                                    </a>
                                    <form action="{{ route('agencies.users.destroy', [$agency->id, $user->id]) }}" method="POST" onsubmit="return confirmDelete();">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-500 text-white font-bold rounded-md hover:bg-red-600 h-10">
                                            <span class="material-icons-round mr-1">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <!-- Section for Agency Updates -->
        <div class="card bg-gray-500 mt-4 rounded-lg">
            <div class="card-header text-lg text-white font-semibold p-4">
                <h3>Agency Updates</h3>
            </div>
            <div class="card-body text-gray-300 p-4">
                @if($agency->pendingUpdates && !$agency->pendingUpdates->isEmpty())
                    <ul>
                        @foreach($agency->pendingUpdates as $update)
                            <li>
                                <strong>{{ $update->created_at->format('Y-m-d H:i:s') }}</strong> - {{ $update->status }}
                                <a href="{{ route('admin.agency.update.review', $update->id) }}" class="btn btn-info btn-sm">Review</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No pending updates.</p>
                @endif
            </div>
        </div>

        <!-- Section for Service Updates -->
        <div class="card bg-gray-500 mt-4 rounded-lg">
            <div class="card-header text-lg text-white font-semibold p-4">
                <h3>Service Updates</h3>
            </div>
            <div class="card-body text-gray-300 p-4">
                @if($agency->serviceUpdates && !$agency->serviceUpdates->isEmpty())
                    <ul>
                        @foreach($agency->serviceUpdates as $update)
                            <li>
                                <strong>{{ $update->created_at->format('Y-m-d H:i:s') }}</strong> - {{ $update->service_name }}: {{ $update->description }}
<a href="{{ route('admin.agency.service.update.show', $update->id) }}" class="btn btn-info btn-sm">Review</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No pending service updates.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this user? This action cannot be undone.");
    }
</script>
