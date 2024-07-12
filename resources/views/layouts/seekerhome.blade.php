<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class=" antialiased bg-gray-100">
    <div>
        @include('layouts.navigation')

        <div class="flex flex-col sm:justify-center pt-6 sm:pt-0 ">
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
    </div>
</body>

</html>