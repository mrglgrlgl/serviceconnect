<!DOCTYPE html>
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
            /* Adjusted padding to align borders */
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            color: #333;
            border-bottom: 4px solid transparent;
            /* Adjusted to 4px for clearer visibility */
            transition: border-color 0.3s ease, color 0.3s ease;
        }

        .nav-link:hover,
        .nav-link-dropdown:hover {
            color: #00aaff;
            border-bottom: 4px solid #00aaff;
            /* Ensure hover effect matches active state */
        }

        .nav-link-active {
            border-bottom: 4px solid #00aaff;
            /* Active state border */
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
    <nav class="bg-gray-100 border-b border-gray-300 font-open-sans text-md">
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
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center px-2 pt-1 border-b-4 {{ request()->routeIs('home') ? $borderColor . ' ' . $activeTextColor : 'border-transparent text-gray-800' }} focus:outline-none transition duration-150 ease-in-out {{ $hoverTextColor }} {{ $hoverBorderColor }}">
                            Home
                        </a>
                        <div x-data="{ serviceDropdownOpen: false }" class="relative">
                            <a href="#"
                                class="inline-flex items-center px-2 pt-1 border-b-4 {{ request()->routeIs('dashboard') || request()->routeIs('service-requests.create') ? $borderColor . ' ' . $activeTextColor : 'border-transparent text-gray-800' }} focus:outline-none transition duration-150 ease-in-out {{ $hoverTextColor }} {{ $hoverBorderColor }}"
                                @click.prevent="serviceDropdownOpen = !serviceDropdownOpen">
                                Service Requests
                                <span class="material-icons">expand_more</span>
                            </a>
                            <div class="dropdown-menu" :class="{ 'show': serviceDropdownOpen }" x-cloak>
                                <a href="{{ route('dashboard') }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100">View Service Requests</a>
                                <a href="{{ route('service-requests.create') }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Create Service Request</a>
                            </div>
                        </div>
                    @elseif ($user->role == '2')
                        <a href="{{ route('provider.dashboard') }}"
                            class="inline-flex items-center px-2 pt-1 border-b-4 {{ request()->routeIs('provider.dashboard') ? $borderColor . ' ' . $activeTextColor : 'border-transparent text-gray-800' }} focus:outline-none transition duration-150 ease-in-out {{ $hoverTextColor }} {{ $hoverBorderColor }}">
                            Service Request
                        </a>
                    @endif

                    <!-- Chat and Notifications Icons -->
                    <a href="{{ route('chat') }}"
                        class="inline-flex items-center px-2 pt-1 border-b-4 {{ request()->routeIs('chat') ? $borderColor . ' ' . $activeTextColor : 'border-transparent text-gray-800' }} focus:outline-none transition duration-150 ease-in-out {{ $hoverTextColor }} {{ $hoverBorderColor }}">
                        <span class="material-icons">chat</span>
                    </a>
                    <a href="{{ route('notifications.index') }}"
                        class="inline-flex items-center px-2 pt-1 border-b-4 {{ request()->routeIs('notifications.index') ? $borderColor . ' ' . $activeTextColor : 'border-transparent text-gray-800' }} focus:outline-none transition duration-150 ease-in-out {{ $hoverTextColor }} {{ $hoverBorderColor }}">
                        <span class="material-icons">notifications</span>
                    </a>


                    <!-- User Dropdown -->
                    <div x-data="{ userDropdownOpen: false }" class="relative">
                        <button @click="userDropdownOpen = !userDropdownOpen" @click.away="userDropdownOpen = false"
                            type="button"
                            class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                            id="menu-button" aria-expanded="true" aria-haspopup="true">
                            {{ Auth::user()->name }}
                            <span class="material-icons ml-2">account_circle</span>
                        </button>
                        <!-- Dropdown Menu -->
                        <div x-show="userDropdownOpen" x-transition:enter="transition ease-out duration-100 transform"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75 transform"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            <div class="py-1" role="none">
                                <a href="{{ route('profile.view') }}"
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

</html>
