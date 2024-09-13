@extends('layouts.app')

@section('content')
@extends('layouts.app')

@section('content')
    <div class="mt-3 md:px-12 py-6 bg-white shadow-md sm:rounded-lg w-full md:w-4/5 mx-auto">
        <div class="flex flex-col md:flex-row w-10/12 mx-auto">
            {{-- User Profile Picture --}}
            <div class="flex justify-center md:justify-start mb-4 md:mb-0">
                {{-- Uncomment if profile picture is available --}}
                {{-- @if ($providerDetail->profile_picture)
                    <img src="{{ Storage::url($providerDetail->profile_picture) }}" alt="Profile Picture" class="rounded-full h-20 w-20 mr-4">
                @endif --}}
            </div>

            {{-- User's Name and Details --}}
            <div class="w-full">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="flex flex-col md:flex-row items-center">
                        <div class="text-custom-dark-blue font-bold text-2xl md:text-4xl text-center md:text-left">
                            {{ $user->name }}
                        </div>
                        {{-- Uncomment if verification status is needed --}}
                        {{-- @if ($user->philidCards && $user->philidCards->status === 'Accepted')
                            <span class="text-green-500 ml-2 flex items-center">
                                <span class="material-icons">check_circle</span>
                                Verified
                            </span>
                        @else
                            <span class="text-red-500 ml-2">Not Verified</span>
                        @endif --}}
                    </div>
                    {{-- Edit Profile Button --}}
                    {{-- <a href="{{ route('profile.edit') }}" class="ml-4 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
                        Edit Profile
                    </a> --}}
                </div>
            </div>
        </div>

        {{-- Contact and Location --}}
        <div class="mt-6 w-10/12 mx-auto">
            <div class="text-xl font-semibold text-gray-800">{{ __('Contact Details and Location') }}</div>
            <div class="md:rounded-2xl md:p-4 mx-auto">
                <div class="block w-full text-start text-base">
                    <div class="flex items-center mb-2">
                        <span class="material-icons pr-2 text-gray-500">call</span>
                        <div>+{{ $user->cell_no ?? 'N/A' }}</div>
                    </div>
                    <div class="flex items-center mb-2">
                        <span class="material-icons text-gray-500 pr-2">mail</span>
                        <div>{{ $user->email }}</div>
                    </div>
                    <div class="flex items-center">
                        <span class="material-icons text-gray-500 pr-2">pin_drop</span>
                        <div>{{ $user->address ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
