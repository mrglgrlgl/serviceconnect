<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 2: Service Information</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Optional: Some custom CSS -->
    <style>
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Step 2: Service Information</h1>

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
                <h5 class="card-title">Service Information</h5>
                <form action="{{ route('save-step2') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="service_category">Service Category</label>
                        <select class="form-control" id="service_category" name="service_category" required>
                            <option value="">Select Service Category</option>
                            <option value="Plumbing">Plumbing</option>
                            <!-- Add other service categories as needed -->
                        </select>
                    </div>

                    <div class="form-group" id="subcategory_container" style="display: none;">
                        <label for="sub_category">Subcategory</label>
                        <select class="form-control" id="sub_category" name="sub_category" required>
                            <option value="">Select Subcategory</option>
                            <!-- Options will be dynamically populated -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="years_of_experience">Years of Experience</label>
                        <input type="number" class="form-control" id="years_of_experience" name="years_of_experience" required>
                    </div>

                    <div class="form-group">
                        <label>Do you have tools/equipment?</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="have_tools" id="have_tools_yes" value="1">
                        <label class="form-check-label" for="have_tools_yes">Yes</label>
                    </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="have_tools" id="have_tools_no" value="0">
                            <label class="form-check-label" for="have_tools_no">No</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Next</button>
                </form>
            </div>
        </div>
@if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif

        <!-- Success or Error Messages -->
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

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Function to populate subcategories based on selected service category
            $('#service_category').change(function() {
                var serviceCategory = $(this).val();
                if (serviceCategory === 'Plumbing') {
                    // Populate subcategories for Plumbing
                    $('#sub_category').empty().append(
                        '<option value="">Select Subcategory</option>' +
                        '<option value="Faucet Leak Repair">Faucet Leak Repair</option>' +
                        '<option value="Sink P-trap Repair">Sink P-trap Repair</option>' +
                        '<option value="Sink Declogging">Sink Declogging</option>' +
                        '<option value="Toilet Repair">Toilet Repair</option>' +
                        '<option value="Exposed Pipe Repair">Exposed Pipe Repair</option>' +
                        '<option value="Pipe Line Declogging">Pipe Line Declogging</option>' +
                        '<option value="Drainage Declogging">Drainage Declogging</option>' +
                        '<option value="Plumbing Inspection">Plumbing Inspection</option>' +
                        '<option value="Water Heater Repair">Water Heater Repair</option>' +
                        '<option value="Water Heater Inspection">Water Heater Inspection</option>'
                    );
                    $('#subcategory_container').show();
                } else {
                    // Handle other service categories if needed
                    $('#subcategory_container').hide();
                }
            });
        });
    </script>
</body>
</html>
