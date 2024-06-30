<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboarddd') }}
        </h2>
    </x-slot>

    <div class="mt-3 px-6 py-6 bg-white shadow-md sm:rounded-lg w-3/5">
        <x-slot name="profilepic">
            <div class="flex">
                <img class="inline-block h-40 w-40 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">

                <!-- User's Name and Details -->
                <div class="ml-6">
                    <div class="mt-6 text-custom-dark-blue text-3xl">{{ Auth::user()->name }}</div>
                    
                    {{-- @if(!empty(Auth::user()->service_category)) --}}
                        <div class="mt-2 text-gray-900 text-xl">
                            {{ __("Service Category") }}: {{ Auth::user()->service_category }}
                        </div>
                    {{-- @endif --}}
                    
                    {{-- Ratings --}}
                    <div class="mt-2 text-gray-900 text-xl">
                        {{ __("Ratings:") }}
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <x-different-links class="h-12 w-40 justify-center font-light border-transparent text-white text-sm" :href="route('profile.edit')">
                    {{ __('Edit profile') }}
                </x-different-links>
            </div>

            <div class="text-center justify-center">
                <div class="border-t my-4 relative text-center"></div>
            </div>
        </x-slot>

        {{-- Provider Details: --}}
        <x-slot name="providerinfo">
            {{-- Services Offered --}}
            <div class="flex justify-start space-x-4">
                <div class="text-md font-bold text-custom-light-blue">{{_('Services Offered:') }}</div>
                <div class="border border-custom-light-blue p-2 rounded-3xl">{{_('Service') }}</div>
            </div>

            {{-- Provider Information Description --}}
            <div class="font-normal">{{ 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque id leo ac eleifend. Nulla sed leo maximus, tempor nisl vitae, interdum diam. Nullam varius dui nibh, sed porta augue pharetra quis. Proin vulputate velit ac purus congue venenatis.' }}</div>
        </x-slot>
    </div>
</x-app-layout>
