<x-app-layout>
    <div class="md:mt-3 md:px-12 md:py-12 bg-white shadow-md sm:rounded-lg md:w-5/12 mx-auto">
        <div class="flex flex-col items-center">
            <div class="text-2xl font-bold text-custom-light-blue pb-6">
                {{ __('Upload PhilID Details') }}
            </div>

            <div class="w-full md:w-8/12 mx-auto">
                <form action="{{ route('philid.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- PhilID Number -->
                    <div class="form-group">
                        <x-input-label for="philid_number" class="text-base md:text-base text-custom-dark-blue">PhilID
                            Number</x-input-label>
                        <x-text-input type="text" id="philid_number" name="philid_number" class="form-control w-full"
                            required />
                        @error('philid_number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Given Name -->
                    <div class="form-group">
                        <x-input-label for="given_names" class="text-base md:text-base text-custom-dark-blue">Given
                            Name</x-input-label>
                        <x-text-input type="text" id="given_names" name="given_names" class="form-control w-full"
                            required />
                        @error('given_names')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Middle Name -->
                    <div class="form-group">
                        <x-input-label for="middle_name" class="text-base md:text-base text-custom-dark-blue">Middle
                            Name</x-input-label>
                        <x-text-input type="text" id="middle_name" name="middle_name" class="form-control w-full" />
                        @error('middle_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div class="form-group">
                        <x-input-label for="last_name" class="text-base md:text-base text-custom-dark-blue">Last
                            Name</x-input-label>
                        <x-text-input type="text" id="last_name" name="last_name" class="form-control w-full"
                            required />
                        @error('last_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date of Birth -->
                    <div class="form-group">
                        <x-input-label for="date_of_birth" class="text-base md:text-base text-custom-dark-blue">Date of
                            Birth</x-input-label>
                        <x-text-input type="date" id="date_of_birth" name="date_of_birth" class="form-control w-full"
                            required />
                        @error('date_of_birth')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Place of Birth -->
                    <div class="form-group">
                        <x-input-label for="place_of_birth" class="text-base md:text-base text-custom-dark-blue">Place
                            of Birth</x-input-label>
                        <x-text-input type="text" id="place_of_birth" name="place_of_birth"
                            class="form-control w-full" required />
                        @error('place_of_birth')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Address -->
                    <div class="form-group">
                        <x-input-label for="address"
                            class="text-base md:text-base text-custom-dark-blue">Address</x-input-label>
                        <textarea id="address" name="address" class="form-control w-full" rows="3" required></textarea>
                        @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sex -->
                    <div class="form-group">
                        <x-input-label for="gender"
                            class="text-base md:text-base text-custom-dark-blue">Sex</x-input-label>
                        <select id="gender" name="gender" class="form-control w-full" required>
                            <option value="">Select Sex</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        @error('gender')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Blood Type -->
                    <div class="form-group">
                        <x-input-label for="blood_type" class="text-base md:text-base text-custom-dark-blue">Blood
                            Type</x-input-label>
                        <x-text-input type="text" id="blood_type" name="blood_type" class="form-control w-full" />
                        @error('blood_type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Civil Status -->
                    <div class="form-group">
                        <x-input-label for="civil_status" class="text-base md:text-base text-custom-dark-blue">Civil
                            Status</x-input-label>
                        <x-text-input type="text" id="civil_status" name="civil_status"
                            class="form-control w-full" />
                        @error('civil_status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Issue Date -->
                    <div class="form-group">
                        <x-input-label for="issue_date" class="text-base md:text-base text-custom-dark-blue">Issue
                            Date</x-input-label>
                        <x-text-input type="date" id="issue_date" name="issue_date" class="form-control w-full"
                            required />
                        @error('issue_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Front Image -->
                    <div class="form-group">
                        <x-input-label for="front_image" class="text-base md:text-base text-custom-dark-blue">Front
                            Image of PhilID</x-input-label>
                        <x-text-input type="file" id="front_image" name="front_image" class="form-control w-full"
                            accept="image/*" required onchange="previewImage('front_image', 'front_image_preview')" />
                        @error('front_image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <div class="mt-2">
                            <img id="front_image_preview" src="#" alt="Front Image Preview"
                                class="hidden w-1/2 mx-auto border rounded-md" />
                        </div>
                    </div>

                    <!-- Back Image -->
                    <div class="form-group">
                        <x-input-label for="back_image" class="text-base md:text-base text-custom-dark-blue">Back
                            Image of PhilID</x-input-label>
                        <x-text-input type="file" id="back_image" name="back_image" class="form-control w-full"
                            accept="image/*" required onchange="previewImage('back_image', 'back_image_preview')" />
                        @error('back_image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <div class="mt-2">
                            <img id="back_image_preview" src="#" alt="Back Image Preview"
                                class="hidden w-1/2 mx-auto border rounded-md" />
                        </div>
                    </div>

                    <div class="flex justify-center pt-6">
                        <x-primary-button type="submit"
                            class="rounded-md px-8 text-lg font-medium text-white bg-custom-dark-blue hover:bg-custom-light-blue">Submit
                            PhilID</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(inputId, previewId) {
            var input = document.getElementById(inputId);
            var preview = document.getElementById(previewId);

            input.addEventListener('change', function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    }
                    reader.readAsDataURL(file);
                } else {
                    preview.src = "#";
                    preview.classList.add('hidden');
                }
            });
        }
    </script>
</x-app-layout>
