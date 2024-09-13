@extends('layouts.app')

@section('content')
    <div class="mt-3 md:px-12 py-6 bg-white shadow-md sm:rounded-lg w-full md:w-4/5 mx-auto">
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('POST') <!-- Method spoofing for POST requests -->
            <!-- Add your form fields here -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
            </div>

            <!-- Add more fields as needed -->

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
                    Update Profile
                </button>
            </div>
        </form>
    </div>
@endsection
