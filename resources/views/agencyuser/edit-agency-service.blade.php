@extends('layouts.agency-dashboard')

@section('content')
<div class="container mx-auto mt-5 p-4">
    <h1 class="text-3xl font-semibold mb-6">Edit Service</h1>

    <form action="{{ route('agencies.services.update', [$agency->id, $service->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="service_name" class="block text-gray-700">Service Name</label>
            <input type="text" name="service_name" id="service_name" class="w-full p-2 border" value="{{ $service->service_name }}" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea name="description" id="description" class="w-full p-2 border">{{ $service->description }}</textarea>
        </div>

        <button type="submit" class="bg-custom-agency-secondary text-white px-4 py-2 rounded-lg">Update Service</button>
    </form>
</div>
@endsection
