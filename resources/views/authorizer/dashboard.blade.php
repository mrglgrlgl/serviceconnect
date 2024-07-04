{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Authorizer Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Authorizer Dashboard') }}
        </h2>
    </x-slot>

<x-slot name="tabble">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">User Name</th>
                                <th class="px-4 py-2">User Email</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($requests as $request)
                            <tr>
                                <td class="border px-4 py-2">{{ $request->status }}</td>
                                <td class="border px-4 py-2">{{ $request->user->name }}</td>
                                <td class="border px-4 py-2">{{ $request->user->email }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('requests.accept', $request->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Accept</a>
                                    <a href="{{ route('requests.decline', $request->id) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Decline</a>
                                </td>
                            </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
                </x-slot>
            </div>
        </div>
    </div>
</x-app-layout>