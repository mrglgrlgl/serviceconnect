<<<<<<< HEAD
<x-guest-layout>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="{{ asset('js/map.js') }}"></script>

<form method="POST" action="{{ route('register') }}" class="w-full mx-auto">
        @csrf

        <div class="w-max">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" required autofocus autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />

            <!-- Map  -->
            <div id="map" style="height: 500px; width: 900px;" class="mt-4 w-full "></div>
        </div>

        <div class="mt-4 flex justify-end items-end">
            <x-primary-button class="text-white">
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
=======
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Address Form</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Address Form</h1>

        <form method="POST" action="{{ route('address.store') }}">
            @csrf

            <input type="hidden" name="userId" value="{{ $userId }}">

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter an address" required>
            </div>

            <button type="submit" class="btn btn-primary">Save Address</button>
        </form>
    </div>
</body>
</html>
>>>>>>> c89e69b736151836972257fee4319efa8bf7adbd
