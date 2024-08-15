@extends('layouts.admin_navigation')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Agencies</h2>

    @if (session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    <div class="button-container">
        <a href="{{ route('agencies.create') }}" class="btn btn-primary">Create Agency</a>
    </div>

    <div class="card-container">
        @foreach ($agencies as $agency)
            <a href="{{ route('agencies.show', $agency->id) }}" class="card-link"> <!-- Link to the show method -->
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $agency->name }}</h3>
                        <span class="status {{ $agency->status }}">{{ ucfirst($agency->status) }}</span>
                    </div>
                    <div class="card-body">
                        <p><strong>Email:</strong> {{ $agency->email }}</p>
                        <p><strong>Phone:</strong> {{ $agency->phone }}</p>
                        <p><strong>Address:</strong> {{ $agency->address }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('agencies.edit', $agency->id) }}" class="btn btn-warning" onclick="event.stopPropagation();">Edit</a>
                        <form action="{{ route('agencies.destroy', $agency->id) }}" method="POST" class="inline-form" onsubmit="event.stopPropagation();">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>

<style>
    .container {
        max-width: 800px;
        margin: 0 auto;
    }

    .alert.success {
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        border: 1px solid #c3e6cb;
    }

    .button-container {
        text-align: right;
        margin-bottom: 20px;
    }

    .btn {
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .btn-warning {
        background-color: #ffc107;
        color: white;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
        cursor: pointer;
    }

    .card-container {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .card-link {
        text-decoration: none;
        color: inherit;
    }

    .card {
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        padding: 20px;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
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

    .status {
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 0.9em;
    }

    .status.active {
        background-color: #28a745;
        color: white;
    }

    .status.inactive {
        background-color: #6c757d;
        color: white;
    }

    .card-body p {
        margin: 5px 0;
    }

    .card-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .inline-form {
        display: inline;
    }
</style>
@endsection
