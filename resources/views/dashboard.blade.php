@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h1 class="text-2xl font-bold mb-4">Authorizer Dashboard</h1>
                        <!-- Add your authorizer-specific content here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
