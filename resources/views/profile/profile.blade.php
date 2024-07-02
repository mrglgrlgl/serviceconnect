<x-app-layout class="font-open-sans">

    <div class="mt-3 md:px-12 py-6 bg-white shadow-md sm:rounded-lg w-3/5 mx-auto">
        <div class="flex w-10/12 mx-auto">

            {{-- User Profile Picture --}}
            <img class="inline-block h-40 w-40 rounded-full ring-2 ring-white"
                src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                alt="">

            {{-- User's Name and Details --}}
            <div class="ml-6 w-full">
                <div class="mt-6 text-custom-dark-blue font-bold text-4xl">{{ Auth::user()->name }}</div>

                {{-- @if (!empty(Auth::user()->service_category)) --}}
                    <div class=" text-gray-900 text-xl">
                        {{-- Insert service Category --}}
                        {{ __('Service Category') }}: 
                        {{-- {{ Auth::user()->service_category }}  --}}
                    </div>
                {{-- @endif --}}

                {{-- Ratings --}}
                <div class="flex items-center justify-between">
                    <div class="text-gray-900 text-xl">
                        {{-- Insert ratings --}}
                        {{ __('Ratings:') }}
                    </div>
                    <x-different-links class="h-12 w-40 justify-center font-light border-transparent text-white text-base"
                        :href="route('profile.edit')">
                        {{ __('Edit profile') }}
                    </x-different-links>
                </div>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="border-t my-4 w-full mx-8"></div>
        </div>

        {{-- Provider Details --}}
        <div class="providerservices w-10/12 mx-auto">
            <div class="flex justify-start space-x-4">
                <div class="text-md font-bold text-custom-light-blue">{{ __('Services Offered:') }}</div>
                {{-- Insert services offered --}}
                <div class="border border-custom-light-blue p-2 rounded-3xl">{{ __('Service') }}</div>
            </div>
        </div>

        {{-- Provider Information Description --}}
        <div class="providerdescription w-10/12 mx-auto">
            <div class="mt-4 font-normal">
                {{-- Insert Provider Description --}}
                {{ 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque id leo ac eleifend. Nulla sed leo maximus, tempor nisl vitae, interdum diam. Nullam varius dui nibh, sed porta augue pharetra quis. Proin vulputate velit ac purus congue venenatis.' }}
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 w-10/12 mx-auto pb-6 md:pt-2">

            {{-- Provider Overview --}}
            <div class="w-full md:col-span-1 rounded-t-lg md:rounded-r-none">
                <div class="provideroverview md:pt-8">
                    <div class="text-2xl font-bold text-custom-light-blue">{{ __('Overview:') }}</div>

                    {{-- Placeholder for verifications, years worked, has equipment, etc --}}
                    {{-- Amount of times hired --}}
                    <div class="flex pt-1">
                        <span class="material-symbols-outlined pr-2">pin_drop</span>
                        <div class="text-base text-custom-dark-text">{{ __('Hired _ times') }}</div>
                    </div>

                    <x-overview/>

                    {{-- Provider Address --}}
                    <div class="flex pt-1">
                        {{-- Insert Provider Address --}}
                        <span class="material-symbols-outlined pr-2">pin_drop</span>
                        <div class="text-base text-custom-dark-text">{{ __('Provider Address') }}</div> 
                    </div>
                </div>
            </div>

            {{-- Provider Availability --}}
            <div class="w-full md:col-span-2 bg-white flex justify-end ">
                <div class="md:w-4/5">
                    <div class="provideroverview pt-8 ">
                        <div class="text-2xl font-bold text-custom-light-blue md:mb-2">{{ __('Availability') }}</div>

                    </div>
                    <div class="md:border-2 md:border-custom-light-text md:rounded-2xl p-4 ml-auto">

                        {{-- Insert Availability of Providers --}}
                        <div class="flex justify-between items-center md:pb-4">
                            <div>Mon - Wed</div>
                            <div>9:00 AM - 5:00 PM</div>
                        </div>
                        <div class="flex justify-between items-center md:pb-4">
                            <div>Mon - Wed</div>
                            <div>9:00 AM - 5:00 PM</div>
                        </div>
                        <div class="flex justify-between items-center md:pb-4">
                            <div>Mon - Wed</div>
                            <div>9:00 AM - 5:00 PM</div>
                        </div>
                    </div>

                    <div class="text-2xl font-bold text-custom-light-blue pt-2 md:mb-2">{{ __('Contact') }}</div>
                <div class="md:border-2 md:border-custom-light-text md:rounded-2xl p-4 ml-auto">

                {{-- Contact info component --}}
                <x-contact-info/>

                </div>
            </div>
        </div>
    </div>


    <div class="flex justify-center">
        <div class="border-t my-4 w-full mx-8"></div>
    </div>

        {{-- Photos Section --}}
        <div class="w-10/12 mx-auto">
            <div class="text-2xl font-bold text-custom-light-blue md:mb-2">{{ __('Photos') }}</div>
            {{-- Insert Photos --}}
            <x-ratings-stars/>
        </div>
    </div>
</x-app-layout>