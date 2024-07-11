<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Service Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Create Service Request</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('service-requests.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" class="form-control" id="category" name="category" required>
                            </div>
                            <div class="mb-3">
                                <label for="subcategory" class="form-label">Subcategory</label>
                                <input type="text" class="form-control" id="subcategory" name="subcategory" required>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>

                            
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location" required>
                            </div>


                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="start_time" class="form-label">Start Time</label>
                                    <input type="datetime-local" class="form-control" id="start_time" name="start_time" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="end_time" class="form-label">End Time</label>
                                    <input type="datetime-local" class="form-control" id="end_time" name="end_time" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="attach_media" class="form-label">Attach Media</label>
                                <input type="file" class="form-control" id="attach_media" name="attach_media" required>
                            </div>
                            <div class="mb-3">
                                <label for="attach_media2" class="form-label">Attach Media 2</label>
                                <input type="file" class="form-control" id="attach_media2" name="attach_media2">
                            </div>
                            <div class="mb-3">
                                <label for="attach_media3" class="form-label">Attach Media 3</label>
                                <input type="file" class="form-control" id="attach_media3" name="attach_media3">
                            </div>
                            <div class="mb-3">
                                <label for="attach_media4" class="form-label">Attach Media 4</label>
                                <input type="file" class="form-control" id="attach_media4" name="attach_media4">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Create Service Request</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
