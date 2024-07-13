<x-dashboard>
    <div class="mt-6 px-6 py-8 bg-white shadow-md sm:rounded-lg w-full md:w-5/12 mx-auto">
        <div class="flex flex-col items-center">
            <div class="text-2xl font-bold text-custom-light-blue">
                {{ __('Edit Service Request') }}
            </div>

            <div class="border-t my-4 w-full pb-6"></div>

            <div class="w-full md:w-7/12 mx-auto space-y-6">
                <form action="{{ route('service-requests.update', $serviceRequest->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4"> 
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                            <x-text-input id="category" name="category" :value="$serviceRequest->category" required class="mt-1 block w-full border-gray-300 shadow-sm focus:ring-custom-light-blue focus:border-custom-light-blue sm:text-sm rounded-md" />
                        </div>
                        <div>
                            <label for="subcategory" class="block text-sm font-medium text-gray-700">Subcategory</label>
                            <x-text-input id="subcategory" name="subcategory" :value="$serviceRequest->subcategory" required class="mt-1 block w-full border-gray-300 shadow-sm focus:ring-custom-light-blue focus:border-custom-light-blue sm:text-sm rounded-md" />
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <x-text-input type="text" id="title" name="title" :value="$serviceRequest->title" required class="mt-1 block w-full border-gray-300 shadow-sm focus:ring-custom-light-blue focus:border-custom-light-blue sm:text-sm rounded-md" />
                    </div>

                    <div class="mb-6">
                        <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                        <x-text-input type="text" id="location" name="location" :value="$serviceRequest->location" required class="mt-1 block w-full border-gray-300 shadow-sm focus:ring-custom-light-blue focus:border-custom-light-blue sm:text-sm rounded-md" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:pb-4">
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                            <x-text-input type="datetime-local" id="start_time" name="start_time" :value="\Carbon\Carbon::parse($serviceRequest->start_time)->format('Y-m-d\TH:i')" required class="mt-1 block w-full border-gray-300 shadow-sm focus:ring-custom-light-blue focus:border-custom-light-blue sm:text-sm rounded-md" />
                        </div>
                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                            <x-text-input type="datetime-local" id="end_time" name="end_time" :value="\Carbon\Carbon::parse($serviceRequest->end_time)->format('Y-m-d\TH:i')" required class="mt-1 block w-full border-gray-300 shadow-sm focus:ring-custom-light-blue focus:border-custom-light-blue sm:text-sm rounded-md" />
                        </div>
                    </div>

                    @foreach(range(1, 4) as $index)
                        <div class="mb-6">
                            <label for="attach_media{{ $index }}" class="block text-sm font-medium text-gray-700">Attach Media {{ $index }}</label>
                            <input type="file" id="attach_media{{ $index }}" name="attach_media{{ $index }}" class="mt-1 block w-full">
                            @if ($serviceRequest->{"attach_media$index"})
                                <div>
                                    <img src="{{ asset('storage/' . $serviceRequest->{"attach_media$index"}) }}" class="mt-3 h-32 w-auto" alt="Service Request Media">
                                </div>
                                <label for="remove_attach_media{{ $index }}" class="mt-2 block">
                                    <input type="checkbox" id="remove_attach_media{{ $index }}" name="remove_attach_media{{ $index }}" class="mr-2">
                                    <span class="text-sm text-gray-700">Remove current media</span>
                                </label>
                            @endif
                        </div>
                    @endforeach

                    <div class="flex justify-center">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-custom-light-blue hover:bg-custom-light-blue-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-light-blue">Update Service Request</button>
                    </div>
                </form>

                @if (session('success'))
                    <div class="mt-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-dashboard>