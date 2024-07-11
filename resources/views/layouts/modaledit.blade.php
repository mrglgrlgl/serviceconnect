<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Service Request</h5>
                    </div>
                    <div class="card-body">
         <form action="{{ route('service-requests.update', $serviceRequest->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <!-- Category -->
    <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <input type="text" class="form-control" id="category" name="category" value="{{ $serviceRequest->category }}" required>
    </div>

    <!-- Subcategory -->
    <div class="mb-3">
        <label for="subcategory" class="form-label">Subcategory</label>
        <input type="text" class="form-control" id="subcategory" name="subcategory" value="{{ $serviceRequest->subcategory }}" required>
    </div>

    <!-- Title -->
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $serviceRequest->title }}" required>
    </div>

    <!-- Location -->
    <div class="mb-3">
        <label for="location" class="form-label">Location</label>
        <input type="text" class="form-control" id="location" name="location" value="{{ $serviceRequest->location }}" required>
    </div>

    <!-- Start and End Time -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="start_time" class="form-label">Start Time</label>
            <input type="datetime-local" class="form-control" id="start_time" name="start_time" value="{{ \Carbon\Carbon::parse($serviceRequest->start_time)->format('Y-m-d\TH:i') }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="end_time" class="form-label">End Time</label>
            <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="{{ \Carbon\Carbon::parse($serviceRequest->end_time)->format('Y-m-d\TH:i') }}" required>
        </div>
    </div>

    <!-- Attach Media 1 -->
    <div class="mb-3">
        <label for="attach_media" class="form-label">Attach Media</label>
        <input type="file" class="form-control" id="attach_media" name="attach_media">
        @if ($serviceRequest->attach_media)
            <div>
                <img src="{{ asset('storage/' . $serviceRequest->attach_media) }}" class="img-fluid mb-3" alt="Service Request Media">
            </div>
            <label for="remove_attach_media">
                <input type="checkbox" id="remove_attach_media" name="remove_attach_media"> Remove current media
            </label>
        @endif
    </div>

    <!-- Attach Media 2 -->
    <div class="mb-3">
        <label for="attach_media2" class="form-label">Attach Media 2</label>
        <input type="file" class="form-control" id="attach_media2" name="attach_media2">
        @if ($serviceRequest->attach_media2)
            <div>
                <img src="{{ asset('storage/' . $serviceRequest->attach_media2) }}" class="img-fluid mb-3" alt="Service Request Media">
            </div>
            <label for="remove_attach_media2">
                <input type="checkbox" id="remove_attach_media2" name="remove_attach_media2"> Remove current media
            </label>
        @endif
    </div>

    <!-- Attach Media 3 -->
    <div class="mb-3">
        <label for="attach_media3" class="form-label">Attach Media 3</label>
        <input type="file" class="form-control" id="attach_media3" name="attach_media3">
        @if ($serviceRequest->attach_media3)
            <div>
                <img src="{{ asset('storage/' . $serviceRequest->attach_media3) }}" class="img-fluid mb-3" alt="Service Request Media">
            </div>
            <label for="remove_attach_media3">
                <input type="checkbox" id="remove_attach_media3" name="remove_attach_media3"> Remove current media
            </label>
        @endif
    </div>

    <!-- Attach Media 4 -->
    <div class="mb-3">
        <label for="attach_media4" class="form-label">Attach Media 4</label>
        <input type="file" class="form-control" id="attach_media4" name="attach_media4">
        @if ($serviceRequest->attach_media4)
            <div>
                <img src="{{ asset('storage/' . $serviceRequest->attach_media4) }}" class="img-fluid mb-3" alt="Service Request Media">
            </div>
            <label for="remove_attach_media4">
                <input type="checkbox" id="remove_attach_media4" name="remove_attach_media4"> Remove current media
            </label>
        @endif
    </div>

    <!-- Submit Button -->
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg">Update Service Request</button>
    </div>
</form>

<!-- Display success message -->
@if (session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
