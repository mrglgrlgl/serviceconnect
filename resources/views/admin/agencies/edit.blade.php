@extends('layouts.dashboard')

@section('content')
    <div class="max-w-lg mx-auto p-6 bg-custom-admin-secondary rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4 text-white">Edit Agency</h2>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-500 text-white rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('agencies.update', $agency->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label for="name" class="block text-white font-medium">Name</label>
                <input type="text" name="name" id="name" class="w-full p-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none" value="{{ old('name', $agency->name) }}">
            </div>

            <div class="flex space-x-4"> {{-- Flex container for email and phone --}}
                <div class="w-full space-y-2"> {{-- Email field container --}}
                    <label for="email" class="block text-white font-medium">Email</label>
                    <input type="email" name="email" id="email" class="w-full p-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none" value="{{ old('email', $agency->email) }}">
                </div>

                <div class="w-full space-y-2"> {{-- Phone field container --}}
                    <label for="phone" class="block text-white font-medium">Phone</label>
                    <input type="text" name="phone" id="phone" class="w-full p-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none" value="{{ old('phone', $agency->phone) }}">
                </div>
            </div>

            <div class="space-y-2">
                <label for="address" class="block text-white font-medium">Address</label>
                <input type="text" name="address" id="address" class="w-full p-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none" value="{{ old('address', $agency->address) }}">
            </div>

            <div class="space-y-2">
                <label for="status" class="block text-white font-medium">Status</label>
                <select name="status" id="status" class="w-full p-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="active" {{ $agency->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $agency->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div>
                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Update Agency
                </button>
            </div>
        </form>
    </div>
@endsection
