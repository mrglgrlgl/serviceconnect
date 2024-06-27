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