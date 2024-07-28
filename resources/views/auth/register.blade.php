<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Create an Account || Already registered? -->
        <div class="flex items-center justify-between mt-3 mb-4">
            <div class="text-3xl text-custom-header">Create an Account</div>
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('log in instead') }}
            </a>
        </div>

        <!-- First Name -->
        <div class="mt-4">
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" class="block mt-1 w-full px-3 py-2 border-gray-300 rounded-md" type="text"
                name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class="mt-4">
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" class="block mt-1 w-full px-3 py-2 border-gray-300 rounded-md" type="text"
                name="last_name" :value="old('last_name')" required autocomplete="last_name" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full px-3 py-2 border-gray-300 rounded-md" type="email"
                name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="cell_no" :value="__('Phone Number')" />
            <div class="flex">
                <!-- Fixed Prefix -->
                <span class="inline-flex items-center px-3 bg-gray-200 border border-gray-300 rounded-l-md">
                    +63
                </span>
                <!-- Editable Input -->
                <x-text-input id="cell_no" class="block w-full border-gray-300 rounded-r-md pl-2" type="tel"
                    name="cell_no" placeholder="Enter phone number" required autocomplete="off" />
            </div>
            <x-input-error :messages="$errors->get('cell_no')" class="mt-2" />
            <small id="phoneHelp" class="text-red-500"></small>
        </div>

        <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full px-3 py-2 border-gray-300 rounded-md"
                    type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="text-xs font-open-sans">Use 8 or more characters with a mix of letters, numbers & symbols.</div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full px-3 py-2 border-gray-300 rounded-md"
                    type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            <!-- Gender -->
            <div class="mt-4">
                <x-input-label for="gender" :value="__('Gender')" class="pb-2 pt-2" />
                <div class="flex justify-start space-x-12">
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="gender" value="Male" class="radio" required />
                        <span>Male</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="gender" value="Female" class="radio" required />
                        <span>Female</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="gender" value="Other" class="radio" required />
                        <span>Other</span>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>

            <!-- Birth Date -->
            <div class="mt-4">
                <x-input-label for="birth_date" :value="__('Birth Date')" />
                <div class="flex mr-4 space-x-4 justify-center">
                    <div class="w-1/3">
                        <x-selection id="birth_date_month" name="birth_date_month" required>
                            <option value="">Month</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                            @endfor
                        </x-selection>
                        <x-input-error :messages="$errors->get('birth_date_month')" class="mt-2" />
                    </div>

                    <div class="w-1/3">
                        <x-selection id="birth_date_day" name="birth_date_day" required>
                            <option value="">Day</option>
                            @for ($i = 1; $i <= 31; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </x-selection>
                        <x-input-error :messages="$errors->get('birth_date_day')" class="mt-2" />
                    </div>

                    <div class="w-1/3">
                        <x-selection id="birth_date_year" name="birth_date_year" required>
                            <option value="">Year</option>
                            @for ($i = date('Y') - 100; $i <= date('Y'); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </x-selection>
                        <x-input-error :messages="$errors->get('birth_date_year')" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- Terms of Service -->
            <div class="block mt-4">
                <label for="remember_me" class="flex items-start">
                    <input id="remember_me" type="checkbox"
                        class="mt-1 checkbox-align rounded border-gray-300 text-custom-light-blue shadow-sm focus:ring-custom-light-blue"
                        name="remember">
                    <span class="ms-2 text-sm text-custom-header">{{ __('By creating an account, I agree to our ') }}
                        <a href="/terms-of-use"
                            class="text-custom-dark-text underline underline-offset-1">{{ __('Terms of use') }}</a>
                        {{ __(' and ') }}
                        <a href="/privacy-policy"
                            class="text-custom-dark-text underline underline-offset-1">{{ __('Privacy Policy') }}</a>
                        {{ __('?') }}
                    </span>
                </label>
            </div>

            <div class="flex items-center justify-center mt-4">
                <x-primary-button class="h-12 w-full justify-center text-xl border-transparent text-white">
                    {{ __('Next') }}
                </x-primary-button>
            </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const phoneInput = document.getElementById('cell_no');
            const phoneHelp = document.getElementById('phoneHelp');

            phoneInput.addEventListener('input', () => {
                let value = phoneInput.value;

                // Trim to a maximum of 10 characters (to make total including +63 to 12)
                if (value.length > 10) {
                    value = value.substring(0, 10);
                }

                phoneInput.value = value;

                // Display error message if length exceeds 10 digits
                if (value.length > 10) {
                    phoneHelp.textContent = "The phone number must be exactly 10 digits after '+63'.";
                } else {
                    phoneHelp.textContent = "";
                }
            });
        });
    </script>
</x-guest-layout>
