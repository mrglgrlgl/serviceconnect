@extends('layouts.agency-dashboard')

@section('content')
    <div class="max-w-4xl mx-auto p-4 bg-gray-800 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4 text-white">Edit Agency User for {{ $agency->name }}</h2>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-500 text-white rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('agencies.users.update', [$agency->id, $user->id]) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="space-y-2">
                <label for="name" class="block text-white font-medium">Name</label>
                <input type="text" name="name" id="name" class="w-full p-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none" value="{{ old('name', $user->name) }}">
            </div>

            <div class="space-y-2">
                <label for="email" class="block text-white font-medium">Email</label>
                <input type="email" name="email" id="email" class="w-full p-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none" value="{{ old('email', $user->email) }}">
            </div>

            <div class="space-y-2">
                <label for="password" class="block text-white font-medium">Password</label>
                <input type="password" name="password" id="password" class="w-full p-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <small class="text-gray-400">Leave blank if you don't want to change the password</small>
            </div>

            <div class="space-y-2">
                <label for="password_confirmation" class="block text-white font-medium">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Update Agency User
                </button>
            </div>
        </form>
    </div>
@endsection
