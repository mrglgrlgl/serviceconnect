<x-app-layout>
    @php
    $bgColor = 'bg-gray-100'; // Default background color
    if ($channel->is_on_the_way) {
        $bgColor = 'bg-blue-100';
    } elseif ($channel->is_arrived === 'true') {
        $bgColor = 'bg-blue-200';
    } elseif ($channel->is_task_started === 'true') {
        if ($channel->is_task_completed === 'true') {
            $bgColor = 'bg-green-100';
        } else {
            $bgColor = 'bg-yellow-100';
        }
    }
@endphp

        @if ($channel->is_on_the_way)
        <div class="h-12 flex items-center rounded-lg shadow-sm p-6 bg-blue-100">
            <div>The provider is on the way.</div>
        </div>
        @else
        <div class="h-12 flex items-center rounded-lg shadow-sm p-6 bg-gray-300">
            <div>Status: Waiting for the provider to be on the way.</div>
        </div>
        @endif
        @if ($channel->is_arrived === 'true')
        <div class="h-12 flex items-center rounded-lg shadow-sm p-6 bg-blue-100">
            <div>The provider has arrived.</div>
        </div>
        @endif
        @if ($channel->is_task_started === 'true')
            @if ($channel->is_task_completed === 'true')
            <div class="h-12 flex items-center rounded-lg shadow-sm p-6 bg-green-100">
                <div>The task has been completed.</div>
            </div>
            @else
            <div class="h-12 flex items-center rounded-lg shadow-sm p-6 bg-yellow-100">
                <p>The task is in progress.</div>
            </div>
            @endif
        @endif


    <div class="container mx-auto">
        <div class="flex flex-wrap">
            <!-- Service Request Details -->
            <div class="w-full md:w-1/2 p-4">
                <div class="bg-white rounded-lg shadow-lg p-6 h-full">
                    <div class="border-b pb-4 mb-4">
                        <h3 class="text-xl font-semibold">Service Request Details</h3>
                    </div>
                    <div>
                        <p><strong>Category:</strong> {{ $channel->serviceRequest->category }}</p>
                        <p><strong>Title:</strong> {{ $channel->serviceRequest->title }}</p>
                        <p><strong>Description:</strong> {{ $channel->serviceRequest->description }}</p>
                        <p><strong>Location:</strong> {{ $channel->serviceRequest->location }}</p>
                        <p><strong>Start Time:</strong> {{ $channel->serviceRequest->start_time }}</p>
                        <p><strong>End Time:</strong> {{ $channel->serviceRequest->end_time }}</p>
                    </div>
                </div>
            </div>
    
            <!-- Provider Details -->
            <div class="w-full md:w-1/2 p-4">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="border-b pb-4 mb-4">
                        <h3 class="text-xl font-semibold">Provider Details</h3>
                    </div>
                    <div>
                        <p><strong>Name:</strong> {{ $channel->provider->name }}</p>
                        <p><strong>Email:</strong> {{ $channel->provider->email }}</p>
                        <p><strong>Contact Number:</strong> {{ optional($channel->provider->providerDetails)->contact_number }}</p>
                    </div>
                </div>
            </div>
        </div>
    
        
        <!-- Arrival Confirmation Modal -->
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-gray-900 bg-opacity-50" id="arrivalModal" style="display: none;">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-auto p-6">
                <div class="border-b pb-4 mb-4">
                    <h5 class="text-xl font-semibold">Confirm Provider Arrival</h5>
                    <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none float-right" onclick="closeModal('arrivalModal')">&times;</button>
                </div>
                <div class="mb-4">
                    <p>The provider has arrived. Please confirm their arrival.</p>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="btn btn-secondary mr-2" onclick="closeModal('arrivalModal')">Close</button>
                    <button type="button" class="btn btn-primary" onclick="confirmArrival()">Confirm Arrival</button>
                </div>
            </div>
        </div>
    
        <!-- Task Start Confirmation Modal -->
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-gray-900 bg-opacity-50" id="startTaskModal" style="display: none;">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-auto p-6">
                <div class="border-b pb-4 mb-4">
                    <h5 class="text-xl font-semibold">Confirm Task Start</h5>
                    <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none float-right" onclick="closeModal('startTaskModal')">&times;</button>
                </div>
                <div class="mb-4">
                    <p>The provider has marked the task as started. Please confirm if the task is indeed started.</p>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="btn btn-secondary mr-2" onclick="closeModal('startTaskModal')">Close</button>
                    <button type="button" class="btn btn-primary" onclick="confirmTaskStart()">Confirm Start</button>
                </div>
            </div>
        </div>
    
        <!-- Task Completion Confirmation Modal -->
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-gray-900 bg-opacity-50" id="completeTaskModal" style="display: none;">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-auto p-6">
                <div class="border-b pb-4 mb-4">
                    <h5 class="text-xl font-semibold">Confirm Task Completion</h5>
                    <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none float-right" onclick="closeModal('completeTaskModal')">&times;</button>
                </div>
                <div class="mb-4">
                    <p>The provider has marked the task as completed. Please confirm if the task is indeed completed.</p>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="btn btn-secondary mr-2" onclick="closeModal('completeTaskModal')">Close</button>
                    <button type="button" class="btn btn-primary" onclick="confirmTaskCompletion()">Confirm Completion</button>
                </div>
            </div>
        </div>
    
        <!-- Payment Modal -->
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-gray-900 bg-opacity-50" id="paymentModal" style="display: none;">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-auto p-6">
                <div class="border-b pb-4 mb-4">
                    <h5 class="text-xl font-semibold">Payment Confirmation</h5>
                </div>
                <div class="mb-4">
                    <p><strong>Bid Amount:</strong> {{ $channel->bid->bid_amount }}</p>
                    @if ($channel->is_paid === 'true')
                        <p>Payment has been confirmed.</p>
                    @else
                        <p>Waiting for payment confirmation from the provider.</p>
                    @endif
                </div>
                <div class="flex justify-end">
                    @if ($channel->is_paid === 'true')
                        <button type="button" class="btn btn-primary" onclick="closeModal('paymentModal')">Close</button>
                    @else
                        <button type="button" class="btn btn-primary" disabled>Waiting for Payment Confirmation</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </x-app-layout>
    


<!-- Rating Modal -->
<div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50" id="seekerRatingModal" style="display: none;">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-auto p-6">
        <div class="border-b pb-4 mb-4 flex justify-between items-center">
            <h5 class="text-xl font-semibold">Rate the Provider</h5>
            <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none" onclick="closeModal('seekerRatingModal')">&times;</button>
        </div>
        <form action="{{ route('submit.seeker.rating') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="channel_id" value="{{ $channel->id }}">
            <input type="hidden" name="rated_for_id" value="{{ $channel->provider_id }}">
            @php
                $criteria = ['Quality of Service', 'Professionalism', 'Cleanliness and Tidiness', 'Value for Money'];
                $highlightClass = 'bg-blue-500 text-white';
            @endphp
            <div class="flex flex-wrap">
                @foreach ($criteria as $criterion)
                    <div class="w-full md:w-1/2 p-2">
                        <label class="block text-lg font-medium text-gray-700 text-center">{{ $criterion }}</label>
                        <div class="flex flex-wrap justify-center space-x-2">
                            @for ($i = 0; $i <= 10; $i++)
                                <input type="radio" name="rating_{{ strtolower(str_replace([' ', '&'], '_', $criterion)) }}" value="{{ $i }}" id="{{ strtolower(str_replace([' ', '&'], '_', $criterion)) }}-{{ $i }}" class="hidden" />
                                <label for="{{ strtolower(str_replace([' ', '&'], '_', $criterion)) }}-{{ $i }}" class="rating-label flex items-center justify-center w-10 h-10 mb-2 border border-gray-300 rounded-full cursor-pointer hover:bg-gray-200 transition-colors duration-150" onclick="highlightSelected(this, '{{ $highlightClass }}')">
                                    {{ $i }}
                                </label>
                            @endfor
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="space-y-2 pt-4">
                <label for="feedback" class="block text-lg font-medium text-gray-700">Additional Feedback (Optional)</label>
                <textarea name="feedback" id="feedback" rows="4" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" placeholder="Share your thoughts...">{{ old('feedback') }}</textarea>
            </div>
            <div class="flex justify-center pt-4">
                <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">Submit</button>
            </div>
        </form>
    </div>
</div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('is_task_completed:', '{{ $channel->is_task_completed }}');
        console.log('is_paid:', '{{ $channel->is_paid ?? "No Data" }}');
    
        if ('{{ $channel->is_task_completed }}' === 'true' && '{{ $channel->is_paid }}' === 'pending') {
            console.log('Showing payment modal');
            document.getElementById('paymentModal').style.display = 'block';
        } else {
            console.log('Conditions not met for showing payment modal');
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
        axios.post('{{ route("channel.confirmArrival", $channel->id) }}', {}, {
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
        axios.post('{{ route("channel.confirmTaskStart", $channel->id) }}', {}, {
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
        axios.post('{{ route("channel.confirmTaskCompletion", $channel->id) }}', {}, {
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
    
    function confirmPayment() {
        axios.post('{{ route("channel.confirmPayment", $channel->id) }}')
            .then(response => {
                alert(response.data.message);
                location.reload(); // Reload the page to update the status
            })
            .catch(error => {
                console.error(error);
            });
    }



    document.addEventListener('DOMContentLoaded', function() {
        console.log('is_task_completed:', '{{ $channel->is_task_completed }}');
        console.log('is_paid:', '{{ $channel->is_paid ?? "No Data" }}');

        var taskCompleted = '{{ $channel->is_task_completed }}' === 'true';
        var paymentStatus = '{{ $channel->is_paid }}' === 'true';

        if (taskCompleted && paymentStatus) {
            console.log('Conditions met, showing rating modal');
            document.getElementById('seekerRatingModal').style.display = 'flex';
        } else {
            console.log('Conditions not met for showing rating modal');
        }
    });

    function highlightSelected(label) {
        const group = label.parentElement.querySelectorAll('.rating-label');
        group.forEach(l => l.classList.remove('bg-blue-500', 'text-white'));
        label.classList.add('bg-blue-500', 'text-white');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }
    </script>