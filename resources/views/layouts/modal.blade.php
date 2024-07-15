<x-dashboard>
    <div class="mt-6 px-6 py-8 bg-white shadow-md sm:rounded-lg w-full md:w-5/12 mx-auto">
        <div class="flex flex-col items-center">
            <div class="text-2xl font-bold text-custom-light-blue">
                {{ __('Create Service Request') }}
            </div>

            <div class="w-full md:w-7/12 space-y-6 mx-auto mt-4">
                        <form action="{{ route('service-requests.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="border-t my-4 w-full pb-6"></div>

                            <div class="mb-4">
                            <label for="category" class="block text-base text-custom-default-text">Category</label>
                            <x-selection class="form-select" id="category" name="category">
                                <option value="carpentry">Carpentry</option>
                                <option value="plumbing">Plumbing</option>
                                <option value="welding">Welding</option>
                                <option value="building_related">Building and Related</option>
                                <option value="electrical">Electrical</option>
                                <option value="food_service">Bus Driving</option>
                                <option value="stone_cutting_masonry">Stone Cutting and Masonry</option>
                                <option value="hairdressing">Hairdressing</option>
                                <option value="beauty_therapy">Beauty Therapy</option>
                            </x-selection>

                            <div class="mb-4">
                                <label for="title" class="block text-base text-custom-default-text">Title</label>
                                <x-text-input type="text" id="title" name="title" required class="mt-1 block w-full sm:text-sm rounded-md" />
                            </div>

                            <div>
                            <x-input-label for="description" class="text-base text-custom-default-text">Description</x-input-label>
                            <textarea class="mt-1 block w-full form-control rounded border border-gray-300 shadow-sm resize-none focus:ring-custom-light-blue  md:h-48 p-2" id="description" name="description" rows="4" required></textarea>
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
                                    <x-text-input type="time" class="mt-1 block w-full sm:text-sm rounded-md" id="start_time" name="start_time"
                                        required/>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="end_time" class="form-label">End Time</label>
                                    <x-text-input type="time" class="mt-1 block w-full    sm:text-sm rounded-md" id="end_time" name="end_time" required/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="skill_tags" class="form-label">Skill Tags</label>
                                <x-text-input type="text" class="mt-1 block w-full sm:text-sm rounded-md" id="skill_tags" name="skill_tags" required/>
                            </div>

{{-- <div class="mb-3">
    <label for="skill_tags" class="form-label">Skill Tags</label>
    <div class="tags-input">
        <input type="text" class="mt-1 block w-full    sm:text-sm rounded-md" id="skill_tags" name="skill_tags" required>
        <ul class="predefined-tags">
            <li class="tag">painting</li>
            <li class="tag">carpentry</li>
            <!-- Add more predefined tags here -->
        </ul>
    </div>
</div> --}}
                         
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
                                <x-selection class="form-select" id="job_type" name="job_type" required>
                                    <option value="project_based">Project Based</option>
                                    <option value="hourly_rate">Hourly Rate</option>
                                </x-selection>
                            </div>
                            <div class="mb-3">
                                <label for="hourly_rate" class="form-label">Hourly Rate</label>
                                <x-text-input type="number" step="0.01" class="mt-1 block w-full    sm:text-sm rounded-md" id="hourly_rate"
                                    name="hourly_rate" value="0.00" required/>
                            </div>
                            <div class="mb-3">
                                <label for="expected_price" class="form-label">Expected Price</label>
                                <x-text-input type="number" step="0.01" class="mt-1 block w-full    sm:text-sm rounded-md" id="expected_price"
                                    name="expected_price" value="0.00" required/>
                            </div>
                            <div class="mb-3">
                                <label for="estimated_duration" class="form-label">Estimated Duration (hours)</label>
                                <x-text-input type="number" class="mt-1 block w-full sm:text-sm rounded-md" id="estimated_duration"
                                    name="estimated_duration" value="0" required/>
                            </div>
                            <div class="mb-3">
                                <label for="attach_media" class="form-label">Attach Media</label>
                                <x-text-input type="file" class="mt-1 block w-full sm:text-sm rounded-md" id="attach_media" name="attach_media"
                                    required/>
                            </div>
                            <div class="mb-3">
                                <label for="attach_media2" class="form-label">Attach Media 2</label>
                                <x-text-input type="file" class="mt-1 block w-full sm:text-sm rounded-md" id="attach_media2" name="attach_media2"/>
                            </div>
                            <div class="mb-3">
                                <label for="attach_media3" class="form-label">Attach Media 3</label>
                                <x-text-input type="file" class="mt-1 block w-full sm:text-sm rounded-md" id="attach_media3" name="attach_media3"/>
                            </div>
                            <div class="mb-3">
                                <label for="attach_media4" class="form-label">Attach Media 4</label>
                                <x-text-input type="file" class="mt-1 block w-full sm:text-sm rounded-md" id="attach_media4" name="attach_media4"/>
                            </div>
                            <div class="flex justify-center">
                                <x-primary-button type="submit" class="md:mt-6 text-white rounded-md btn-lg">Create Service Request</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</x-dashboard>
<!--
    {{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
    const skillTagsInput = document.getElementById('skill_tags');
    const predefinedTags = document.querySelectorAll('.predefined-tags li');
    const selectedTags = [];

    skillTagsInput.addEventListener('click', function() {
        document.querySelector('.predefined-tags').style.display = 'block';
    });

    predefinedTags.forEach(function(tag) {
        tag.addEventListener('click', function() {
            const tagText = this.textContent;
            if (!selectedTags.includes(tagText)) {
                selectedTags.push(tagText);
                addTag(tagText);
                skillTagsInput.value = selectedTags.join(', ');
                document.querySelector('.predefined-tags').style.display = 'none';
            }
        });
    });

    document.addEventListener('click', function(event) {
        if (!event.target.closest('.tags-input')) {
            document.querySelector('.predefined-tags').style.display = 'none';
        }
    });

    function addTag(tagText) {
        const tagElement = document.createElement('span');
        tagElement.classList.add('tag');
        tagElement.textContent = tagText;
        tagElement.addEventListener('click', function() {
            removeTag(tagText);
        });
        skillTagsInput.parentNode.insertBefore(tagElement, skillTagsInput);
    }

    function removeTag(tagText) {
        const index = selectedTags.indexOf(tagText);
        if (index !== -1) {
            selectedTags.splice(index, 1);
            skillTagsInput.value = selectedTags.join(', ');
            const tagElement = document.querySelector(`.tag:nth-child(${index + 1})`);
            tagElement.parentNode.removeChild(tagElement);
        }
    }
});
    </script> 
--}}
--}}
--}}