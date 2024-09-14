@extends('layouts.app')

@section('content')
    <div class="p-12 font-open-sans">
        <div class="w-full mx-auto">
            <div class="container mx-auto">
                <div class="flex flex-wrap">
                    <div class="w-full">
                        <div class="bg-white shadow-sm p-6 border border-gray-300">
                            <h1 class="text-2xl font-semibold text-gray-700">Service Request Details</h1>
                            <div class="border-b pb-4 mb-4"></div>
                            <!-- Status Indicator -->
                            @if ($channel->is_task_completed === 'true')
                                <div
                                    class="h-12 flex items-center rounded-t-lg rounded-b-none shadow-sm p-6 bg-green-100 text-green-800">
                                    <div>The task has been completed.</div>
                                </div>
                            @elseif ($channel->is_task_started === 'true' && $channel->is_task_completed === 'pending')
                                <div
                                    class="h-12 flex items-center rounded-t-lg rounded-b-none shadow-sm p-6 bg-yellow-100 text-yellow-800">
                                    <div>Waiting for seeker to confirm task completion.</div>
                                </div>
                            @elseif ($channel->is_task_started === 'true')
                                <div
                                    class="h-12 flex items-center rounded-t-lg rounded-b-noneshadow-sm p-6 bg-yellow-100 text-yellow-800">
                                    <div>The task is in progress.</div>
                                </div>
                            @elseif ($channel->is_arrived === 'true')
                                <div
                                    class="h-12 flex items-center rounded-t-lg rounded-b-none shadow-sm p-6 bg-blue-100 text-blue-800">
                                    <div>Waiting for provider to start the task.</div>
                                </div>
                            @elseif ($channel->is_on_the_way)
                                <div
                                    class="h-12 flex items-center rounded-t-lg rounded-b-none shadow-sm p-6 bg-blue-100 text-blue-800">
                                    <div>The provider is on the way.</div>
                                </div>
                            @else
                                <div class="h-12 flex items-center rounded-t-lg rounded-b-none shadow-sm p-6 bg-gray-300">
                                    <div>Waiting for the provider to be on the way.</div>
                                </div>
                            @endif

                            <div
                                class="border bg-custom-lightestblue-accent p-6 rounded-b-lg flex justify-between items-center">
                                <div class="">
                                    <h3 class="text-xl font-semibold text-white">Task Actions</h3>
                                </div>
                                <div class="space-y-4">
                                    @if ($channel->is_on_the_way == 'pending')
                                        <button onclick="confirmArrival()"
                                            class="bg-custom-lightest-blue hover:bg-cyan-800 text-white py-2 px-4 rounded">Confirm
                                            Provider Arrival</button>
                                    @elseif ($channel->is_task_started === 'true')
                                        <p class="text-white">Task is currently in progress.</p>

                                        <button onclick="completeTask()"
                                            class="bg-cyan-700 hover:bg-gray-200 hover:text-custom-light-blue transform transition-transform duration-300 hover:scale-105 hover:shadow-xl text-white py-2 px-4 rounded">Complete
                                            Task</button>
                                    @elseif ($channel->is_arrived === 'true')
                                        {{-- <p class="text-white">Waiting for provider to start the task.</p> --}}
                                    @elseif ($channel->is_task_started === 'true')
                                        @if ($channel->is_task_completed === 'pending')
                                            <p class="text-white">Waiting for seeker to confirm task completion</p>
                                        @elseif ($channel->is_task_completed === 'true')
                                            <p class="text-white">Task is completed.</p>
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

                            <div class="grid grid-cols-1 md:grid-cols-5 pl-4 gap-8 pt-4">
                                <div class="md:col-span-3">
                                    <div class="flex items-center pt-4">
                                        <x-category :category="$channel->serviceRequest->category" class="mr-2" />
                                    </div>

                                    <div class="mt-2">
                                        <span
                                            class="text-2xl text-custom-header font-semibold pl-7">{{ $channel->serviceRequest->title }}</span>
                                    </div>
                                    <div class="mt-2">
                                        <div class="flex items-center pl-6">
                                            <span class="material-icons mr-1 text-red-500">location_on</span>
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

                                    {{-- Assigned Employees --}}
                                    <div class="border rounded-md p-4 mt-12">
                                        <div class="border-b flex items-center space-x-2 py-4">
                                            <span class="material-icons text-4xl text-custom-header">group</span>
                                            <h3 class="text-2xl font-semibold text-custom-header">Assigned Employees</h3>
                                        </div>
                                        <ul class="mt-4">
                                            @forelse ($assignedEmployees as $employee)
                                                <li class="flex justify-between items-center py-2 border-b border-gray-300">
                                                    <div class="flex items-center space-x-4">
                                                        @if ($employee->photo)
                                                            <img src="{{ asset('storage/' . $employee->photo) }}"
                                                                alt="{{ $employee->name }}"
                                                                class="w-16 h-16 rounded-md shadow-sm object-cover">
                                                        @else
                                                            <img src="{{ asset('images/default-profile.png') }}"
                                                                alt="Default Profile"
                                                                class="w-16 h-16 rounded-md shadow-sm object-cover">
                                                        @endif
                                                        <span class="text-lg font-medium">{{ $employee->name }}</span>
                                                    </div>
                                                    <span>{{ $employee->position }}</span>
                                                </li>
                                            @empty
                                                <p>No employees assigned.</p>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>



                                {{-- Provider Details --}}
                                <div class="md:col-span-2 md:ml-auto w-full bg-gray-50">
                                    <div class="border rounded-md p-4">
                                        <div class="border-b pb-2">
                                            <h3 class="text-2xl font-semibold text-custom-header">Provider Details</h3>
                                        </div>
                                        <div class="mt-4">
                                            @if ($channel->agencyuser)
                                                @php
                                                    $agency = $channel->agencyuser->agency; // Get the agency associated with the provider
                                                @endphp

                                                @if ($agency)
                                                    <div class="flex items-center text-xl pb-4">
                                                        @if ($agency->logo_path)
                                                            <img src="{{ asset('storage/' . $agency->logo_path) }}"
                                                                alt="{{ $agency->name }}"
                                                                class="w-16 h-16 object-cover rounded-full">
                                                        @else
                                                            <span class="text-gray-400">No logo available</span>
                                                        @endif
                                                        <span class="ml-4">{{ $agency->name }}</span>
                                                    </div>
                                                    <div class="flex items-center mt-2 pl-4">
                                                        <span class="material-icons text-gray-400 mr-2">mail</span>
                                                        <span>{{ $agency->email }}</span>
                                                    </div>
                                                    <div class="flex items-center mt-2 pl-4">
                                                        <span class="material-icons mr-2 text-gray-400">call</span>
                                                        <span>{{ $agency->phone }}</span>
                                                    </div>
                                                @else
                                                    <p>Agency details not available.</p>
                                                @endif
                                            @else
                                                <p>Provider details not available.</p>
                                            @endif



                                            <div class="flex justify-end pt-4">
                                                <!-- Bid Details Section -->
                                                <div class="bg-yellow-50 rounded-lg border p-6 mt-6 w-full text-gray-700">
                                                    <div class=" pb-4 mb-4">
                                                        <div
                                                            class="flex items-center space-x-2 text-2xl border-b pb-4 mb-4">
                                                            <span class="material-icons text-2xl">sell</span>
                                                            <h3 class="text-2xl font-semibold text-gray-800">Bid Details
                                                            </h3>
                                                        </div>

                                                        <div class="text-gray-800 pl-4">
                                                            <p>{{ $channel->bid->job_type }}</p>
                                                            @if ($channel->serviceRequest->job_type == 'hourly_rate')
                                                                <p class="flex items-center space-x-2">
                                                                    <span
                                                                        class="material-symbols-outlined">description</span>
                                                                    <strong>Description:</strong>
                                                                    {{ $channel->bid->bid_description }}
                                                                </p>

                                                                <p class="flex items-center space-x-2">
                                                                    <span class="material-icons text-md">schedule</span>
                                                                    <strong>Estimated Duration:</strong>
                                                                    <span>{{ $channel->serviceRequest->estimated_duration }}
                                                                        hours</span>
                                                                </p>

                                                                <div class="border-b pb-4 mb-4">
                                                                    <p class="flex items-center space-x-2">
                                                                        <span
                                                                            class="material-symbols-outlined">checkbook</span>
                                                                        <strong>Bid Amount:</strong>
                                                                        ₱{{ $channel->bid->bid_amount }}
                                                                    </p>
                                                                </div>

                                                                <div
                                                                    class="bg-yellow-100 py-4 rounded-md flex items-center space-x-2 pl-2">
                                                                    <span
                                                                        class="material-icons text-yellow-800">payments</span>
                                                                    <p class="text-yellow-800">
                                                                        <strong>Total Amount:</strong>
                                                                        ₱{{ number_format($channel->bid->bid_amount * $channel->serviceRequest->estimated_duration, 2) }}
                                                                    </p>
                                                                </div>
                                                            @else
                                                                <p class="flex items-center space-x-2">
                                                                    <span class="material-symbols-outlined">checkbook</span>
                                                                    <strong>Amount:</strong>
                                                                    {{ $channel->bid->bid_amount }}
                                                                </p>
                                                                <p class="flex items-center space-x-2">
                                                                    <span
                                                                        class="material-symbols-outlined text-custom-header">description</span>
                                                                    <strong>Description:</strong>
                                                                    {{ $channel->bid->bid_description }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            {{-- End Bid Details --}}

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
                        <button type="button"
                            class="bg-custom-lightest-blue text-white px-4 py-2 rounded hover:bg-cyan-800"
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
                        <p>The provider has marked the task as started. Please confirm if the task is indeed
                            started.</p>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-700"
                            onclick="closeModal('startTaskModal')">Close</button>
                        <button type="button"
                            class="bg-custom-lightest-blue text-white px-4 py-2 rounded hover:bg-cyan-800"
                            onclick="confirmTaskStart()">Confirm Start</button>
                    </div>
                </div>
            </div>




            <!-- Rating Modal -->
            <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 pt-4"
                id="seekerRatingModal" style="display: none;">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl mx-auto p-6 overflow-auto max-h-screen">
                    <div class="border-b pb-4 mb-4 flex justify-between items-center">
                        <h5 class="text-xl font-semibold">Rate the Provider</h5>
                        <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none"
                            onclick="closeModal('seekerRatingModal')">&times;</button>
                    </div>
                    <div class="mb-4">
                        <p class="text-lg">On a scale of one to ten, rate the provider by the following criteria:
                        </p>
                    </div>
                    <form action="{{ route('submit.seeker.rating') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="channel_id" value="{{ $channel->id }}">
                        {{-- <input type="hidden" name="rated_for_id" value="{{ $channel->provider_id }}"> --}}
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
                                    <label
                                        class="block text-lg font-medium text-gray-700 text-center">{{ $label }}</label>
                                    <div class="flex justify-center space-x-2">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <input type="radio" name="rating_{{ $field }}"
                                                value="{{ $i }}"
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
                            <label for="feedback" class="block text-lg font-medium text-gray-700">Additional
                                Feedback
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

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var hasRated = localStorage.getItem('hasRated') === 'true'; // Check if the user has already rated
                    var isTaskCompleted = '{{ $channel->is_task_completed ? 'true' : 'false' }}';

                    // Show the modal only if the task is completed and the user hasn't rated
                    if (!hasRated && isTaskCompleted === 'true') {
                        document.getElementById('seekerRatingModal').style.display = 'flex';
                    }


                    if ('{{ $channel->is_arrived }}' === 'pending') {
                        document.getElementById('arrivalModal').style.display = 'block';
                    }

                    if ('{{ $channel->is_task_started }}' === 'pending') {
                        document.getElementById('startTaskModal').style.display = 'block';
                    }

                    /**if ('{{ $channel->is_task_completed }}' === 'pending') {
                        document.getElementById('completeTaskModal').style.display = 'block';
                    }**/
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

                /**function confirmTaskCompletion() {
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
                }**/
                function completeTask() {
                    axios.post('{{ route('channel.completeTask', $channel->id) }}')
                        .then(response => {
                            alert('Task completion notified.');
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
        @endsection
