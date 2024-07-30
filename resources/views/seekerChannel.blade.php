<x-app-layout>
    <div class="py-12">
        <div class="w-full md:w-10/12 lg:w-8/12 xl:w-8/12 2xl:w-7/12 mx-auto">
            <!-- Service Request and Provider Details -->
            <div class="container mx-auto">
                <div class="flex flex-wrap">
                    <div class="w-full">
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h1 class="text-2xl font-semibold text-custom-header">Service Request Details</h1>
                            <div class="border-b pb-4 mb-4"></div>
                            <!-- Status Indicator -->
                            @if ($channel->is_task_completed === 'true')
                                <div class="h-12 flex items-center rounded-lg shadow-sm p-6 bg-green-100">
                                    <div>The task has been completed.</div>
                                </div>
                            @elseif ($channel->is_task_started === 'true')
                                <div class="h-12 flex items-center rounded-lg shadow-sm p-6 bg-yellow-100">
                                    <div>The task is in progress.</div>
                                </div>
                            @elseif ($channel->is_arrived === 'true')
                                <div class="h-12 flex items-center rounded-lg shadow-sm p-6 bg-blue-100">
                                    <div>The provider has arrived.</div>
                                </div>
                            @elseif ($channel->is_on_the_way)
                                <div class="h-12 flex items-center rounded-lg shadow-sm p-6 bg-blue-100">
                                    <div>The provider is on the way.</div>
                                </div>
                            @else
                                <div class="h-12 flex items-center rounded-lg shadow-sm p-6 bg-gray-300">
                                    <div>Status: Waiting for the provider to be on the way.</div>
                                </div>
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4">
                                <div>
                                    <div class="flex items-center text-xl">
                                        <x-category :category="$channel->serviceRequest->category" class="mr-2 text-gray-900" />
                                        <span class="text-gray-900"> - {{ $channel->serviceRequest->title }}</span>
                                    </div>
                                    <div class="mt-2">
                                        <div class="flex items-center">
                                            <span class="material-symbols-outlined mr-1 text-red-500">location_on</span>
                                            <span>{{ $channel->serviceRequest->location }}</span>
                                        </div>
                                        <p class="mt-2"><strong>Description:</strong> {{ $channel->serviceRequest->description }}</p>
                                        <p><strong>Start Time:</strong> {{ $channel->serviceRequest->start_time }}</p>
                                        <p><strong>End Time:</strong> {{ $channel->serviceRequest->end_time }}</p>
                                    </div>
                                </div>
                                <div class="md:w-full md:pl-8">
                                    <div class="border rounded-md p-4">
                                        <div class="border-b pb-2">
                                            <h3 class="text-xl font-semibold">Provider Details</h3>
                                        </div>
                                        <div class="mt-2">
                                            <p><strong>Name:</strong> {{ $channel->provider->name }}</p>
                                            <p class="flex items-center"><span class="material-symbols-outlined mr-1">mail</span>{{ $channel->provider->email }}</p>
                                            <p><strong>Contact Number:</strong> {{ optional($channel->provider->providerDetails)->contact_number }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modals for Arrival, Task Start, Task Completion, Payment Confirmation, and Rating -->
            <!-- Modals similar to what you provided earlier -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle modal display logic based on channel status
        });

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function confirmArrival() {
            // Handle arrival confirmation
        }

        function confirmTaskStart() {
            // Handle task start confirmation
        }

        function confirmTaskCompletion() {
            // Handle task completion confirmation
        }

        function highlightSelected(label) {
            const group = label.parentElement.querySelectorAll('.rating-label');
            group.forEach(l => l.classList.remove('bg-blue-500', 'text-white'));
            label.classList.add('bg-blue-500', 'text-white');
        }
    </script>
</x-app-layout>
