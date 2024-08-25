@extends('layouts.agencyuser-navigation')

@section('content')
<div class="container mt-5">
    <h1>Create a New Service</h1>

    <form action="{{ route('agencies.services.store', $agency->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="service_name">Service Name</label>
            <input type="text" name="service_name" id="service_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create Service</button>
    </form>
</div>
@endsection