@extends('layouts.agencyuser-navigation')

@section('content')
{{-- <div class="container mx-auto p-4">
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
                                    <a href="#" class="btn btn-sm btn-primary">Place Bid</a>
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
</div> --}}
<div class="py-12">
        <div class="w-full md:w-10/12 lg:w-8/12 xl:w-8/12 2xl:w-7/12 mx-auto">
            <div class="flex justify-center text-center w-full mb-6">
                <div class="flex items-center space-x-4 sm:space-x-12 md:space-x-20 lg:space-x-28 xl:space-x-28 2xl:space-x-28 overflow-x-auto md:overflow-hidden">
                    {{-- <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Service Requests') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('myrequests') }}" :active="request()->routeIs('myrequests')">
                        {{ __('My Requests') }}
                    </x-nav-link> --}}
                </div>
            </div>

            <div class="flex justify-center">
                <div class="border-t w-full text-center border-custom-cat-border pb-4"></div>
            </div>

            @if ($serviceRequests->isEmpty())
                <div class="bg-blue-100 text-blue-700 p-4 rounded mb-6">
                    No service requests found.
                </div>
            @else
                @foreach ($serviceRequests as $serviceRequest)
                    <div class="p-4 border border-gray-300 bg-white shadow-sm rounded-lg md:mb-4">
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center space-x-2">
                                <x-category :category="$serviceRequest->category" class="mr-2 text-gray-900" />
                                <span class="text-gray-900 font-semibold">{{ $serviceRequest->title }}</span>
                                <span class="text-gray-900">- {{ $serviceRequest->user->name }}</span>
                            </div>
                            <div class="text-sm text-gray-600 md:mt-2">
                                @if (\Carbon\Carbon::parse($serviceRequest->start_date)->isSameDay(\Carbon\Carbon::parse($serviceRequest->end_date)))
                                    {{ \Carbon\Carbon::parse($serviceRequest->start_date)->format('F j, Y') }},
                                    {{ \Carbon\Carbon::parse($serviceRequest->start_time)->format('h:i A') }} -
                                    {{ \Carbon\Carbon::parse($serviceRequest->end_time)->format('h:i A') }}
                                @else
                                    {{ \Carbon\Carbon::parse($serviceRequest->start_date . ' ' . $serviceRequest->start_time)->format('F j, Y h:i A') }}
                                    - {{ \Carbon\Carbon::parse($serviceRequest->end_date . ' ' . $serviceRequest->end_time)->format('F j, Y h:i A') }}
                                @endif
                            </div>
                        </div>

                        <div class="flex items-start px-8">
                            <div class="flex-1">
                                <div class="flex text-gray-700 items-center space-x-4">
                                    <div class="flex items-center p-2">
                                        <span class="material-symbols-outlined text-gray-500">work</span>
                                        {{ $serviceRequest->job_type }}
                                    </div>
                                    <div class="flex items-center p-2">
                                        <span class="material-symbols-outlined text-gray-500">request_quote</span>
                                        Price: 
                                        @if ($serviceRequest->min_price)
                                            {{ $serviceRequest->min_price }} -
                                        @endif
                                        {{ $serviceRequest->max_price }}
                                    </div>
                                    <div class="flex items-center p-2">
                                        Estimated Duration: {{ $serviceRequest->estimated_duration }} {{ 'hours'}}
                                    </div>
                                </div>
                                <div class="flex items-center p-2">
                                    <span class="material-symbols-outlined text-red-500">location_on</span>
                                    {{ $serviceRequest->location }}
                                </div>
                                <div class="pl-3">Description: {{ $serviceRequest->description }}</div>
                            </div>
                        </div>

                        <div class="flex justify-end items-center space-x-2 mt-4">
<a href="{{ route('bids.create', ['id' => $serviceRequest->id]) }}"
    class="bg-custom-light-blue text-white px-4 py-2 rounded hover:bg-cyan-700">
    Place Bid
</a>


                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection 
