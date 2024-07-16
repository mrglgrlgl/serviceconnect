<x-app-layout>
    <div class="py-12">
        <div class="w-full md:w-11/12 lg:w-9/12 xl:w-9/12 2xl:w-9/12 mx-auto">

            @if ($serviceRequests->isEmpty())
                <div class="bg-blue-100 text-blue-800 p-4 rounded mb-6">
                    No service requests found.
                </div>
            @else
                @foreach ($serviceRequests as $serviceRequest)
                    <div class="p-4 bg-white shadow-sm rounded-lg md:mb-4">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center space-x-2">
                                <x-category :category="$serviceRequest->category" class="mr-2" />
                                <span class="text-gray-700 font-semibold">{{ $serviceRequest->title }}</span>
                                <span class="text-gray-700">- {{ $serviceRequest->user->name }}</span>
                            </div>
                            <div class="text-sm text-gray-600 md:mt-2">
                                {{ $serviceRequest->start_date }} {{ $serviceRequest->start_time }} to {{ $serviceRequest->end_date }} {{ $serviceRequest->end_time }}
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-1">
                                <div class="flex items-center p-2">
                                    <span class="material-symbols-outlined mr-1">
                                        location_on
                                    </span>
                                    <strong>Location:</strong> {{ $serviceRequest->location }}
                                </div>
                                <div class="p-2"><strong>Description:</strong> {{ $serviceRequest->description }}</div>
                            </div>
                            <div class="ml-4">
                                <div class="flex items-center p-2">
                                    <span class="material-symbols-outlined mr-1">
                                        work
                                    </span>
                                    <strong>Job Type:</strong> {{ $serviceRequest->job_type }}
                                </div>
                                @if ($serviceRequest->job_type == 'hourly_rate')
                                    <div class="flex items-center p-2">
                                        <span class="material-symbols-outlined mr-1">
                                            request_quote
                                        </span>
                                        <strong>Hourly Rate:</strong> {{ $serviceRequest->hourly_rate }}
                                    </div>
                                @elseif ($serviceRequest->job_type == 'project_based')
                                    <div class="flex items-center p-2">
                                        <span class="material-symbols-outlined mr-1">
                                            request_quote
                                        </span>
                                        <strong>Expected Price:</strong> {{ $serviceRequest->expected_price }}
                                    </div>
                                @endif
                                <div class="flex items-center p-2">
                                    <span class="material-symbols-outlined mr-1">
                                        hourglass_bottom
                                    </span>
                                    <strong>Estimated Duration:</strong> {{ $serviceRequest->estimated_duration }}
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-center space-x-2 mt-4">
                            <button type="button" class="bg-custom-light-blue text-white px-4 py-2 rounded hover:bg-cyan-700" data-toggle="modal" data-target="#bidModal-{{ $serviceRequest->id }}">
                                Place Bid
                            </button>
                        </div>
                    </div>

                    <!-- Bid Modal -->
                    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="bidModal-{{ $serviceRequest->id }}" role="dialog" aria-labelledby="bidModalLabel-{{ $serviceRequest->id }}" aria-hidden="true">
                        <div class="flex items-center justify-center min-h-screen">
                            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                                <div class="bg-white p-4">
                                    <div class="flex justify-between items-center pb-2">
                                        <h5 class="text-lg font-semibold" id="bidModalLabel-{{ $serviceRequest->id }}">Place Bid</h5>
                                        <button type="button" class="text-gray-400 hover:text-gray-600" data-dismiss="modal" aria-label="Close" onclick="closeModal('bidModal-{{ $serviceRequest->id }}')">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('bids.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="service_request_id" value="{{ $serviceRequest->id }}">
                                        <div class="mb-4">
                                            <label for="bid_amount" class="block text-sm font-medium text-gray-700">Bid Amount</label>
                                            <input type="number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="bid_amount" name="bid_amount" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="bid_description" class="block text-sm font-medium text-gray-700">Bid Description</label>
                                            <textarea class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="bid_description" name="bid_description" required></textarea>
                                        </div>
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit Bid</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <script>
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        document.querySelectorAll('[data-toggle="modal"]').forEach(button => {
            button.addEventListener('click', () => {
                const modalId = button.getAttribute('data-target').substring(1);
                document.getElementById(modalId).classList.remove('hidden');
            });
        });

        document.querySelectorAll('[data-dismiss="modal"]').forEach(button => {
            button.addEventListener('click', () => {
                const modalId = button.closest('.modal').id;
                closeModal(modalId);
            });
        });
    </script>
</x-app-layout>