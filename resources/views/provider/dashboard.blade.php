<x-app-layout>
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
                        <div class="servicerequestindividual p-4 bg-white shadow-sm rounded-lg mb-4"> <!-- Added mb-4 for spacing -->
                            <div class="flex justify-between items-start mb-4">
                                <div id="category" class="flex flex-col">

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

                                <div class="flex flex-col md:flex-row justify-center items-center md:space-x-2 space-y-2 md:space-y-0">
                                    <x-outline-button href="{{ route('service-requests.edit', $serviceRequest) }}" class="flex-1 md:flex-none w-full md:w-auto">
                                        Edit
                                    </x-outline-button>
                                    <form action="{{ route('service-requests.destroy', $serviceRequest) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button class="flex-1 md:flex-none w-full md:w-auto" onclick="return confirm('Are you sure you want to delete this service request?')">
                                            Delete
                                        </x-danger-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</body>
</html>
</x-app-layout>
