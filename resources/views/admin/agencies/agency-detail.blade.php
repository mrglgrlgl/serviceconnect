@extends('layouts.admin_navigation')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">{{ $agency->name }} Details</h2>

    <div class="card">
        <div class="card-header">
            <h3>Agency Information</h3>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $agency->name }}</p>
            <p><strong>Email:</strong> {{ $agency->email }}</p>
            <p><strong>Phone:</strong> {{ $agency->phone }}</p>
            <p><strong>Address:</strong> {{ $agency->address }}</p>
            <p><strong>Status:</strong> <span class="status {{ $agency->status }}">{{ ucfirst($agency->status) }}</span></p>
        </div>
        <div class="card-footer">
            <a href="{{ route('agencies.edit', $agency->id) }}" class="btn btn-warning">Edit Agency</a>
        </div>
    </div>

    <!-- You can add more sections here, like related users or services -->
</div>

<style>
    .container {
        max-width: 800px;
        margin: 0 auto;
    }

    .card {
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .card-header h3 {
        margin: 0;
    }

    .card-body p {
        margin: 5px 0;
    }

    .status.active {
        background-color: #28a745;
        color: white;
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 0.9em;
    }

    .status.inactive {
        background-color: #6c757d;
        color: white;
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 0.9em;
    }

    .btn {
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
    }

    .btn-warning {
        background-color: #ffc107;
        color: white;
    }
</style>
@endsection
