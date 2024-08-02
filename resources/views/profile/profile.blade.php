<x-app-layout class="font-open-sans">
    <div class="mt-3 md:px-12 py-6 bg-white shadow-md sm:rounded-lg w-full md:w-3/5 mx-auto">
        <div class="flex flex-col md:flex-row w-10/12 mx-auto">
            {{-- {{ __('Profile') }} --}}

            {{-- User Profile Picture --}}
            {{-- <div class="flex justify-center md:justify-start mb-4 md:mb-0">
                <img class="inline-block h-40 w-40 rounded-full ring-2 ring-white"
                    src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                    alt="">
            </div> --}}

            {{-- User's Name and Details --}}
            <div class="md:ml-6 w-full">
                <div class="text-custom-dark-blue font-bold text-2xl md:text-4xl text-center md:text-left">{{ $user->name }}</div>

                {{-- Service Category --}}
                <div class="text-gray-900 text-lg md:text-xl mt-2 text-center md:text-left">
                    {{ __('Service Category') }}: {{ $providerDetail->serviceCategory ?? 'N/A' }}
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
                <div class="border border-custom-light-blue p-2 rounded-3xl">{{ $providerDetail->serviceCategory ?? 'N/A' }}</div>
            </div>
        </div>

        {{-- Provider Information Description --}}
        <div class="providerdescription w-10/12 mx-auto mt-4">
            <div class="font-normal">
                {{ $providerDetail->description ?? 'No description available.' }}
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 w-10/12 mx-auto pb-6 md:pt-2">

            {{-- Provider Overview --}}
            <div class="w-full md:col-span-1 rounded-t-lg md:rounded-r-none md:pt-12">
                <div class="provideroverview">
                    <div class="text-2xl font-bold text-custom-light-blue">{{ __('Overview:') }}</div>

                    {{-- Verifications, years worked, has equipment, etc --}}
                    <div class="flex pt-1">
                        <span class="material-symbols-outlined pr-2">pin_drop</span>
                        <div class="text-base text-custom-dark-text">{{ __('Hired') }} {{ $providerDetail->years_of_experience ?? 'N/A' }} {{ __('times') }}</div>
                    </div>

                    <x-overview/>

                    {{-- Provider Address --}}
                    <div class="flex pt-1">
                        <span class="material-symbols-outlined pr-2">pin_drop</span>
                        <div class="text-base text-custom-dark-text">{{ $providerDetail->address ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            {{-- Provider Availability --}}
            <div class="w-full md:col-span-2 bg-white flex md:justify-end md:mt-4">
                <div class="md:w-4/5">
                    <div class="provideroverview pt-8">
                        <div class="text-2xl font-bold text-custom-light-blue md:mb-2">{{ __('Availability') }}</div>
                    </div>
                    <div class="md:border md:border-custom-light-text md:rounded-2xl md:p-4 ml-auto">
                        <div class="space-y-4 md:space-y-0 md:grid md:grid-cols-2 md:gap-4">
                            @foreach (explode(',', $providerDetail->availability_days ?? '') as $day)
                                <div class="flex justify-between items-center">
                                    <div>{{ $day }}</div>
                                    <div>{{ $providerDetail->availability_time ?? 'N/A' }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="text-2xl font-bold text-custom-light-blue pt-2 md:mb-2">{{ __('Contact') }}</div>
                    <div class="md:border md:border-custom-light-text md:rounded-2xl p-4 ml-auto">
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
            <x-ratings-stars/>
        </div>

        {{-- Certifications Section --}}
        <div class="w-10/12 mx-auto mt-4">
            <div class="text-2xl font-bold text-custom-light-blue md:mb-2">{{ __('Certifications') }}</div>
            <ul>
                @forelse ($certifications as $certification)
                    <li class="border border-custom-light-blue p-2 rounded-3xl mb-2">
                        {{ $certification->name }} - {{ $certification->issuing_organization }}
                        <a href="{{ Storage::url($certification->file_path) }}" target="_blank" class="text-blue-500">View File</a>
                    </li>
                @empty
                    <li>No certifications found.</li>
                @endforelse
            </ul>
            <button class="mt-4 px-4 py-2 bg-blue-500 text-white rounded" onclick="showModal()">Add More</button>
        </div>
    </div>

    {{-- Modal for Adding Certifications --}}
    <div id="certificationModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded shadow-md w-full max-w-lg">
            <h2 class="text-2xl font-bold mb-4">Add Certification</h2>
            <form action="{{ route('certifications.save') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-4">
                    <x-input-label for="name" class="text-base md:text-lg text-custom-dark-text mb-1">Certification Name</x-input-label>
                    <x-text-input type="text" id="name" name="name" class="form-control w-full px-4 py-2" required />
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <x-input-label for="issuing_organization" class="text-base md:text-lg text-custom-dark-blue mb-1">Issuing Organization</x-input-label>
                    <x-text-input type="text" id="issuing_organization" name="issuing_organization" class="form-control w-full px-4 py-2" required />
                    @error('issuing_organization')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <x-input-label for="date_attained" class="text-base md:text-lg text-custom-dark-blue mb-1">Date Attained</x-input-label>
                    <x-text-input type="date" id="date_attained" name="date_attained" class="form-control w-full px-4 py-2" required />
                    @error('date_attained')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <x-input-label for="expiry_date" class="text-base md:text-lg text-custom-dark-blue mb-1">Expiry Date (Optional)</x-input-label>
                    <x-text-input type="date" id="expiry_date" name="expiry_date" class="form-control w-full px-4 py-2" />
                    @error('expiry_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <x-input-label for="description" class="text-base md:text-lg text-custom-dark-blue mb-1">Description (Optional)</x-input-label>
                    <textarea id="description" name="description" rows="4" class="form-control w-full px-4 py-2 border rounded"></textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <x-input-label for="file_path" class="text-base md:text-lg text-custom-dark-blue mb-1">Upload Certification File (Optional)</x-input-label>
                    <x-text-input type="file" id="file_path" name="file_path" class="form-control w-full" />
                    @error('file_path')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="button" class="mr-4 px-4 py-2 bg-gray-500 text-white rounded" onclick="closeModal()">Cancel</button>
                    <x-primary-button type="submit" class="rounded-md px-8 text-lg font-medium text-white bg-custom-dark-blue hover:bg-custom-light-blue">Save Certification</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    function showModal() {
        document.getElementById('certificationModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('certificationModal').classList.add('hidden');
    }
</script>

<style>
    .form-control {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }
</style>
