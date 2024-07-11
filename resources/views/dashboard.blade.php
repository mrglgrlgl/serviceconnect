<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .card-img-top {
            max-height: 200px; /* Adjust max-height as needed */
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row mb-4">
            <div class="col">
                <h2>Your Service Requests</h2>
            </div>
            <div class="col text-right">
                <a href="{{ route('service-requests.create') }}" class="btn btn-primary">Create New Request</a>
            </div>
        </div>

        <div class="row">
            @forelse ($serviceRequests as $serviceRequest)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm">
                        @if ($serviceRequest->attach_media)
                            <img src="{{ asset('storage/' . $serviceRequest->attach_media) }}" class="card-img-top" alt="Service Request Image">
                        @endif
                        @if ($serviceRequest->attach_media2)
                            <img src="{{ asset('storage/' . $serviceRequest->attach_media2) }}" class="card-img-top" alt="Service Request Image">
                        @endif
                        @if ($serviceRequest->attach_media3)
                            <img src="{{ asset('storage/' . $serviceRequest->attach_media3) }}" class="card-img-top" alt="Service Request Image">
                        @endif
                        @if ($serviceRequest->attach_media4)
                            <img src="{{ asset('storage/' . $serviceRequest->attach_media4) }}" class="card-img-top" alt="Service Request Image">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $serviceRequest->title }}</h5>
                            <p class="card-text">{{ $serviceRequest->category }}</p>
                            <p class="card-text">{{ $serviceRequest->location }}</p>
                            <p class="card-text">{{ $serviceRequest->start_time }} to {{ $serviceRequest->end_time }}</p>
                            <!-- Additional fields as needed -->

                            <div class="mt-3">
                                <a href="{{ route('service-requests.edit', $serviceRequest) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('service-requests.destroy', $serviceRequest) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this service request?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <p>No service requests found.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
