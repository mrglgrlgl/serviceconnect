<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Authorizer Dashboard') }}
        </h2>
    </x-slot>

    @if(Auth::check() && Auth::user()->role == 1)
<x-slot name="tabble">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">User Name</th>
                                <th class="px-4 py-2">User Email</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($requests as $request)
                            <tr>
                                <td class="border px-4 py-2">{{ $request->status }}</td>
                                <td class="border px-4 py-2">{{ $request->user->name }}</td>
                                <td class="border px-4 py-2">{{ $request->user->email }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('requests.accept', $request->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Accept</a>
                                    <a href="{{ route('requests.decline', $request->id) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Decline</a>
                                </td>
                            </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
                </x-slot>
            </div>
        </div>
    </div>
</x-app-layout><!DOCTYPE html>
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
            border: 1px solid transparent;
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
        @if ($request->providerDetail)
<tr>
    <td colspan="5">
        <h2>Provider Details</h2>
        <table>
            <tr>
                <th>Work Email</th>
                <th>Contact Number</th>
                <th>Service Category</th>
                <th>Sub Category</th>
                <th>Description</th>
                <th>Government ID Front</th>
                <th>Government ID Back</th>
                <th>NBI Clearance</th>
                <th>TESDA Certification</th>
                <th>Other Credentials</th>
            </tr>
            <tr>
                <td>{{ $request->providerDetail->work_email }}</td>
                <td>{{ $request->providerDetail->contact_number }}</td>
                <td>{{ $request->providerDetail->serviceCategory }}</td>
                <td>{{ $request->providerDetail->subcategory }}</td>
                <td>{{ $request->providerDetail->description }}</td>
                <td>
                    <img src="{{ asset('storage/' . $request->providerDetail->government_id_front) }}" alt="Government ID Front" width="100">
                </td>
                <td>
                    <img src="{{ asset('storage/' . $request->providerDetail->government_id_back) }}" alt="Government ID Back">
                </td>
                <td>
                    <img src="{{ asset('storage/' . $request->providerDetail->nbi_clearance) }}" alt="NBI Clearance" width="100">
                </td>
                <td>
                    <img src="{{ asset('storage/' . $request->providerDetail->tesda_certification) }}" alt="TESDA Certification" width="100">
                </td>
                <td>
                    <img src="{{ asset('storage/' . $request->providerDetail->other_credentials) }}" alt="Other Credentials" width="100">
                </td>
            </tr>
        </table>
    </td>
</tr>
@endif
            @endforeach
            </tbody>
        </table>
        @else
        <p>No requests found.</p>
        @endif
    </div>
</body>
</html>

{{ $request->providerDetail->government_id_front_url }}
<!-- Debugging output -->
<pre>{{ print_r($request->providerDetail->toArray(), true) }}</pre>

<!-- Check individual URL -->
<pre>{{ $request->providerDetail->government_id_front_url }}</pre>
