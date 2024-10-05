@extends('layouts.app')

@section('content')
    <div class="mt-3 md:px-12 py-6 bg-white shadow-md sm:rounded-lg w-full md:w-4/5 mx-auto">
        <h2 class="text-2xl font-semibold mb-4">Edit Profile</h2>

        {{-- Profile Edit Form --}}
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="w-full">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Name --}}
                <div>
                    <label for="name" class="block text-gray-700 font-bold">Name:</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                        class="form-control w-full" required>
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-gray-700 font-bold">Email:</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                        class="form-control w-full" required>
                </div>

                {{-- Cell Number --}}
                <div>
                    <label for="cell_no" class="block text-gray-700 font-bold">Cell Number:</label>
                    <input type="text" name="cell_no" id="cell_no" value="{{ old('cell_no', $user->cell_no) }}"
                        class="form-control w-full" required>
                </div>

                {{-- Address --}}
                <div>
                    <label for="address" class="block text-gray-700 font-bold">Address:</label>
                    <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}"
                        class="form-control w-full" required>
                </div>

                {{-- Profile Picture --}}
                <div>
                    <label for="profile_picture" class="block text-gray-700 font-bold">Profile Picture:</label>
                    <input type="file" name="profile_picture" id="profile_picture" class="form-control w-full">
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
@endsection
