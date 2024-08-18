<x-dashboard>
    <div class="max-w-2xl mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Agencies</h2>
    
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-2 mb-4 rounded border border-green-200">
                {{ session('success') }}
            </div>
        @endif
    
        <div class="text-right mb-4">
            <a href="{{ route('agencies.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded font-bold hover:bg-blue-600">
                Create Agency
            </a>
        </div>
    
        <div class="grid gap-5">
            @foreach ($agencies as $agency)
                <a href="{{ route('agencies.show', $agency->id) }}" class="block text-inherit no-underline">
                    <div class="bg-gray-800 border border-gray-700 rounded shadow-sm p-5 hover:shadow-lg transition-transform transform hover:-translate-y-1">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-100">{{ $agency->name }}</h3>
                            <span class="px-3 py-1 text-sm rounded-full {{ $agency->status == 'active' ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">
                                {{ ucfirst($agency->status) }}
                            </span>
                        </div>
                        <div class="mb-4 text-gray-200 space-y-1">
                            <p><strong>Email:</strong> {{ $agency->email }}</p>
                            <p><strong>Phone:</strong> {{ $agency->phone }}</p>
                            <p><strong>Address:</strong> {{ $agency->address }}</p>
                        </div>
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('agencies.edit', $agency->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded font-bold hover:bg-yellow-600" onclick="event.stopPropagation();">
                                Edit
                            </a>
                            <form action="{{ route('agencies.destroy', $agency->id) }}" method="POST" class="inline" onsubmit="event.stopPropagation();">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded font-bold hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    </x-dashboard>
    