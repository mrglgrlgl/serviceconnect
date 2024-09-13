@extends('layouts.dashboard')

@section('content')
    <div class="max-w-lg mx-auto p-6 bg-gray-800 text-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Create Agency User for {{ $agency->name }}</h2>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('agencies.users.store', $agency->id) }}" method="POST" class="space-y-6 text-gray-300">
            @csrf

            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium">Name</label>
                <input type="text" name="name" id="name" class="w-full p-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none" value="{{ old('name') }}">
            </div>

            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" class="w-full p-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none" value="{{ old('email') }}">
            </div>

            <div class="space-y-2">
                <label for="password" class="block text-sm font-medium">Password</label>
                <input type="password" name="password" id="password" class="w-full p-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div class="space-y-2">
                <label for="password_confirmation" class="block text-sm font-medium">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Create Agency User
                </button>
            </div>
        </form>
    </div>
@endsection
