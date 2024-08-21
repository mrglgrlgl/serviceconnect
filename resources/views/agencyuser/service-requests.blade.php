<x-agency-dashboard>
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Service Requests</h2>
        <p class="mb-6">View and manage service requests from seekers.</p>

        @if($serviceRequests->isEmpty())
            <div class="alert alert-info">
                No service requests found.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($serviceRequests as $serviceRequest)
                            <tr>
                                <td>{{ $serviceRequest->title }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($serviceRequest->description, 50) }}</td>
                                <td>{{ ucfirst($serviceRequest->category) }}</td>
                                <td>
                                    <span class="badge badge-{{ $serviceRequest->status == 'open' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($serviceRequest->status) }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($serviceRequest->start_date)->format('F j, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($serviceRequest->end_date)->format('F j, Y') }}</td>
                                <td>
                                    @if($serviceRequest->status == 'open')
                                        <a href="{{ route('bids.create', ['id' => $serviceRequest->id]) }}" class="btn btn-sm btn-primary">Place Bid</a>
                                    @elseif($serviceRequest->status == 'in_progress')
                                        <a href="#" class="btn btn-sm btn-warning">View Progress</a>
                                    @elseif($serviceRequest->status == 'completed')
                                        <a href="#" class="btn btn-sm btn-success">View Details</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-agency-dashboard>
