<x-app-layout>
    <div class="container mx-auto mt-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Service Request Details -->
            <div class="bg-white rounded-lg shadow-md p-6">
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
            <!-- Seeker Details -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="border-b pb-4 mb-4">
                    <h3 class="text-xl font-semibold">Seeker Details</h3>
                </div>
                <div>
                    <p><strong>Name:</strong> {{ $channel->seeker->name }}</p>
                    <p><strong>Email:</strong> {{ $channel->seeker->email }}</p>
                </div>
            </div>


            <!-- Provider Details -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="border-b pb-4 mb-4">
                    <h3 class="text-xl font-semibold">Bid Details</h3>
                </div>
                <div>
                    <p><strong>Bid Amount:</strong> {{ $channel->bid->bid_amount }}</p>
                    <p><strong>Bid Description:</strong> {{ $channel->bid->bid_description }}</p>
                </div>
            </div>
        </div>




        <!-- Task Actions -->
        <div class="bg-white rounded-lg shadow-md p-6 mt-6">
            <div class="border-b pb-4 mb-4">
                <h3 class="text-xl font-semibold">Task Actions</h3>
            </div>
            <div>
                <button onclick="informSeekerOnTheWay()"
                    class="btn btn-custom bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Inform Seeker
                    Provider is on the way</button>
                <button onclick="setArrived()"
                    class="btn btn-custom bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Notify Seeker
                    Provider has Arrived</button>
                @if ($channel->is_arrived === 'true')
                    @if ($channel->is_task_started === 'true')
                        @if ($channel->is_task_completed === 'true')
                            <p class="text-green-500">Task is completed.</p>
                        @else
                            <button onclick="completeTask()"
                                class="btn btn-custom bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Complete
                                Task</button>
                        @endif
                    @else
                        <button onclick="startTask()"
                            class="btn btn-custom bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Start
                            Task</button>
                    @endif
                @else
                    <p class="text-yellow-500">Waiting for the seeker to confirm arrival.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Payment Confirmation Modal -->
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50" id="providerPaymentModal"
        style="display: none;">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-auto p-6">
            <div class="border-b pb-4 mb-4 flex justify-between items-center">
                <h5 class="text-xl font-semibold">Confirm Payment Received</h5>
                <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none"
                    onclick="closeModal('providerPaymentModal')">&times;</button>
            </div>
            <div>
                <p>Amount: {{ $channel->bid->bid_amount }}</p>
                <p>Confirm you have received the payment.</p>
            </div>
            <div class="flex justify-end">
                <button type="button" class="btn bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded mr-2"
                    onclick="closeModal('providerPaymentModal')">Close</button>
                <button type="button" class="btn bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded"
                    onclick="confirmProviderPayment()">Confirm Payment</button>
            </div>
        </div>
    </div>

    <!-- Rating Modal -->
       <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50" id="ratingModal"
            style="display: none;">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl mx-auto p-6">
                <div class="border-b pb-4 mb-4 flex justify-between items-center">
                    <h5 class="text-xl font-semibold">Rate Your Experience</h5>
                    <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none"
                        onclick="closeModal('ratingModal')">&times;</button>
                </div>
                <form action="{{ route('submit.rating') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="channel_id" value="{{ $channel->id }}">
                    <input type="hidden" name="rated_for_id" value="{{ $channel->seeker_id }}">
                    @php
                        $criteria = ['Communication', 'Fairness', 'Respectfulness', 'Preparation', 'Responsiveness'];
                        $highlightClass = 'bg-blue-500 text-white'; // Using Tailwind blue-500 for highlighting
                    @endphp
                    <div class="flex flex-wrap">
                        @foreach ($criteria as $criterion)
                            <div class="w-full md:w-1/2 p-2">
                                <label class="block text-lg font-medium text-gray-700 text-center">{{ $criterion }}</label>
                                <div class="flex flex-wrap justify-center space-x-2">
                                    @for ($i = 0; $i <= 10; $i++)
                                        <input type="radio" name="rating_{{ strtolower(str_replace(' ', '_', $criterion)) }}"
                                            value="{{ $i }}"
                                            id="{{ strtolower(str_replace(' ', '_', $criterion)) }}-{{ $i }}"
                                            class="hidden" />
                                        <label for="{{ strtolower(str_replace(' ', '_', $criterion)) }}-{{ $i }}"
                                            class="rating-label flex items-center justify-center w-10 h-10 mb-2 border border-gray-300 rounded-full cursor-pointer hover:bg-gray-200 transition-colors duration-150"
                                            onclick="highlightSelected(this, '{{ $highlightClass }}')">
                                            {{ $i }}
                                        </label>
                                    @endfor
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
                            class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">Submit</button>
                    </div>
                </form>
                @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/custom-forms@0.3.0/dist/custom-forms.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        function informSeekerOnTheWay() {
            axios.post('{{ route('channel.informSeekerOnTheWay', $channel->id) }}')
                .then(response => {
                    alert(response.data.message);
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

        function confirmProviderPayment() {
            axios.post('{{ route('channel.confirmPayment', $channel->id) }}')
                .then(response => {
                    alert(response.data.message);
                    closeModal('providerPaymentModal');
                    location.reload(); // Refresh to reflect the changes
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
            group.forEach(l => l.classList.remove('bg-blue-500', 'text-white'));

            // Highlight the selected label
            label.classList.add('bg-blue-500', 'text-white');
        }

        // Modal display functions
        function openRatingModal() {
            document.getElementById('ratingModal').style.display = 'flex';
        }

    

        // Trigger the modal opening conditionally
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM fully loaded and parsed');

            var taskCompleted = '{{ $channel->is_task_completed }}';
            var paymentStatus = '{{ $channel->is_paid }}';

            console.log('Task Completed:', taskCompleted);
            console.log('Payment Status:', paymentStatus);

            if (taskCompleted === 'true' && paymentStatus === 'pending') {
                console.log('Conditions met, showing payment modal');
                document.getElementById('providerPaymentModal').style.display = 'flex';
            } else {
                console.log('Conditions not met for showing payment modal');
            }

            // Open rating modal if the task is completed
            if (paymentStatus === 'true') {
                openRatingModal();
            }
        });
        
    </script>


</x-app-layout>
