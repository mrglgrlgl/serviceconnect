<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
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

        .profile-section {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding-left: 1.25rem;
            margin-top: 1.5rem;
            color: #2c5282; /* dark blue color for contrast */
        }

        .profile-section .material-icons-round {
            font-size: 2rem;
        }

        .profile-section .username {
            font-size: 1rem;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <aside class="flex flex-col w-64 h-screen px-5 py-8 overflow-y-auto bg-white border-r rtl:border-r-0 rtl:border-l font-open-sans text-xl">
        <div class="flex items-center justify-center">
            <a href="{{ route('dashboard') }}">
                <img class="w-auto h-7" src="{{ asset('images/horizontal-logo.png') }}" alt="Your Company">
            </a>
        </div>

        @php
        $user = Auth::user();
    @endphp

        <div class="profile-section">
            <span class="material-icons-round text-4xl">account_circle</span>
            <span class="username">{{ Auth::user()->name }}</span>
        </div>

        <div class="flex flex-col justify-between flex-1 mt-6">
            <nav class="-mx-3 space-y-6">
                <div class="space-y-3">
                    <label class="px-3 text-xs text-gray-500 uppercase">Service Requests</label>
                    
                    <x-nav-link href="{{ route('home') }}" icon="home" :active="request()->routeIs('home')">
                        Home
                    </x-nav-link>

                    <x-nav-link href="{{ route('service-requests.create') }}" icon="add" :active="request()->routeIs('service-requests.create')">
                        Create Service Request
                    </x-nav-link>

                    <x-nav-link href="{{ route('dashboard') }}" icon="view_list" :active="request()->routeIs('dashboard')">
                        View Service Requests
                    </x-nav-link>

                </div>

                <div class="space-y-3">
                    <label class="px-3 text-xs text-gray-500 uppercase">Other</label>
                    
                    <x-nav-link href="{{ route('notifications.index') }}" icon="notifications" :active="request()->routeIs('notifications.index')">
                        Notifications
                    </x-nav-link>

                    <x-nav-link href="{{ route('chat') }}" icon="chat" :active="request()->routeIs('chat')">
                        Chats
                    </x-nav-link>
                </div>

                <div class="space-y-3">
                    <label class="px-3 text-xs text-gray-500 uppercase">User</label>
                    
                    <x-nav-link href="{{ $user->role == 3 ? route('seekerprofile') : route('profile.view') }}" icon="account_circle" :active="request()->routeIs('seekerprofile') || request()->routeIs('profile.view')">
                        Profile
                    </x-nav-link>

                    <x-nav-link href="{{ route('analytics') }}" icon="bar_chart" :active="request()->routeIs('analytics')">
                        Analytics
                    </x-nav-link>
                           
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-lightest-blue">
                            <span class="material-icons-round">logout</span> Log Out
                        </button>
                    </form>
                </div>
            </nav>
        </div>
    </aside>
</body>

</html>
