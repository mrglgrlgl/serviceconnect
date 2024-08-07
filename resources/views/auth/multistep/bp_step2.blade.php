{{-- <x-app-layout>
    <div class="md:mt-6 md:px-12 md:py-12 px-4 py-6 bg-white shadow-md sm:rounded-lg md:w-5/12 mx-auto">
        <div class="flex flex-col items-center">
            <div class="text-2xl font-bold text-custom-light-blue pb-6">
                {{ __('Become a Provider!') }}
            </div>

            <div class="w-full flex justify-between items-center">
                <a href="{{ route('become-provider') }}" class="text-center text-lg text-custom-dark-blue w-1/3">
                    Step 1
                </a>
                <a class="text-center text-lg text-custom-dark-blue w-1/3">
                    Step 2
                </a>
                <a class="text-center text-lg text-custom-dark-blue w-1/3">
                    Step 3
                </a>
            </div>

            <div class="w-full flex justify-between items-center pb-2">
                <a class="text-center text-sm font-medium text-custom-dark-blue w-1/3">
                    Profile Details
                </a>
                <a class="text-center text-sm font-medium text-custom-dark-blue w-1/3">
                    Service Category Details
                </a>
                <a class="text-center text-sm font-medium text-custom-dark-blue w-1/3">
                    Upload Documents
                </a>
            </div>

            <div class="w-full flex">
                <div class="flex-1 h-2 bg-custom-light-blue rounded-l-lg"></div>
                <div class="flex-1 h-2 bg-custom-light-blue"></div>
                <div class="flex-1 h-2 bg-gray-300 rounded-r-lg"></div>
            </div>
        </div>

        <div class="border-t my-4 w-full md:pb-6"></div> 

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="w-full md:w-8/12 mx-auto">
            <form id="step2-form" action="{{ route('save-step2') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                @csrf

                <div class="form-group flex flex-col">
                    <x-input-label for="service_category" class="text-base text-custom-dark-blue mb-1">Service Category</x-input-label>
                    <x-selection class="form-control w-full rounded-md border-gray-300 focus:ring-custom-light-blue" id="service_category" name="service_category" required>
                        <option value="">Select Service Category</option>
                        <option value="Carpentry">Carpentry</option>
                        <option value="Plumbing">Plumbing</option>
                        <option value="Welding">Welding</option>
                        <option value="Building and Related">Building and Related</option>
                        <option value="Electrical">Electrical</option>
                        <option value="Food Service">Food Service</option>
                        <option value="Bus Driving">Bus Driving</option>
                        <option value="Stone Cutting and Masonry">Stone Cutting and Masonry</option>
                        <option value="Hairdressing">Hairdressing</option>
                        <option value="Beauty Therapy">Beauty Therapy</option>
                    </x-selection>
                    @error('service_category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <x-input-label for="description" class="text-base text-custom-dark-blue mb-1">Description</x-input-label>
                    <textarea class="form-control w-full border border-gray-300 shadow-sm focus:ring-custom-light-blue p-2 resize-none" id="description" name="description" rows="5" required></textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group flex flex-col">
                    <x-input-label for="years_of_experience" class="text-base text-custom-dark-blue mb-1">Years of Experience</x-input-label>
                    <x-text-input type="number" class="form-control w-full rounded-md border-gray-300 focus:ring-custom-light-blue" id="years_of_experience" name="years_of_experience" required />
                    @error('years_of_experience')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group flex flex-col">
                    <x-input-label for="have_tools" class="text-base text-custom-dark-blue mb-1">Do you have tools/equipment?</x-input-label>
                    <div class="flex items-center space-x-4">
                        <input class="form-check-input" type="radio" name="have_tools" id="have_tools_yes" value="1" required/>
                        <label class="form-check-label" for="have_tools_yes">Yes</label>
                        <input class="form-check-input" type="radio" name="have_tools" id="have_tools_no" value="0" required/>
                        <label class="form-check-label" for="have_tools_no">No</label>
                    </div>
                    @error('have_tools')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-center pt-6">
                    <x-primary-button type="submit" class="rounded-md px-8 py-2 text-lg font-medium text-white">Next</x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</x-app-layout> --}}
