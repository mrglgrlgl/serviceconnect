@extends('layouts.agencyuser-navigation')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Edit Employee</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('agency.employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="block mt-1 w-full" value="{{ old('name', $employee->name) }}">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="block mt-1 w-full" value="{{ old('email', $employee->email) }}">
        </div>
        <div class="mb-4">
            <label for="phone" class="block text-gray-700">Phone</label>
            <input type="text" name="phone" id="phone" class="block mt-1 w-full" value="{{ old('phone', $employee->phone) }}">
        </div>
        <div class="mb-4">
            <label for="position" class="block text-gray-700">Position</label>
            <input type="text" name="position" id="position" class="block mt-1 w-full" value="{{ old('position', $employee->position) }}">
        </div>
        <div class="mb-4">
            <label for="gender" class="block text-gray-700">Gender</label>
            <select name="gender" id="gender" class="block mt-1 w-full">
                <option value="male" {{ old('gender', $employee->gender) == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender', $employee->gender) == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('gender', $employee->gender) == 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="birthdate" class="block text-gray-700">Birthdate</label>
            <input type="date" name="birthdate" id="birthdate" class="block mt-1 w-full" value="{{ old('birthdate', $employee->birthdate) }}">
        </div>
        <div class="mb-4">
            <label for="photo" class="block text-gray-700">Photo</label>
            <input type="file" name="photo" id="photo" class="block mt-1 w-full">
            @if ($employee->photo)
                <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}" width="100" class="mt-2">
            @endif
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Update Employee</button>
        </div>
    </form>
</div>
@endsection
