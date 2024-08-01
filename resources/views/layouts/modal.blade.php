<x-dashboard>
    <div class="mt-6 px-6 py-8 bg-white shadow-md sm:rounded-lg w-full md:w-5/12 mx-auto">
        <div class="flex flex-col items-center">
            <div class="text-2xl font-bold text-custom-light-blue">
                {{ __('Create Service Request') }}
            </div>

            <div class="w-full md:w-7/12 space-y-6 mx-auto mt-4">
                <form id="serviceRequestForm" action="{{ route('service-requests.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="border-t my-4 w-full pb-6"></div>

                    <div class="mb-4">
                        <label for="category" class="block text-base text-custom-default-text">Category</label>
                        <x-selection class="form-select" id="category" name="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->Job_Title }}">{{ $category->Job_Title }}</option>
                            @endforeach
                        </x-selection>
                    </div>

                    <div class="mb-4">
                        <label for="title" class="block text-base text-custom-default-text">Title</label>
                        <x-text-input type="text" id="title" name="title" required
                            class="mt-1 block w-full sm:text-sm rounded-md" />
                    </div>

                    <div>
                        <x-input-label for="description"
                            class="text-base text-custom-default-text">Description</x-input-label>
                        <textarea
                            class="mt-1 block w-full form-control rounded border border-gray-300 shadow-sm resize-none focus:ring-custom-light-blue md:h-48 p-2"
                            id="description" name="description" rows="4" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block text-base text-custom-default-text">Location</label>
                        <x-text-input type="text" id="location" name="location" required
                            class="mt-1 block w-full" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:pb-4">
                        <div>
                            <label for="start_date" class="block text-base text-custom-default-text">Start Date</label>
                            <x-text-input type="date" id="start_date" name="start_date" required
                                class="mt-1 block w-full sm:text-sm rounded-md" />
                        </div>
                        <div>
                            <label for="end_date" class="block text-base text-custom-default-text">End Date</label>
                            <x-text-input type="date" id="end_date" name="end_date" required
                                class="mt-1 block w-full sm:text-sm rounded-md" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:pb-4">
                        <div>
                            <label for="start_time" class="form-label">Start Time</label>
                            <x-text-input type="time" class="mt-1 block w-full sm:text-sm rounded-md" id="start_time"
                                name="start_time" required />
                        </div>
                        <div>
                            <label for="end_time" class="form-label">End Time</label>
                            <x-text-input type="time" class="mt-1 block w-full sm:text-sm rounded-md" id="end_time"
                                name="end_time" required />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="skill_tags" class="form-label">Skill Tags</label>
                        <x-text-input type="text" class="mt-1 block w-full sm:text-sm rounded-md" id="skill_tags"
                            name="skill_tags" required />
                    </div>

                    <div class="mb-3">
                        <label for="provider_gender" class="form-label">Preferred Provider Gender</label>
                        <x-selection class="form-select" id="provider_gender" name="provider_gender">
                            <option value="">No preference</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </x-selection>
                    </div>
                    <div class="mb-3">
                        <label for="job_type" class="form-label">Job Type</label>
                        <x-selection class="form-select" id="job_type" name="job_type">
                            <option value="project_based">Project Based</option>
                            <option value="hourly_rate">Hourly Rate</option>
                        </x-selection>
                    </div>

                    <!-- Price Range -->
                    <div class="mb-3" style="display: flex; gap: 1rem;">
                        <div style="flex: 1;">
                            <label for="min_price" class="form-label">Minimum Price</label>
                            <x-text-input type="number" step="0.01" class="mt-1 block sm:text-sm rounded-md"
                                id="min_price" name="min_price" style="width: 100%;" required />
                        </div>
                        <div style="flex: 1;">
                            <label for="max_price" class="form-label">Maximum Price</label>
                            <x-text-input type="number" step="0.01" class="mt-1 block sm:text-sm rounded-md"
                                id="max_price" name="max_price" style="width: 100%;" required />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="estimated_duration" class="form-label">Estimated Duration (hours)</label>
                        <x-text-input type="number" class="mt-1 block w-full sm:text-sm rounded-md"
                            id="estimated_duration" name="estimated_duration" value="" required />
                    </div>


                    <!-- Attach Images -->
         <div class="file-upload-container">
        <label class="form-label">Attach Photos (up to 4)</label>
        <div class="upload-wrapper">
            <div class="file-upload-box">
                <input type="file" id="attach_media1" name="attach_media1" accept="image/*" onchange="previewImage(event, 1)" />
                <div id="preview1" class="image-preview"></div>
            </div>
            <div class="file-upload-box">
                <input type="file" id="attach_media2" name="attach_media2" accept="image/*" onchange="previewImage(event, 2)" />
                <div id="preview2" class="image-preview"></div>
            </div>
            <div class="file-upload-box">
                <input type="file" id="attach_media3" name="attach_media3" accept="image/*" onchange="previewImage(event, 3)" />
                <div id="preview3" class="image-preview"></div>
            </div>
            <div class="file-upload-box">
                <input type="file" id="attach_media4" name="attach_media4" accept="image/*" onchange="previewImage(event, 4)" />
                <div id="preview4" class="image-preview"></div>
            </div>
        </div>
                 {{-- <div class="mb-3">
    <label class="form-label">Attach Images</label>
    <div>
        <input type="file" id="attach_media1" name="attach_media1" accept="image/*" />
    </div>
    <div>
        <input type="file" id="attach_media2" name="attach_media2" accept="image/*" />
    </div>
    <div>
        <input type="file" id="attach_media3" name="attach_media3" accept="image/*" />
    </div>
    <div>
        <input type="file" id="attach_media4" name="attach_media4" accept="image/*" />
    </div>
</div> --}}

                    <!-- Terms and Conditions Checkbox -->
                    <div class="mb-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="agreed_to_terms" value="1" required class="mr-2">
                            <span class="text-sm text-gray-700">By creating the service request I agree to the <a
                                    href="/terms" target="_blank" class="text-blue-500 underline">terms and
                                    conditions</a>.</span>
                        </label>
                    </div>


                    <div class="flex justify-center">
                        <x-primary-button type="submit" class="md:mt-6 text-white rounded-md btn-lg">Create Service
                            Request</x-primary-button>
                    </div>

                </form>
            </div>
        </div>
    </div>
<style>
.file-upload-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.upload-wrapper {
    display: flex;
    gap: 10px;
}

.file-upload-box {
    border: 2px dashed #ccc;
    border-radius: 4px;
    width: 100px;
    height: 100px;
    position: relative;
    overflow: hidden;
    cursor: pointer;
}

.file-upload-box input[type="file"] {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.image-preview {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.image-preview img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
}

</style>
    <script>
function previewImage(event, boxId) {
    var file = event.target.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var previewBox = document.getElementById('preview' + boxId);
            previewBox.innerHTML = '<img src="' + e.target.result + '" alt="Image Preview" />';
        }
        reader.readAsDataURL(file);
    }
}
        function validateDates() {
            var today = new Date().toISOString().split('T')[0];
            var startDate = document.getElementById('start_date').value;
            var endDate = document.getElementById('end_date').value;
         
            if (startDate < today) {
                alert("Start date cannot be in the past.");
                document.getElementById('start_date').value = today;
            }

            if (endDate && endDate < startDate) {
                alert("End date cannot be before the start date. The web app does not support time travel.");
                document.getElementById('end_date').value = startDate;
            }
        }

        // Function to validate times
        function validateTimes() {
    // Get the values of the date and time fields
    var startDate = document.getElementById('start_date').value;
    var endDate = document.getElementById('end_date').value;
    var startTime = document.getElementById('start_time').value;
    var endTime = document.getElementById('end_time').value;

    // Check if the dates are the same
    if (startDate === endDate) {
        // Validate the times only if both are provided and the end time is not after the start time
        if (startTime && endTime && endTime <= startTime) {
            alert("End time must be after start time.");
            document.getElementById('end_time').value = ''; // Clear the invalid end time
        }
    }
}


        // Function to validate minimum and maximum prices
        function validateMinMax() {
            var minPrice = parseFloat(document.getElementById('min_price').value);
            var maxPrice = parseFloat(document.getElementById('max_price').value);

            if (!isNaN(minPrice) && !isNaN(maxPrice) && minPrice > maxPrice) {
                alert("Minimum Price cannot be greater than Maximum Price.");
                document.getElementById('max_price').value = '';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('start_date').addEventListener('change', validateDates);
            document.getElementById('end_date').addEventListener('change', validateDates);
            document.getElementById('start_time').addEventListener('change', validateTimes);
            document.getElementById('end_time').addEventListener('change', validateTimes);
            document.getElementById('min_price').addEventListener('blur', validateMinMax);
            document.getElementById('max_price').addEventListener('blur', validateMinMax);
        });
    </script>
</x-dashboard>
