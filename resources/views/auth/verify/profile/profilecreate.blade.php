<x-app-layout>
    <div class="md:mt-3 md:px-12 md:py-12 bg-white shadow-md sm:rounded-lg md:w-5/12 mx-auto">
        <div class="flex flex-col items-center">
            <div class="text-2xl font-bold text-custom-light-blue pb-6">
                {{ __('Complete Your Profile') }}
            </div>
            <div class="w-full md:w-8/12 mx-auto">
                <form action="{{ route('save-profile') }}" method="POST">
                    @csrf

                    <!-- Work Email -->
                    <div class="form-group">
                        <x-input-label for="work_email" class="text-base md:text-base text-custom-dark-blue">Work Email
                            <span class="text-sm text-gray-500">(Optional)</span></x-input-label>
                        <input type="email" id="work_email" name="work_email"
                            class="form-control w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" />
                        @error('work_email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contact Number -->
                    <div class="form-group">
                        <x-input-label for="contact_number" class="text-base md:text-base text-custom-dark-blue">Contact
                            Number <span class="text-sm text-gray-500">(Optional)</span></x-input-label>
                        <input type="text" id="contact_number" name="contact_number"
                            class="form-control w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" />
                        @error('contact_number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Service Category -->
                    <div class="form-group">
                        <x-input-label for="serviceCategory"
                            class="text-base md:text-base text-custom-dark-blue">Service Category</x-input-label>
                        <select id="serviceCategory" name="serviceCategory"
                            class="form-control w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300"
                            required>
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
                            <option value="Landscaping">Landscaping</option>
                        </select>
                        @error('serviceCategory')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <x-input-label for="description"
                            class="text-base md:text-base text-custom-dark-blue">Description</x-input-label>
                        <textarea id="description" name="description" rows="4"
                            class="form-control w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required></textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Years of Experience and Have Tools -->
                    <div class="form-group flex space-x-4">
                        <!-- Years of Experience -->
                        <div>
                            <x-input-label for="years_of_experience"
                                class="text-base md:text-base text-custom-dark-blue">Years of Experience</x-input-label>
                            <select id="years_of_experience" name="years_of_experience"
                                class="form-control w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300"
                                required>
                                @for ($i = 1; $i <= 50; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            @error('years_of_experience')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Have Tools -->
                        <div>
                            <x-input-label for="have_tools" class="text-base md:text-base text-custom-dark-blue">Do you
                                have tools/equipment?</x-input-label>
                            <div class="flex items-center space-x-4">
                                <label for="have_tools_yes" class="inline-flex items-center">
                                    <input type="radio" id="have_tools_yes" name="have_tools" value="1"
                                        class="form-radio" required>
                                    <span class="ml-2">Yes</span>
                                </label>
                                <label for="have_tools_no" class="inline-flex items-center">
                                    <input type="radio" id="have_tools_no" name="have_tools" value="0"
                                        class="form-radio" required>
                                    <span class="ml-2">No</span>
                                </label>
                            </div>
                            @error('have_tools')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Availability Days and Time -->
                    <div class="form-group">
                        <x-input-label for="availability"
                            class="text-base md:text-base text-custom-dark-blue">Availability</x-input-label>
                        <div class="flex flex-col space-y-4">
                            <div id="availability_days" class="flex justify-center space-x-2">
                                @foreach (['M' => 'Monday', 'T' => 'Tuesday', 'W' => 'Wednesday', 'Th' => 'Thursday', 'F' => 'Friday', 'S' => 'Saturday', 'Sn' => 'Sunday'] as $abbr => $day)
                                    <div class="flex flex-col items-center">
                                        <input type="checkbox" id="day_{{ $abbr }}" name="availability_days[]"
                                            value="{{ $day }}" />
                                        <label for="day_{{ $abbr }}"
                                            class="day-label flex items-center justify-center w-10 h-10 border border-gray-300 rounded-full cursor-pointer hover:bg-custom-light-blue hover:text-white transition-colors duration-150">
                                            {{ $abbr }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>





{{-- <div class="form-group">
    <x-input-label for="availability_time" class="text-base md:text-base text-custom-dark-blue">Availability Time</x-input-label>
    <div class="flex justify-center items-center space-x-4">
        <span class="text-sm">From:</span>
        <select name="availability_start" id="availability_start" required class="form-control">
            @for ($hour = 0; $hour < 24; $hour++)
                @foreach (['00', '30'] as $minute)
                    <option value="{{ sprintf('%02d:%02d', $hour, $minute) }}">
                        {{ date('g:i A', strtotime(sprintf('%02d:%02d', $hour, $minute))) }}
                    </option>
                @endforeach
            @endfor
        </select>
        <span class="text-sm">To:</span>
        <select name="availability_end" id="availability_end" required class="form-control">
            @for ($hour = 0; $hour < 24; $hour++)
                @foreach (['00', '30'] as $minute)
                    <option value="{{ sprintf('%02d:%02d', $hour, $minute) }}">
                        {{ date('g:i A', strtotime(sprintf('%02d:%02d', $hour, $minute))) }}
                    </option>
                @endforeach
            @endfor
        </select>
    </div>
    @error('availability_start')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
    @error('availability_end')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div> --}}

        <div class="flex justify-center pt-6">
            <x-primary-button type="submit"
                class="rounded-md px-8 text-lg font-medium text-white bg-custom-dark-blue hover:bg-custom-light-blue">Save
                Profile</x-primary-button>
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

    .day-label {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .day-label:hover,
    .day-label.bg-custom-light-blue {
        background-color: #3498DB;
        color: white;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .availability-checkbox:checked+.day-label {
        background-color: #3498DB;
        color: white;
    }

    .availability-checkbox+.day-label {
        transition: background-color 0.3s, color 0.3s;
    }

    .availability-checkbox {
        display: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dayLabels = document.querySelectorAll('.day-label');
        dayLabels.forEach(label => {
            label.addEventListener('click', function() {
                this.classList.toggle('bg-custom-light-blue');
                this.classList.toggle('text-white');
                const checkbox = this.previousElementSibling;
                checkbox.checked = !checkbox.checked;
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.availability-checkbox').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    if (checkbox.checked) {
                        checkbox.nextElementSibling.classList.add(
                            'bg-custom-light-blue', 'text-white');
                    } else {
                        checkbox.nextElementSibling.classList.remove(
                            'bg-custom-light-blue', 'text-white');
                    }
                });
            });
        });

    });
</script>
