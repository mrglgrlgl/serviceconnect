<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seeker Channel</title>
</head>
<body>
    <h1>Service Request Details</h1>
    <p><strong>Category:</strong> {{ $channel->serviceRequest->category }}</p>
    <p><strong>Title:</strong> {{ $channel->serviceRequest->title }}</p>
    <p><strong>Description:</strong> {{ $channel->serviceRequest->description }}</p>
    <p><strong>Location:</strong> {{ $channel->serviceRequest->location }}</p>
    <p><strong>Start Time:</strong> {{ $channel->serviceRequest->start_time }}</p>
    <p><strong>End Time:</strong> {{ $channel->serviceRequest->end_time }}</p>

    <h2>Provider Details</h2>
    <p><strong>Name:</strong> {{ $channel->provider->name }}</p>
    <p><strong>Email:</strong> {{ $channel->provider->email }}</p>

    <h2>Seeker Details</h2>
    <p><strong>Name:</strong> {{ $channel->seeker->name }}</p>
    <p><strong>Email:</strong> {{ $channel->seeker->email }}</p>

    <h2>Bid Details</h2>
    <p><strong>Bid Amount:</strong> {{ $channel->bid->bid_amount }}</p>
    <p><strong>Bid Description:</strong> {{ $channel->bid->bid_description }}</p>
</body>
</html>
