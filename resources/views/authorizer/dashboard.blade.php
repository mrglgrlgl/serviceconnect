<!DOCTYPE html>
<html>
<head>
    <title>Requests Dashboard</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: normal;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            border: 1 px solid transparent;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn-success {
            color: #fff;
            background-color: #5cb85c;
            border-color: #4cae4c;
        }

        .btn-danger {
            color: #fff;
            background-color: #d9534f;
            border-color: #d43f3a;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Requests Dashboard</h1>
        @if (!empty($requests))
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $request)
                <tr>
                    <td>{{ $request->id }}</td>
                       <td>{{ $request->user_id }}</td>
                    <td>{{ $request->status }}</td>
                    <td>{{ $request->created_at }}</td>
                    <td>
                        <form action="{{ route('requests.accept', $request->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Accept</button>
                        </form>
                       <form action="{{ route('requests.decline', $request->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">Decline</button>
</form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>No requests found.</p>
        @endif
    </div>
</body>
</html>
