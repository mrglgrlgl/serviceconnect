<!-- Provider Channel Blade Template -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provider Channel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        .container { margin-top: 20px; }
        .panel { margin-bottom: 20px; }
        .panel-heading { background-color: #f7f7f7; padding: 10px; border-bottom: 1px solid #ddd; }
        .panel-body { padding: 10px; }
        .btn-custom { background-color: #007bff; color: #fff; }
        .btn-custom:hover { background-color: #0056b3; color: #fff; }
    </style>
</head>
<body>
<div class="debug-output">
    <p>Task Completed: {{ $channel->is_task_completed }}</p>
    <p>Payment Status: {{ $channel->is_paid }}</p>
</div>

<div class="container">
    <div class="row">
        <!-- Service Request Details -->
        <div class="col-md-4 panel">
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
        <div class="col-md-4 panel">
            <div class="panel-heading">
                <h3>Provider Details</h3>
            </div>
            <div class="panel-body">
                <p><strong>Name:</strong> {{ $channel->provider->name }}</p>
                <p><strong>Email:</strong> {{ $channel->provider->email }}</p>
                <p><strong>Contact Number:</strong> {{ optional($channel->provider->providerDetails)->contact_number }}</p>
            </div>
        </div>

        <!-- Seeker Details -->
        <div class="col-md-4 panel">
            <div class="panel-heading">
                <h3>Seeker Details</h3>
            </div>
            <div class="panel-body">
                <p><strong>Name:</strong> {{ $channel->seeker->name }}</p>
                <p><strong>Email:</strong> {{ $channel->seeker->email }}</p>
            </div>
        </div>
    </div>

    <!-- Bid Details -->
    <div class="panel">
        <div class="panel-heading">
            <h3>Bid Details</h3>
        </div>
        <div class="panel-body">
            <p><strong>Bid Amount:</strong> {{ $channel->bid->bid_amount }}</p>
            <p><strong>Bid Description:</strong> {{ $channel->bid->bid_description }}</p>
        </div>
    </div>
    
    <!-- Task Actions -->
    <div id="task-actions" class="panel">
        <div class="panel-heading">
            <h3>Task Actions</h3>
        </div>
        <div class="panel-body">
            <button onclick="informSeekerOnTheWay()" class="btn btn-custom">Inform Seeker Provider is on the way</button>
            <button onclick="setArrived()" class="btn btn-custom">Notify Seeker Provider has Arrived</button>
            @if ($channel->is_arrived === 'true')
                @if ($channel->is_task_started === 'true')
                    @if ($channel->is_task_completed === 'true')
                        <p>Task is completed.</p>
                    @else
                        <button onclick="completeTask()" class="btn btn-custom">Complete Task</button>
                    @endif
                @else
                    <button onclick="startTask()" class="btn btn-custom">Start Task</button>
                @endif
            @else
                <p>Waiting for the seeker to confirm arrival.</p>
            @endif
        </div>
    </div>
</div>

<!-- Payment Confirmation Modal -->
<div class="modal fade" id="providerPaymentModal" tabindex="-1" role="dialog" aria-labelledby="providerPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="providerPaymentModalLabel">Confirm Payment Received</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Amount: {{ $channel->bid->bid_amount }}</p>
                <p>Confirm you have received the payment.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="confirmProviderPayment()">Confirm Payment</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    function informSeekerOnTheWay() {
        axios.post('{{ route("channel.informSeekerOnTheWay", $channel->id) }}')
            .then(response => {
                alert(response.data.message);
            })
            .catch(error => {
                console.error(error);
            });
    }

    function setArrived() {
        axios.post('{{ route("channel.setArrived", $channel->id) }}')
            .then(response => {
                alert(response.data.message);
            })
            .catch(error => {
                console.error(error);
            });
    }

    function startTask() {
        axios.post('{{ route("channel.startTask", $channel->id) }}')
            .then(response => {
                alert('Task started.');
                location.reload(); // Reload the page to update the status
            })
            .catch(error => {
                console.error(error);
            });
    }

    function completeTask() {
        axios.post('{{ route("channel.completeTask", $channel->id) }}')
            .then(response => {
                alert('Task completion notified.');
            })
            .catch(error => {
                console.error(error);
            });
    }
    function confirmProviderPayment() {
    axios.post('{{ route("channel.confirmPayment", $channel->id) }}')
        .then(response => {
            alert(response.data.message);
            $('#providerPaymentModal').modal('hide');
            location.reload(); // Refresh to reflect the changes
        })
        .catch(error => {
            console.error(error);
        });
}

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded and parsed');

    var taskCompleted = '{{ $channel->is_task_completed }}';
    var paymentStatus = '{{ $channel->is_paid }}';
    
    console.log('Task Completed:', taskCompleted);
    console.log('Payment Status:', paymentStatus);

    if (taskCompleted === 'true' && paymentStatus === 'pending') {
        console.log('Conditions met, showing payment modal');
        $('#providerPaymentModal').modal('show');
    } else {
        console.log('Conditions not met for showing payment modal');
    }
});

</script>


<!-- Include Bootstrap JS (Make sure to include it at the bottom) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
