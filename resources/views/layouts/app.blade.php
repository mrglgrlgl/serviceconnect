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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div class="min-h-screen bg-gray-100">

        {{-- Check what type of user --}}
        @if(Auth::check())
            @if(Auth::user()->role == 1)
                @include('layouts.auth-navigation')
            @elseif(Auth::user()->role == 2 || Auth::user()->role == 3)
                @include('layouts.navigation')
            @endif
        @endif

                @isset($profilepic)
                <div class=shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $profilepic }}
                    </div>
                    </>
                    @endisset
{{-- 
<div class="">
{{ $tabble }}
</div> --}}

        @if(Auth::check() && Auth::user()->role == 1)
        <div>
            {{ $tabble ?? '' }}
        </div>
        @endif


        <main>
            {{ $slot }}
        </main>

    </div>
</body>

</html>