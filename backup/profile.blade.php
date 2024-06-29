<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboarddd') }}
        </h2>
    </x-slot>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="mt-3 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg">

    <x-slot name="profilepic">
        <div class="flex">
            <img class="inline-block h-40 w-40 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
        
        <!-- User's Name -->
        <div class="mt-6 text-custom-dark-blue text-3xl ml-6">{{ Auth::user()->name }}</div>
        </div>
        <div class="">
        <div class="p-6 text-gray-900">
        {{ __("Service Category") }}
        </div>
 
    </x-slot>
        </div>
    </div>
</x-app-layout>
