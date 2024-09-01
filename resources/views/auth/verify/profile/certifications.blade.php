<x-app-layout>
    <div class="md:mt-3 md:px-12 md:py-12 bg-white shadow-sm sm:rounded-lg md:w-5/12 mx-auto border border-gray-300">
        <div class="flex flex-col items-center">
            <div class="text-2xl font-bold text-custom-light-blue pb-8">
                {{ __('Upload Certification') }}
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Display Existing Certifications -->
            <div class="w-full mb-8">
                <div class="grid grid-cols-1 gap-6">
                    @foreach ($certifications as $certification)
                        <div class="bg-white border border-gray-300 rounded p-4">
                            <h3 class="font-bold text-lg">{{ $certification->name }}</h3>
                            <p>Issued by: {{ $certification->issuing_organization }}</p>
                            <p>Date Attained: {{ $certification->date_attained }}</p>
                            @if ($certification->expiry_date)
                                <p>Expiry Date: {{ $certification->expiry_date }}</p>
                            @endif
                            @if ($certification->description)
                                <p>{{ $certification->description }}</p>
                            @endif
                            @if ($certification->file_path)
                                <a href="{{ Storage::url($certification->file_path) }}" target="_blank" class="text-blue-500">View File</a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="w-full md:w-8/12 mx-auto">
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

                    <div class="flex justify-center pt-6">
                        <x-primary-button type="submit" class="rounded-md px-8 text-lg font-medium text-white bg-custom-dark-blue hover:bg-custom-light-blue">Save Certification</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

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
