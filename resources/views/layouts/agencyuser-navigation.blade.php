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
        </style>
<body>

<aside class="flex flex-col w-64 h-screen px-5 py-8 overflow-y-auto bg-white border-r rtl:border-r-0 rtl:border-l font-open-sans text-xl">
    <a href="{{ route('dashboard') }}">
        <img class="w-auto h-7" src="{{ asset('images/horizontal-logo.png') }}" alt="Your Company">
    </a>

    <div class="flex flex-col justify-between flex-1 mt-6">
        <nav class="-mx-3 space-y-6 ">
            <div class="space-y-3 ">
                <label class="px-3 text-xs text-gray-500 uppercase dark:text-gray-400">Admin</label>

                <x-nav-link href="{{ route('agency.home') }}" icon="home" :active="request()->routeIs('agency.home')">
                    Home
                </x-nav-link>
                
                <x-nav-link href="{{ route('agency.employees') }}" icon="groups" :active="request()->routeIs('agency.employees')">
                    Employee List
                </x-nav-link>
                
                <x-nav-link href="{{ route('agency.requests') }}" icon="assignment" :active="request()->routeIs('agency.requests')">
                    Service Requests
                </x-nav-link>
                
                <x-nav-link href="{{ route('agency.reports') }}" icon="bar_chart" :active="request()->routeIs('agency.reports')">
                    Reports
                </x-nav-link>
                
                <x-nav-link href="{{ route('agency.analytics') }}" icon="analytics" :active="request()->routeIs('agency.analytics')">
                    Analytics
                </x-nav-link>

            <div class="space-y-3 ">
                <label class="px-3 text-xs text-gray-500 uppercase dark:text-gray-400">Customization</label>

                <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-800 hover:bg-gray-300" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.098 19.902a3.75 3.75 0 005.304 0l6.401-6.402M6.75 21A3.75 3.75 0 013 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 003.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008z" />
                    </svg>

                    <span class="mx-2 text-sm font-medium">Themes</span>
                </a>

           <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-800 hover:bg-gray-300" href="{{ route('agency.settings') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
    </svg>
    <span class="mx-2 text-sm font-medium">Settings</span>
</a>


                <div class="space-y-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-300 hover:bg-lightest-blue">
                            <span class="material-icons">logout</span> Log Out
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
</aside>
</body>
</html>

{{-- <!DOCTYPE html>
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
/* 
        main {
            margin-left: 250px;
            flex-grow: 1;
            padding: 20px;
        } */

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
    <aside class="flex flex-col w-64 h-screen px-5 py-8 overflow-y-auto bg-white border-r rtl:border-r-0 rtl:border-l dark:border-gray-800">
        <div class="flex items-center justify-center">
            @php
                $user = Auth::user();
            @endphp

            <a href="{{ route('agency.home') }}">
                <img class="w-auto h-7" src="{{ asset('images/horizontal-logo.png') }}" alt="Your Company">
            </a>
        </div>

        <div class="profile-section">
            <span class="material-icons text-4xl">account_circle</span>
            <span class="username">{{ Auth::user()->name }}</span>
        </div>

        <nav class="mt-10 space-y-6">
            <div class="space-y-3">
                <label class="px-3 text-xs text-gray-500 uppercase">Admin</label>
                <a href="{{ route('agency.home') }}" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-lightest-blue hover:text-gray-800 hover:bg-gray-300 {{ request()->routeIs('agency.home') ? 'active-link' : '' }}">
                    <span class="material-icons">home</span>
                    <span class="mx-2 text-sm font-medium">Home</span>
                </a>
                <a href="{{ route('agency.employees') }}" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-lightest-blue hover:text-gray-800 hover:bg-gray-300 {{ request()->routeIs('agency.employees') ? 'active-link' : '' }}">
                    <span class="material-icons">groups</span>
                    <span class="mx-2 text-sm font-medium">Employee List</span>
                </a>
                <a href="{{ route('agency.requests') }}" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-lightest-blue hover:text-gray-800 hover:bg-gray-300 {{ request()->routeIs('agency.requests') ? 'active-link' : '' }}">
                    <span class="material-icons">assignment</span>
                    <span class="mx-2 text-sm font-medium">Service Requests</span>
                </a>
                <a href="{{ route('agency.reports') }}" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-lightest-blue hover:text-gray-800 hover:bg-gray-300 {{ request()->routeIs('agency.reports') ? 'active-link' : '' }}">
                    <span class="material-icons">bar_chart</span>
                    <span class="mx-2 text-sm font-medium">Reports</span>
                </a>
                <a href="{{ route('agency.analytics') }}" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-lightest-blue hover:text-gray-800 hover:bg-gray-300 {{ request()->routeIs('agency.analytics') ? 'active-link' : '' }}">
                    <span class="material-icons">analytics</span>
                    <span class="mx-2 text-sm font-medium">Analytics</span>
                </a>
            </div>

            <div class="space-y-3">
                <label class="px-3 text-xs text-gray-500 uppercase">Customization</label>
                <a href="{{ route('agency.settings') }}" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-lightest-blue hover:text-gray-800 hover:bg-gray-300 {{ request()->routeIs('agency.settings') ? 'active-link' : '' }}">
                    <span class="material-icons">settings</span>
                    <span class="mx-2 text-sm font-medium">Agency Settings</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="px-3">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-lightest-blue hover:text-gray-800 hover:bg-gray-300">
                        <span class="material-icons">logout</span>
                        <span class="mx-2 text-sm font-medium">Log Out</span>
                    </button>
                </form>
            </div>
        </nav>
    </aside>
</body>

</html> --}}
