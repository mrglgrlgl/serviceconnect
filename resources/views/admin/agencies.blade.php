<x-dashboard>
    <div class="max-w-8xl mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-3xl font-bold text-white">Agencies</h2>
            <a href="{{ route('agencies.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded font-bold hover:bg-blue-600">
                Create Agency
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-2 mb-4 rounded border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-800 text-white rounded-lg">
                <thead>
                    <tr class="bg-gray-700 text-left text-sm uppercase font-bold">
                        <th class="p-4">Name</th>
                        <th class="p-4">Email</th>
                        <th class="p-4">Phone</th>
                        <th class="p-4">Address</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach ($agencies as $agency)
                        <tr class="border-t border-gray-700 hover:bg-gray-600 transition">
                            <td class="p-4 font-semibold">
                                <a href="{{ route('agencies.show', $agency->id) }}" class="text-blue-400 hover:underline">
                                    {{ $agency->name }}
                                </a>
                            </td>
                            <td class="p-4">{{ $agency->email }}</td>
                            <td class="p-4">{{ $agency->phone }}</td>
                            <td class="p-4">{{ $agency->address }}</td>
                            <td class="p-4">
                                <span class="px-3 py-1 text-sm rounded-full {{ $agency->status == 'active' ? 'bg-green-700 text-white' : 'bg-gray-500 text-white' }}">
                                    {{ ucfirst($agency->status) }}
                                </span>
                            </td>
                            <td class="p-4 text-right space-x-2">
                                <a href="{{ route('agencies.edit', $agency->id) }}" class="inline-flex items-center border border-gray-200 text-white px-4 py-2 rounded font-bold hover:bg-gray-600" onclick="event.stopPropagation();">
                                    <span class="material-icons-round mr-1">edit</span> Edit
                                </a>
                                <form action="{{ route('agencies.destroy', $agency->id) }}" method="POST" class="inline" onsubmit="event.stopPropagation();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center bg-red-500 text-white px-4 py-2 rounded font-bold hover:bg-red-600">
                                        <span class="material-icons-round mr-1">delete</span> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard>
