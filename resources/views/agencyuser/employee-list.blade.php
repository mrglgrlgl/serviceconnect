@extends('layouts.agencyuser-navigation')

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
    </div>
@endsection
