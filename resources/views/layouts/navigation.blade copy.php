{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        .nav-link,
        .nav-link-dropdown {
            padding: 0.75rem 1rem;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            color: #333;
            border-bottom: 4px solid transparent;
            transition: border-color 0.3s ease, color 0.3s ease;
        }

        .nav-link:hover,
        .nav-link-dropdown:hover {
            color: #00aaff;
            border-bottom: 4px solid #00aaff;
        }

        .nav-link-active {
            border-bottom: 4px solid #00aaff;
            color: #00aaff;
        }

        .nav-link-dropdown svg {
            margin-left: 4px;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            left: 0;
            top: 100%;
            margin-top: 0.5rem;
            width: 12rem;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 0.25rem;
            z-index: 1000;
        }

        .dropdown-menu.show {
            display: block;
        }
    </style>
</head>

<body>
    <nav class="bg-gray-100 border-b border-gray-300 font-open-sans text-md font-semibold">
        <div class="container mx-auto px-4">
            <div class="flex justify-between h-16 items-center">
                @php
                    $user = Auth::user();
                @endphp

                <!-- Left Side: Logo -->
                @if ($user->role == '3')
                    <div class="flex items-center">
                        <a href="{{ route('dashboard') }}">
                            <img class="h-8 w-auto" src="{{ asset('images/horizontal-logo.png') }}" alt="Your Company">
                        </a>
                    </div>
                @elseif ($user->role == '2')
                    <div class="flex items-center">
                        <a href="{{ route('provider.dashboard') }}">
                            <img class="h-8 w-auto" src="{{ asset('images/horizontal-logo.png') }}" alt="Your Company">
                        </a>
                    </div>
                @else
                    <div class="flex items-center">
                        <a href="{{ route('authorizer.dashboard') }}">
                            <img class="h-8 w-auto" src="{{ asset('images/horizontal-logo.png') }}" alt="Your Company">
                        </a>
                    </div>
                @endif
                <!-- Right Side: Navigation Links and User Info -->
                <div class="flex items-center space-x-4">
                    @php
                        $user = Auth::user();
                        if ($user) {
                            $borderColor =
                                $user->role == '3' ? 'border-custom-lightest-blue' : 'border-custom-light-blue';
                            $hoverBorderColor =
                                $user->role == '3'
                                    ? 'hover:border-custom-lightestblue-accent'
                                    : 'hover:border-custom-light-blue';
                            $activeTextColor =
                                $user->role == '3' ? 'text-custom-lightest-blue' : 'text-custom-light-blue';
                            $hoverTextColor =
                                $user->role == '3' ? 'hover:text-cyan-600' : 'hover:text-custom-light-blue';
                        } else {
                            // Default styles for guests
                            $borderColor = 'border-gray-500';
                            $hoverBorderColor = 'hover:border-gray-400';
                            $activeTextColor = 'text-gray-900';
                            $hoverTextColor = 'hover:text-gray-600';
                        }
                    @endphp

                <!-- Navigation Links -->
                @if ($user->role == '3')
                    <a href="{{ route('home') }}" class="inline-flex items-center px-2 pt-1 border-b-4 {{ request()->routeIs('home') ? $borderColor . ' ' . $activeTextColor : 'border-transparent text-gray-800' }} focus:outline-none transition duration-150 ease-in-out {{ $hoverTextColor }} {{ $hoverBorderColor }}">
                        Home
                    </a>
                    <div x-data="{ serviceDropdownOpen: false }" class="relative font-normal">
                        <a href="#" class="inline-flex items-center px-2 pt-1 border-b-4 {{ request()->routeIs('dashboard') || request()->routeIs('service-requests.create') ? $borderColor . ' ' . $activeTextColor : 'border-transparent text-gray-800' }} focus:outline-none transition duration-150 ease-in-out {{ $hoverTextColor }} {{ $hoverBorderColor }}" 
                           @click.prevent="serviceDropdownOpen = !serviceDropdownOpen">
                            Service Requests
                            <span class="material-icons">expand_more</span>
                        </a>
                        <div class="dropdown-menu" :class="{ 'show': serviceDropdownOpen }" x-cloak>
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">View Service Requests</a>
                            <a href="{{ route('service-requests.create') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Create Service Request</a>
                        </div>
                    </div>
                @elseif ($user->role == '2')
                    <a href="{{ route('provider.dashboard') }}" class="inline-flex items-center px-2 pt-1 border-b-4 {{ request()->routeIs('provider.dashboard') || request()->routeIs('provider.myrequests') ? $borderColor . ' ' . $activeTextColor : 'border-transparent text-gray-800' }} focus:outline-none transition duration-150 ease-in-out {{ $hoverTextColor }} {{ $hoverBorderColor }}">
                        Service Request
                    </a>
                @endif
                
                <!-- Chat and Notifications Icons -->
                <a href="{{ route('provider.chats') }}" class="inline-flex items-center px-2 pt-1 border-b-4 {{ request()->routeIs('chat') ? $borderColor . ' ' . $activeTextColor : 'border-transparent text-gray-800' }} focus:outline-none transition duration-150 ease-in-out {{ $hoverTextColor }} {{ $hoverBorderColor }}">
                    <span class="material-icons">chat</span>
                </a>
                <a href="{{ route('notifications.index') }}" class="inline-flex items-center px-2 pt-1 border-b-4 {{ request()->routeIs('notifications.index') ? $borderColor . ' ' . $activeTextColor : 'border-transparent text-gray-800' }} focus:outline-none transition duration-150 ease-in-out {{ $hoverTextColor }} {{ $hoverBorderColor }}">
                    <span class="material-icons">notifications</span>
                </a>


                    <!-- User Dropdown -->
                    <div x-data="{ userDropdownOpen: false }" class="relative">
                        <button @click="userDropdownOpen = !userDropdownOpen" @click.away="userDropdownOpen = false" type="button" 
                                class="inline-flex w-full justify-center gap-x-1.5 rounded-md px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-cyan-800
                                {{ Auth::user()->role == 3 ? 'bg-custom-lightest-blue' : (Auth::user()->role == 2 ? 'bg-custom-light-blue' : 'bg-white') }}" 
                                id="menu-button" aria-expanded="true" aria-haspopup="true">
                            {{ Auth::user()->name }}
                            <span class="material-icons ml-2">account_circle</span>
                            <span class="material-symbols-outlined">arrow_drop_down</span>
                        </button>
                        <!-- Dropdown Menu -->
                        <div x-show="userDropdownOpen" x-transition:enter="transition ease-out duration-100 transform"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75 transform"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            <div class="py-1" role="none">
                                <a href="{{ $user->role == 3 ? route('seekerprofile') : route('profile.view') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                                    tabindex="-1" id="menu-item-0">Profile</a>
                                    
                                <a href=""
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                                    tabindex="-1" id="menu-item-1">Become a Provider!</a>
                                <form method="POST" action="{{ route('logout') }}" role="none">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem" tabindex="-1" id="menu-item-3">Log Out</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </nav>
</body>

</html> --}}

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
    <aside class="flex flex-col w-64 h-screen px-5 py-8 overflow-y-auto bg-white border-r">
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

        <div class="flex flex-col justify-between flex-1 mt-6">
            <nav class="-mx-3 space-y-6">
                <div class="space-y-3">
                    <label class="px-3 text-xs text-gray-500 uppercase">Service Requests</label>
                    @if ($user->role == '3')
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
                    @elseif ($user->role == '2')
                        <a href="{{ route('provider.dashboard') }}" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 hover:text-gray-700">
                            <span class="material-icons">assignment</span>
                            <span class="mx-2 text-sm font-medium">Service Request</span>
                        </a>
                    @endif
                </div>

                <div class="space-y-3">
                    <label class="px-3 text-xs text-gray-500 uppercase">Other</label>
                    <a href="{{ route('provider.chats') }}" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 hover:text-gray-700">
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
                    <div x-data="{ userDropdownOpen: false }" class="relative">
                        <button @click="userDropdownOpen = !userDropdownOpen" @click.away="userDropdownOpen = false" type="button"
                                class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 hover:text-gray-700">
                            <span class="material-icons">account_circle</span>
                            <span class="mx-2 text-sm font-medium">{{ Auth::user()->name }}</span>
                            <span class="material-icons">expand_more</span>
                        </button>
                        <div class="ml-8" x-show="userDropdownOpen" x-transition:enter="transition ease-out duration-100 transform"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75 transform"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="block mt-2 w-48 bg-white shadow-lg rounded-lg">
                            <a href="{{ $user->role == 3 ? route('seekerprofile') : route('profile.view') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Become a Provider!</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log Out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </aside>
</body>

</html>
