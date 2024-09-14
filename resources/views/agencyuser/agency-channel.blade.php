@extends('layouts.agency-dashboard')

@section('content')
    <div class="p-12">
        <div class="w-full mx-auto">
            <div class="container mx-auto">
                <div class="flex flex-wrap">
                    <div class="w-full">
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-300">
                            <h1 class="text-2xl font-semibold text-custom-header ">Service Request Details</h1>
                            <div class="border-b pb-4 mb-4"></div>

                            <!-- Status Indicator -->
                            @if ($channel->is_task_completed === 'true')
                                <div class="h-12 flex items-center rounded-lg shadow-sm p-6 bg-green-100">
                                    <div>The task has been completed.</div>
                                </div>
                            @elseif ($channel->is_task_started === 'true' && $channel->is_task_completed === 'pending')
                                <div class="h-12 flex items-center rounded-lg shadow-sm p-6 bg-blue-100">
                                    <div>Waiting for seeker to confirm task completion.</div>
                                </div>
                            @elseif ($channel->is_task_started === 'true')
                                <div class="h-12 flex items-center rounded-lg shadow-sm p-6 bg-yellow-100">
                                    <div>The task is in progress.</div>
                                </div>
                            @elseif ($channel->is_task_started === 'pending')
                                <div class="h-12 flex items-center rounded-lg shadow-sm p-6 bg-blue-100 text-blue-500">
                                    <div>Awaiting seeker's task start confirmation.</div>
                                </div>
                            @elseif ($channel->is_arrived === 'true')
                                <div class="h-12 flex items-center rounded-lg shadow-sm p-6 bg-blue-100">
                                    <div>Start the task</div>
                                </div>
                            @endif

                            {{-- Task actions --}}
                            <div class="bg-custom-light-blue rounded-lg border p-4 flex justify-between">

                                <h3 class="text-xl font-semibold text-white">Task Actions:</h3>

                                <div class="space-y-4">
                                    @if ($channel->is_on_the_way == '1' && is_null($channel->is_arrived))
                                        <!-- Only show the "Notify Seeker Provider has Arrived" button -->
                                        <button onclick="setArrived()"
                                            class="bg-cyan-700 hover:bg-gray-200 hover:text-custom-light-blue transform transition-transform duration-300 hover:scale-105 hover:shadow-xl text-white py-2 px-4 rounded">Notify
                                            Seeker Provider has Arrived</button>
                                    @elseif ($channel->is_arrived === 'true')
                                        @if ($channel->is_task_started === 'true')
                                            @if ($channel->is_task_completed === 'true')
                                                <p class="text-green-white">Task is completed.</p>
                                            @else

                                            
                                                {{-- <p class="text-gray-500">Click complete task to notify provider you have
                                                    finished the request.</p>
                                                <button onclick="completeTask()"
                                                    class="bg-cyan-700 hover:bg-gray-200 hover:text-custom-light-blue transform transition-transform duration-300 hover:scale-105 hover:shadow-xl text-white py-2 px-4 rounded">Complete
                                                    Task</button> --}}
                                            @endif
                                        @else
                                            <button onclick="startTask()"
                                                class="bg-cyan-700 hover:bg-gray-200 hover:text-custom-light-blue transform transition-transform duration-300 hover:scale-105 hover:shadow-xl text-white py-2 px-4 rounded">Start
                                                Task</button>
                                        @endif
                                    @elseif (is_null($channel->is_on_the_way))
                                        <button onclick="informSeekerOnTheWay()"
                                            class="bg-cyan-700 hover:bg-gray-200 hover:text-custom-light-blue transform transition-transform duration-300 hover:scale-105 hover:shadow-xl text-white py-2 px-4 rounded">Inform
                                            Seeker Provider is on the way</button>
                                    @elseif ($channel->is_arrived == 'pending')
                                        <div>Awaiting seeker's arrival confirmation.</div>
                                    @elseif ($channel->is_task_started == 'pending')
                                        <div class="text-gray-500">Task is ongoing</div>
                                    @endif
                                </div>
                            </div>
                            {{-- /Task actions --}}


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
                                                <div>
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
                                                <strong>Description:</strong> {{ $channel->serviceRequest->description }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="md:col-span-2 md:ml-auto w-full">
                                    <div class="border rounded-md p-4">
                                        <div class="border-b pb-2 ">
                                            <h3 class="text-2xl font-semibold text-custom-header">Seeker Details</h3>
                                        </div>
                                        <div class="mt-4">
                                            <div class="flex items-center text-xl pb-4">
                                                {{ $channel->seeker->name }}
                                            
                                            </div>
                                            <div class="flex items-center mt-2 pl-4">
                                                <span class="material-icons text-gray-400 mr-2">mail</span>
                                                <span>{{ $channel->seeker->email }}</span>
                                            </div>
                                            <div class="flex items-center mt-2 pl-4">
                                                <span class="material-icons mr-2 text-gray-400">call</span>
                                                <span>{{ $channel->seeker->phone_number ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                      


                            <div class="flex justify-between pt-4">
                                <!-- Bid Details Section -->
                                <div class="bg-gray-50 rounded-lg border p-6 mt-6 md:mr-4 w-5/12 text-gray-700">
                                    <div class="border-b pb-4 mb-4">
                                        <div class="flex items-center space-x-2 text-2xl">
                                            <span class="material-icons text-2xl">sell</span>
                                            <h3 class="text-2xl font-semibold">Bid Details</h3>
                                        </div>
                                    </div>

                                    <p>{{ $channel->bid->job_type }}</p>

                                    @if ($channel->serviceRequest->job_type == 'hourly_rate')
                                        <p class="flex items-center space-x-2">
                                            <span class="material-symbols-outlined">description</span>
                                            <strong>Description:</strong> {{ $channel->bid->bid_description }}
                                        </p>

                                        <p class="flex items-center space-x-2">
                                            <span class="material-icons text-md">schedule</span>
                                            <strong>Estimated Duration:</strong>
                                            <span>{{ $channel->serviceRequest->estimated_duration }} hours</span>
                                        </p>

                                        <div class="border-b pb-4 mb-4">
                                            <p class="flex items-center space-x-2">
                                                <span class="material-symbols-outlined">checkbook</span>
                                                <strong>Bid Amount: </strong> ₱{{ $channel->bid->bid_amount }}
                                            </p>
                                        </div>

                                        <div class="bg-yellow-100 py-4 rounded-md flex items-center space-x-2 pl-2">
                                            <span class="material-icons text-yellow-800">payments</span>
                                            <p class="text-yellow-800">
                                                <strong>Total Amount:</strong>
                                                ₱{{ number_format($channel->bid->bid_amount * $channel->serviceRequest->estimated_duration, 2) }}
                                            </p>
                                        </div>
                                    @else
                                        <p class="flex items-center space-x-2">
                                            <span class="material-symbols-outlined">checkbook</span>
                                            <strong>Amount:</strong> {{ $channel->bid->bid_amount }}
                                        </p>
                                        <p class="flex items-center space-x-2">
                                            <span class="material-symbols-outlined text-custom-header">description</span>
                                            <strong>Description:</strong> {{ $channel->bid->bid_description }}
                                        </p>
                                    @endif
                                </div>

                                <!-- Assigned Employees Section -->
                                <div class="bg-gray-50 rounded-lg border p-6 mt-6 w-full">
                                    <div class="border-b pb-4 mb-4 flex justify-between items-center">
                                        <div class="flex items-center space-x-2">
                                            <span class="material-icons text-4xl text-custom-header">group</span>
                                            <h3 class="text-2xl font-semibold text-gray-700">Assigned Employees</h3>
                                        </div>
                                        @if (session('success'))
                                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 mr-4 py-3 rounded relative"
                                                role="alert">
                                                <strong class="font-bold">Success!</strong>
                                                <span class="block sm:inline">{{ session('success') }}</span>
                                            </div>
                                        @endif

                                        <!-- Example Button to Open Modal -->
                                        <button
                                            onclick="window.location.href='{{ route('show.assignment.page', $channel->service_request_id) }}'"
                                            class="flex items-center bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition-colors duration-300">
                                            <span class="material-symbols-outlined text-lg mr-2">person_add</span>
                                            Assign Employees
                                        </button>
                                    </div>

                                    <ul class="list-none p-0">
                                        @forelse ($assignedEmployees as $employee)
                                            <li class="flex justify-between items-center py-2 border-b border-gray-300">
                                                <!-- Employee Image -->
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

                                                <!-- Unassign Button -->
                                                <div>
                                                    <form
                                                        action="{{ route('unassign.employee', ['channel' => $channel->id, 'employee' => $employee->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
                                                            Unassign
                                                        </button>
                                                    </form>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="py-2 text-gray-500">No employees assigned yet.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

 Task Completion Confirmation Modal -->
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50"
                id="completeTaskModal" style="display: none;">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-auto p-6 md:max-w-md">
                    <div class="flex justify-between items-center border-b pb-4 mb-4">
                        <h5 class="text-xl font-semibold">Confirm Task Completion</h5>
                        <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none"
                            onclick="closeModal('completeTaskModal')">&times;</button>
                    </div>
                    <div class="mb-4">
                        <p>The provider has marked the task as completed. Please confirm if the task is indeed
                            completed.</p>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-700"
                            onclick="closeModal('completeTaskModal')">Close</button>
                        <button type="button"
                            class="bg-custom-lightest-blue text-white px-4 py-2 rounded hover:bg-cyan-800 "
                            onclick="confirmTaskCompletion()">Confirm Completion</button>
                    </div>
                </div>
            </div>

    





    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/custom-forms@0.3.0/dist/custom-forms.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>

         document.addEventListener('DOMContentLoaded', function() {

                            if ('{{ $channel->is_task_completed }}' === 'pending') {
                                document.getElementById('completeTaskModal').style.display = 'block';
                            }
                        });
        function informSeekerOnTheWay() {
            axios.post('{{ route('channel.informSeekerOnTheWay', $channel->id) }}')
                .then(response => {
                    alert(response.data.message);
                    location.reload(); // Refresh the page to update the status
                })
                .catch(error => {
                    console.error(error);
                });
        }

        function setArrived() {
            axios.post('{{ route('channel.setArrived', $channel->id) }}')
                .then(response => {
                    alert(response.data.message);
                    location.reload(); // Refresh the page to update the status
                })
                .catch(error => {
                    console.error(error);
                });
        }

        function startTask() {
            axios.post('{{ route('channel.startTask', $channel->id) }}')
                .then(response => {
                    alert('Task started.');
                    location.reload(); // Reload the page to update the status
                })
                .catch(error => {
                    console.error(error);
                });
        }

        /** function completeTask() {
             axios.post('{{ route('channel.completeTask', $channel->id) }}')
                 .then(response => {
                     alert('Task completion notified.');
                     location.reload(); // Reload the page to update the status
                 })
                 .catch(error => {
                     console.error(error);
                 });
         }**/

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

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function highlightSelected(label) {
            // Remove selected class from all labels in the group
            const group = label.parentElement.querySelectorAll('.rating-label');
            group.forEach(l => l.classList.remove('bg-custom-light-blue', 'text-white'));

            // Highlight the selected label
            label.classList.add('bg-custom-light-blue', 'text-white');
        }

        // Modal display functions


        // Trigger the modal opening conditionally
        document.addEventListener('DOMContentLoaded', function() {
            var taskCompleted = '{{ $channel->is_task_completed }}';


            if (taskCompleted === 'true') {
                openRatingModal();
            }
        });


        function toggleEmployeeForm() {
            const form = document.getElementById('employee-form');
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }
    </script>
@endsection
