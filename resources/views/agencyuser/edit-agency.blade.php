@extends('layouts.agency-dashboard')

@section('content')
<div class="container mx-auto my-10 max-w-2xl">
    <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Edit Agency Settings</h1>

    @if(isset($agency))
        <form action="{{ route('agency.settings.update') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-lg space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label for="name" class="block text-lg text-gray-700">
                    Agency Name <span class="text-red-500">*</span>
                </label>
                <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="name" name="name" value="{{ $agency->name }}" required>
            </div>

            <div class="space-y-2">
                <label for="email" class="block text-lg text-gray-700">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="email" name="email" value="{{ $agency->email }}" required>
            </div>

            <div class="space-y-2">
                <label for="phone" class="block text-lg text-gray-700">
                    Phone <span class="text-red-500">*</span>
                </label>
                <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="phone" name="phone" value="{{ $agency->phone }}" required>
            </div>

            <div class="space-y-2">
                <label for="address" class="block text-lg text-gray-700">
                    Address <span class="text-red-500">*</span>
                </label>
                <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="address" name="address" value="{{ $agency->address }}" required>
            </div>

            <div class="space-y-2">
                <label for="logo" class="block text-lg text-gray-700">
                    Agency Logo <span class="text-red-500">*</span>
                </label>
                @if($agency->logo_path)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $agency->logo_path) }}" alt="{{ $agency->name }} Logo" class="max-w-xs rounded-md shadow-sm">
                    </div>
                @endif
                <input type="file" class="mt-1 block w-full text-sm text-gray-500 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="logo" name="logo">
            </div>

            <div class="flex justify-between">

                <a href="{{ route('agency.settings') }}" class="bg-gray-300 text-gray-800 py-3 px-6 rounded-md font-semibold shadow-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Cancel
                </a>
                <button type="submit" class="bg-custom-light-blue hover:bg-gray-700 text-white py-3 px-6 rounded-md font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Save Changes
                </button>
            </div>
        </form>
    @else
        <p class="text-center text-gray-600">No agency data found.</p>
    @endif
</div>
@endsection
