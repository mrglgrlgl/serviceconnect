<x-app-layout>
        <div class="py-12">
            <div class="w-full md:w-10/12 lg:w-8/12 xl:w-8/12 2xl:w-7/12 mx-auto">
                @if ($notifications->isEmpty())
                    <div class="bg-blue-100 text-custom-light-blue p-4 rounded mb-6">
                        <p>No notifications.</p>
                    </div>
                @else
                    <ul class="list-group">
                        @foreach ($notifications as $notification)
                            <li class="list-group-item">
                                {{ $notification->data['message'] }}
                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                <form action="{{ route('notifications.read', $notification->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-link">Mark as Read</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
</x-app-layout>
