@extends('layouts.app')

@section('content')
    <div class="mt-3 md:px-12 py-6 bg-white shadow-md sm:rounded-lg w-full md:w-4/5 mx-auto">
        <div class="flex flex-col md:flex-row w-10/12 mx-auto">
            {{-- User Profile Picture --}}
        {{--    <div class="flex justify-center md:justify-between mb-4 md:mb-0">
                 If you want to display the provider's profile picture, uncomment the line below --}}
                {{-- <img src="{{ Storage::url($providerDetail->profile_picture) }}" alt="Profile Picture" class="rounded-full h-20 w-20 mr-4"> 
            </div>--}}

            {{-- User's Name and Edit Profile Button --}}
            <div class="w-full flex justify-between items-center">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="text-custom-dark-blue font-bold text-2xl md:text-4xl text-center md:text-left">
                        {{ $user->name }}
                    </div>
                </div>

                {{-- Edit Profile Button aligned to the far right with custom color --}}
                <div class="ml-auto">
                    <a href="{{ route('seekerprofile-edit') }}" class="bg-custom-lightest-blue text-white px-4 py-2 rounded transform transition-transform duration-300 hover:scale-105 hover:shadow-xl">
                        Edit Profile
                    </a>
                </div>
            </div>

    
        </div>


        <div class="flex justify-center mx-8 pt-4">
            <div class="border-t my-4 w-full mx-8"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 w-10/12 mx-auto gap-4">
            {{-- Contact --}}
            <div class="w-full md:border-r text-center">
                <div class="text-xl font-semibold text-gray-800">{{ __('Contact Details') }}</div>
                <div class="md:rounded-2xl md:p-4 mx-auto text-custom-header">
                    <div class="block w-full justify-center text-start text-base focus:outline-none">
                        <div class="flex md:pb-2">
                            <span class="material-icons pr-2 text-gray-500">call</span>
                            <div class="pb-2">+{{ $user->cell_no ?? 'N/A' }}</div>
                        </div>
                        <div class="flex md:pb-2">
                            <span class="material-icons text-gray-500 pr-2">mail</span>
                            <div class="pb-2">{{ $user->email }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Location --}}
            <div class="w-full text-center">
                <div class="text-xl font-semibold text-gray-800">{{ __('Location') }}</div>
                <div class="md:rounded-2xl md:p-4 mx-auto">
                    <div class="block w-full justify-center text-start text-base focus:outline-none">
                        <div class="flex md:pb-2">
                            <span class="material-icons text-gray-500 pr-2">pin_drop</span>
                            <div class="pb-2">{{ $user->address ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
