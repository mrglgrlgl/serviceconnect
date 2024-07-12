<div>
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
    
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')
    
            <!-- Dashboard Bar -->
            @if (isset($dashboardbar))
                <div class="py-4">
                    {{ $dashboardbar }}
                </div>
            @endif
    
                <div>
                        {{ $slot }}
                </div>  
                </div>
    </body>
    
    </html>
{{-- @extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="mt-3 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg w-3/5">
                <div class="text-center mb-4">
                    @if ($user && $user->role == 'seeker')
                        <p class="text-lg font-bold text-green-500">You are logged in as a Seeker</p>
                    @elseif ($user && $user->role == 'authorizer')
                        <p class="text-lg font-bold text-blue-500">You are logged in as an Authorizer</p>
                    @elseif ($user && $user->role == 'provider')
                        <p class="text-lg font-bold text-purple-500">You are logged in as a Provider</p>
                    @else
                        <p class="text-lg font-bold text-gray-500">You are logged in with an unrecognized role</p>
                    @endif
                </div>

                @if ($user && $user->role == 'seeker')
                    <div>
                        <!-- Seeker-specific content goes here -->
                    </div>
                @elseif ($user && $user->role == 'authorizer')
                    <div>
                        <!-- Authorizer-specific content goes here -->
                    </div>
                @elseif ($user && $user->role == 'provider')
                    <div>
                        <!-- Provider-specific content goes here -->
                    </div>
                @else
                    <div>
                        <!-- Default content for other roles goes here -->
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection --}}
