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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-lg text-gray-700">Name
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('name', $employee->name) }}">
                </div>
                <div>
                    <label for="email" class="block text-lg text-gray-700">Email
                        <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('email', $employee->email) }}">
                </div>
                <div>
                    <label for="phone" class="block text-lg text-gray-700">Phone
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="phone" id="phone" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('phone', $employee->phone) }}">
                </div>
                <div>
                    <label for="position" class="block text-lg text-gray-700">Position
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="position" id="position" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('position', $employee->position) }}">
                </div>
                <div>
                    <label for="gender" class="block text-lg text-gray-700">Gender
                        <span class="text-red-500">*</span>
                    </label>
                    <select name="gender" id="gender" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="male" {{ old('gender', $employee->gender) == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $employee->gender) == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender', $employee->gender) == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div>
                    <label for="birthdate" class="block text-lg text-gray-700">Birthdate
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="birthdate" id="birthdate" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('birthdate', $employee->birthdate) }}">
                </div>
            </div>

            <!-- Photo Field -->
            <div class="mt-6">
                <label for="photo" class="block text-lg text-gray-700">Photo
                    <span class="text-red-500">*</span>
                </label>
                <input type="file" name="photo" id="photo" class="mt-1 block w-full text-sm text-gray-500 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @if ($employee->photo)
                    <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}" width="100" class="mt-2 rounded-md shadow-sm">
                @endif
            </div>

            <!-- Assign Services Section -->
            <div class="mt-6">
                <label class="block text-gray-700">Assign Services
                    <span class="text-red-500">*</span>
                </label>
                <div class="mt-2">
                    @foreach($agency->services as $service)
                        <div class="flex items-center mb-2">
                            <input type="checkbox" name="services[]" id="service-{{ $service->id }}" value="{{ $service->id }}"
                                {{ $employee->services->contains($service->id) ? 'checked' : '' }} class="mr-2">
                            <label for="service-{{ $service->id }}" class="text-gray-600">{{ $service->service_name }} - {{ $service->description }}</label>
                        </div>
                    @endforeach
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
