@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <div class="max-w-screen-5xl mx-auto">
        <form method="GET" action="{{ route('provider.search') }}" class="w-full">
            @csrf

            {{-- Filter Section --}}
            <div class="border-2 rounded-t-lg w-full mx-auto flex flex-wrap items-center justify-center p-4 space-y-4 md:space-y-0 md:space-x-4 mt-8 bg-cover bg-center bg-no-repeat rounded-r-lg bg-gradient-to-b from-sky-900 to-cyan-600">
                <div class="flex justify-center items-center w-full md:py-4 md:pt-6">
                    <div class="text-3xl md:text-2xl text-white font-semibold">Browse Agencies</div>
                </div>

                {{-- Search Bar --}}
                <div class="flex flex-col items-center text-header w-full md:w-auto">
                    <input type="text" id="provider-search" name="search" class="w-full rounded-3xl h-12 border border-custom-fields focus:border-custom-lightest-blue pl-4 pr-10" placeholder="Search...">
                    <button type="submit" class="h-11 w-full md:w-auto justify-center text-sm rounded-lg border text-white font-bold border-custom-lightestblue-accent border-3xl bg-none bg-custom-lightestblue-accent md:px-8">
                        {{ __('Search') }}
                    </button>
                </div>
            </div>

            {{-- Agency List --}}
            <div class="p-4 bg-white shadow-md w-full mx-auto pb-6 rounded-lg overflow-y-hidden" style="min-height: 60vh;">
                <div class="h-full overflow-y-auto p-4">
                    @if(isset($agencies))
                        <h3 class="text-xl font-bold mb-4">Agency List</h3>
                        @if($agencies->isEmpty())
                            <div class="bg-red-100 text-red-800 p-4 rounded mb-6">No agencies found.</div>
                        @else
                            <ul class="list-none space-y-4">
                                @foreach($agencies as $agency)
                                    <li class="mb-4">
                                        <div class="flex flex-col md:flex-row md:items-start space-y-4 md:space-y-0">
                                            <div class="md:w-1/4">
                                                @if ($agency->logo_path)
                                                    <img src="{{ asset('storage/' . $agency->logo_path) }}"
                                                        alt="{{ $agency->name }}"
                                                        class="w-16 h-16 object-cover rounded-full">
                                                @else
                                                    <span class="text-gray-400">No logo available</span>
                                                @endif
                                            </div>
                                            <div class="md:w-3/4">
                                                <div class="flex justify-between items-center mb-2">
                                                    <div class="font-medium text-lg">
                                                        {{ $agency->name }}
                                                    </div>
                                                    <div class="font-normal text-custom-default-text mb-4">
                                                        {{ strlen($agency->address) > 100 ? substr($agency->address, 0, 100) . '...' : $agency->address }}
                                                    </div>
                                                </div>
                                                <div class="font-normal text-custom-default-text mb-4">
                                                    @foreach($agency->services as $service)
                                                        <div>
                                                            <strong>{{ $service->service_name }}</strong>: {{ $service->description }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="flex justify-end items-center space-x-4">
                                                    <a href="{{ route('view-agency-profile', $agency->id) }}" class="text-base h-10 px-4 rounded-md bg-white border border-gray-300 hover:text-custom-light-blue text-custom-lightest-blue flex items-center justify-center">
                                                        {{ __('View Profile') }}
                                                    </a>
                                                    
                                                    
{{--                                                    
                                                    <button type="button" onclick="showConfirmationModal({{ $agency->id }})" class="text-base h-10 px-4 rounded-md bg-green-500 hover:bg-green-700 text-white flex items-center justify-center">
                                                        {{ __('Direct Hire') }}
                                                    </button>
                                                    
                                                    
                                                    --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-t my-4"></div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    @else
                        {{-- Display a message if no search has been performed yet --}}
                        <div class="bg-gray-100 text-gray-800 p-4 rounded mb-6">Please enter a search term.</div>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-bold mb-4">Confirm Direct Hire</h2>
            <p>Are you sure you want to hire this agency?</p>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="hideConfirmationModal()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancel</button>
                <button type="button" onclick="confirmHire()" class="bg-green-500 text-white px-4 py-2 rounded">Confirm</button>
            </div>
        </div>
    </div>

    <script>
        function showConfirmationModal(agencyId) {
            document.getElementById('confirmationModal').dataset.agencyId = agencyId;
            document.getElementById('confirmationModal').classList.remove('hidden');
        }

        function hideConfirmationModal() {
            document.getElementById('confirmationModal').classList.add('hidden');
        }

        function confirmHire() {
            var agencyId = document.getElementById('confirmationModal').dataset.agencyId;
            window.location.href = '/direct-hire/create/' + agencyId;
        }
    </script>
@endsection
