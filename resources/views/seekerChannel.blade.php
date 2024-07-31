<x-app-layout>
    <div class="py-12 font-open-sans">
        <div class="w-full md:w-10/12 lg:w-8/12 xl:w-8/12 2xl:w-7/12 mx-auto">
            <div class="container mx-auto">
                <div class="flex flex-wrap">
                    <div class="w-full">
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h1 class="text-2xl font-semibold text-gray-700">Service Request Details</h1>
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

                            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 pt-4">
                                <div class="md:col-span-3">
                                    <div class="flex items-center text-xl pt-4">
                                        <x-category :category="$channel->serviceRequest->category" class="mr-2" />
                                        <span> - {{ $channel->serviceRequest->title }}</span>
                                    </div>
                                    <div class="mt-2">
                                        <div class="flex items-center pl-6">
                                            <span class="material-symbols-outlined mr-1 text-red-500">location_on</span>
                                            <span>{{ $channel->serviceRequest->location }}</span>
                                        </div>
                                        <div class="mt-2 pl-6">
                                            <div class="flex items-center mt-2">
                                            <span class="material-symbols-outlined text-gray-500 mr-2">schedule</span>
                                            
                                            <div class="font-light">
                                            @if (\Carbon\Carbon::parse($channel->serviceRequest->start_date)->isSameDay(\Carbon\Carbon::parse($channel->serviceRequest->end_date)))
                                                {{ \Carbon\Carbon::parse($channel->serviceRequest->start_date)->format('F j, Y') }},
                                                {{ \Carbon\Carbon::parse($channel->serviceRequest->start_time)->format('h:i A') }} -
                                                {{ \Carbon\Carbon::parse($channel->serviceRequest->end_time)->format('h:i A') }}
                                            @else
                                                {{ \Carbon\Carbon::parse($channel->serviceRequest->start_date . ' ' . $channel->serviceRequest->start_time)->format('F j, Y h:i A') }}
                                                - {{ \Carbon\Carbon::parse($channel->serviceRequest->end_date . ' ' . $channel->serviceRequest->end_time)->format('F j, Y h:i A') }}
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
                                            <h3 class="text-xl text-custom-header">Provider Details</h3>
                                        </div>
                                        <div class="mt-4">
                                            <div class="flex items-center text-xl">
                                                {{ $channel->provider->name }}
                                                <span class="ml-2 text-yellow-500">
                                                    @if(isset($averageRating))
                                                        {{ number_format($averageRating, 2) }} / 5
                                                    @else
                                                        No ratings yet
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="flex items-center mt-2">
                                                <span class="material-symbols-outlined text-gray-500 mr-2">mail</span>
                                                <span>{{ $channel->provider->email }}</span>
                                            </div>
                                            <div class="flex items-center mt-2">
                                                <span class="material-symbols-outlined mr-2 text-gray-500">call</span>
                                                <span>{{ optional($channel->provider->providerDetails)->contact_number }}</span>
                                            </div>
                                            <div class="flex items-center mt-2">
                                                <div>Availability:</div>
                                                <div class="flex space-x-2 ml-2">
                                                    @php
                                                        $daysAbbreviations = ['M' => 'Monday', 'T' => 'Tuesday', 'W' => 'Wednesday', 'Th' => 'Thursday', 'F' => 'Friday', 'S' => 'Saturday', 'Sn' => 'Sunday'];
                                                        $availabilityDays = explode(',', optional($channel->provider->providerDetails)->availability_days);
                                                    @endphp
                                                    @if($availabilityDays)
                                                        @foreach ($availabilityDays as $day)
                                                            @php
                                                                $abbr = array_search(trim($day), $daysAbbreviations);
                                                            @endphp
                                                            <div class="day-label flex items-center justify-center w-10 h-10 border border-gray-300 rounded-full bg-gray-300">
                                                                {{ $abbr }}
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <span>No availability provided.</span>
                                                    @endif
                                                </div>
                                            </div>
                                            </div>
                                            <div class="flex items-center mt-2">
                                                <span>{{ optional($channel->provider->providerDetails)->description }}</span>
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

        <!-- Modals for Arrival, Task Start, Task Completion, Payment Confirmation, and Rating -->
        <!-- Modals similar to what you provided earlier -->

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
