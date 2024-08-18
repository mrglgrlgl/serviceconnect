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

        main {
            margin-left: 250px;
            flex-grow: 1;
            padding: 20px;
        }

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

<body class="antialiased">
    <div class="min-h-screen">

        {{-- Sidebar inclusion --}}

        @include('layouts.admin_navigation')

        {{-- Main Content Area --}}
        <main>
            <div class="content-container">
                {{ $slot }}
            </div>
        </main>

    </div>
</body>

</html>
