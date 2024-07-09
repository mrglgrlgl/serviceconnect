<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become a Provider</title>
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
        <h1>Become a Provider</h1>
        <div>
            @if (Auth::check())
                @php
                    $nameParts = explode(' ', Auth::user()->name, 2);
                    $firstName = isset($nameParts[0]) ? $nameParts[0] : '';
                    $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
                @endphp

                <p>First Name: {{ $firstName }}</p>
                <p>Last Name: {{ $lastName }}</p>
                <p>Email: {{ Auth::user()->email }}</p>
            @endif
        </div>

        <!-- Contact Information Form -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Contact Information</h5>
                <form action="{{ route('save-step1') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="work_email">Work Email</label>
                        <input type="email" class="form-control" id="work_email" name="work_email" required>
                    </div>
                    <div class="form-group">
                        <label for="contact_number">Contact Number</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Next</button>
                </form>
            </div>
        </div>

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
</body>
</html>
