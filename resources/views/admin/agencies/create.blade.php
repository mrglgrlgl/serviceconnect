@extends('layouts.agency-dashboard')

@section('content')
    <div class="max-w-lg mx-auto p-6 bg-gray-800 text-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Create Agency</h2>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('agencies.store') }}" method="POST" class="space-y-6">
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
                <label for="phone" class="block text-sm font-medium">Phone</label>
                <input type="text" name="phone" id="phone" class="w-full p-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none" value="{{ old('phone') }}">
            </div>

            <div class="space-y-2">
                <label for="address" class="block text-sm font-medium">Address</label>
                <input type="text" name="address" id="address" class="w-full p-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none" value="{{ old('address') }}">
            </div>

            <div class="space-y-2">
                <label for="status" class="block text-sm font-medium">Status</label>
                <select name="status" id="status" class="w-full p-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div>
                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Create Agency
                </button>
            </div>
        </form>
    </div>
@endsection
