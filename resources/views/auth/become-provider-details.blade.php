<x-app-layout>
    <form action="{{ route('requests.store') }}" method="POST">
        @csrf

        <div class="md:mt-3 md:px-12 md:py-12 bg-white shadow-md sm:rounded-lg md:w-3/6 mx-auto">
            <div class="flex flex-col items-center space-y-6">
                <div class="text-2xl font-bold text-custom-light-blue">
                    {{ __("Become a Provider!") }}
                </div>
                
                <div>
                    {{ __("Edit your provider profile details") }}
                </div>
                
                <div class="border-t my-4 w-full"></div>

                {{-- Placeholder - Service Provider Profile Information --}}
                <div class="w-full md:w-8/12 space-y-6 mx-auto">
                    {{-- Description --}}
                    <div class="flex flex-col items-start">
                        <x-input-label for="provider_description" class="text-xl text-custom-dark-blue font-bold">
                            {{ __("Description") }}
                        </x-input-label>
                        <x-text-input id="provider_description" class="rounded border-gray-300 shadow-sm focus:ring-custom-light-blue w-full"/>
                    </div>
                        
                    {{-- Services Offered --}}
                    <div class="flex flex-col items-start">
                        <x-input-label for="services_offered" class="text-xl text-custom-dark-blue font-bold">
                            {{ __("Services Offered") }}
                        </x-input-label>
                        <x-text-input id="services_offered" class="rounded border-gray-300 shadow-sm focus:ring-custom-light-blue w-full"/>
                    </div>


                    {{-- Contact --}}
                    <div class="flex flex-col items-start">
                        <x-input-label for="provider_contact" class="text-xl text-custom-dark-blue font-bold">
                            {{ __("Contact") }}
                        </x-input-label>
                        <x-text-input id="provider_contact" class="rounded border-gray-300 shadow-sm focus:ring-custom-light-blue w-full"/>
                    </div>

                    {{-- Availability?--}}
                    <div class="flex flex-col items-start">
                        <x-input-label for="provider_contact" class="text-xl text-custom-dark-blue font-bold">
                            {{ __("Availability") }}
                        </x-input-label>
                        <x-text-input id="provider_contact" class="rounded border-gray-300 shadow-sm focus:ring-custom-light-blue w-full"/>
                    </div>

                    {{-- Tools / Equipment--}}
                    <div class="flex flex-col items-start">
                        <x-input-label for="provider_contact" class="text-xl text-custom-dark-blue font-bold">
                            {{ __("Availability") }}
                        </x-input-label>
                        <x-text-input id="provider_contact" class="rounded border-gray-300 shadow-sm focus:ring-custom-light-blue w-full"/>
                    </div>


                <!-- Hidden Inputs and Submit Button -->
                <div class="flex justify-center w-full">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="status" value="pending">
                    <button type="submit" class="mt-4 md:px-12 bg-custom-light-blue text-white font-bold py-2 rounded-lg">
                        {{ __("Submit") }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>