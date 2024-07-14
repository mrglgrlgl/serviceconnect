{{-- @foreach ($pendingRequests as $request)
  @if ($request->providerDetail && $request->status == 'pending')
    <div class="col-span-1">{{ $request->user->name }}</div>
    @endif
@endforeach --}}


<x-app-layout>
    <div class="relative w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 mx-auto pt-4 overflow-hidden">
        <div class="font-semibold text-3xl md:pb-4">{{ __('Dashboard') }}</div>
        <div class="flex items-center space-x-4 sm:space-x-12 md:space-x-20 lg:space-x-28 xl:space-x-28 2xl:space-x-28 overflow-x-auto md:overflow-hidden">
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

    <div class="overflow-x-auto p-4 bg-white shadow-sm rounded-lg md:mb-4 w-11/12 mx-auto">
        <div class="bg-gray-100 border border-gray-200 rounded-lg overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-9 gap-4 p-4 bg-gray-200">
                <div class="col-span-1 font-semibold text-sm">Date</div>
                <div class="col-span-1 font-semibold text-sm">Service Category and Subcategory</div>
                <div class="col-span-1 font-semibold text-sm">Name</div>
                <div class="col-span-1 font-semibold text-sm">Contact Information</div>
                <div class="col-span-2 font-semibold text-sm">Description</div>
                <div class="col-span-1 font-semibold text-sm">Government ID</div>
                <div class="col-span-1 font-semibold text-sm">Other Documents</div>
                <div class="col-span-1 font-semibold text-sm">Actions</div>
            </div>

            @if (!empty($requests))
                @foreach ($requests as $request)
                    @if ($request->providerDetail)
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden mt-4 hover:bg-gray-100">
                            <div class="grid grid-cols-1 md:grid-cols-9 gap-4 p-4 {{ $loop->odd ? 'bg-gray-50' : 'bg-white' }}">
                                <div class="col-span-1">{{ $request->created_at->format('Y-m-d') }}</div>
                                <div class="col-span-1">{{ $request->providerDetail->serviceCategory }} - {{ $request->providerDetail->subcategory }}</div>
                                <div class="col-span-1">{{ $request->user->name }}</div>
                                <div class="col-span-1">
                                    <div>
                                    {{ $request->providerDetail->work_email }}
                                    </div>
                                    <div>
                                    {{ $request->providerDetail->contact_number }}
                                    </div>
                                </div>
                                <div class="col-span-2 truncate">{{ $request->providerDetail->description }}</div>
                                <div class="col-span-1">
                                    <img src="{{ asset('storage/' . $request->providerDetail->government_id_front) }}" alt="Government ID Front" width="100">
                                    <img src="{{ asset('storage/' . $request->providerDetail->government_id_back) }}" alt="Government ID Back" width="100">
                                </div>
                                <div class="col-span-1">
                                    <img src="{{ asset('storage/' . $request->providerDetail->nbi_clearance) }}" alt="NBI Clearance" width="100">
                                    <img src="{{ asset('storage/' . $request->providerDetail->tesda_certification) }}" alt="TESDA Certification" width="100">
                                    <img src="{{ asset('storage/' . $request->providerDetail->other_credentials) }}" alt="Other Credentials" width="100">
                                </div>
                                <div class="col-span-1">
                                    <form action="{{ route('requests.accept', $request->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Accept</button>
                                    </form>
                                    <form action="{{ route('requests.decline', $request->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Decline</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <p class="p-4">No requests found.</p>
            @endif
        </div>
    </div>
</x-app-layout>