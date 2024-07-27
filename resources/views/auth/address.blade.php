

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address Form</title>

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <!-- Include MapTiler Geocoding Control CSS -->
    <link href="https://cdn.maptiler.com/maptiler-geocoding-control/v1.2.0/style.css" rel="stylesheet">

    <style>
        #map {
            height: 400px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Address Form</h1>

        <!-- Form for entering address -->
        <form method="POST" action="{{ route('address.store') }}">
            @csrf

            <!-- Hidden input for user ID -->
            <input type="hidden" name="userId" value="{{ $userId }}">

            <!-- Address input field -->
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter an address" required>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Save Address</button>
        </form>

        <!-- Map container -->
        <div id="map"></div>
    </div>

    <!-- Include Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- Include MapTiler Geocoding Control JS -->
    <script src="https://cdn.maptiler.com/maptiler-geocoding-control/v1.2.0/leaflet.umd.js"></script>

    <script>
        // MapTiler API key
        const key = 'EIgfWgKktc8AtSmt7rvi';

        // Initialize the map
        const map = L.map('map').setView([49.2125578, 16.62662018], 14);

        // Add a tile layer to the map
        L.tileLayer(`https://api.maptiler.com/maps/streets-v2/{z}/{x}/{y}.png?key=${key}`, {
            tileSize: 512,
            zoomOffset: -1,
            minZoom: 1,
            attribution: "<a href=\"https://www.maptiler.com/copyright/\" target=\"_blank\">&copy; MapTiler</a> <a href=\"https://www.openstreetmap.org/copyright\" target=\"_blank\">&copy; OpenStreetMap contributors</a>",
            crossOrigin: true
        }).addTo(map);

        // Initialize the geocoding control
        const geocoder = L.control.maptilerGeocoding({
            apiKey: key,
            placeholder: 'Search for an address',
            limit: 5
        }).addTo(map);

        // Bind the input field to the geocoding control
        geocoder.on('select', function (e) {
            document.getElementById('address').value = e.feature.place_name;
        });

        // Update the input field with the selected address
        document.getElementById('address').addEventListener('input', function (e) {
            geocoder.setQuery(e.target.value);
        });
    </script>
</body>
</html>
