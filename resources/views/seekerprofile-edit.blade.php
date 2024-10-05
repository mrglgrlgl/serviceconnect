@extends('layouts.app')

@section('content')
    <div class="container mx-auto my-10 max-w-2xl">
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Edit Profile</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('seekerprofile-update') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-lg">
            @csrf
            @method('PUT')

            <div class="mb-6 flex space-x-4">
                <div class="flex-1">
                    <label for="name" class="block font-medium text-gray-700">Name<span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>
                <div class="flex-1">
                    <label for="email" class="block font-medium text-gray-700">Email<span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>
            </div>

            <div class="mb-6 flex space-x-4">
                <div class="flex-1">
                    <label for="cell_no" class="block font-medium text-gray-700">Cell Number<span class="text-red-500">*</span></label>
                    <input type="text" name="cell_no" id="cell_no" value="{{ old('cell_no', $user->cell_no) }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>
                <div class="flex-1">
                    <label for="address" class="block font-medium text-gray-700">Address<span class="text-red-500">*</span></label>
                    <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>
            </div>

           {{-- <div class="mb-6">
                <label for="profile_picture" class="block font-medium text-gray-700">Profile Picture</label>
                <input type="file" name="profile_picture" id="profile_picture"
                    class="mt-1 block w-full text-gray-500 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>--}}

            {{-- Submit Button --}}
            <div class="flex justify-center space-x-4">
                <button type="button" onclick="window.history.back()" class="bg-gray-300 text-gray-700 py-3 px-6 rounded-md font-semibold shadow-md hover:bg-gray-400 transform transition-transform duration-300 hover:scale-105 hover:shadow-xl       ">
                    Back
                </button>
                <button type="submit" class="bg-custom-lightest-blue text-white py-3 px-6 rounded-md font-semibold shadow-md transform transition-transform duration-300 hover:scale-105 hover:shadow-xl        ">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
@endsection
