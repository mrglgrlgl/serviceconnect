@extends('layouts.agency-dashboard')

@section('content')
<div class="container mx-auto my-10 max-w-2xl">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Edit Employee</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
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
           <!-- Employee Details Fields -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="name" class="block text-lg text-gray-700">Name
            <span class="text-red-500">*</span>
        </label>
        <input type="text" name="name" id="name" 
            class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
            value="{{ old('name', $employee->name) }}"
            {{ $employee->is_archived ? 'disabled' : '' }}>
    </div>
    <div>
        <label for="email" class="block text-lg text-gray-700">Email
            <span class="text-red-500">*</span></label>
        <input type="email" name="email" id="email" 
            class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
            value="{{ old('email', $employee->email) }}"
            {{ $employee->is_archived ? 'disabled' : '' }}>
    </div>
    <div>
        <label for="phone" class="block text-lg text-gray-700">Phone
            <span class="text-red-500">*</span>
        </label>
        <input type="text" name="phone" id="phone" 
            class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
            value="{{ old('phone', $employee->phone) }}"
            {{ $employee->is_archived ? 'disabled' : '' }}>
    </div>
    <div>
        <label for="position" class="block text-lg text-gray-700">Position
            <span class="text-red-500">*</span>
        </label>
        <input type="text" name="position" id="position" 
            class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
            value="{{ old('position', $employee->position) }}"
            {{ $employee->is_archived ? 'disabled' : '' }}>
    </div>
    <div>
        <label for="gender" class="block text-lg text-gray-700">Gender
            <span class="text-red-500">*</span>
        </label>
        <select name="gender" id="gender" 
            class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
            {{ $employee->is_archived ? 'disabled' : '' }}>
            <option value="male" {{ old('gender', $employee->gender) == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender', $employee->gender) == 'female' ? 'selected' : '' }}>Female</option>
            <option value="other" {{ old('gender', $employee->gender) == 'other' ? 'selected' : '' }}>Other</option>
        </select>
    </div>
    <div>
        <label for="birthdate" class="block text-lg text-gray-700">Birthdate
            <span class="text-red-500">*</span>
        </label>
        <input type="date" name="birthdate" id="birthdate" 
            class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
            value="{{ old('birthdate', $employee->birthdate) }}"
            {{ $employee->is_archived ? 'disabled' : '' }}>
    </div>
</div>

<!-- Availability Options -->
<div class="mt-6">
    <label for="availability" class="block text-lg text-gray-700">Availability</label>
    <select name="availability" id="availability" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
        {{ $employee->is_archived ? 'disabled' : '' }}>
        <option value="available" {{ $employee->availability == 'available' ? 'selected' : '' }}>Available</option>
        <option value="unavailable" {{ $employee->availability == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
    </select>
</div>


<!-- Archive Option -->
<div class="mt-6">
    @if (!$employee->is_archived) <!-- Only show if the employee is not archived -->
        <label for="is_archived" class="block text-lg text-gray-700">Archive Employee</label>
        <input type="checkbox" name="is_archived" id="is_archived" {{ $employee->is_archived ? 'checked' : '' }} class="mr-2">
        <label for="is_archived" class="text-gray-600">Check to archive this employee</label>
    @else
    @endif
</div>


<!-- Revert from Archive Checkbox (shown only if employee is archived) -->
@if ($employee->is_archived)
    <div class="mt-6">
        <label for="revert" class="block text-lg text-gray-700">Restore Employee</label>
        <input type="checkbox" name="revert" id="revert" class="mr-2">
        <label for="revert" class="text-gray-600">Check to restore this employee to available</label>
    </div>
@endif

         
<!-- Photo Field -->
<div class="mt-6">
    <label for="photo" class="block text-lg text-gray-700">Photo
        <span class="text-red-500">*</span>
    </label>
    @if ($employee->is_archived)
        @if ($employee->photo)
            <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}" width="100" class="mt-2 rounded-md shadow-sm">
        @else
            <p class="mt-2 text-gray-600">No photo uploaded.</p>
        @endif
    @else
        <input type="file" name="photo" id="photo" class="mt-1 block w-full text-sm text-gray-500 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        @if ($employee->photo)
            <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}" width="100" class="mt-2 rounded-md shadow-sm">
        @endif
    @endif
</div>

            <!-- Assign Services Section -->
<div class="mt-6">
    <label class="block text-gray-700">Assigned Services</label>
    <div class="mt-2">
        @if ($employee->is_archived)
            @if ($employee->services->isEmpty())
                <p class="text-gray-600">No services assigned.</p>
            @else
                <ul>
                    @foreach($employee->services as $service)
                        <li class="text-gray-600">{{ $service->service_name }} - {{ $service->description }}</li>
                    @endforeach
                </ul>
            @endif
        @else
            <div>
                @foreach($agency->services as $service)
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="services[]" id="service-{{ $service->id }}" value="{{ $service->id }}"
                            {{ $employee->services->contains($service->id) ? 'checked' : '' }} class="mr-2">
                        <label for="service-{{ $service->id }}" class="text-gray-600">{{ $service->service_name }} - {{ $service->description }}</label>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

            <div class="flex justify-center mt-6 space-x-4">
                <a href="{{ route('agency.employees') }}" class="bg-gray-300 text-gray-700 py-3 px-6 rounded-md font-semibold shadow-md hover:bg-gray-400 transition duration-300">
                    Cancel
                </a>
                <button type="submit" class="bg-custom-light-blue text-white py-3 px-6 rounded-md font-semibold shadow-md hover:bg-gray-700 transition ease-in-out duration-300">
                    <span class="material-icons align-middle">save</span> Update Employee
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
