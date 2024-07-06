@extends('layouts.app')

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
@endsection
