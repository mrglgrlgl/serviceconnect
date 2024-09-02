<x-agency-dashboard>
    @if (session('status'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('assign.employees', ['channel_id' => $channel->id]) }}">
        @csrf
        <input type="hidden" name="channel_id" value="{{ $channel->id }}">
        <input type="hidden" name="agency_id" value="{{ $agencyId }}">

        <div class="bg-white rounded-lg border p-6">
            <h2 class="text-xl font-semibold mb-4">Available Employees</h2>

            <ul class="space-y-4">
                @foreach($employees as $employee)
                    <li class="p-4 border rounded-lg flex items-center">
                        @if($employee->photo)
                            <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}" class="w-16 h-16 rounded-md shadow-sm object-cover">
                        @else
                            <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile" class="w-16 h-16 rounded-md shadow-sm object-cover">
                        @endif
                        <span class="ml-4">{{ $employee->name }}</span>
                        <input type="checkbox" name="employee_ids[]" value="{{ $employee->id }}" class="ml-auto">
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Assign Employees</button>
        </div>
    </form>
<div class="mt-6">
        <a href="{{ route('channel.agency', ['serviceRequestId' => $channel->service_request_id]) }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Return to Channel</a>
    </div>
</x-agency-dashboard>
