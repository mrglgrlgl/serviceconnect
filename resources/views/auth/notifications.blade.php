<x-app-layout>
    <div class="py-12">
        <div class="w-full mx-auto">
            @if ($notifications->isEmpty())
                <div class="bg-blue-100 text-custom-light-blue p-4 rounded mb-6 text-center">
                    <p>No notifications.</p>
                </div>
            @else
                <ul class="list-none space-y-4">
                    @foreach ($notifications as $notification)
                        <li class="p-4 bg-white border border-gray-300 rounded-md shadow-sm flex justify-between items-center">
                            <div>
                                <p class="text-custom-default-text">{{ $notification->data['message'] }}</p>
                                <small class="text-custom-light-text">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                            <form action="{{ route('notifications.read', $notification->id) }}" method="POST" class="ml-4">
                                @csrf
                                <button type="submit" class="text-custom-light-blue hover:text-custom-dark-blue transition duration-150">
                                    Mark as Read
                                </button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>
