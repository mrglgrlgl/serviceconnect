<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<style>
    aside {
        width: 250px; /* Define a fixed width */
        position: fixed; /* Keep the sidebar fixed on the screen */
        height: 100%; /* Make sure it takes up the full height of the viewport */
        overflow-y: auto; /* Add scrolling to the sidebar if the content overflows */
        top: 0;
        left: 0;
        background-color: #fff; /* Ensure the background covers the entire sidebar */
        border-right: 1px solid #e5e7eb; /* Add a border to the right of the sidebar */
        z-index: 1000; /* Ensure the sidebar stays on top of other content */
    }

    main {
        margin-left: 250px; /* Adjust the main content's left margin to make space for the sidebar */
        flex-grow: 1; /* Allow the main content to grow and fill the space */
        padding: 20px; /* Add some padding for separation */
    }
</style>
    
<body>
    <aside class="flex flex-col w-64 h-screen px-5 py-8 overflow-y-auto bg-white border-r fixed top-0 left-0 z-50">
        <div class="flex items-center justify-center">
            @php
                $user = Auth::user();
            @endphp
    
            @if ($user->role == '3')
                <a href="{{ route('dashboard') }}">
                    <img class="w-auto h-7" src="{{ asset('images/horizontal-logo.png') }}" alt="Your Company">
                </a>
            @elseif ($user->role == '2')
                <a href="{{ route('provider.dashboard') }}">
                    <img class="w-auto h-7" src="{{ asset('images/horizontal-logo.png') }}" alt="Your Company">
                </a>
            @else
                <a href="{{ route('authorizer.dashboard') }}">
                    <img class="w-auto h-7" src="{{ asset('images/horizontal-logo.png') }}" alt="Your Company">
                </a>
            @endif
        </div>
    
        <div class="flex items-center justify-center mt-6">
            <span class="material-icons text-4xl text-gray-600">account_circle</span>
            <span class="ml-2 text-lg font-medium">{{ Auth::user()->name }}</span>
        </div>
    
        <nav class="mt-10 space-y-6">
            <div class="space-y-3">
                <label class="px-3 text-xs text-gray-500 uppercase">Service Requests</label>
                <a href="{{ route('home') }}" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 hover:text-gray-700">
                    <span class="material-icons">home</span>
                    <span class="mx-2 text-sm font-medium">Home</span>
                </a>
                <div x-data="{ serviceDropdownOpen: false }" class="relative">
                    <a href="#" @click.prevent="serviceDropdownOpen = !serviceDropdownOpen" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 hover:text-gray-700">
                        <span class="material-icons">assignment</span>
                        <span class="mx-2 text-sm font-medium">Service Requests</span>
                        <span class="material-icons">expand_more</span>
                    </a>
                    <div class="ml-8" :class="{ 'block': serviceDropdownOpen, 'hidden': !serviceDropdownOpen }" x-cloak>
                        <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-sm text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 hover:text-gray-700">View Service Requests</a>
                        <a href="{{ route('service-requests.create') }}" class="block px-3 py-2 text-sm text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 hover:text-gray-700">Create Service Request</a>
                    </div>
                </div>
                <a href="{{ route('analytics') }}" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 hover:text-gray-700">
                    <span class="material-icons">bar_chart</span>
                    <span class="mx-2 text-sm font-medium">Analytics</span>
                </a>
            </div>
    
            <div class="space-y-3">
                <label class="px-3 text-xs text-gray-500 uppercase">Other</label>
                <a href="{{ route('chat') }}" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 hover:text-gray-700">
                    <span class="material-icons">chat</span>
                    <span class="mx-2 text-sm font-medium">Chats</span>
                </a>
                <a href="{{ route('notifications.index') }}" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 hover:text-gray-700">
                    <span class="material-icons">notifications</span>
                    <span class="mx-2 text-sm font-medium">Notifications</span>
                </a>
            </div>
    
            <div class="space-y-3">
                <label class="px-3 text-xs text-gray-500 uppercase">User</label>
                <a href="{{ $user->role == 3 ? route('seekerprofile') : route('profile.view') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Become a Provider!</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                        <span class="material-icons">logout</span> Log Out
                    </button>
                </form>
            </div>
        </nav>
    </aside>
    
</body>

</html>
