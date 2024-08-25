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

        <!-- Employee Details Fields -->
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

        <!-- Bootstrap Dropdown for Assigning Services -->
        <div class="mb-4">
            <label for="services" class="block text-gray-700">Assign Services</label>
            
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle mt-1 w-full text-left" type="button" id="servicesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Select Services
                </button>
                <ul class="dropdown-menu w-full" aria-labelledby="servicesDropdown">
                    @foreach($agency->services as $service)
                        <li>
                            <label class="dropdown-item">
                                <input type="checkbox" name="services[]" value="{{ $service->id }}"
                                       {{ $employee->services->contains($service->id) ? 'checked' : '' }}>
                                {{ $service->service_name }} - {{ $service->description }}
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="btn btn-primary">Update Employee</button>
        </div>
    </form>
</div>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
