<x-app-layout>
    @if (Auth::check())
        @php
            $nameParts = explode(' ', Auth::user()->name, 2);
            $firstName = isset($nameParts[0]) ? $nameParts[0] : '';
            $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
        @endphp
    @endif

    <div class="mt-6 px-6 py-8 bg-white shadow-md sm:rounded-lg w-full md:w-5/12 mx-auto">
        <div class="flex flex-col items-center">
            <div class="text-2xl font-bold text-custom-light-blue pb-6">
                {{ __('Become a Provider!') }}
            </div>

            <div class="w-full flex justify-between items-center">
                <a class="text-center text-custom-dark-blue w-1/3">
                    Step 1
                </a>
                <a class="text-center text-custom-dark-blue w-1/3">
                    Step 2
                </a>
                <a class="text-center text-custom-dark-blue w-1/3">
                    Step 3
                </a>
            </div>

            <div class="w-full flex justify-between items-center pb-2">
                <a class="text-center text-sm font-medium text-custom-dark-blue w-1/3">
                    Profile Details
                </a>
                <a class="text-center text-sm font-medium text-custom-dark-blue w-1/3">
                    Service Category Details
                </a>
                <a class="text-center text-sm font-medium text-custom-dark-blue w-1/3">
                    Step 3
                </a>
            </div>

            <div class="w-full flex justify-between items-center mt-2">
                <a class="bg-custom-light-blue h-2 w-1/3 rounded-l-lg"></a>
                <a class="bg-gray-300 h-2 w-1/3"></a>
                <a class="bg-gray-300 h-2 w-1/3 rounded-r-lg"></a>
            </div>
        </div>
        
        <div class="border-t my-4 w-full pb-6"></div>

        <div class="w-full md:w-7/12 space-y-6 mx-auto mt-4">
            <form action="{{ route('save-step1') }}" method="POST" class="space-y-4">
                @csrf
                <div class="flex flex-col items-start">
                    <x-input-label for="first_name" class="text-base text-custom-default-text">
                        {{ 'First Name' }}
                    </x-input-label>
                    <div class="relative w-full">
                        <x-provider-edit-input id="first_name" value="{{ $firstName }}" readonly
                            class="bg-gray-100 cursor-not-allowed focus:outline-none focus:ring-0" />
                    </div>
                </div>
                <div class="flex flex-col items-start">
                    <x-input-label for="last_name" class="text-base text-custom-default-text">
                        {{ 'Last Name' }}
                    </x-input-label>
                    <div class="relative w-full">
                        <x-provider-edit-input id="last_name" value="{{ $lastName }}" readonly
                            class="bg-gray-100 cursor-not-allowed focus:outline-none focus:ring-0" />
                    </div>
                </div>
                <div class="flex flex-col items-start">
                    <x-input-label for="email" class="text-base text-custom-default-text">
                        {{ 'Email' }}
                    </x-input-label>
                    <div class="relative w-full">
                        <x-provider-edit-input id="email" value="{{ Auth::user()->email }}" readonly
                            class="bg-gray-100 cursor-not-allowed focus:outline-none focus:ring-0" />
                    </div>
                </div>

                {{-- Contact Details --}}
                <div class="flex flex-col items-start">
                    <x-input-label for="work_email" class="text-base text-custom-default-text">
                        {{ __('Work Email') }}
                    </x-input-label>
                    <div class="flex w-full">
                        <div class="rounded-l-lg border-r-none border border-gray-300 shadow-sm p-2">
                            <span class="material-symbols-outlined">mail</span>
                        </div>
                        <div class="relative flex-1">
                            <x-provider-edit-input id="work_email" name="work_email" />
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-start">
                    <x-input-label for="contact_number" class="text-base text-custom-default-text">
                        {{ __('Contact Number') }}
                    </x-input-label>
                    <div class="flex w-full">
                        <div class="rounded-l-lg border-r-none border border-gray-300 shadow-sm p-2">
                            <span class="material-symbols-outlined">call</span>
                        </div>
                        <div class="relative flex-1">
                            <x-provider-edit-input id="contact_number" name="contact_number" />
                        </div>
                    </div>
                </div>

                <div class="flex justify-center pt-6">
                    <x-primary-button type="submit" class="rounded-md px-8 text-lg font-medium text-white">Next</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>