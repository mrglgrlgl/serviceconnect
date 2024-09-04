@extends('layouts.agency-dashboard')

@section('content')
    <div class="py-12 font-open-sans">
        <div class="w-full md:w-10/12 lg:w-8/12 xl:w-8/12 2xl:w-7/12 mx-auto">
            <div class="container mx-auto">
                <div class="flex flex-wrap">
                    <div class="w-full">
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-300">
                            <h1 class="text-2xl font-semibold text-gray-800">Service Request Details</h1>
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

                                            <p class="mt-4 pl-6 text-custom-header">
                                                <strong>Manpower:</strong>
                                                {{ $channel->serviceRequest->manpower_number }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="md:col-span-2 md:ml-auto w-full">
                                    <div class="border rounded-md p-4">
                                        <div class="border-b pb-2 ">
                                            <h3 class="text-xl text-custom-header">Seeker Details</h3>
                                        </div>
                                        <div class="mt-4">
                                            <div class="flex items-center text-xl pb-4">
                                                {{ $channel->seeker->name }}
                                                {{-- <span class="ml-2 text-yellow-500">
                                                    @if (isset($averageRating))
                                                        {{ number_format($averageRating, 2) }} / 5
                                                    @else
                                                        No ratings yet
                                                    @endif
                                                </span> --}}
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

                            {{-- <div class="bg-white rounded-lg border p-6 mt-6">
                                <div class="border-b pb-4 mb-4">
                                    <h3 class="text-2xl font-semibold text-gray-800">Bid Details</h3>
                                </div>
                                <div class="text-gray-800">
                                    <p><strong>Bid Amount:</strong> {{ $channel->bid->bid_amount }}</p>
                                    <p><strong>Bid Description:</strong> {{ $channel->bid->bid_description }}</p>
                                </div>
                            </div> --}}


<div class="bg-white rounded-lg border p-6 mt-6">
    <div class="border-b pb-4 mb-4">
        <h3 class="text-2xl font-semibold text-gray-800">Assigned Employees</h3>
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

        <!-- Example Button to Open Modal -->
        <button onclick="window.location.href='{{ route('show.assignment.page', $channel->service_request_id) }}'" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">
            Assign Employees
        </button>
    </div>

    <ul class="list-none p-0">
        @forelse ($assignedEmployees as $employee)
            <li class="flex justify-between items-center py-2 border-b border-gray-300">
                <!-- Employee Image -->
                <div class="flex items-center space-x-4">
                    @if($employee->photo)
                        <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}" class="w-16 h-16 rounded-md shadow-sm object-cover">
                    @else
                        <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile" class="w-16 h-16 rounded-md shadow-sm object-cover">
                    @endif
                    <span class="text-lg font-medium">{{ $employee->name }}</span>
                </div>

                <!-- Unassign Button -->
                <div>
                    <form action="{{ route('unassign.employee', ['channel' => $channel->id, 'employee' => $employee->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
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


                            <div class="bg-white rounded-lg border p-6 mt-6">
    <div class="border-b pb-4 mb-4">
        <h3 class="text-2xl font-semibold text-gray-800">Bid Details</h3>
    </div>


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



                            <div class="bg-white rounded-lg border p-6 mt-6">
                                <div class="border-b pb-4 mb-4">
                                    <h3 class="text-2xl font-semibold text-gray-800">Task Actions</h3>
                                </div>
                                <div class="space-y-4">
                                    @if ($channel->is_on_the_way == '1' && is_null($channel->is_arrived))
                                        <!-- Only show the "Notify Seeker Provider has Arrived" button -->
                                        <button onclick="setArrived()"
                                            class="bg-custom-light-blue hover:bg-cyan-700 text-white py-2 px-4 rounded">Notify
                                            Seeker Provider has Arrived</button>
                                    @elseif ($channel->is_arrived === 'true')
                                        @if ($channel->is_task_started === 'true')
                                            @if ($channel->is_task_completed === 'true')
                                                <p class="text-green-500">Task is completed.</p>
                                            @else
                                                <p class="text-gray-500">Click complete task to notify provider you have finished the request.</p>
                                                <button onclick="completeTask()"
                                                    class="bg-custom-light-blue hover:bg-sky-800 text-white py-2 px-4 rounded">Complete
                                                    Task</button>
                                            @endif
                                        @else
                                            <button onclick="startTask()"
                                                class="bg-custom-light-blue hover:bg-cyan-700 text-white py-2 px-4 rounded">Start
                                                Task</button>
                                        @endif
                                    @elseif (is_null($channel->is_on_the_way))
                                        <button onclick="informSeekerOnTheWay()"
                                            class="bg-custom-light-blue hover:bg-cyan-700 text-white py-2 px-4 rounded">Inform
                                            Seeker Provider is on the way</button>
                                    @elseif ($channel->is_arrived == 'pending')
                                        <div>Awaiting seeker's arrival confirmation.</div>
                                    @elseif ($channel->is_task_started == 'pending')
                                    <div class="text-gray-500">Task is ongoing</div>
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




    <!-- Rating Modal -->
    {{-- <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 pt-4" id="ratingModal"
        style="display: none;">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl mx-auto p-6 overflow-auto max-h-screen">
            <div class="border-b pb-4 mb-4 flex justify-between items-center">
                <h5 class="text-xl font-semibold">Rate Your Experience</h5>
                <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none"
                    onclick="closeModal('ratingModal')">&times;</button>
            </div>
            <div class="mb-4">
                <p class="text-lg">On a scale of one to ten, rate your seeker by the following criteria:</p>
            </div>
            <form action="{{ route('submit.rating') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="channel_id" value="{{ $channel->id }}">
                <input type="hidden" name="rated_for_id" value="{{ $channel->seeker_id }}">
                @php
                    $criteria = ['Communication', 'Fairness', 'Respectfulness', 'Preparation', 'Responsiveness'];
                @endphp
                <div class="space-y-4">
                    @foreach ($criteria as $criterion)
                        <div>
                            <label
                                class="block text-lg font-medium text-gray-700 text-center">{{ $criterion }}</label>
                            <div class="flex justify-center space-x-2">
                                @for ($i = 1; $i <= 10; $i++)
                                    <input type="radio"
                                        name="rating_{{ strtolower(str_replace(' ', '_', $criterion)) }}"
                                        value="{{ $i }}"
                                        id="{{ strtolower(str_replace(' ', '_', $criterion)) }}-{{ $i }}"
                                        class="hidden" />
                                    <label
                                        for="{{ strtolower(str_replace(' ', '_', $criterion)) }}-{{ $i }}"
                                        class="rating-label flex items-center justify-center w-12 h-12 mb-2 border border-gray-300 rounded-full cursor-pointer hover:bg-gray-200 transition-colors duration-150"
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
                        class="px-6 py-2 bg-custom-light-blue text-white rounded-md hover:bg-blue-600 focus:outline-none">Submit</button>
                </div>
            </form>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div> --}}

{{-- <div class="bg-white rounded-lg border p-6 mt-6">
    <div class="border-b pb-4 mb-4">
        <h3 class="text-2xl font-semibold text-gray-800">Assigned Employees</h3>
    </div>
    <ul>
        @forelse ($assignedEmployees as $employee)
            <li class="flex items-center py-2 border-b border-gray-300">
                @if($employee->photo)
                    <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}" class="w-12 h-12 rounded-full object-cover mr-4">
                @else
                    <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile" class="w-12 h-12 rounded-full object-cover mr-4">
                @endif
                <span>{{ $employee->name }}</span>
            </li>
        @empty
            <li>No employees assigned.</li>
        @endforelse
    </ul>
</div> --}}





    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/custom-forms@0.3.0/dist/custom-forms.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
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

