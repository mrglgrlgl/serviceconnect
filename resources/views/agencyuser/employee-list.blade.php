@extends('layouts.agency-dashboard')

@section('content')
    <div class="font-poppins bg-gray-100 min-h-screen">
        <div class="max-w-8xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Employee List</h1>

            <!-- Button to navigate to the Create Employee page -->
            <div class="text-right mb-4">
                <a href="{{ route('agency.employees.create') }}"
                    class="bg-custom-agency-secondary text-white py-3 px-6 rounded-md font-semibold shadow-md  duration-300 hover:bg-gray-700 hover:shadow-lg transition-transform hover:scale-105">
                    <span class="material-icons align-middle">add_circle</span> Add New Employee
                </a>
            </div>

            @if ($employees->isEmpty())
                <div class="bg-green-100 text-green-800 p-4 rounded-lg text-center font-medium mb-8">
                    <strong>No employees found.</strong> Please add employees.
                </div>
            @else
                <div class="overflow-x-auto rounded-lg mt-4">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-custom-agency-bg text-white text-sm font-bold">
                                <th class="p-4 text-center">Photo</th>
                                <th class="p-4 text-center">Name</th>
                                {{-- <th class="p-4 text-center">Email</th> --}}
                                <th class="p-4 text-center">Phone</th>
                                <th class="p-4 text-center">Role</th>
                                <th class="p-4 text-center">Gender</th>
                                {{-- <th class="p-4 text-center">Birthdate</th> --}}
                                <th class="p-4 text-center">Services</th> <!-- New column -->
                                <th class="p-4 text-center">Availability</th> <!-- Availability column -->
                                <th class="p-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700 bg-gray-100">
                            @foreach ($employees as $employee)
                                <tr
                                    class="border-t border-gray-200 hover:bg-gray-100 transition ease-in-out duration-150 text-md">
                                    <td class="p-4 text-center">
                                        @if ($employee->photo)
                                            <img src="{{ asset('storage/' . $employee->photo) }}"
                                                alt="{{ $employee->name }}"
                                                class="w-16 h-16 rounded-md shadow-sm object-cover">
                                        @else
                                            <span class="text-gray-500">No photo</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-center">{{ $employee->name }}</td>
                                    {{-- <td class="p-4 text-center">{{ $employee->email }}</td> --}}
                                    <td class="p-4 text-center">{{ $employee->phone }}</td>
                                    <td class="p-4 text-center">{{ $employee->position }}</td>
                                    <td class="p-4 text-center">{{ ucfirst($employee->gender) }}</td>
                                    {{-- <td class="p-4 text-center">{{ $employee->birthdate }}</td> --}}
                                    <td class="p-4 text-center">
                                        @if($employee->services->isEmpty())
                                            <span class="text-gray-500">No services</span>
                                        @else
                                            <ul class="list-disc list-inside pl-5">
                                                @foreach($employee->services as $service)
                                                    <li>{{ $service->service_name }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td class="p-4 text-center">
                                        <span class="px-2 py-1 rounded-full 
                                            @if($employee->availability === 'available') bg-green-500 text-white 
                                            @elseif($employee->availability === 'assigned') bg-yellow-500 text-white 
                                            @else bg-red-500 text-white 
                                            @endif">
                                            {{ ucfirst($employee->availability) }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-center">
                                        
                                        
                                        <div class="flex justify-center space-x-2">
                                                 <!-- View Button -->
                                            <a href="{{ route('agency.employees.show', $employee->id) }}" class="border-2 border-custom-agency-secondary text-custom-agency-secondary py-2 px-4 rounded-md font-semibold shadow-sm hover:bg-custom-agency-secondary hover:text-white hover:shadow-lg transition ease-in-out duration-300">
                                                <span class="material-icons align-middle">visibility</span>
                                            </a>
                                            <a href="{{ route('agency.employees.edit', $employee->id) }}"
                                                class="border-2 border-gray-600 text-gray-600 py-2 px-4 rounded-md font-semibold shadow-sm hover:bg-gray-600 hover:text-white hover:shadow-lg duration-300 transition-transform hover:scale-105">
                                                <span class="material-icons align-middle">edit</span>
                                            </a>
                                            <form action="{{ route('agency.employees.destroy', $employee->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 border-2 border-red-500 text-white py-2 px-4 rounded-md font-semibold shadow-md hover:bg-red-600 hover:shadow-lg  ease-in-out duration-300 transition-transform hover:scale-105">
                                                    <span class="material-icons align-middle">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
