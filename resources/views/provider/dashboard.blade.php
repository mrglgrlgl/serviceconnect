<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Requests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            background-color: #fff;
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            font-size: 1.25rem;
            margin-bottom: 10px;
        }
        .card-text {
            margin-bottom: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .alert-info {
            background-color: #d1ecf1;
            border-color: #bee5eb;
            color: #0c5460;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
        }
    </style>
    <!-- Add Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 style="margin: 0;">Your Service Requests</h2>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="border-t my-2 w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 text-center"></div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 mx-auto ">
            @if ($serviceRequests->isEmpty())
                <div class="alert-info">
                    No service requests found.
                </div>
            @else
                <div class="">
                    @foreach ($serviceRequests as $serviceRequest)
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $serviceRequest->title }}</h5>
                                <p class="card-text"><strong>Category:</strong> {{ $serviceRequest->category }}</p>
                                <p class="card-text"><strong>Description:</strong> {{ $serviceRequest->description }}</p>
                                <p class="card-text"><strong>Status:</strong> {{ $serviceRequest->status }}</p>
                                <p class="card-text"><strong>Location:</strong> {{ $serviceRequest->location }}</p>
                                <p class="card-text"><strong>Date:</strong> {{ $serviceRequest->start_date }} to {{ $serviceRequest->end_date }}</p>
                                <p class="card-text"><strong>Time:</strong> {{ $serviceRequest->start_time }} to {{ $serviceRequest->end_time }}</p>
                                
                                <!-- Display user's name who sent the request -->
                                <p class="card-text"><strong>Sent By:</strong> {{ $serviceRequest->user->name }}</p>
                                
                                <div>
                                    {{-- <a href="{{ route('service-requests.edit', $serviceRequest) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('service-requests.destroy', $serviceRequest) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this service request?')">Delete</button>
                                    </form> --}}
                                    <!-- Bid Button -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#bidModal-{{ $serviceRequest->id }}">
                                        Place Bid
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Bid Modal -->
                        <div class="modal fade" id="bidModal-{{ $serviceRequest->id }}" tabindex="-1" role="dialog" aria-labelledby="bidModalLabel-{{ $serviceRequest->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bidModalLabel-{{ $serviceRequest->id }}">Place Bid</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('bids.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="service_request_id" value="{{ $serviceRequest->id }}">
                                        <div class="form-group">
                                            <label for="bid_amount">Bid Amount</label>
                                            <input type="number" class="form-control" id="bid_amount" name="bid_amount" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="bid_description">Bid Description</label>
                                            <textarea class="form-control" id="bid_description" name="bid_description" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit Bid</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Add Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
</x-app-layout>
