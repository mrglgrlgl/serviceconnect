@extends('layouts.admin_navigation')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Create Agency</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('agencies.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full" value="{{ old('name') }}">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full" value="{{ old('email') }}">
        </div>
        <div class="mb-4">
            <label for="phone" class="block text-gray-700">Phone</label>
            <input type="text" name="phone" id="phone" class="mt-1 block w-full" value="{{ old('phone') }}">
        </div>
        <div class="mb-4">
            <label for="address" class="block text-gray-700">Address</label>
            <input type="text" name="address" id="address" class="mt-1 block w-full" value="{{ old('address') }}">
        </div>
        <div class="mb-4">
            <label for="status" class="block text-gray-700">Status</label>
            <select name="status" id="status" class="mt-1 block w-full">
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Agency</button>
        </div>
    </form>
</div>
@endsection
