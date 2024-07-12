<x-app-layout>
    <div class="relative w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 mx-auto pt-4 overflow-hidden">
        <div class="font-semibold text-3xl md:pb-4">{{ __('Dashboard') }}</div>
        <div class="flex items-center space-x-4 sm:space-x-12 md:space-x-20 lg:space-x-28 xl:space-x-28 2xl:space-x-28 overflow-x-auto md:overflow-hidden">
            {{-- Categories --}}
            <x-category-link :href="route('home')" class="inline-block hover:border-custom-lightest-blue border-custom-lightest-blue">
                <div class="flex flex-col items-center text-base md:text-xl">
                    {{ __('Pending') }}
                </div>
            </x-category-link>
            <x-category-link class="inline-block hover:border-custom-lightest-blue border-custom-lightest-blue">
                <div class="flex flex-col items-center text-base md:text-xl">
                    {{ __('Approved') }}
                </div>
            </x-category-link>
        </div>
    </div>

    <div class="flex justify-center">
        <div class="border-t my-2 w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 text-center"></div>
    </div>

    {{-- Insert user's name and other details here --}}
    @if (!empty($requests))
        @foreach ($requests as $request)
            @if ($request->providerDetail)
                <div class="py-12">
                    <div class="w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 mx-auto">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 font-medium">
                                <div>
                                    <div>{{ $request->user->name }}</div>
                                    <div>{{ $request->providerDetail->serviceCategory }}</div>
                                    <div>{{ $request->providerDetail->created_at }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif

    <div class="py-12">
        <div class="w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 font-medium">
                    <div class="container mx-auto p-4">
                        <h1 class="text-2xl font-bold mb-4">Requests Dashboard</h1>
                        @if (!empty($requests))
                            <div class="overflow-x-auto">
                                <table class="w-full border-collapse">
                                    <tbody>
                                        @foreach ($requests as $request)
                                            <tr>
                                                <td class="border px-4 py-2">{{ $request->id }}</td>
                                                <td class="border px-4 py-2">{{ $request->user->name }}</td> {{-- Display user's name --}}
                                                <td class="border px-4 py-2">{{ $request->status }}</td>
                                                <td class="border px-4 py-2">{{ $request->created_at }}</td>
                                                <td class="border px-4 py-2">
                                                    <form action="{{ route('requests.accept', $request->id) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Accept</button>
                                                    </form>
                                                    <form action="{{ route('requests.decline', $request->id) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Decline</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @if ($request->providerDetail)
                                                <tr>
                                                    <td colspan="5" class="border px-4 py-2">
                                                        <h2 class="text-lg font-semibold">Provider Details</h2>
                                                        <table class="w-full mt-2 border-collapse">
                                                            <tr>
                                                                <th class="px-4 py-2 border bg-gray-100">Work Email</th>
                                                                <th class="px-4 py-2 border bg-gray-100">Contact Number</th>
                                                                <th class="px-4 py-2 border bg-gray-100">Service Category</th>
                                                                <th class="px-4 py-2 border bg-gray-100">Sub Category</th>
                                                                <th class="px-4 py-2 border bg-gray-100">Description</th>
                                                                <th class="px-4 py-2 border bg-gray-100">Government ID Front</th>
                                                                <th class="px-4 py-2 border bg-gray-100">Government ID Back</th>
                                                                <th class="px-4 py-2 border bg-gray-100">NBI Clearance</th>
                                                                <th class="px-4 py-2 border bg-gray-100">TESDA Certification</th>
                                                                <th class="px-4 py-2 border bg-gray-100">Other Credentials</th>
                                                            </tr>
                                                            <tr>
                                                                <td class="border px-4 py-2">{{ $request->providerDetail->work_email }}</td>
                                                                <td class="border px-4 py-2">{{ $request->providerDetail->contact_number }}</td>
                                                                <td class="border px-4 py-2">{{ $request->providerDetail->serviceCategory }}</td>
                                                                <td class="border px-4 py-2">{{ $request->providerDetail->subcategory }}</td>
                                                                <td class="border px-4 py-2">{{ $request->providerDetail->description }}</td>
                                                                <td class="border px-4 py-2">
                                                                    <img src="{{ asset('storage/' . $request->providerDetail->government_id_front) }}" alt="Government ID Front" class="w-24">
                                                                </td>
                                                                <td class="border px-4 py-2">
                                                                    <img src="{{ asset('storage/' . $request->providerDetail->government_id_back) }}" alt="Government ID Back" class="w-24">
                                                                </td>
                                                                <td class="border px-4 py-2">
                                                                    <img src="{{ asset('storage/' . $request->providerDetail->nbi_clearance) }}" alt="NBI Clearance" class="w-24">
                                                                </td>
                                                                <td class="border px-4 py-2">
                                                                    <img src="{{ asset('storage/' . $request->providerDetail->tesda_certification) }}" alt="TESDA Certification" class="w-24">
                                                                </td>
                                                                <td class="border px-4 py-2">
                                                                    <img src="{{ asset('storage/' . $request->providerDetail->other_credentials) }}" alt="Other Credentials" class="w-24">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No requests found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div> 
    </div>
</x-app-layout>