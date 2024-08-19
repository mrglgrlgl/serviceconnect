@extends('layouts.agencyuser-navigation')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Add New Employee</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('agency.employees.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow">
        @csrf

        <div class="form-group mb-4">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="form-group mb-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
        </div>

        <div class="form-group mb-4">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
        </div>

        <div class="form-group mb-4">
            <label for="position" class="form-label">Position</label>
            <input type="text" name="position" id="position" class="form-control" value="{{ old('position') }}">
        </div>

        <div class="form-group mb-4">
            <label for="gender" class="form-label">Gender</label>
            <select name="gender" id="gender" class="form-select">
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <div class="form-group mb-4">
            <label for="birthdate" class="form-label">Birthdate</label>
            <input type="date" name="birthdate" id="birthdate" class="form-control" value="{{ old('birthdate') }}">
        </div>

        <div class="form-group mb-4">
            <label for="photo" class="form-label">Photo</label>
            <input type="file" name="photo" id="photo" class="form-control">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Add Employee</button>
        </div>
    </form>
</div>
@endsection
