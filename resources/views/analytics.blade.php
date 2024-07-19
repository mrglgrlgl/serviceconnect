<x-dashboard>
    <x-slot name="dashboardbar">
        <div class="relative w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 mx-auto pt-4 overflow-hidden">
            <div class="font-semibold text-3xl md:pb-4">{{ __('Service Requests') }}</div>
            <div class="flex justify-center text-center w-full">
                <div class="flex items-center space-x-4 sm:space-x-12 md:space-x-20 lg:space-x-28 xl:space-x-28 2xl:space-x-28 overflow-x-auto md:overflow-hidden">
                    <x-category-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="inline-block">
                        <div class="flex flex-col items-center text-base md:text-xl">
                            {{ __('Service Requests') }}
                        </div>
                    </x-category-link>
                    <x-category-link class="inline-block">
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
            @if ($serviceRequests->isEmpty())
                <div class="flex flex-col items-center">
                    <div class="alert-info mb-4">
                        No service requests found. Create one now!
                    </div>
                    <a href="{{ route('service-requests.create') }}" class="h-11 w-auto px-6 justify-center text-sm rounded-lg border text-custom-dark-blue font-bold border-custom-lightest-blue hover:text-white hover:border-custom-lightestblue-accent hover:border-3xl bg-custom-lightest-blue hover:bg-custom-lightestblue-accent flex items-center">
                        {{ __('Create Service Request') }}
                    </a>
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
                                {{ \Carbon\Carbon::parse($serviceRequest->start_date)->format('m/d/Y') }} {{ \Carbon\Carbon::parse($serviceRequest->start_time)->format('h:i A') }} to {{ \Carbon\Carbon::parse($serviceRequest->end_date)->format('m/d/Y') }} {{ \Carbon\Carbon::parse($serviceRequest->end_time)->format('h:i A') }}
                            </div>
                        </div>

                        <div class="mt-4 mx-12">
                            <div class="font-semibold text-xl mb-2">
                                {{ $serviceRequest->title }}
                            </div>

                            <div id="requestdesc" class="mb-4">
                                {{ $serviceRequest->description }}
                            </div>

                            <div id="requestimg" class="mb-4">
                                {{-- Request image here --}}
                            </div>

                            <div class="flex justify-between items-center">
                                <div>
                                    <x-outline-button href="{{ route('service-requests.edit', $serviceRequest) }}" class="flex-1 md:flex-none w-full md:w-auto">
                                        <span class="material-symbols-outlined">
                                            edit
                                            </span>
                                    </x-outline-button>
                                    <form action="{{ route('service-requests.destroy', $serviceRequest) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button class="flex-1 md:flex-none w-full md:w-auto" onclick="return confirm('Are you sure you want to delete this service request?')">
                                            <span class="material-symbols-outlined">
                                                delete
                                            </span>
                                        </x-danger-button>
                                    </form>
                                </div>
                                <div class="flex justify-end font-semibold text-custom-light-blue">
                                    Bids >
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</x-dashboard>