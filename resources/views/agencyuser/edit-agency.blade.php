@extends('layouts.agency-dashboard')

@section('content')

    <div class="container mt-5">
        <h1>Edit Agency Settings</h1>

        @if(isset($agency))
            <form action="{{ route('agency.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="name">Agency Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $agency->name }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $agency->email }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $agency->phone }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $agency->address }}" required>
                </div>

              

                <div class="form-group mb-3">
                    <label for="logo">Agency Logo</label>
                    @if($agency->logo_path)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $agency->logo_path) }}" alt="{{ $agency->name }} Logo" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    @endif
                    <input type="file" class="form-control-file" id="logo" name="logo">
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('agency.settings') }}" class="btn btn-secondary">Cancel</a>
            </form>
        @else
            <p>No agency data found.</p>
        @endif
    </div>
@endsection

