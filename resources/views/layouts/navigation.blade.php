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
            display: flex;
            flex-direction: column; /* Added */
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
            margin-top: 1.5rem;
            color: #2793b1; /* dark blue color for contrast */
        }

        .profile-section .material-icons-round {
            font-size: 2rem;
        }

        .profile-section .username {
            font-size: 1rem;
            font-weight: 500;
        }
        
        .logout-button {
            border-top: 1px solid #e5e7eb;
            margin-top: auto; /* Pushes this section to the bottom */
            padding-top: 1rem; /* Space above the logout button */
        }
    </style>
</head>

<body>
    <aside class="flex flex-col w-64 h-screen px-5 py-8 overflow-y-auto bg-white border-r rtl:border-r-0 rtl:border-l font-open-sans text-xl">
        <div class="flex items-center pb-4">
            <a href="{{ route('agency.home') }}" class="flex items-center">
                <img class="h-16 w-auto mr-2" src="{{ asset('images/logo.png') }}" alt="Your Company">
                <img class="h-14 w-auto" src="{{ asset('images/logo-text-2.png') }}" alt="Your Company">
            </a>
        </div>

        @php
        $user = Auth::user();
        @endphp

<div class="flex-grow mt-6">
    <nav class="-mx-3 space-y-6">
        <div class="space-y-3">
            <label class="px-3 text-xs text-gray-500 uppercase">Service Requests</label>
            
            <x-nav-link href="{{ route('home') }}" icon="home" :active="request()->routeIs('home')">
                Home
            </x-nav-link>

            <x-nav-link href="{{ route('service-requests.create') }}" icon="add" :active="request()->routeIs('service-requests.create')">
                Create Request
            </x-nav-link>

            <x-nav-link href="{{ route('dashboard') }}" icon="view_list" :active="request()->routeIs('dashboard')">
                View My Requests
            </x-nav-link>
        </div>

        <div class="space-y-3">
            <label class="px-3 text-xs text-gray-500 uppercase">User</label>

            <x-nav-link href="{{ $user->role == 3 ? route('seekerprofile') : route('profile.view') }}" icon="account_circle" :active="request()->routeIs('seekerprofile') || request()->routeIs('profile.view')">
                Profile
            </x-nav-link>
        

        </div>
    </nav>
</div>



        <div class="profile-section">
            <span class="material-icons-round text-4xl">account_circle</span>
            <span class="username">{{ Auth::user()->name }}</span>
        </div>

    <div class="space-y-2">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex w-full text-left text-sm text-red-600 hover:bg-red-50 rounded-lg px-3 py-4 items-center transition-colors duration-300 transform border-t pt-4 mt-4">
                <span class="material-icons-round mr-2">logout</span> Log Out
            </button>
        </form>
    </div>
    </aside>
</body>
</html>
