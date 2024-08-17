<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v3.x.x/dist/cdn.min.js" defer></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        main {
            margin-left: 250px; /* Sidebar width */
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .content-container {
            max-width: calc(100% - 250px); /* Available width minus the sidebar */
            padding: 20px; /* Add padding for separation */
            margin: auto; /* Center the content horizontally */
        }
    </style>
</head>

<body class="antialiased">
    <div class="min-h-screen bg-gray-100">

        {{-- Sidebar inclusion --}}
        @if(Auth::check())
            @if(Auth::user()->role == 1)
                @include('layouts.auth-navigation')
            @elseif(Auth::user()->role == 2 || Auth::user()->role == 3)
                @include('layouts.navigation')
            @endif
        @endif

        {{-- Main Content Area --}}
        <main>
            <div class="content-container">
                {{ $slot }}
            </div>
        </main>

    </div>
</body>

</html>
