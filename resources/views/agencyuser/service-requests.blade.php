<x-agency-dashboard>
    <div class="font-poppins bg-gray-100 min-h-screen">
        <div class="max-w-8xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Service Requests</h1>
            <p class="text-lg text-gray-700 mb-6 text-center">View and manage service requests from seekers.</p>

            @if($serviceRequests->isEmpty())
                <div class="bg-blue-100 text-blue-800 p-4 rounded-lg text-center font-medium mb-8">
                    No service requests found.
                </div>
            @else
                <div class="overflow-x-auto rounded-lg mt-4">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-custom-agency-bg text-white text-sm font-bold">
                                <th class="p-4 text-center">Title</th>
                                <th class="p-4 text-center">Description</th>
                                <th class="p-4 text-center">Category</th>
                                <th class="p-4 text-center">Status</th>
                                <th class="p-4 text-center">Start Date</th>
                                <th class="p-4 text-center">End Date</th>
                                <th class="p-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700 bg-gray-100">
                            @foreach($serviceRequests as $serviceRequest)
                                <tr class="border-t border-gray-200 hover:bg-gray-100 transition ease-in-out duration-150 text-md">
                                    <td class="p-4 text-center">{{ $serviceRequest->title }}</td>
                                    <td class="p-4 text-center">{{ \Illuminate\Support\Str::limit($serviceRequest->description, 50) }}</td>
                                    <td class="p-4 text-center">{{ ucfirst($serviceRequest->category) }}</td>
                                    <td class="p-4 text-center">
                                        <span class="inline-block px-3 py-1 text-sm rounded-full {{ $serviceRequest->status == 'open' ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">
                                            {{ ucfirst($serviceRequest->status) }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-center">{{ \Carbon\Carbon::parse($serviceRequest->start_date)->format('F j, Y') }}</td>
                                    <td class="p-4 text-center">{{ \Carbon\Carbon::parse($serviceRequest->end_date)->format('F j, Y') }}</td>
                                    <td class="p-4 text-center">
                                        @if($serviceRequest->status == 'open')
                                            <a href="#" class="bg-blue-500 text-white py-2 px-4 rounded-md font-semibold shadow-md hover:bg-blue-600 hover:shadow-lg transition ease-in-out duration-300 text-sm">
                                                Place Bid
                                            </a>
                                        @elseif($serviceRequest->status == 'in_progress')
                                            <a href="#" class="bg-yellow-500 text-white py-2 px-4 rounded-md font-semibold shadow-md hover:bg-yellow-600 hover:shadow-lg transition ease-in-out duration-300 text-sm">
                                                View Progress
                                            </a>
                                        @elseif($serviceRequest->status == 'completed')
                                            <a href="#" class="bg-green-500 text-white py-2 px-4 rounded-md font-semibold shadow-md hover:bg-green-600 hover:shadow-lg transition ease-in-out duration-300 text-sm">
                                                View Details
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-agency-dashboard>
