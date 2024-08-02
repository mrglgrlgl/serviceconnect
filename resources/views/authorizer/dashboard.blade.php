<!-- resources/views/authorizer/dashboard.blade.php -->
<x-app-layout>
    <style>
        .record-container {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #f9f9f9;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .record-container h3 {
            width: 100%;
            margin-top: 0;
        }
        .column {
            flex: 1;
            margin: 10px;
            min-width: 200px;
        }
        .column h4 {
            margin-bottom: 5px;
        }
        .column img {
            max-width: 100px;
            height: auto;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .column img:hover {
            transform: scale(1.05);
        }
        .zoomed-image {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 90%;
            max-height: 90%;
            z-index: 1000;
            border: 2px solid #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 999;
        }
    </style>

    <div class="container">
    <!-- Add this button in your authorizer/dashboard.blade.php -->
<div class="text-center my-4">
    <a href="{{ route('authorizer.reports') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        View Reports
    </a>
</div>

        <h1>All PhilID Records</h1>

        @if(isset($philIDs) && $philIDs->isNotEmpty())
            @foreach ($philIDs as $philID)
                <div class="record-container">
                    <!-- User Data -->
                    <div class="column">
                        <h4>User Data</h4>
                        @if ($philID->provider)
                            <p><strong>Name:</strong> {{ $philID->provider->name }}</p>
                            <p><strong>Email:</strong> {{ $philID->provider->email }}</p>
                            <p><strong>Phone:</strong> {{ $philID->provider->cell_no ?? 'N/A' }}</p>
                            <p><strong>Address:</strong> {{ $philID->provider->address ?? 'N/A' }}</p>
                        @else
                            <p>User data not available.</p>
                        @endif
                    </div>
                    
                    <!-- PhilID Data -->
                    <div class="column">
                        <h4>PhilID Data</h4>
                        <p><strong>PhilID Number:</strong> {{ $philID->philid_number }}</p>
                        <p><strong>Name:</strong> {{ $philID->given_names }} {{ $philID->middle_name }} {{ $philID->last_name }}</p>
                        <p><strong>Date of Birth:</strong> {{ $philID->date_of_birth }}</p>
                        <p><strong>Address:</strong> {{ $philID->address }}</p>
                        <p><strong>Status:</strong> {{ $philID->status }}</p>
                    </div>
                    
                    <!-- PhilID Images -->
                    <div class="column">
                        <h4>PhilID Images</h4>
                        <p><strong>Front Image:</strong></p>
                        <img src="{{ asset('storage/' . $philID->front_image) }}" alt="Front Image of {{ $philID->philid_number }}" class="zoomable-image">
                        
                        <p><strong>Back Image:</strong></p>
                        <img src="{{ asset('storage/' . $philID->back_image) }}" alt="Back Image of {{ $philID->philid_number }}" class="zoomable-image">
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div style="text-align: center; margin-bottom: 20px;">
                    <form method="POST" action="{{ route('philid.accept', $philID->id) }}" style="display:inline;">
                        @csrf
                        <button type="submit" style="background-color: green; color: white;">Accept</button>
                    </form>
                    <form method="POST" action="{{ route('philid.reject', $philID->id) }}" style="display:inline;">
                        @csrf
                        <button type="submit" style="background-color: red; color: white;">Reject</button>
                    </form>
                </div>
            @endforeach
        @else
            <p>No PhilID records found.</p>
        @endif

        <!-- Image Zoom Overlay -->
        <div class="overlay" id="overlay"></div>
        <img class="zoomed-image" id="zoomedImage" src="" alt="Zoomed Image">
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const zoomableImages = document.querySelectorAll('.zoomable-image');
            const overlay = document.getElementById('overlay');
            const zoomedImage = document.getElementById('zoomedImage');

            zoomableImages.forEach(image => {
                image.addEventListener('click', () => {
                    zoomedImage.src = image.src;
                    zoomedImage.style.display = 'block';
                    overlay.style.display = 'block';
                });
            });

            overlay.addEventListener('click', () => {
                zoomedImage.style.display = 'none';
                overlay.style.display = 'none';
            });

            zoomedImage.addEventListener('click', () => {
                zoomedImage.style.display = 'none';
                overlay.style.display = 'none';
            });
        });
    </script>
</x-app-layout>
