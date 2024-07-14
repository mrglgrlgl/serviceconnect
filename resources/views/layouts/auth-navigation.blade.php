<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar with Alpine.js</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body>
    <nav x-data="{ open: false, dropdownOpen: false }" class="bg-gray-300 border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Left Side: Logo -->
                <div class="flex items-center">
                    <div class="shrink-0">
                        <a>
                            <img class="h-8 w-auto" src="{{ asset('..\images\horizontal-logo.png') }}" alt="Your Company">
                        </a>
                    </div>
                </div>

                <!-- Right Side: Navigation Links and Settings Dropdown -->

                {{-- Create Service Request button --}}
                <div class="flex">

                    <!-- Navigation Links -->
                    <div class="hidden sm:flex space-x-4 sm:-my-px">
                        <x-nav-link class="text-slate-900" :href="route('authorizer.dashboard')" :active="request()->routeIs('authorizer/dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>

                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        @if (Auth::check())
                                <div
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ml-1">
                                </div>
                            </div>
                        @endif
                    </div>

                <x-nav-link :href="route('logout')" class="md:pl-6 text-red-500">
                    {{ __('Logout') }}
                </x-nav-link>

        <!-- Responsive Navigation Menu -->
        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </div>

            

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</body>
</html>