@extends('layouts.dashboard')

@section('content')
<div class="max-w-8xl mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-3xl font-bold text-white">PSA Jobs</h2>
        <button class="bg-blue-500 text-white px-4 py-2 rounded font-bold hover:bg-blue-600" onclick="openAddJobModal()">
            Add Service Name
        </button>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-gray-800 text-white rounded-lg">
            <thead>
                <tr class="bg-gray-700 text-left text-sm uppercase font-bold">
                    <th class="p-4">Service Name</th>
                    <th class="p-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach ($psaJobs as $job)
                <tr class="border-t border-gray-700 hover:bg-gray-600 transition">
                    <td class="p-4">{{ $job->Job_Title }}</td>
                    <td class="p-4 flex justify-end space-x-2">
                        <button class="bg-yellow-500 text-white px-4 py-2 rounded font-bold hover:bg-yellow-600" onclick="openEditJobModal({{ $job->id }}, '{{ $job->Job_Title }}')">Edit</button>
                        <form action="{{ route('admin.psajobs.destroy', $job->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this service?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded font-bold hover:bg-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
<!-- Add Job Modal -->
<div id="addJobModal" class="modal hidden fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center">
    <div class="modal-content bg-white rounded-lg shadow-lg p-6 w-1/2">
        <form action="{{ route('admin.psajobs.store') }}" method="POST">
            @csrf
            <div class="modal-header flex justify-between items-center mb-4">
                <h5 class="modal-title text-xl font-semibold text-gray-800">Add Service Name</h5>
                <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closeAddJobModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-4">
                    <label for="Job_Title" class="text-gray-700">Service Name</label>
                    <input type="text" name="Job_Title" class="form-control border border-gray-300 rounded-md p-2 w-full" required>
                </div>
            </div>
            <div class="modal-footer flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md font-semibold hover:bg-blue-600 transition">Save</button>
                <button type="button" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-md font-semibold hover:bg-gray-400 transition ml-2" onclick="closeAddJobModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Job Modal -->
<div id="editJobModal" class="modal hidden fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center">
    <div class="modal-content bg-white rounded-lg shadow-lg p-6 w-1/2">
        <form id="editJobForm" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="modal-header flex justify-between items-center mb-4">
                <h5 class="modal-title text-xl font-semibold text-gray-800">Edit Service Name</h5>
                <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closeEditJobModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-4">
                    <label for="edit_Job_Title" class="text-gray-700">Service Name</label>
                    <input type="text" name="Job_Title" id="edit_Job_Title" class="form-control border border-gray-300 rounded-md p-2 w-full" required>
                </div>
            </div>
            <div class="modal-footer flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md font-semibold hover:bg-blue-600 transition">Save</button>
                <button type="button" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-md font-semibold hover:bg-gray-400 transition ml-2" onclick="closeEditJobModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>




<script>
    function openAddJobModal() {
        const modal = document.getElementById('addJobModal');
        if (modal) {
            modal.classList.remove('hidden');
        }
    }

    function closeAddJobModal() {
        const modal = document.getElementById('addJobModal');
        if (modal) {
            modal.classList.add('hidden');
        }
    }

    function openEditJobModal(id, serviceName) {
        const modal = document.getElementById('editJobModal');
        const serviceNameInput = document.getElementById('edit_Job_Title');
        const editJobForm = document.getElementById('editJobForm');

        if (modal) {
            modal.classList.remove('hidden');
        }

        if (serviceNameInput) {
            serviceNameInput.value = serviceName;
        }

        if (editJobForm) {
            editJobForm.action = '/admin/psajobs/' + id; // Update the form action to point to the edit route
        }
    }

    function closeEditJobModal() {
        const modal = document.getElementById('editJobModal');
        if (modal) {
            modal.classList.add('hidden');
        }
    }
</script>

@endsection
