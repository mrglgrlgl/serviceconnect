<x-app-layout>
    <div class="relative w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 mx-auto pt-4 overflow-hidden">
        <div class="font-semibold text-3xl md:pb-4">{{ __('Dashboard') }}</div>
    </div>

    <!-- Pending Requests Section -->
    <div class="overflow-x-auto p-4 bg-white shadow-sm rounded-lg md:mb-4 w-full md:w-11/12 mx-auto">
        <div class="bg-gray-100 border border-gray-200 rounded-lg overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 p-4 bg-gray-200">
                <div class="col-span-1 font-semibold text-sm">User Name</div>
                <div class="col-span-1 font-semibold text-sm">Contact Information</div>
                <div class="col-span-1 font-semibold text-sm">PhilID Number</div>
                <div class="col-span-1 font-semibold text-sm">Date of Birth</div>
                <div class="col-span-1 font-semibold text-sm">Gender</div>
            </div>

            @if (!empty($requests))
                @foreach ($requests as $request)
                    @if ($request->user && $request->user->philidCard)  <!-- Check if user and philidCard exist -->
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden mt-4 hover:bg-gray-100">
                            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 p-4 {{ $loop->odd ? 'bg-gray-50' : 'bg-white' }}">
                                <div class="col-span-1">{{ $request->user->given_names }} {{ $request->user->last_name }}</div> <!-- Display user's full name -->
                                <div class="col-span-1">
                                    <div>
                                        {{ $request->user->email }}  <!-- Display user's email -->
                                    </div>
                                    <div>
                                        {{ $request->user->contact_number ?? 'N/A' }}  <!-- Display user's contact number -->
                                    </div>
                                </div>
                                <div class="col-span-1">{{ $request->user->philidCard->philid_number }}</div>  <!-- Display PhilID number -->
                                <div class="col-span-1">{{ $request->user->philidCard->date_of_birth }}</div>  <!-- Display date of birth -->
                                <div class="col-span-1">{{ $request->user->philidCard->gender }}</div>  <!-- Display gender -->
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <p class="p-4">No approved requests found.</p>
            @endif
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="relative bg-white rounded-lg shadow-lg overflow-hidden">
            <button class="absolute top-2 right-2 text-white text-2xl" onclick="closeModal()">&times;</button>
            <img id="modalImage" src="" alt="Enlarged Image" class="max-w-full max-h-screen">
        </div>
    </div>

    <script>
        function openModal(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.getElementById('modalImage').src = '';
        }
    </script>
</x-app-layout>
