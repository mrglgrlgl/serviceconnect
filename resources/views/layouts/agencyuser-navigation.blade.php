<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
            color: #204860; /* dark blue color for contrast */
        }

        .profile-section .material-icons-round {
            font-size: 2rem;
        }

        .profile-section .username {
            font-size: 1rem;
            font-weight: 500;
        }
        </style>
<body>


<aside class="flex flex-col w-64 h-screen px-5 py-8 overflow-y-auto bg-white border-r rtl:border-r-0 rtl:border-l text-xl">
    <div class="flex items-center pb-4">
        <a href="{{ route('agency.home') }}" class="flex items-center">
            <img class="h-16 w-auto mr-2" src="{{ asset('images/logo.png') }}" alt="Your Company">
            <img class="h-14 w-auto" src="{{ asset('images/logo-text-2.png') }}" alt="Your Company">
        </a>
    </div>

    <div class="flex-grow mt-6">
        <nav class="-mx-3 space-y-6">
            @if(Auth::user()->agency->status === 'active')
                <div class="space-y-3">
                    <label class="px-3 text-sm text-gray-500 uppercase dark:text-gray-400">Navigation</label>

                    <x-nav-link href="{{ route('agency.analytics') }}" icon="home" :active="request()->routeIs('agency.analytics')">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link href="{{ route('agency.employees') }}" icon="groups" :active="request()->routeIs('agency.employees', 'agency.employees.edit', 'agency.employees.create')">
                        Employee List
                    </x-nav-link>

                    <x-nav-link href="{{ route('agency.requests') }}" icon="assignment" :active="request()->routeIs('agency.requests')">
                        Service Requests
                    </x-nav-link>

{{--                <x-nav-link href="{{ route('agency.reports') }}" icon="bar_chart" :active="request()->routeIs('agency.reports')">
                        Reports
                    </x-nav-link> --}}

{{--                    <x-nav-link href="{{ route('agency.analytics') }}" icon="analytics" :active="request()->routeIs('agency.analytics')">
                        Analytics
                    </x-nav-link> --}}
                    
                   <x-nav-link href="{{ route('agency.feedback') }}" icon="reviews" :active="request()->routeIs('agency.feedback')">
                        Feedback
                    </x-nav-link>

                    <x-nav-link href="{{ route('agency.settings') }}" icon="settings" :active="request()->routeIs('agency.settings')">
                        Settings
                    </x-nav-link>
                    
                </div>
            @else
                <p class="text-red-500 px-3 py-2">Your agency is inactive. Navigation is restricted.</p>
            @endif
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
