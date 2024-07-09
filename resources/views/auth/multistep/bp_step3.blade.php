<!-- Step 3: Upload Documents -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 3: Upload Documents</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Optional: Some custom CSS -->
    <style>
        .container {
            margin-top: 50px;
        }
        .img-preview {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Step 3: Upload Documents</h1>

        <!-- Display success or error messages if any -->
        @if (session('success'))
            <div class="alert alert-success mt-4">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger mt-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Upload Documents</h5>
                <form action="{{ route('save-step3') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Input fields for uploading documents -->
                    <div class="form-group">
                        <label for="government_id_front">Government ID (Front)</label>
                        <input type="file" class="form-control" id="government_id_front" name="government_id_front" required onchange="previewImage(event, 'government_id_front_preview')">
                        <img id="government_id_front_preview" class="img-preview" src="#" alt="Government ID Front Preview" style="display: none;">
                    </div>

                    <div class="form-group">
                        <label for="government_id_back">Government ID (Back)</label>
                        <input type="file" class="form-control" id="government_id_back" name="government_id_back" required onchange="previewImage(event, 'government_id_back_preview')">
                        <img id="government_id_back_preview" class="img-preview" src="#" alt="Government ID Back Preview" style="display: none;">
                    </div>

                    <div class="form-group">
                        <label for="nbi_clearance">NBI Clearance (optional)</label>
                        <input type="file" class="form-control" id="nbi_clearance" name="nbi_clearance" onchange="previewImage(event, 'nbi_clearance_preview')">
                        <img id="nbi_clearance_preview" class="img-preview" src="#" alt="NBI Clearance Preview" style="display: none;">
                    </div>

                    <div class="form-group">
                        <label for="tesda_certification">TESDA Certification (optional)</label>
                        <input type="file" class="form-control" id="tesda_certification" name="tesda_certification" onchange="previewImage(event, 'tesda_certification_preview')">
                        <img id="tesda_certification_preview" class="img-preview" src="#" alt="TESDA Certification Preview" style="display: none;">
                    </div>

                    <div class="form-group">
                        <label for="other_credentials">Other Credentials (optional)</label>
                        <input type="file" class="form-control" id="other_credentials" name="other_credentials" onchange="previewImage(event, 'other_credentials_preview')">
                        <img id="other_credentials_preview" class="img-preview" src="#" alt="Other Credentials Preview" style="display: none;">
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>

        <!-- JavaScript for previewing images -->
        <script>
            function previewImage(event, previewId) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById(previewId);
                    output.src = reader.result;
                    output.style.display = 'block';
                };
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>
    </div>

    <!-- Bootstrap JS and other dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<!-- Send Request Form -->
<div class="container">
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Send Request</h5>
            <form action="{{ route('requests.store') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input type="hidden" name="status" value="pending">
                <button type="submit" class="btn btn-primary">Send Request</button>
            </form>
        </div>
    </div>

    <!-- Success or Error Messages for sending request -->
    @if (session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger mt-4">
            {{ session('error') }}
        </div>
    @endif
</div>
