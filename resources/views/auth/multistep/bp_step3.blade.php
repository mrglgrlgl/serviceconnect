<x-app-layout>
    <div class="md:mt-6 md:px-12 md:py-12 bg-white shadow-md sm:rounded-lg md:w-5/12 mx-auto">
        <div class="flex flex-col items-center">
            <div class="text-2xl font-bold text-custom-light-blue pb-6">
                {{ __('Become a Provider!') }}
            </div>

            <!-- Display success or error messages if any -->
            {{-- @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-4">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-4">
                    {{ session('error') }}
                </div>
            @endif --}}

            <div class="w-full flex justify-between items-center">
                <a href="{{ route('become-provider') }}" class="text-center text-lg text-custom-dark-blue w-1/3">
                    Step 1
                </a>
                <a href="{{ route('bp_step2') }}" class="text-center text-lg text-custom-dark-blue w-1/3">
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

            <div class="w-full flex justify-between items-center mt-2">
                <a href="{{ route('become-provider') }}" class="bg-custom-light-blue h-2 w-1/3 rounded-l-lg"></a>
                <a href="{{ route('bp_step2') }}" class="bg-custom-light-blue h-2 w-1/3"></a>
                <a class="bg-custom-light-blue h-2 w-1/3 rounded-r-lg"></a>
            </div>

            <div class="border-t my-4 w-full"></div> 
            <div class="w-full md:w-10/12 space-y-6 mx-auto">
                <form action="{{ route('save-step3') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <!-- Government ID Section -->
                    <div class="border border-gray-300 rounded-lg p-4">
                        <div class="text-2xl font-semibold text-gray-700 mb-4">
                            Government ID
                        </div>
                        <div class="flex flex-col md:flex-row justify-between space-y-4 md:space-y-0 md:space-x-4">
                            <div>
                                <label for="government_id_front" class="block text-gray-700">Front <span class="text-red-500">*</span></label>
                                <input type="file" class="form-control w-full px-3 py-2 border rounded" id="government_id_front" name="government_id_front" required onchange="previewImage(event, 'government_id_front_preview')">
                                <img id="government_id_front_preview" class="img-preview mt-2" src="#" alt="Government ID Front Preview" style="display: none;">
                                @error('government_id_front')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="government_id_back" class="block text-gray-700">Back <span class="text-red-500">*</span></label>
                                <input type="file" class="form-control w-full px-3 py-2 border rounded" id="government_id_back" name="government_id_back" required onchange="previewImage(event, 'government_id_back_preview')">
                                <img id="government_id_back_preview" class="img-preview mt-2" src="#" alt="Government ID Back Preview" style="display: none;">
                                @error('government_id_back')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- NBI Clearance Section -->
                    <div class="border border-gray-300 rounded-lg p-4">
                        <div class="text-2xl font-semibold text-gray-700 mb-4">NBI Clearance</div>
                        <input type="file" class="form-control w-full px-3 py-2 border rounded" id="nbi_clearance" name="nbi_clearance" required onchange="previewImage(event, 'nbi_clearance_preview')">
                        <img id="nbi_clearance_preview" class="img-preview mt-2" src="#" alt="NBI Clearance Preview" style="display: none;">
                        @error('nbi_clearance')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- TESDA Certification and Other Credentials Section -->
                    <div class="border border-gray-300 rounded-lg p-4">
                        <div class="text-2xl font-semibold text-gray-700 mb-4">Certification & Other Credentials</div>
                        <div class="space-y-4">
                            <div>
                                <label for="tesda_certification" class="block text-gray-700">TESDA Certification</label>
                                <input type="file" class="form-control w-full px-3 py-2 border rounded" id="tesda_certification" name="tesda_certification" onchange="previewImage(event, 'tesda_certification_preview')">
                                <img id="tesda_certification_preview" class="img-preview mt-2" src="#" alt="TESDA Certification Preview" style="display: none;">
                            </div>
                            <div>
                                <label for="other_credentials" class="block text-gray-700">Other Credentials (Optional)</label>
                                <input type="file" class="form-control w-full px-3 py-2 border rounded" id="other_credentials" name="other_credentials" onchange="previewImage(event, 'other_credentials_preview')">
                                <img id="other_credentials_preview" class="img-preview mt-2" src="#" alt="Other Credentials Preview" style="display: none;">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center pt-6">
                        <button type="submit" class="px-6 py-2 bg-custom-light-blue text-white rounded-md hover:bg-opacity-75 focus:outline-none">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event, previewId) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById(previewId);
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-app-layout>
