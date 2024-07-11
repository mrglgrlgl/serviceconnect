
    @if (Auth::check())
        @php
            $nameParts = explode(' ', Auth::user()->name, 2);
            $firstName = isset($nameParts[0]) ? $nameParts[0] : '';
            $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
        @endphp
    @endif

    <form action="{{ route('save-step1') }}" method="POST">
        @csrf
        <div class="flex flex-col items-start">
            <x-input-label for="first_name" class="text-base md:text-base font-semibold text-custom-dark-blue ">
                {{ 'First Name' }}
            </x-input-label>
            <div class="relative w-full">
                <x-provider-edit-input id="first_name" value="{{ $firstName }}" readonly
                    class="bg-gray-100 cursor-not-allowed focus:outline-none focus:ring-0" />
            </div>
        </div>
        <div class="flex flex-col items-start">
            <x-input-label for="last_name" class="text-base md:text-base text-custom-dark-blue font-semibold">
                {{ 'Last Name' }}
            </x-input-label>
            <div class="relative w-full">
                <x-provider-edit-input id="first_name" value="{{ $lastName }}" readonly
                    class="bg-gray-100 cursor-not-allowed focus:outline-none focus:ring-0" />
            </div>
        </div>
        <div class="flex flex-col items-start">
            <x-input-label for="email" class="text-base md:text-base text-custom-dark-blue font-semibold">
                {{ 'Email' }}
            </x-input-label>
            <div class="relative w-full">
                <x-provider-edit-input id="first_name" value="{{ Auth::user()->email }}" readonly
                    class="bg-gray-100 cursor-not-allowed focus:outline-none focus:ring-0" />
            </div>
        </div>



    {{-- Services Offered --}}
    {{-- <div class="flex flex-col items-start relative">
                <x-input-label for="services_offered" class="text-lg md:text-xl text-custom-dark-blue font-semibold">
                    {{ __('Services Offered') }}
                </x-input-label>

                {{-- Insert services offered and add input fields here --}}
    {{-- <div id="services_offered_container" class="w-full relative">
                    <x-provider-edit-input id="services_offered" name="services_offered[]" />
                </div>
            </div> --}}

        {{-- Contact Details --}}
        <div class="flex flex-col items-start">
            <x-input-label for="email" class="text-base md:text-base text-custom-dark-blue font-semibold">
                {{ __('Work Email') }}
            </x-input-label>
            <div id="work_email" class="flex w-full">
                <div
                    class="rounded-l-lg border-r-none border border-gray-300 shadow-sm focus:ring-custom-light-blue p-2">
                    <span class="material-symbols-outlined">mail</span>
                </div>
                <div class="relative flex-1">
                    <x-provider-edit-input id="work_email" name="work_email" />
                </div>
            </div>
        </div>


        {{-- Availability --}}
        {{-- <div class="flex flex-col items-start">
                <x-input-label for="provider_availability" class="text-lg md:text-xl text-custom-dark-blue font-semibold">
                    {{ __('Availability') }}
                </x-input-label>
                <div id="provider_availability_container" class="relative w-full">

                    {{-- Insert provider availability schedule here
                    <x-provider-edit-input id="provider_availability" name="provider_availability[]" />
                </div>
            </div> --}}

        <div class="flex flex-col items-start">
            <x-input-label for="contact_number" class="text-base md:text-base text-custom-dark-blue font-semibold">
                {{ __('Contact Number') }}
            </x-input-label>
            <div class="flex w-full">
                <div
                    class="rounded-l-lg border-r-none border border-gray-300 shadow-sm focus:ring-custom-light-blue p-2">
                    <span class="material-symbols-outlined">call</span>
                </div>
                <div class="relative flex-1">
                    <x-provider-edit-input id="contact_number" name="contact_number" />
                </div>
            </div>
        </div>

        <div class="flex justify-center">
            <x-primary-button type="submit" class="btn btn-primary">Next</x-primary-button>
            </div>

        {{-- Tools / Equipment --}}
        {{-- <div class="flex flex-col items-start">
                <div class="flex items-center space-x-4">
                    <x-input-label for="provider_tools" class="text-lg md:text-xl text-custom-dark-blue font-semibold">
                        {{ __('Have tools / equipment?') }}
                    </x-input-label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="tools_equipment" value="yes"
                            clas="form-radio text-custom-light-blue">
                        <span class="ml-2">{{ __('Yes') }}</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="tools_equipment" value="no"
                            class="form-radio text-custom-light-blue">
                        <span class="ml-2">{{ __('No') }}</span>
                    </label>
                </div>
                <div id="provider_tools_container" class="relative w-full">

                    <x-provider-edit-input id="provider_tools" name="provider_tools[]" />
                    <span
                        class="material-symbols-outlined add-box absolute right-2 top-1/2 transform -translate-y-1/2 text-custom-light-blue cursor-pointer text-2xl"data-container-id="provider_tools_container">add_box</span>
                </div>
            </div> --}}

        <!-- Hidden Inputs and Submit Button -->
        <!-- Success or Error Messages -->
        @if (session('success'))
            <div class="alert alert-success mt-4">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger mt-4">
                {{ session('error') }}
            </div>
        @endif
    </div>
    </form>
