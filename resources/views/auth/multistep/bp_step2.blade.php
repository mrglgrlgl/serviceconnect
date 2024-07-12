<x-app-layout>
    <div class="md:mt-3 md:px-12 md:py-12 bg-white shadow-md sm:rounded-lg md:w-5/12 mx-auto">
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
                    Step 3
                </a>
            </div>

            <div class="w-full flex justify-between items-center mt-2">
                <a href="{{ route('become-provider') }}" class="bg-custom-light-blue h-2 w-1/3 rounded-l-lg"></a>
                <a class="bg-custom-light-blue h-2 w-1/3"></a>
                <a class="bg-gray-300 h-2 w-1/3 rounded-r-lg"></a>
            </div>
        </div>

        <div class="border-t my-4 w-full md:pb-6"></div> 

    {{-- @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-4">
            {{ session('success') }}
        </div> --}}
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-4">
            {{ session('error') }}
        </div>
    @endif

        <div class="w-full md:w-8/12 mx-auto">
            <form action="{{ route('save-step2') }}" method="POST" class="space-y-4">
                @csrf

                <div class="form-group flex flex-col items-start">
                    <x-input-label for="service_category" class="text-base md:text-base text-custom-dark-blue">Service Category</x-input-label>
                    <x-selection class="form-control" id="service_category" name="service_category" required>
                        <option value="">Select Service Category</option>
                        <option value="Plumbing">Plumbing</option>
                        <!-- Add other service categories as needed -->
                    </x-selection>
                </div>

                <div class="form-group flex flex-col items-start" id="subcategory_container" style="display: none;">
                    <x-input-label for="sub_category" class="text-base md:text-base text-custom-dark-blue">Subcategory</x-input-label>
                    <x-selection class="form-control" id="sub_category" name="sub_category" required>
                        <option value="">Select Subcategory</option>
                    </x-selection>
                </div>

                <div class="form-group">
                    <x-input-label for="description" class="text-base md:text-base text-custom-dark-blue">Description</x-input-label>
                    <textarea class="form-control rounded border border-gray-300 shadow-sm resize-none focus:ring-custom-light-blue w-full md:h-48 p-2" id="description" name="description" rows="4" required></textarea>
                </div>

                <div class="form-group flex flex-col items-start">
                    <x-input-label for="years_of_experience" class="text-base md:text-base text-custom-dark-blue">Years of Experience</x-input-label>
                    <x-text-input type="number" class="form-control w-full" id="years_of_experience" name="years_of_experience" required />
                </div>

                <div class="form-group flex flex-col items-start">
                    <x-input-label for="have_tools" class="text-base md:text-base text-custom-dark-blue">Do you have tools/equipment?</x-input-label>
                    <div class="flex items-center space-x-4">
                        <input class="form-check-input" type="radio" name="have_tools" id="have_tools_yes" value="1"/>
                        <label class="form-check-label" for="have_tools_yes">Yes</label>
                        <input class="form-check-input" type="radio" name="have_tools" id="have_tools_no" value="0"/>
                        <label class="form-check-label" for="have_tools_no">No</label>
                    </div>
                </div>

                <div class="flex justify-center pt-6">
                    <x-primary-button type="submit" class="rounded-md px-8 text-lg font-medium text-white">Next</x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#service_category').change(function() {
                var serviceCategory = $(this).val();
                if (serviceCategory === 'Plumbing') {
                    $('#sub_category').empty().append(
                        '<option value="">Select Subcategory</option>' +
                        '<option value="Faucet Leak Repair">Faucet Leak Repair</option>' +
                        '<option value="Sink P-trap Repair">Sink P-trap Repair</option>' +
                        '<option value="Sink Declogging">Sink Declogging</option>' +
                        '<option value="Toilet Repair">Toilet Repair</option>' +
                        '<option value="Exposed Pipe Repair">Exposed Pipe Repair</option>' +
                        '<option value="Pipe Line Declogging">Pipe Line Declogging</option>' +
                        '<option value="Drainage Declogging">Drainage Declogging</option>' +
                        '<option value="Plumbing Inspection">Plumbing Inspection</option>' +
                        '<option value="Water Heater Repair">Water Heater Repair</option>' +
                        '<option value="Water Heater Inspection">Water Heater Inspection</option>'
                    );
                    $('#subcategory_container').show();
                } else {
                    $('#subcategory_container').hide();
                }
            });
        });
    </script>
</x-app-layout>