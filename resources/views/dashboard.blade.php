<x-dashboard>
    <x-slot name="dashboardbar">
        <div class="relative w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 mx-auto pt-4 overflow-hidden">
            {{-- <div class="font-semibold text-3xl md:pb-4">{{ __('Dashboard') }}</div> --}}
            <div class="flex justify-center text-center w-full">
                <div class="flex items-center space-x-4 sm:space-x-12 md:space-x-20 lg:space-x-28 xl:space-x-28 2xl:space-x-28 overflow-x-auto md:overflow-hidden">
                    <x-category-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="inline-block hover:border-custom-lightest-blue border-custom-lightest-blue focus:border-cyan-600">
                        <div class="flex flex-col items-center text-base md:text-xl">
                            {{ __('Service Requests') }}
                        </div>
                    </x-category-link>
                    <x-category-link class="inline-block hover:border-custom-lightest-blue border-custom-lightest-blue focus:border-cyan-600">
                        <div class="flex flex-col items-center text-base md:text-xl">
                            {{ __('History') }}
                        </div>
                    </x-category-link>
                    <x-category-link class="inline-block hover:border-custom-lightest-blue border-custom-lightest-blue focus:border-cyan-600">
                        <div class="flex flex-col items-center text-base md:text-xl">
                            {{ __('Archived') }}
                        </div>
                    </x-category-link>
                    {{-- <x-category-link class="inline-block hover:border-custom-lightest-blue border-custom-lightest-blue focus:border-cyan-600">
                        <div class="flex flex-col items-center text-base md:text-xl">
                            {{ __('Analytics') }}
                        </div>
                    </x-category-link> --}}
                </div>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="border-t w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 text-center"></div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 mx-auto ">
            @if ($serviceRequests->isEmpty())
                <div class="alert-info">
                    No service requests found.
                </div>
            @else
    
                    @foreach ($serviceRequests as $serviceRequest)
                    <div class="servicerequestindividual p-4 bg-white shadow-sm rounded-lg md:mb-4">
                        <div class="flex justify-between items-start mb-4">
                            <div id="category" class="flex flex-col items-start">
                                <div class="flex items-center">
                                    <x-category :category="$serviceRequest->category" class="mr-2" />
                                    <span class="text-gray-700"> - {{ $serviceRequest->subcategory }}</span>
                                </div>
                                <x-service-status :status="$serviceRequest->status" />
                            </div>
                            <div id="date" class="text-sm text-gray-600 md:mt-2">
                                {{ $serviceRequest->start_date }} {{ $serviceRequest->start_time }} to {{ $serviceRequest->end_date }} {{ $serviceRequest->end_time }}
                            </div>
                    </div>

                            <div class="mt-4 text-center">
                                <div class="font-semibold text-xl mb-2">
                                    {{ $serviceRequest->title }}
                                </div>

                                <div id="requestdesc" class="mb-4">
                                    {{ $serviceRequest->description }}
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
                            <div class="flex justify-end font-semibold text-custom-light-blue">
                                Bids >
                            </div>
                        </div>
                    @endforeach
            @endif
        </div>
    </div>
</div>
</x-dashboard>

    


    
    {{-- <div class="container mt-4">
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
</html> --}}
{{-- <x-dashboard>


    <x-slot name="dashboardbar">
        <div class="relative w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 mx-auto pt-4 overflow-hidden">
            <div class="font-semibold text-3xl md:pb-4">{{ __('Dashboard') }}</div>
            <div class="flex justify-center text-center w-full">
                <div class="flex items-center space-x-4 sm:space-x-12 md:space-x-20 lg:space-x-28 xl:space-x-28 2xl:space-x-28 overflow-x-auto md:overflow-hidden">

                    <x-category-link :href="route('home')" class="inline-block hover:border-custom-lightest-blue border-custom-lightest-blue">
                        <div class="flex flex-col items-center text-base md:text-xl">
                            {{ __('Service Requests') }}
                        </div>
                    </x-category-link>
                    <x-category-link class="inline-block hover:border-custom-lightest-blue border-custom-lightest-blue">
                        <div class="flex flex-col items-center text-base md:text-xl">
                            {{ __('History') }}
                        </div>
                    </x-category-link>
                    <x-category-link class="inline-block hover:border-custom-lightest-blue border-custom-lightest-blue">
                        <div class="flex flex-col items-center text-base md:text-xl">
                            {{ __('Archived') }}
                        </div>
                    </x-category-link>
                    <x-category-link class="inline-block hover:border-custom-lightest-blue border-custom-lightest-blue">
                        <div class="flex flex-col items-center text-base md:text-xl">
                            {{ __('Analytics') }}
                        </div>
                    </x-category-link>
                </div>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="border-t my-2 w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 text-center"></div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 font-medium">
                    <x-service-request-individual/>
                </div>
            </div>
        </div> 
    </div>
</x-dashboard> --}}
