<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agency User Dashboard</title>
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

        #agency-profile-dropdown {
            background-color: transparent;
            color: #edf2f7;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
        }

        #agency-profile-dropdown:hover {
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
        #agency-sidebar {
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

        #agency-sidebar.active {
            transform: translateX(0);
        }

        #agency-sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        #agency-sidebar ul li {
            margin: 20px 0;
        }

        #agency-sidebar ul li a {
            color: #edf2f7;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }

        #agency-sidebar ul li a:hover {
            background-color: #2d3748;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div id="agency-sidebar">
        <ul>
            <li><a href="{{ route('agency.home') }}">Home</a></li>
<li><a href="{{ route('agency.employees') }}">Employee List</a></li>
<li><a href="{{ route('agency.requests') }}">Service Requests</a></li>
<li><a href="{{ route('agency.reports') }}">Reports</a></li>
<li><a href="{{ route('agency.analytics') }}">Analytics</a></li>
<li><a href="{{ route('agency.settings') }}">Agency Settings</a></li>

            <!-- Add other sidebar links here -->
        </ul>
    </div>

    <!-- Navbar -->
    <nav>
        <!-- Sidebar toggle button -->
        <button id="sidebar-toggle">
            &#9776; <!-- HTML entity for the hamburger icon -->
        </button>

        <h2>Agency Dashboard</h2>

        <div class="relative">
            <button id="agency-profile-dropdown">
                {{ Auth::guard('agency_user')->user()->name }}
            </button>
            <div id="dropdown-menu">
                <form method="POST" action="{{ route('agency.logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Additional Script for Dropdown and Sidebar Toggle -->
    <script>
        // Toggle dropdown menu
        document.getElementById('agency-profile-dropdown').addEventListener('click', function() {
            const dropdownMenu = document.getElementById('dropdown-menu');
            dropdownMenu.classList.toggle('show');
        });

        // Close the dropdown if clicked outside
        window.addEventListener('click', function(e) {
            const dropdownButton = document.getElementById('agency-profile-dropdown');
            const dropdownMenu = document.getElementById('dropdown-menu');

            if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove('show');
            }
        });

        // Toggle sidebar visibility
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('agency-sidebar');
            sidebar.classList.toggle('active');
        });
    </script>

    <!-- Yield the content -->
    <div>
        @yield('content')
    </div>
</body>
</html>
