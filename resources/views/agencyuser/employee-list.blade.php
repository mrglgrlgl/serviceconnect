<x-agency-dashboard>
    <div class="font-poppins bg-gray-100 min-h-screen">
        <div class="max-w-8xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Employee List</h1>

<<<<<<< HEAD
            <!-- Button to navigate to the Create Employee page -->
            <div class="text-right mb-4">
                <a href="{{ route('agency.employees.create') }}" class="bg-custom-agency-secondary text-white py-3 px-6 rounded-md font-semibold shadow-md hover:bg-gray-700 hover:shadow-lg transition ease-in-out duration-300">
                    <span class="material-icons align-middle">add_circle</span> Add New Employee
                </a>
            </div>

            @if($employees->isEmpty())
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
                                <th class="p-4 text-center">Email</th>
                                <th class="p-4 text-center">Phone</th>
                                <th class="p-4 text-center">Position</th>
                                <th class="p-4 text-center">Gender</th>
                                <th class="p-4 text-center">Birthdate</th>
                                <th class="p-4 text-center">Services</th> <!-- New column -->
                                <th class="p-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700 bg-gray-100">
                            @foreach($employees as $employee)
                                <tr class="border-t border-gray-200 hover:bg-gray-100 transition ease-in-out duration-150 text-md">
                                    <td class="p-4 text-center">
                                        @if($employee->photo)
                                            <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}" class="w-16 h-16 rounded-md shadow-sm object-cover">
                                        @else
                                            <span class="text-gray-500">No photo</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-center">{{ $employee->name }}</td>
                                    <td class="p-4 text-center">{{ $employee->email }}</td>
                                    <td class="p-4 text-center">{{ $employee->phone }}</td>
                                    <td class="p-4 text-center">{{ $employee->position }}</td>
                                    <td class="p-4 text-center">{{ ucfirst($employee->gender) }}</td>
                                    <td class="p-4 text-center">{{ $employee->birthdate }}</td>
                                    <td class="p-4 text-center">
                                        @if($employee->services->isEmpty())
                                            <span class="text-gray-500">No services</span>
                                        @else
                                            <ul class="list-disc list-inside pl-5">
                                                @foreach($employee->services as $service)
                                                    <li>{{ $service->name }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td class="p-4 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('agency.employees.edit', $employee->id) }}" class="border-2 border-gray-600 text-gray-600 py-2 px-4 rounded-md font-semibold shadow-sm hover:bg-gray-600 hover:text-white hover:shadow-lg transition ease-in-out duration-300">
                                                <span class="material-icons align-middle">edit</span>
                                            </a>
                                            <form action="{{ route('agency.employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 border-2 border-red-500 text-white py-2 px-4 rounded-md font-semibold shadow-md hover:bg-red-600 hover:shadow-lg transition ease-in-out duration-300">
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
</x-agency-dashboard>
=======
@section('content')
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f8;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        h1 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 30px;
            font-weight: 700;
            text-align: center;
        }

        .btn-primary {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 12px 24px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 0;
            border-radius: 25px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            background-color: #45a049;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
            margin-top: 20px;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
            background-color: #ffffff;
        }

        .table th,
        .table td {
            padding: 15px;
            vertical-align: middle;
            border-top: 1px solid #dee2e6;
            text-align: center;
        }

        .table thead th {
            background-color: #4CAF50;
            color: #ffffff;
            font-weight: 700;
            border-bottom: 2px solid #4CAF50;
        }

        .table tbody tr {
            transition: background-color 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .img-thumbnail {
            border-radius: 50%;
            width: 60px;
            height: 60px;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-warning {
            background-color: #ffc107;
            color: #fff;
            font-size: 14px;
            padding: 8px 20px;
            border-radius: 50px;
            transition: all 0.3s ease;
            margin-right: 5px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-warning:hover {
            background-color: #e0a800;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            font-size: 14px;
            padding: 8px 20px;
            border-radius: 50px;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-danger:hover {
            background-color: #c82333;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .actions-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .alert-info {
            background-color: #e2f0d9;
            color: #3c763d;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
        }
    </style>


    <div class="container">
        <h1>Employee List</h1>

        <!-- Button to navigate to the Create Employee page -->
        <div class="text-right">
            <a href="{{ route('agency.employees.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i> Add New Employee
            </a>
        </div>

        @if($employees->isEmpty())
            <div class="alert alert-info">
                <strong>No employees found.</strong> Please add employees.
            </div>
        @else
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Position</th>
                            <th>Gender</th>
                            <th>Birthdate</th>
                            <th>Services</th> <!-- Add Services Column -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td>
                                    @if($employee->photo)
                                        <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}" class="img-thumbnail">
                                    @else
                                        <span class="text-muted">No photo</span>
                                    @endif
                                </td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>{{ $employee->position }}</td>
                                <td>{{ ucfirst($employee->gender) }}</td>
                                <td>{{ $employee->birthdate }}</td>
                               <td>
    @foreach($employee->services as $service)
        <span class="badge bg-info">{{ $service->service_name }}</span>
    @endforeach
</td>

                                <td class="actions-container">
                                    <a href="{{ route('agency.employees.edit', $employee->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('agency.employees.destroy', $employee->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

@endsection
>>>>>>> f2e8c17 (working assignation of services to employees)
