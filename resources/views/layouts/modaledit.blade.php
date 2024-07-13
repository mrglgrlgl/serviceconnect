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
                        <form action="{{ route('service-requests.update', $serviceRequest->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <!-- Category -->
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" class="form-control" id="category" name="category"
                                    value="{{ $serviceRequest->category }}" required>
                            </div>
  <!-- Title -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ $serviceRequest->title }}" required>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description"
                                    required>{{ $serviceRequest->description }}</textarea>
                            </div>

                            <!-- Location -->
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location"
                                    value="{{ $serviceRequest->location }}" required>
                            </div>

                            <!-- Start Date -->
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date"
                                    value="{{ $serviceRequest->start_date }}" required>
                            </div>

                            <!-- End Date -->
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date"
                                    value="{{ $serviceRequest->end_date }}" required>
                            </div>

                            <!-- Start Time -->
                            <div class="mb-3">
                                <label for="start_time" class="form-label">Start Time</label>
                                <input type="time" class="form-control" id="start_time" name="start_time"
                                    value="{{ $serviceRequest->start_time }}" required>
                            </div>

                            <!-- End Time -->
                            <div class="mb-3">
                                <label for="end_time" class="form-label">End Time</label>
                                <input type="time" class="form-control" id="end_time" name="end_time"
                                    value="{{ $serviceRequest->end_time }}" required>
                            </div>

                            <!-- Provider Gender Preference -->
                            <div class="mb-3">
                                <label for="provider_gender" class="form-label">Preferred Provider Gender</label>
                                <select class="form-select" id="provider_gender" name="provider_gender">
                                    <option value="">No preference</option>
                                    <option value="male" {{ $serviceRequest->provider_gender == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $serviceRequest->provider_gender == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>

                            <!-- Job Type -->
                            <div class="mb-3">
                                <label for="job_type" class="form-label">Job Type</label>
                                <select class="form-select" id="job_type" name="job_type" required>
                                    <option value="project_based" {{ $serviceRequest->job_type == 'project_based' ? 'selected' : '' }}>Project Based</option>
                                    <option value="hourly_rate" {{ $serviceRequest->job_type == 'hourly_rate' ? 'selected' : '' }}>Hourly Rate</option>
                                </select>
                            </div>

                            <!-- Hourly Rate -->
                            <div class="mb-3">
                                <label for="hourly_rate" class="form-label">Hourly Rate</label>
                                <input type="number" step="0.01" class="form-control" id="hourly_rate"
                                    name="hourly_rate" value="{{ $serviceRequest->hourly_rate }}" required>
                            </div>

                            <!-- Expected Price -->
                            <div class="mb-3">
                                <label for="expected_price" class="form-label">Expected Price</label>
                                <input type="number" step="0.01" class="form-control" id="expected_price"
                                    name="expected_price" value="{{ $serviceRequest->expected_price }}" required>
                            </div>

                            <!-- Estimated Duration -->
                            <div class="mb-3">
                                <label for="estimated_duration" class="form-label">Estimated Duration (hours)</label>
                                <input type="number" class="form-control" id="estimated_duration"
                                    name="estimated_duration" value="{{ $serviceRequest->estimated_duration }}" required>
                            </div>

                            <!-- Attach Media 1 -->
                            <div class="mb-3">
                                <label for="attach_media" class="form-label">Attach Media</label>
                                <input type="file" class="form-control" id="attach_media" name="attach_media">
                                @if ($serviceRequest->attach_media)
                                    <div>
                                        <img src="{{ asset('storage/' . $serviceRequest->attach_media) }}"
                                            class="img-fluid mb-3" alt="Service Request Media">
                                    </div>
                                    <label for="remove_attach_media">
                                        <input type="checkbox" id="remove_attach_media" name="remove_attach_media">
                                        Remove current media
                                    </label>
                                @endif
                            </div>

                            <!-- Attach Media 2 -->
                            <div class="mb-3">
                                <label for="attach_media2" class="form-label">Attach Media 2</label>
                                <input type="file" class="form-control" id="attach_media2" name="attach_media2">
                                @if ($serviceRequest->attach_media2)
                                    <div>
                                        <img src="{{ asset('storage/' . $serviceRequest->attach_media2) }}"
                                            class="img-fluid mb-3" alt="Service Request Media">
                                    </div>
                                    <label for="remove_attach_media2">
                                        <input type="checkbox" id="remove_attach_media2" name="remove_attach_media2">
                                        Remove current media
                                    </label>
                                @endif
                            </div>

                            <!-- Attach Media 3 -->
                            <div class="mb-3">
                                <label for="attach_media3" class="form-label">Attach Media 3</label>
                                <input type="file" class="form-control" id="attach_media3" name="attach_media3">
                                @if ($serviceRequest->attach_media3)
                                    <div>
                                        <img src="{{ asset('storage/' . $serviceRequest->attach_media3) }}"
                                            class="img-fluid mb-3" alt="Service Request Media">
                                    </div>
                                    <label for="remove_attach_media3">
                                        <input type="checkbox" id="remove_attach_media3" name="remove_attach_media3">
                                        Remove current media
                                    </label>
                                @endif
                            </div>

                            <!-- Attach Media 4 -->
                            <div class="mb-3">
                                <label for="attach_media4" class="form-label">Attach Media 4</label>
                                <input type="file" class="form-control" id="attach_media4" name="attach_media4">
                                @if ($serviceRequest->attach_media4)
                                    <div>
                                        <img src="{{ asset('storage/' . $serviceRequest->attach_media4) }}"
                                            class="img-fluid mb-3" alt="Service Request Media">
                                    </div>
                                    <label for="remove_attach_media4">
                                        <input type="checkbox" id="remove_attach_media4" name="remove_attach_media4">
                                        Remove current media
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
