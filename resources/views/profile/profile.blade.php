<x-app-layout class="font-open-sans">
    <div class="mt-3 md:px-12 py-6 bg-white shadow-md sm:rounded-lg w-full md:w-3/5 mx-auto">
        <div class="flex flex-col md:flex-row w-10/12 mx-auto">

            {{-- Placeholder - User Profile Picture --}}
            <div class="flex justify-center md:justify-start mb-4 md:mb-0">
                <img class="inline-block h-40 w-40 rounded-full ring-2 ring-white"
                    src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                    alt="">
            </div>

            {{-- User's Name and Details --}}
            <div class="md:ml-6 w-full">
                <div class="text-custom-dark-blue font-bold text-2xl md:text-4xl text-center md:text-left">{{ Auth::user()->name }}</div>

                {{-- Service Category --}}
                <div class="text-gray-900 text-lg md:text-xl mt-2 text-center md:text-left">
                    {{ __('Service Category') }}:
                    {{-- {{ Auth::user()->service_category }} --}}
                </div>

                {{-- Placeholder - Ratings --}}
                <div class="flex flex-col md:flex-row items-center justify-between mt-2">
                    <div class="text-gray-900 text-lg md:text-xl">
                        {{ __('Ratings:') }}
                    </div>
                    <x-different-links class="mt-2 md:mt-0 h-12 w-full md:w-40 justify-center font-light border-transparent text-white text-base"
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
            <div class="flex flex-col md:flex-row justify-start space-y-2 md:space-y-0 md:space-x-4">
                <div class="text-md font-bold text-custom-light-blue">{{ __('Services Offered:') }}</div>
                <div class="border border-custom-light-blue p-2 rounded-3xl">{{ __('Service') }}</div>
            </div>
        </div>

        {{-- Placeholder - Provider Information Description --}}
        <div class="providerdescription w-10/12 mx-auto mt-4">
            <div class="font-normal">
                {{ 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque id leo ac eleifend. Nulla sed leo maximus, tempor nisl vitae, interdum diam. Nullam varius dui nibh, sed porta augue pharetra quis. Proin vulputate velit ac purus congue venenatis.' }}
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 w-10/12 mx-auto pb-6 md:pt-2">

            {{-- Placeholder - Provider Overview --}}
            <div class="w-full md:col-span-1 rounded-t-lg md:rounded-r-none md:pt-12 ">
                <div class="provideroverview">
                    <div class="text-2xl font-bold text-custom-light-blue">{{ __('Overview:') }}</div>

                    {{-- Placeholder for verifications, years worked, has equipment, etc --}}
                    <div class="flex pt-1">
                        <span class="material-symbols-outlined pr-2">pin_drop</span>
                        <div class="text-base text-custom-dark-text">{{ __('Hired _ times') }}</div>
                    </div>

                    <x-overview/>

                    {{-- Placeholder - Provider Address --}}
                    <div class="flex pt-1">
                        <span class="material-symbols-outlined pr-2">pin_drop</span>
                        <div class="text-base text-custom-dark-text">{{ __('Provider Address') }}</div>
                    </div>
                </div>
            </div>

            {{-- Placeholder - Provider Availability --}}
            <div class="w-full md:col-span-2 bg-white flex md:justify-end md:mt-4">
                <div class="md:w-4/5">
                    <div class="provideroverview pt-8">
                        <div class="text-2xl font-bold text-custom-light-blue md:mb-2">{{ __('Availability') }}</div>
                    </div>
                    <div class="md:border-2 md:border-custom-light-text md:rounded-2xl md:p-4 ml-auto">
                        <div class="space-y-4 md:space-y-0 md:grid md:grid-cols-2 md:gap-4">
                            <div class="flex justify-between items-center">
                                <div>Mon - Wed</div>
                                <div>9:00 AM - 5:00 PM</div>
                            </div>
                            <div class="flex justify-between items-center">
                                <div>Thu - Fri</div>
                                <div>10:00 AM - 6:00 PM</div>
                            </div>
                            <div class="flex justify-between items-center">
                                <div>Sat - Sun</div>
                                <div>10:00 AM - 4:00 PM</div>
                            </div>
                        </div>
                    </div>

                    <div class="text-2xl font-bold text-custom-light-blue pt-2 md:mb-2">{{ __('Contact') }}</div>
                    <div class="md:border-2 md:border-custom-light-text md:rounded-2xl p-4 ml-auto">
                        <x-contact-info/>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="border-t my-4 w-full mx-8"></div>
        </div>

        {{-- Placeholder - Photos Section --}}
        <div class="w-10/12 mx-auto">
            <div class="text-2xl font-bold text-custom-light-blue md:mb-2">{{ __('Photos') }}</div>
            <x-ratings-stars/>
        </div>
    </div>
</x-app-layout>