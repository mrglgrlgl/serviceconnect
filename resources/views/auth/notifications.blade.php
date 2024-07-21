<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Your Notifications</h1>
    @if($notifications->isEmpty())
        <p>No notifications.</p>
    @else
        <ul class="list-group">
            @foreach ($notifications as $notification)
                <li class="list-group-item">
                    {{ $notification->data['message'] }}
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    <form action="{{ route('notifications.read', $notification->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-link">Mark as Read</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
</div>
</body>
</html>
