<x-dashboard>
    <div class="max-w-4xl mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">{{ $agency->name }} Details</h2>

        <div class="bg-gray-800 text-white rounded-lg shadow-lg p-5 mb-5">
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
                <a href="{{ route('agencies.edit', $agency->id) }}" class="inline-block px-4 py-2 bg-yellow-500 text-white font-bold rounded-md hover:bg-yellow-600">
                    Edit Agency
                </a>
            </div>
        </div>

        <!-- Section for managing agency users -->
        <div class="bg-gray-800 rounded-lg shadow-lg p-5 text-white">
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
                                    <a href="{{ route('agencies.users.edit', [$agency->id, $user->id]) }}" class="px-3 py-2 bg-yellow-500 text-white font-bold rounded-md hover:bg-yellow-600">
                                        Edit
                                    </a>
                                    <form action="{{ route('agencies.users.destroy', [$agency->id, $user->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-2 bg-red-500 text-white font-bold rounded-md hover:bg-red-600">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-dashboard>
