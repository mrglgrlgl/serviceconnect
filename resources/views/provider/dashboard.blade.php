<x-dashboard>
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
</x-dashboard>