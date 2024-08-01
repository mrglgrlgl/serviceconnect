
<nav x-data="{ open: false, signUpDropdownOpen: false }" class="border-b-gray-300 bg-gray-100 border font-open-sans">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img class="h-8 w-auto" src="{{ asset('images/horizontal-logo.png') }}" alt="Your Company">
                    </a>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Right-aligned navigation links -->
                <div class="hidden space-x-8 sm:flex font-semibold">
                    <!-- Sign up link with dropdown -->
                    <div x-data="{ signUpDropdownOpen: false }" class="relative">
                        <a href="#" @click.prevent="signUpDropdownOpen = !signUpDropdownOpen" @click.away="signUpDropdownOpen = false" class="inline-flex items-center px-2 pt-1 border-b-4 border-transparent text-gray-800 focus:outline-none transition duration-150 ease-in-out hover:border-gray-700 hover:text-gray-700">
                            {{ __('Sign Up') }}
                            <span class="material-symbols-outlined">arrow_drop_down</span>
                        </a>
                        <div x-show="signUpDropdownOpen" x-transition:enter="transition ease-out duration-100 transform" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75 transform" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5" style="display: none;">
                            <div class="py-1">
                                <a href="{{ route('register.provider') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Sign up as a Seeker
                                </a>
                                <a href="{{ route('register.provider') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Sign up as a Provider
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Login link -->
                    <a href="{{ route('login') }}" class="inline-flex items-center px-2 pt-1 border-b-4 border-transparent text-gray-800 focus:outline-none transition duration-150 ease-in-out hover:border-gray-700 hover:text-gray-700">
                        {{ __('Login') }}
                    </a>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
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
