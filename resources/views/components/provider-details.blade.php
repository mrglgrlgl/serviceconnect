<div class="md:mt-3 md:px-12 md:py-12 bg-white shadow-md sm:rounded-lg md:w-3/6 mx-auto">
    <div class="flex flex-col items-center space-y-6">
        <div class="text-2xl font-bold text-custom-light-blue">
            {{ __('Become a Provider!') }}
        </div>

        <div>{{ __('Edit your provider profile details') }}</div>

        <div class="border-t my-4 w-full"></div>


        <div class="w-full md:w-8/12 space-y-6 mx-auto">
            <div class="flex flex-col items-start">
                <x-input-label for="first_name" class="text-lg md:text-xl text-custom-dark-blue font-bold">
                    {{ __('First Name') }}
                </x-input-label>
                <div class="relative w-full">
                    {{-- Insert first name --}}
                    <x-provider-edit-input name="first_name" />
                </div>
            </div>

            <div class="flex flex-col items-start">
                <x-input-label for="last_name" class="text-lg md:text-xl text-custom-dark-blue font-bold">
                    {{ __('Last Name') }}
                </x-input-label>
                <div class="relative w-full">
                    {{-- Insert last name --}}
                    <x-provider-edit-input name="last_name" />
                </div>
            </div>

            <div class="flex flex-col items-start">
                <x-input-label for="email" class="text-lg md:text-xl text-custom-dark-blue font-bold">
                    {{ __('Email') }}
                </x-input-label>
                <div class="relative w-full">
                    {{-- Insert last name --}}
                    <x-provider-edit-input name="email" />
                </div>
            </div>


            {{-- Services Offered --}}
            {{-- <div class="flex flex-col items-start relative">
                <x-input-label for="services_offered" class="text-lg md:text-xl text-custom-dark-blue font-bold">
                    {{ __('Services Offered') }}
                </x-input-label>

                {{-- Insert services offered and add input fields here --}}
               {{-- <div id="services_offered_container" class="w-full relative">
                    <x-provider-edit-input id="services_offered" name="services_offered[]" />
                </div>
            </div> --}}


            {{-- Contact Details --}}
            <div class="flex flex-col items-start">
                <x-input-label for="provider_contact" class="text-lg md:text-xl text-custom-dark-blue font-bold">
                    {{ __('Work Email') }}
                </x-input-label>
                <div id="provider_contact_container" class="flex w-full">
                    <div name="provider_contact_type[]"
                        class="rounded-l-lg border-r-none border border-gray-300 shadow-sm focus:ring-custom-light-blue p-2">
                        <span class="material-symbols-outlined">mail</span>
                    </div>
                    <div class="relative flex-1">
                        <x-provider-edit-input id="provider_contact" name="provider_contact[]" />
                    </div>
                </div>
            </div>

            {{-- Availability --}}
            {{-- <div class="flex flex-col items-start">
                <x-input-label for="provider_availability" class="text-lg md:text-xl text-custom-dark-blue font-bold">
                    {{ __('Availability') }}
                </x-input-label>
                <div id="provider_availability_container" class="relative w-full">

                    {{-- Insert provider availability schedule here
                    <x-provider-edit-input id="provider_availability" name="provider_availability[]" />
                </div>
            </div> --}}

            <div class="flex flex-col items-start">
                <x-input-label for="provider_contact" class="text-lg md:text-xl text-custom-dark-blue font-bold">
                    {{ __('Contact Number') }}
                </x-input-label>
                <div id="provider_contact_container" class="flex w-full">
                    <div name="provider_contact_type[]"
                        class="rounded-l-lg border-r-none border border-gray-300 shadow-sm focus:ring-custom-light-blue p-2">
                        <span class="material-symbols-outlined">call</span>
                    </div>
                    <div class="relative flex-1">
                        <x-provider-edit-input id="provider_contact" name="provider_contact[]" />
                    </div>
                </div>
            </div>

            {{-- Tools / Equipment --}}
            {{-- <div class="flex flex-col items-start">
                <div class="flex items-center space-x-4">
                    <x-input-label for="provider_tools" class="text-lg md:text-xl text-custom-dark-blue font-bold">
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
            <div class="flex justify-center w-full">
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input type="hidden" name="status" value="pending">
                <button type="submit" class="mt-4 md:px-12 bg-custom-light-blue text-white font-bold py-2 rounded-lg">
                    {{ __('Submit') }}
                </button>
            </div>
        </div>
    </div>
</div>
</form>
