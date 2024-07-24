<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seeker Channel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .container { margin-top: 20px; }
        .panel { margin-bottom: 20px; }
        .panel-heading { background-color: #f7f7f7; padding: 10px; border-bottom: 1px solid #ddd; }
        .panel-body { padding: 10px; }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <!-- Service Request Details -->
        <div class="col-md-6 panel">
            <div class="panel-heading">
                <h3>Service Request Details</h3>
            </div>
            <div class="panel-body">
                <p><strong>Category:</strong> {{ $channel->serviceRequest->category }}</p>
                <p><strong>Title:</strong> {{ $channel->serviceRequest->title }}</p>
                <p><strong>Description:</strong> {{ $channel->serviceRequest->description }}</p>
                <p><strong>Location:</strong> {{ $channel->serviceRequest->location }}</p>
                <p><strong>Start Time:</strong> {{ $channel->serviceRequest->start_time }}</p>
                <p><strong>End Time:</strong> {{ $channel->serviceRequest->end_time }}</p>
            </div>
        </div>

        <!-- Provider Details -->
        <div class="col-md-6 panel">
            <div class="panel-heading">
                <h3>Provider Details</h3>
            </div>
            <div class="panel-body">
                <p><strong>Name:</strong> {{ $channel->provider->name }}</p>
                <p><strong>Email:</strong> {{ $channel->provider->email }}</p>
                <p><strong>Contact Number:</strong> {{ optional($channel->provider->providerDetails)->contact_number }}</p>
            </div>
        </div>
    </div>

    <!-- Status -->
    <div class="panel">
        <div class="panel-heading">
            <h3>Status</h3>
        </div>
        <div class="panel-body">
            @if ($channel->is_on_the_way)
                <p>The provider is on the way.</p>
            @else
                <p>Waiting for the provider to be on the way.</p>
            @endif
            @if ($channel->is_arrived === 'true')
                <p>The provider has arrived.</p>
            @endif
            @if ($channel->is_task_started === 'true')
                @if ($channel->is_task_completed === 'true')
                    <p>The task has been completed.</p>
                @else
                    <p>The task is in progress.</p>
                @endif
            @endif
        </div>
    </div>

    <!-- Arrival Confirmation Modal -->
    <div class="modal fade" id="arrivalModal" tabindex="-1" role="dialog" aria-labelledby="arrivalModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="arrivalModalLabel">Confirm Provider Arrival</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>The provider has arrived. Please confirm their arrival.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="confirmArrival()">Confirm Arrival</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Task Start Confirmation Modal -->
    <div class="modal fade" id="startTaskModal" tabindex="-1" role="dialog" aria-labelledby="startTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="startTaskModalLabel">Confirm Task Start</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>The provider has marked the task as started. Please confirm if the task is indeed started.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="confirmTaskStart()">Confirm Start</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Task Completion Confirmation Modal -->
    <div class="modal fade" id="completeTaskModal" tabindex="-1" role="dialog" aria-labelledby="completeTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="completeTaskModalLabel">Confirm Task Completion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>The provider has marked the task as completed. Please confirm if the task is indeed completed.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="confirmTaskCompletion()">Confirm Completion</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Payment Confirmation</h5>
            </div>
            <div class="modal-body">
            
                <p><strong>Bid Amount:</strong> {{ $channel->bid->bid_amount }}</p>
                @if ($channel->is_paid === 'true')
                    <p>Payment has been confirmed.</p>
                @else
                    <p>Waiting for payment confirmation from the provider.</p>
                @endif
            </div>
            <div class="modal-footer">
                @if ($channel->is_paid === 'true')
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                @else
                    <button type="button" class="btn btn-primary" disabled>Waiting for Payment Confirmation</button>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('is_task_completed:', '{{ $channel->is_task_completed }}');
    console.log('is_paid:', '{{ $channel->is_paid ?? "No Data" }}');

    if ('{{ $channel->is_task_completed }}' === 'true' && '{{ $channel->is_paid }}' === 'pending') {
        console.log('Showing payment modal');
        $('#paymentModal').modal('show');
    } else {
        console.log('Conditions not met for showing payment modal');
    }
});



    document.addEventListener('DOMContentLoaded', function() {
        // Show the arrival confirmation modal if is_arrived is 'pending'
        if ('{{ $channel->is_arrived }}' === 'pending') {
            $('#arrivalModal').modal('show');
        }

        // Show the task start confirmation modal if is_task_started is 'pending'
        if ('{{ $channel->is_task_started }}' === 'pending') {
            $('#startTaskModal').modal('show');
        }

        // Show the task completion confirmation modal if is_task_completed is 'pending'
        if ('{{ $channel->is_task_completed }}' === 'pending') {
            $('#completeTaskModal').modal('show');
        }
    });

    function confirmArrival() {
        axios.post('{{ route("channel.confirmArrival", $channel->id) }}', {}, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            alert(response.data.message);
            $('#arrivalModal').modal('hide');
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
            $('#startTaskModal').modal('hide');
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
            $('#completeTaskModal').modal('hide');
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
            document.addEventListener('DOMContentLoaded', function() {
    // Show the payment confirmation modal if the task is completed and payment is pending
    if ('{{ $channel->is_task_completed }}' === 'true' && '{{ $channel->is_paid }}' === 'pending') {
        $('#paymentModal').modal('show');
    }
});

    }
</script>

<!-- Include Bootstrap JS (Make sure to include it at the bottom) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
