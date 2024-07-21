<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provider Channel</title>
</head>
<body>
    <h1>Service Request Details</h1>
    <p><strong>Category:</strong> {{ $serviceRequest->category }}</p>
    <p><strong>Title:</strong> {{ $serviceRequest->title }}</p>
    <p><strong>Description:</strong> {{ $serviceRequest->description }}</p>
    <p><strong>Location:</strong> {{ $serviceRequest->location }}</p>
    <p><strong>Start Time:</strong> {{ $serviceRequest->start_time }}</p>
    <p><strong>End Time:</strong> {{ $serviceRequest->end_time }}</p>

    <h2>Seeker Details</h2>
    <p><strong>Name:</strong> {{ $seeker->name }}</p>
    <p><strong>Email:</strong> {{ $seeker->email }}</p>

    <h2>Bid Details</h2>
    <p><strong>Bid Amount:</strong> {{ $channel->bid->bid_amount }}</p>
    <p><strong>Bid Description:</strong> {{ $channel->bid->bid_description }}</p>
</body>
</html>
