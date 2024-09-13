@extends('layouts.agency-dashboard')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Welcome, {{ Auth::guard('agency_users')->user()->name }}</h1>

    <p>This is your agency user home page. Here you can manage your agency's operations, view reports, manage employees, and more.</p>

    <!-- Add more content specific to the agency user home page -->
</div>
@endsection
