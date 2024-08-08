<x-app-layout>
    <div class="py-12 font-open-sans">
        <div class="w-full md:w-10/12 lg:w-8/12 xl:w-8/12 2xl:w-7/12 mx-auto">
            <div class="container mx-auto">
                <div class="flex flex-wrap">
                    <div class="w-full">
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-300">
                            <h1 class="text-2xl font-semibold text-gray-700">Service Request Details</h1>
                            <div class="border-b pb-4 mb-4"></div>
                            <!-- Status Indicator -->
                            @if ($channel->is_task_completed === 'true')
                                <div class="h-12 flex items-center rounded-lg shadow-sm p-6 bg-green-100">
                                    <div>The task has been completed.</div>
                                </div>
                            @elseif ($channel->is_task_started === 'true' && $channel->is_task_completed === 'pending')
                                <div class="h-12 flex items-center rounded-lg shadow-sm p-6 bg-yellow-100">
                                    <div>Waiting for seeker to confirm task completion.</div>
                                </div>
                            @elseif ($channel->is_task_started === 'true')
                                <div class="h-12 flex items-center rounded-lg shadow-sm p-6 bg-yellow-100">
                                    <div>The task is in progress.</div>
                                </div>
                            @elseif ($channel->is_arrived === 'true')
                                <div class="h-12 flex items-center rounded-lg shadow-sm p-6 bg-blue-100">
                                    <div>Waiting for provider to start the task.</div>
                                </div>
                            @elseif ($channel->is_on_the_way)
                                <div class="h-12 flex items-center rounded-lg shadow-sm p-6 bg-blue-100">
                                    <div>The provider is on the way.</div>
                                </div>
                            @else
                                <div class="h-12 flex items-center rounded-lg shadow-sm p-6 bg-gray-300">
                                    <div>Waiting for the provider to be on the way.</div>
                                </div>
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-5 gap-8 pt-4">
                                <div class="md:col-span-3">
                                    <div class="flex items-center text-xl pt-4">
                                        <x-category :category="$channel->serviceRequest->category" class="mr-2" />
                                        <span> - {{ $channel->serviceRequest->title }}</span>
                                    </div>
                                    <div class="mt-2">
                                        <div class="flex items-center pl-6">
                                            <span class="material-icons mr-1 text-gray-500">location_on</span>
                                            <span>{{ $channel->serviceRequest->location }}</span>
                                        </div>
                                        <div class="mt-2 pl-6">
                                            <div class="flex items-center mt-2">
                                                <span class="material-icons text-gray-500 mr-2">schedule</span>
                                                <div class="font-light">
                                                    @if (
                                                        \Carbon\Carbon::parse($channel->serviceRequest->start_date)->isSameDay(
                                                            \Carbon\Carbon::parse($channel->serviceRequest->end_date)))
                                                        {{ \Carbon\Carbon::parse($channel->serviceRequest->start_date)->format('F j, Y') }},
                                                        {{ \Carbon\Carbon::parse($channel->serviceRequest->start_time)->format('h:i A') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($channel->serviceRequest->end_time)->format('h:i A') }}
                                                    @else
                                                        {{ \Carbon\Carbon::parse($channel->serviceRequest->start_date . ' ' . $channel->serviceRequest->start_time)->format('F j, Y h:i A') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($channel->serviceRequest->end_date . ' ' . $channel->serviceRequest->end_time)->format('F j, Y h:i A') }}
                                                    @endif
                                                </div>
                                            </div>
                                            <p class="mt-4 pl-6 text-custom-header">
                                                <strong>Description:</strong>
                                                {{ $channel->serviceRequest->description }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="md:col-span-2 md:ml-auto w-full">
                                    <div class="border rounded-md p-4">
                                        <div class="border-b pb-2 ">
                                            <h3 class="text-xl text-custom-header">Provider Details</h3>
                                        </div>
                                        <div class="mt-4">
                                            <div class="flex items-center text-xl pb-4">
                                                {{ $channel->provider->name }}
                                                <span class="ml-2 text-yellow-500">
                                                    {{-- @if (isset($averageRating))
                                                        {{ number_format($averageRating, 2) }} / 5
                                                    @else
                                                        No ratings yet
                                                    @endif --}}
                                                </span>
                                            </div>
                                            <div class="flex items-center mt-2 pl-4">
                                                <span class="material-icons text-gray-400 mr-2">mail</span>
                                                <span>{{ $channel->provider->email }}</span>
                                            </div>
                                            <div class="flex items-center mt-2 pl-4">
                                                <span class="material-icons mr-2 text-gray-400">call</span>
                                                <span>{{ optional($channel->provider->providerDetails)->contact_number }}</span>
                                            </div>
                                      
                                        </div>
                                    </div>
                                </div>
                            </div>
                              <div class="border-b pb-4 mb-4">
        <h3 class="text-2xl font-semibold text-gray-800">Bid Details</h3>
    </div>
    <div class="text-gray-800">

     <p>{{ $channel->bid->job_type }}</p>
            @if ($channel->serviceRequest->job_type == 'hourly_rate' )

        <p><strong>Bid Amount:</strong> {{ $channel->bid->bid_amount }}</p>
        <p><strong>Bid Description:</strong> {{ $channel->bid->bid_description }}</p>
        <span>{{ $channel->serviceRequest->estimated_duration }}</span>

        <p><strong>Total Amount:</strong> {{ number_format($channel->bid->bid_amount * $channel->serviceRequest->estimated_duration, 2) }}</p>
            @else
            <p><strong>Bid Amount:</strong> {{ $channel->bid->bid_amount }}</p>
        <p><strong>Bid Description:</strong> {{ $channel->bid->bid_description }}</p>
    </div>
    @endif
                        </div>

                        <div class="bg-white rounded-lg shadow-md p-6 mt-6">
                            <div class="border-b pb-4 mb-4">
                                <h3 class="text-2xl font-semibold">Task Actions</h3>
                            </div>
                            <div class="space-y-4">
                                @if ($channel->is_on_the_way == 'pending')
                                    <button onclick="confirmArrival()"
                                        class="bg-custom-lightest-blue hover:bg-cyan-800 text-white py-2 px-4 rounded">Confirm
                                        Provider Arrival</button>
                                @elseif ($channel->is_task_started === 'true')
                                    <p class="text-gray-500">Task is currently in progress. Wait for the provider to
                                        send a task completion notification.</p>
                                @elseif ($channel->is_arrived === 'true')
                                    <p class="text-gray-500">Waiting for provider to start the task.</p>
                                @elseif ($channel->is_task_started === 'true')
                                    @if ($channel->is_task_completed === 'pending')
                                        <p class="text-green-500">Waiting for seeker to confirm task completion</p>
                                    @elseif ($channel->is_task_completed === 'true')
                                        <p class="text-green-500">Task is completed.</p>
                                    @else
                                        <button onclick="completeTask()"
                                            class="bg-custom-lightest-blue hover:bg-cyan-800 text-white py-2 px-4 rounded">Complete
                                            Task</button>
                                    @endif
                                @else
                                    <p class="text-gray-500">Waiting for the provider to arrive.</p>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modals for Arrival, Task Start, Task Completion, and Rating -->
    <!-- Modals similar to what you provided earlier -->

    <!-- Arrival Confirmation Modal -->
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50" id="arrivalModal"
        style="display: none;">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-auto p-6 md:max-w-md">
            <div class="flex justify-between items-center border-b pb-4 mb-4">
                <h5 class="text-xl font-semibold">Confirm Provider Arrival</h5>
                <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none"
                    onclick="closeModal('arrivalModal')">&times;</button>
            </div>
            <div class="mb-4">
                <p>The provider has arrived. Please confirm their arrival.</p>
            </div>
            <div class="flex justify-end">
                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-700"
                    onclick="closeModal('arrivalModal')">Close</button>
                <button type="button" class="bg-custom-lightest-blue text-white px-4 py-2 rounded hover:bg-cyan-800"
                    onclick="confirmArrival()">Confirm Arrival</button>
            </div>
        </div>
    </div>

    <!-- Task Start Confirmation Modal -->
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50" id="startTaskModal"
        style="display: none;">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-auto p-6 md:max-w-md">
            <div class="flex justify-between items-center border-b pb-4 mb-4">
                <h5 class="text-xl font-semibold">Confirm Task Start</h5>
                <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none"
                    onclick="closeModal('startTaskModal')">&times;</button>
            </div>
            <div class="mb-4">
                <p>The provider has marked the task as started. Please confirm if the task is indeed started.</p>
            </div>
            <div class="flex justify-end">
                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-700"
                    onclick="closeModal('startTaskModal')">Close</button>
                <button type="button" class="bg-custom-lightest-blue text-white px-4 py-2 rounded hover:bg-cyan-800"
                    onclick="confirmTaskStart()">Confirm Start</button>
            </div>
        </div>
    </div>


    <!-- Task Completion Confirmation Modal -->
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50" id="completeTaskModal"
        style="display: none;">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-auto p-6 md:max-w-md">
            <div class="flex justify-between items-center border-b pb-4 mb-4">
                <h5 class="text-xl font-semibold">Confirm Task Completion</h5>
                <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none"
                    onclick="closeModal('completeTaskModal')">&times;</button>
            </div>
            <div class="mb-4">
                <p>The provider has marked the task as completed. Please confirm if the task is indeed completed.</p>
            </div>
            <div class="flex justify-end">
                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-700"
                    onclick="closeModal('completeTaskModal')">Close</button>
                <button type="button" class="bg-custom-lightest-blue text-white px-4 py-2 rounded hover:bg-cyan-800 "
                    onclick="confirmTaskCompletion()">Confirm Completion</button>
            </div>
        </div>
    </div>

    <!-- Rating Modal -->
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 pt-4" id="seekerRatingModal"
        style="display: none;">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl mx-auto p-6 overflow-auto max-h-screen">
            <div class="border-b pb-4 mb-4 flex justify-between items-center">
                <h5 class="text-xl font-semibold">Rate the Provider</h5>
                <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none"
                    onclick="closeModal('seekerRatingModal')">&times;</button>
            </div>
            <div class="mb-4">
                <p class="text-lg">On a scale of one to ten, rate the provider by the following criteria:</p>
            </div>
            <form action="{{ route('submit.seeker.rating') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="channel_id" value="{{ $channel->id }}">
                <input type="hidden" name="rated_for_id" value="{{ $channel->provider_id }}">
                @php
                    $criteria = [
                        'quality_of_service' => 'Quality of Service',
                        'communication' => 'Communication',
                        'professionalism' => 'Professionalism',
                        'cleanliness_tidiness' => 'Cleanliness and Tidiness',
                        'value_for_money' => 'Value for Money',
                    ];
                @endphp
                <div class="space-y-4">
                    @foreach ($criteria as $field => $label)
                        <div>
                            <label class="block text-lg font-medium text-gray-700 text-center">{{ $label }}</label>
                            <div class="flex justify-center space-x-2">
                                @for ($i = 1; $i <= 10; $i++)
                                    <input type="radio" name="rating_{{ $field }}" value="{{ $i }}"
                                        id="{{ $field }}-{{ $i }}" class="hidden" />
                                    <label for="{{ $field }}-{{ $i }}"
                                        class="rating-label flex items-center justify-center w-12 h-12 mb-2 border border-gray-300 rounded-full cursor-pointer hover:bg-cyan-800 transition-colors duration-150"
                                        onclick="highlightSelected(this)">
                                        {{ $i }}
                                    </label>
                                @endfor
                            </div>
                            <div class="flex justify-between text-sm text-gray-600 mt-1">
                                <span>Poor</span>
                                <span>Excellent</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="space-y-2 pt-4">
                    <label for="feedback" class="block text-lg font-medium text-gray-700">Additional Feedback
                        (Optional)</label>
                    <textarea name="feedback" id="feedback" rows="4"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                        placeholder="Share your thoughts...">{{ old('feedback') }}</textarea>
                </div>
                <div class="flex justify-center pt-4">
                    <button type="submit"
                        class="px-6 py-2 bg-custom-lightest-blue text-white rounded-md hover:bg-cyan-800 focus:outline-none">Submit</button>
                </div>
            </form>
            @if (session('success'))
                <div class="alert alert-success mt-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger mt-4">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if ('{{ $channel->is_task_completed }}' === 'true') {
            document.getElementById('seekerRatingModal').style.display = 'flex';
        }

        if ('{{ $channel->is_arrived }}' === 'pending') {
            document.getElementById('arrivalModal').style.display = 'block';
        }

        if ('{{ $channel->is_task_started }}' === 'pending') {
            document.getElementById('startTaskModal').style.display = 'block';
        }

        if ('{{ $channel->is_task_completed }}' === 'pending') {
            document.getElementById('completeTaskModal').style.display = 'block';
        }
    });

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    function confirmArrival() {
        axios.post('{{ route('channel.confirmArrival', $channel->id) }}', {}, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                alert(response.data.message);
                closeModal('arrivalModal');
                location.reload(); // Reload the page to update the status
            })
            .catch(error => {
                console.error(error);
            });
    }

    function confirmTaskStart() {
        axios.post('{{ route('channel.confirmTaskStart', $channel->id) }}', {}, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                alert(response.data.message);
                closeModal('startTaskModal');
                location.reload(); // Reload the page to update the status
            })
            .catch(error => {
                console.error(error);
            });
    }

    function confirmTaskCompletion() {
        axios.post('{{ route('channel.confirmTaskCompletion', $channel->id) }}', {}, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                alert(response.data.message);
                closeModal('completeTaskModal');
                location.reload(); // Reload the page to update the status
            })
            .catch(error => {
                console.error(error);
            });
    }

    function highlightSelected(label) {
        const group = label.parentElement.querySelectorAll('.rating-label');
        group.forEach(l => l.classList.remove('bg-custom-lightest-blue', 'text-white'));
        label.classList.add('bg-custom-lightest-blue', 'text-white');
    }
</script>
