<x-dashboard>
    <div class="mt-6 px-6 py-8 bg-white shadow-md sm:rounded-lg w-full md:w-5/12 mx-auto">
        <div class="flex flex-col items-center">
            <div class="text-2xl font-bold text-custom-light-blue">
                {{ __('Create Service Request') }}
            </div>

            <div class="w-full md:w-7/12 space-y-6 mx-auto mt-4">
                <form action="{{ route('service-requests.store') }}" method="POST" enctype="multipart/form-data">
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
                        <x-text-input type="text" id="title" name="title" required class="mt-1 block w-full sm:text-sm rounded-md" />
                    </div>

                    <div>
                        <x-input-label for="description" class="text-base text-custom-default-text">Description</x-input-label>
                        <textarea class="mt-1 block w-full form-control rounded border border-gray-300 shadow-sm resize-none focus:ring-custom-light-blue md:h-48 p-2" id="description" name="description" rows="4" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block text-base text-custom-default-text">Location</label>
                        <x-text-input type="text" id="location" name="location" required class="mt-1 block w-full" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:pb-4">
                        <div>
                            <label for="start_date" class="block text-base text-custom-default-text">Start Date</label>
                            <x-text-input type="date" id="start_date" name="start_date" required class="mt-1 block w-full sm:text-sm rounded-md" />
                        </div>
                        <div>
                            <label for="end_date" class="block text-base text-custom-default-text">End Time</label>
                            <x-text-input type="date" id="end_date" name="end_date" required class="mt-1 block w-full sm:text-sm rounded-md" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:pb-4">
                        <div>
                            <label for="start_time" class="form-label">Start Time</label>
                            <x-text-input type="time" class="mt-1 block w-full sm:text-sm rounded-md" id="start_time" name="start_time" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_time" class="form-label">End Time</label>
                            <x-text-input type="time" class="mt-1 block w-full sm:text-sm rounded-md" id="end_time" name="end_time" required />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="skill_tags" class="form-label">Skill Tags</label>
                        <x-text-input type="text" class="mt-1 block w-full sm:text-sm rounded-md" id="skill_tags" name="skill_tags" required />
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
                        <x-selection class="form-select" id="job_type" name="job_type" required onchange="toggleJobTypeFields()">
                            <option value="project_based">Project Based</option>
                            <option value="hourly_rate">Hourly Rate</option>
                        </x-selection>
                    </div>

                    <!-- Hourly Rate Range -->
                    <div class="mb-3" id="hourly_rate_container">
                        <label for="hourly_rate" class="form-label">Hourly Rate Minimum</label>
                        <x-text-input type="number" step="0.01" class="mt-1 block w-full sm:text-sm rounded-md" id="hourly_rate" name="hourly_rate" value="" required />
                    </div>

                    <div class="mb-3" id="hourly_rate_max_container">
                        <label for="hourly_rate_max" class="form-label">Hourly Rate Maximum</label>
                        <x-text-input type="number" step="0.01" class="mt-1 block w-full sm:text-sm rounded-md" id="hourly_rate_max" name="hourly_rate_max" value="" required />
                    </div>

                    <!-- Expected Price Range -->
                    <div class="mb-3" id="expected_price_container">
                        <label for="expected_price" class="form-label">Expected Price Minimum</label>
                        <x-text-input type="number" step="0.01" class="mt-1 block w-full sm:text-sm rounded-md" id="expected_price" name="expected_price" value="" required />
                    </div>

                    <div class="mb-3" id="expected_price_max_container">
                        <label for="expected_price_max" class="form-label">Expected Price Maximum </label>
                        <x-text-input type="number" step="0.01" class="mt-1 block w-full sm:text-sm rounded-md" id="expected_price_max" name="expected_price_max" value="" required />
                    </div>

                    <div class="mb-3">
                        <label for="estimated_duration" class="form-label">Estimated Duration (hours)</label>
                        <x-text-input type="number" class="mt-1 block w-full sm:text-sm rounded-md" id="estimated_duration" name="estimated_duration" value="" required />
                    </div>

                    <div class="mb-3">
                        <label for="attach_media" class="form-label">Attach Image <span class="text-red-500">*</span></label>
                        <x-text-input type="file" class="mt-1 block w-full sm:text-sm rounded-md" id="attach_media" name="attach_media" required />
                    </div>

                    <div class="mb-3">
                        <label for="attach_media2" class="form-label">Attach Image 2</label>
                        <x-text-input type="file" class="mt-1 block w-full sm:text-sm rounded-md" id="attach_media2" name="attach_media2" />
                    </div>

                    <div class="mb-3">
                        <label for="attach_media3" class="form-label">Attach Image 3</label>
                        <x-text-input type="file" class="mt-1 block w-full sm:text-sm rounded-md" id="attach_media3" name="attach_media3" />
                    </div>

                    <div class="mb-3">
                        <label for="attach_media4" class="form-label">Attach Image 4</label>
                        <x-text-input type="file" class="mt-1 block w-full sm:text-sm rounded-md" id="attach_media4" name="attach_media4" />
                    </div>

                    <div class="flex justify-center">
                        <x-primary-button type="submit" class="md:mt-6 text-white rounded-md btn-lg">Create Service Request</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

   <script>
    function toggleJobTypeFields() {
        var jobType = document.getElementById('job_type').value;
        var hourlyRateContainer = document.getElementById('hourly_rate_container');
        var hourlyRateMaxContainer = document.getElementById('hourly_rate_max_container');
        var expectedPriceContainer = document.getElementById('expected_price_container');
        var expectedPriceMaxContainer = document.getElementById('expected_price_max_container');

        if (jobType === 'hourly_rate') {
            hourlyRateContainer.style.display = 'block';
            hourlyRateMaxContainer.style.display = 'block';
            expectedPriceContainer.style.display = 'none';
            expectedPriceMaxContainer.style.display = 'none';

            document.getElementById('hourly_rate').required = true;
            document.getElementById('hourly_rate_max').required = true;
            document.getElementById('expected_price').required = false;
            document.getElementById('expected_price_max').required = false;

        } else if (jobType === 'project_based') {
            hourlyRateContainer.style.display = 'none';
            hourlyRateMaxContainer.style.display = 'none';
            expectedPriceContainer.style.display = 'block';
            expectedPriceMaxContainer.style.display = 'block';

            document.getElementById('hourly_rate').required = false;
            document.getElementById('hourly_rate_max').required = false;
            document.getElementById('expected_price').required = true;
            document.getElementById('expected_price_max').required = true;

        } else {
            hourlyRateContainer.style.display = 'none';
            hourlyRateMaxContainer.style.display = 'none';
            expectedPriceContainer.style.display = 'none';
            expectedPriceMaxContainer.style.display = 'none';

            document.getElementById('hourly_rate').required = false;
            document.getElementById('hourly_rate_max').required = false;
            document.getElementById('expected_price').required = false;
            document.getElementById('expected_price_max').required = false;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        toggleJobTypeFields();
        document.getElementById('job_type').addEventListener('change', toggleJobTypeFields);
    });


// Function to validate dates
    function validateDates() {
        var today = new Date().toISOString().split('T')[0];
        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;
        var sameDayOption = document.getElementById('same_day')?.checked;

        if (startDate < today) {
            alert("Start date cannot be in the past.");
            document.getElementById('start_date').value = today;
        }

        if (endDate && endDate < startDate) {
            alert("End date cannot be before the start date. The web app does not support time travel");
            document.getElementById('end_date').value = startDate;
        }

        if (sameDayOption) {
            document.getElementById('end_date').value = startDate;
        }
    }

    // Function to validate times
    function validateTimes() {
        var startTime = document.getElementById('start_time').value;
        var endTime = document.getElementById('end_time').value;

        if (startTime && endTime && endTime <= startTime) {
            alert("End time must be after start time.");
            document.getElementById('end_time').value = '';
        }
    }

    // Initialize event listeners after the document is fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        toggleJobTypeFields();
        document.getElementById('job_type').addEventListener('change', toggleJobTypeFields);
        document.getElementById('start_date').addEventListener('change', validateDates);
        document.getElementById('end_date').addEventListener('change', validateDates);
        document.getElementById('same_day')?.addEventListener('change', validateDates);
        document.getElementById('start_time').addEventListener('change', validateTimes);
        document.getElementById('end_time').addEventListener('change', validateTimes);
    });

function validateMinMax() {
    var hourlyRate = parseFloat(document.getElementById('hourly_rate').value);
    var hourlyRateMax = parseFloat(document.getElementById('hourly_rate_max').value);
    var expectedPrice = parseFloat(document.getElementById('expected_price').value);
    var expectedPriceMax = parseFloat(document.getElementById('expected_price_max').value);

    if (!isNaN(hourlyRate) && !isNaN(hourlyRateMax)) {
        if (hourlyRate > hourlyRateMax) {
            alert("Hourly Rate Minimum cannot be greater than Hourly Rate Maximum.");
            document.getElementById('hourly_rate_max').value = '';
        }
    }

    if (!isNaN(expectedPrice) && !isNaN(expectedPriceMax)) {
        if (expectedPrice > expectedPriceMax) {
            alert("Expected Price Minimum cannot be greater than Expected Price Maximum.");
            document.getElementById('expected_price_max').value = '';
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('hourly_rate').addEventListener('blur', validateMinMax);
    document.getElementById('hourly_rate_max').addEventListener('blur', validateMinMax);
    document.getElementById('expected_price').addEventListener('blur', validateMinMax);
    document.getElementById('expected_price_max').addEventListener('blur', validateMinMax);
});


</script>

</x-dashboard>
