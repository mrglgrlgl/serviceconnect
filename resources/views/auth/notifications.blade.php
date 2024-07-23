<x-app-layout>
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
</x-app-layout>
