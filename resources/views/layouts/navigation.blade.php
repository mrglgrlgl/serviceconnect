<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        aside {
            width: 250px;
            position: fixed;
            height: 100%;
            overflow-y: auto;
            top: 0;
            left: 0;
            background-color: #fff;
            border-right: 1px solid #e5e7eb;
            z-index: 1000;
        }

        main {
            margin-left: 250px;
            flex-grow: 1;
            padding: 20px;
        }

        .active-link {
            background-color: #ebf8ff; /* lightest-blue */
            color: #2c5282; /* dark blue for contrast */
        }

        .profile-section {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding-left: 1.25rem;
            margin-top: 1.5rem;
            color: #2c5282; /* dark blue color for contrast */
        }

        .profile-section .material-icons {
            font-size: 2rem;
        }

        .profile-section .username {
            font-size: 1rem;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <aside class="flex flex-col w-64 h-screen px-5 py-8 overflow-y-auto bg-white border-r fixed top-0 left-0 z-50">
        <div class="flex items-center justify-center">
            @php
                $user = Auth::user();
            @endphp

                <a href="{{ route('dashboard') }}">
                    <img class="w-auto h-7" src="{{ asset('images/horizontal-logo.png') }}" alt="Your Company">
                </a>

        </div>

        <div class="profile-section">
            <span class="material-icons text-4xl">account_circle</span>
            <span class="username">{{ Auth::user()->name }}</span>
        </div>

        <nav class="mt-10 space-y-6">
            <div class="space-y-3">
                <label class="px-3 text-xs text-gray-500 uppercase">Service Requests</label>
                <a href="{{ route('home') }}" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-lightest-blue hover:text-gray-700 hover:bg-gray-200 {{ request()->routeIs('home') ? 'active-link' : '' }}">
                    <span class="material-icons">home</span>
                    <span class="mx-2 text-sm font-medium">Home</span>
                </a>
                <div x-data="{ serviceDropdownOpen: localStorage.getItem('serviceDropdownOpen') === 'true' }" class="relative">
                    <a href="#" @click.prevent="serviceDropdownOpen = !serviceDropdownOpen; localStorage.setItem('serviceDropdownOpen', serviceDropdownOpen)" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-lightest-blue hover:text-gray-700 {{ request()->routeIs('dashboard') || request()->routeIs('service-requests.create') ? 'active-link' : '' }}">
                        <span class="material-icons">assignment</span>
                        <span class="mx-2 text-sm font-medium">Service Requests</span>
                        <span class="material-icons">expand_more</span>
                    </a>
                    <div class="ml-8" :class="{ 'block': serviceDropdownOpen, 'hidden': !serviceDropdownOpen }" x-cloak>
                        <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-sm text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-lightest-blue hover:text-gray-700 hover:bg-gray-200 {{ request()->routeIs('dashboard') ? 'active-link' : '' }}">View Service Requests</a>
                        <a href="{{ route('service-requests.create') }}" class="block px-3 py-2 text-sm text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-lightest-blue hover:text-gray-700 hover:bg-gray-200{{ request()->routeIs('service-requests.create') ? 'active-link' : '' }}">Create Service Request</a>
                    </div>
                </div>
                <a href="{{ route('analytics') }}" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-lightest-blue hover:text-gray-700 hover:bg-gray-200{{ request()->routeIs('analytics') ? 'active-link' : '' }}">
                    <span class="material-icons">bar_chart</span>
                    <span class="mx-2 text-sm font-medium">Analytics</span>
                </a>
            </div>

            <div class="space-y-3">
                <label class="px-3 text-xs text-gray-500 uppercase">Other</label>
                <a href="{{ route('chat') }}" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-lightest-blue hover:text-gray-700 hover:bg-gray-200{{ request()->routeIs('chat') ? 'active-link' : '' }}">
                    <span class="material-icons">chat</span>
                    <span class="mx-2 text-sm font-medium">Chats</span>
                </a>
                <a href="{{ route('notifications.index') }}" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-lightest-blue hover:text-gray-700 hover:bg-gray-200{{ request()->routeIs('notifications.index') ? 'active-link' : '' }}">
                    <span class="material-icons">notifications</span>
                    <span class="mx-2 text-sm font-medium">Notifications</span>
                </a>
            </div>

            <div class="space-y-3">
                <label class="px-3 text-xs text-gray-500 uppercase">User</label>
                <a href="{{ $user->role == 3 ? route('seekerprofile') : route('profile.view') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-lightest-blue {{ request()->routeIs('seekerprofile') || request()->routeIs('profile.view') ? 'active-link' : '' }}">Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-lightest-blue">Become a Provider!</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-lightest-blue">
                        <span class="material-icons">logout</span> Log Out
                    </button>
                </form>
            </div>
        </nav>
    </aside>
</body>

</html>
