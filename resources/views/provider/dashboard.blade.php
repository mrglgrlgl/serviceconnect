<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Service Requests</title>
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
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 style="margin: 0;">Your Service Requests</h2>
            </div>
            <div class="card-body">
                @if ($serviceRequests->isEmpty())
                    <div class="alert-info">
                        No service requests found.
                    </div>
                @else
                    @foreach ($serviceRequests as $serviceRequest)
                        <div class="card">
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
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</body>
</html>
