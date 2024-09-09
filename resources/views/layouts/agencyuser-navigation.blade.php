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

<aside class="flex flex-col w-64 h-screen px-5 py-8  overflow-y-auto bg-white border-r rtl:border-r-0 rtl:border-l text-xl">
    <div class="flex items-center pb-4">
        <a href="{{ route('agency.home') }}" class="flex items-center">
            <img class="h-16 w-auto mr-2" src="{{ asset('images/logo.png') }}" alt="Your Company">
            <img class="h-14 w-auto" src="{{ asset('images/logo-text-2.png') }}" alt="Your Company">
        </a>
    </div>
    

    <div class="flex-grow mt-6">
        <nav class="-mx-3 space-y-6">
            <div class="space-y-3">
                <label class="px-3 text-sm text-gray-500 uppercase dark:text-gray-400">Navigation</label>

                <x-nav-link href="{{ route('agency.home') }}" icon="home" :active="request()->routeIs('agency.home')">
                    Home
                </x-nav-link>
                
                <x-nav-link href="{{ route('agency.employees') }}" icon="groups" :active="request()->routeIs('agency.employees', 'agency.employees.edit', 'agency.employees.create')">
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

                <x-nav-link href="{{ route('agency.settings') }}" icon="settings" :active="request()->routeIs('agency.settings')">
                    Settings
                </x-nav-link>
            {{-- <div class="space-y-3 ">
                <label class="px-3 text-xs text-gray-500 uppercase dark:text-gray-400">Customization</label>


           <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-800 hover:bg-gray-300" href="{{ route('agency.settings') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
    </svg>
    <span class="mx-2 text-sm font-medium">Settings</span>
</a> --}}
                <div class="space-y-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex w-full text-left text-sm text-red-600 hover:bg-red-50 rounded-lg px-3 py-4 items-center transition-colors duration-300 transform border-t pt-4 mt-8">
                            <span class="material-icons-round mr-2">logout</span> Log Out
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
    <div class="profile-section">
        <span class="material-icons-round text-4xl">account_circle</span>
        <span class="username">{{ Auth::user()->name }}</span>
    </div>
</aside>
</body>
</html>
