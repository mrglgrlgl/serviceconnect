@extends('layouts.app')

@section('content')
    <div class="mt-6 px-6 py-8 bg-white shadow-md sm:rounded-lg w-full max-w-lg mx-auto">
        <div class="flex flex-col items-center">
            <div class="text-2xl font-bold text-custom-light-blue">
                {{ __('Edit Service Request') }}
            </div>

            <div class="w-full space-y-6 mx-auto mt-4">
                <form action="{{ route('service-requests.update', $serviceRequest->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="border-t my-4 w-full pb-6"></div>

                    <div class="mb-4">
                        <label for="category" class="block text-base text-custom-default-text">Category</label>
                        <x-selection id="category" name="category" :value="$serviceRequest->category">
                            <option value="carpentry" {{ $serviceRequest->category == 'carpentry' ? 'selected' : '' }}>Carpentry</option>
                            <option value="plumbing" {{ $serviceRequest->category == 'plumbing' ? 'selected' : '' }}>Plumbing</option>
                            <!-- Add other options similarly -->
                        </x-selection>
                    </div>

                    <div class="mb-4">
                        <label for="title" class="block text-base text-custom-default-text">Title</label>
                        <x-text-input id="title" name="title" :value="$serviceRequest->title" class="mt-1 block w-full sm:text-sm rounded-md" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" class="text-base text-custom-default-text">Description</x-input-label>
                        <textarea id="description" name="description" class="mt-1 block w-full sm:text-sm border resize-none border-gray-300 shadow-sm focus:ring-custom-light-blue md:h-48 p-2">{{ old('description', $serviceRequest->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block text-base text-custom-default-text">Location</label>
                        <x-text-input id="location" name="location" :value="$serviceRequest->location" class="mt-1 block w-full" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="start_date" class="block text-base text-custom-default-text">Start Date</label>
                            <x-text-input type="date" id="start_date" name="start_date" :value="$serviceRequest->start_date" class="mt-1 block w-full sm:text-sm rounded-md" />
                        </div>

                        <div>
                            <label for="end_date" class="block text-base text-custom-default-text">End Date</label>
                            <x-text-input type="date" id="end_date" name="end_date" :value="$serviceRequest->end_date" class="mt-1 block w-full sm:text-sm rounded-md" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>

                            <label for="start_time" class="block text-base text-custom-default-text">Start Time</label>
                            <x-text-input type="time" class="mt-1 block w-full sm:text-sm rounded-md" id="start_time" 
                            
                            :value="old('start_time')" class="mt-1 block w-full sm:text-sm rounded-md"
                                name="start_time" required />

                             @error('start_time')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror

                            {{-- <label for="start_time" class="form-label">Start Time</label>
                            <x-text-input type="time" id="start_time" name="start_time" :value="old('start_time', \Carbon\Carbon::parse($serviceRequest->start_time)->format('H:i'))" class="mt-1 block w-full sm:text-sm rounded-md" />
                            @error('start_time')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror --}}
                        </div>
                        
                        <div>
                            <label for="end_time" class="form-label">End Time</label>
                            <x-text-input type="time" id="end_time" name="end_time" :value="old('end_time', \Carbon\Carbon::parse($serviceRequest->end_time)->format('H:i'))" class="mt-1 block w-full sm:text-sm rounded-md" />
                            @error('end_time')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="skill_tags" class="form-label">Skill Tags</label>
                        <x-text-input id="skill_tags" name="skill_tags" :value="$serviceRequest->skill_tags" class="mt-1 block w-full sm:text-sm rounded-md" />
                    </div>

                    <div class="mb-4">
                        <label for="provider_gender" class="form-label">Preferred Provider Gender</label>
                        <x-selection id="provider_gender" name="provider_gender" :value="$serviceRequest->provider_gender" class="mt-1 block w-full sm:text-sm rounded-md">
                            <option value="">No preference</option>
                            <option value="male" {{ $serviceRequest->provider_gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $serviceRequest->provider_gender == 'female' ? 'selected' : '' }}>Female</option>
                        </x-selection>
                    </div>

                    <div class="mb-4">
                        <label for="job_type" class="form-label">Job Type</label>
                        <x-selection id="job_type" name="job_type" :value="$serviceRequest->job_type" class="mb-4">
                            <option value="project_based" {{ $serviceRequest->job_type == 'project_based' ? 'selected' : '' }}>Project Based</option>
                            <option value="hourly_rate" {{ $serviceRequest->job_type == 'hourly_rate' ? 'selected' : '' }}>Hourly Rate</option>
                        </x-selection>
                    </div>

                    <div class="mb-4">
                        <label for="hourly_rate" class="form-label">Hourly Rate</label>
                        <x-text-input type="number" step="0.01" id="hourly_rate" name="hourly_rate" :value="$serviceRequest->hourly_rate" class="mt-1 block w-full sm:text-sm rounded-md" />
                    </div>

                    <div class="mb-4">
                        <label for="expected_price" class="form-label">Expected Price</label>
                        <x-text-input type="number" step="0.01" id="expected_price" name="expected_price" :value="$serviceRequest->expected_price" class="mt-1 block w-full sm:text-sm rounded-md" />
                    </div>

                    <div class="mb-4">
                        <label for="estimated_duration" class="form-label">Estimated Duration (hours)</label>
                        <x-text-input type="number" id="estimated_duration" name="estimated_duration" :value="$serviceRequest->estimated_duration" class="mt-1 block w-full sm:text-sm rounded-md" />
                    </div>

                    <div class="mb-4">
                        <label for="attach_media" class="block text-base text-custom-default-text">Attach Media</label>
                        <input type="file" id="attach_media" name="attach_media" class="mt-1 block w-full border-gray-300 shadow-sm focus:ring-custom-light-blue focus:border-custom-light-blue sm:text-sm rounded-md">
                        @if ($serviceRequest->attach_media)
                            <div>
                                <img src="{{ asset('storage/' . $serviceRequest->attach_media) }}" class="img-fluid mb-3" alt="Service Request Media">
                            </div>
                            <input type="checkbox" id="remove_media" name="remove_media" value="1">
                            <label for="remove_media" class="block text-sm text-red-500 cursor-pointer hover:underline">Remove Media</label>
                        @endif
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="px-4 py-2 bg-custom-light-blue text-white rounded-md hover:bg-custom-light-blue-dark">
                            {{ __('Update Service Request') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection