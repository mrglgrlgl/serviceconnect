@extends('layouts.agency-dashboard')

@section('content')
<div class="container mx-auto my-10 max-w-2xl">
    <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Create a New Service</h1>

    <form action="{{ route('agencies.services.store', $agency->id) }}" method="POST" class="bg-white p-8 rounded-lg shadow-lg space-y-6">
        @csrf

        <div class="space-y-2">
            <label for="service_name" class="block text-lg text-gray-700">
                Service Name <span class="text-red-500">*</span>
            </label>
            <input type="text" name="service_name" id="service_name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div class="space-y-2">
            <label for="description" class="block text-lg text-gray-700">
                Description <span class="text-red-500">*</span>
            </label>
            <textarea name="description" id="description" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" rows="4"></textarea>
        </div>

        <div class="flex justify-center space-x-4">
            <button type="button" onclick="history.back()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-3 px-6 rounded-md font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-gray-500">
                Cancel
            </button>
            <button type="submit" class="bg-custom-agency-secondary hover:bg-gray-700 text-white py-3 px-6 rounded-md font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                Create Service
            </button>
        </div>
    </form>
</div>
@endsection
