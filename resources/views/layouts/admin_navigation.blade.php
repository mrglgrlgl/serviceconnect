<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
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
</head>
<body>

<aside class="flex flex-col w-64 h-screen px-5 py-8 overflow-y-auto bg-white border-r rtl:border-r-0 rtl:border-l dark:bg-custom-admin-secondary dark:border-gray-800 font-open-sans text-xl">
        <div class="flex items-center pb-4">
            <a href="{{ route('agencies.index') }}" class="flex items-center">
                <img class="h-16 w-auto mr-2" src="{{ asset('images/logo.png') }}" alt="Your Company">
                <img class="h-14 w-auto" src="{{ asset('images/logo-text-2.png') }}" alt="Your Company">
            </a>
        </div>

    <div class="flex flex-col justify-between flex-1 mt-6">
        <nav class="-mx-3 space-y-6 ">
            <div class="space-y-3 ">
                
{{--                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700">
                    <span class="material-icons-round">home</span>
                    <span class="mx-2 text-sm font-medium">Home</span>
                </a> --}}

                <a href="{{ route('agencies.index') }}" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700">
                    <span class="material-icons-round">dashboard</span>
                    <span class="mx-2 text-sm font-medium">Dashboard</span>
                </a>
            </div>

            <div class="space-y-3 ">

<a href="{{ route('admin.psajobs.index') }}" class="flex items-center ...">
                    <span class="material-icons-round">services</span>
                    <span class="mx-2 text-sm font-medium">Services</span>
                </a>
            </div>

            <div class="space-y-3 ">
{{--             <label class="px-3 text-xs text-gray-500 uppercase dark:text-gray-400">Customization</label> --}}


                <div class="space-y-3 flex items-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full flex items-center text-left px-4 py-2 text-sm text-red-300 hover:bg-lightest-blue">
                            <span class="material-icons-round">logout</span> Log Out
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
    <title>Administrator</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Tailwind CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito Sans', sans-serif;
            background-color: #f4f6f8;
        }

        nav {
            background-color: #1a202c;
            color: #edf2f7;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h2 {
            color: #edf2f7;
            font-weight: 700;
            font-size: 1.5rem;
            margin: 0;
        }

        #admin-profile-dropdown {
            background-color: transparent;
            color: #edf2f7;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
        }

        #admin-profile-dropdown:hover {
            background-color: #2d3748;
        }

        #dropdown-menu {
            background-color: #ffffff;
            color: #1a202c;
            border-radius: 0.375rem;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
            display: none;
            position: absolute;
            right: 0;
            top: 60px;
            z-index: 1000;
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        #dropdown-menu.show {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        #dropdown-menu a,
        #dropdown-menu button {
            color: #1a202c;
            padding: 0.75rem 1rem;
            display: block;
            text-decoration: none;
            transition: background-color 0.3s ease;
            width: 100%;
            text-align: left;
        }

        #dropdown-menu a:hover,
        #dropdown-menu button:hover {
            background-color: #f7fafc;
        }

        #sidebar-toggle {
            background-color: transparent;
            color: #edf2f7;
            border: none;
            cursor: pointer;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        #sidebar-toggle:hover {
            color: #a0aec0;
        }

        /* Sidebar Styles */
        #admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #1a202c;
            color: #edf2f7;
            transform: translateX(-250px);
            transition: transform 0.3s ease;
            z-index: 1000;
            padding-top: 60px; /* Add space for the navbar */
        }

        #admin-sidebar.active {
            transform: translateX(0);
        }

        #admin-sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        #admin-sidebar ul li {
            margin: 20px 0;
        }

        #admin-sidebar ul li a {
            color: #edf2f7;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }

        #admin-sidebar ul li a:hover {
            background-color: #2d3748;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div id="admin-sidebar">
        <ul>
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('agencies.index') }}">Agencies</a></li>
            <!-- Add other sidebar links here -->
        </ul>
    </div>

    <!-- Navbar -->
    <nav>
        <!-- Sidebar toggle button -->
        <button id="sidebar-toggle">
            &#9776; <!-- HTML entity for the hamburger icon -->
        </button>

        <h2>Admin Dashboard</h2>

        <div class="relative">
            <button id="admin-profile-dropdown">
                {{ Auth::guard('admin_user')->user()->name }}
            </button>
            <div id="dropdown-menu">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Additional Script for Dropdown and Sidebar Toggle -->
    <script>
        // Toggle dropdown menu
        document.getElementById('admin-profile-dropdown').addEventListener('click', function() {
            const dropdownMenu = document.getElementById('dropdown-menu');
            dropdownMenu.classList.toggle('show');
        });

        // Close the dropdown if clicked outside
        window.addEventListener('click', function(e) {
            const dropdownButton = document.getElementById('admin-profile-dropdown');
            const dropdownMenu = document.getElementById('dropdown-menu');

            if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove('show');
            }
        });

        // Toggle sidebar visibility
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('admin-sidebar');
            sidebar.classList.toggle('active');
        });
    </script>

    <!-- Yield the content -->
    <div>
        @yield('content')
    </div>
</body>
</html> --}}
