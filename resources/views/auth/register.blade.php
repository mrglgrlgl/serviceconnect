<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Create an Account || Already registered? -->
        <div class="flex items-center justify-between mt-3 mb-4">
            <div class="text-3xl text-custom-header">Create an Account</div>
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('log in instead') }}
            </a>
        </div>

        <!-- First Name -->
        <div>
            <x-input-label for="firstname" :value="__('First name')"/>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class="mt-4">
            <x-input-label for="lastname" :value="__('Last name')"/>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="text-xs font-open-sans">User 8 or more characters with a mix of letters, numbers & symbols.</div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Gender Selection -->
        <div class="mt-4">
        <x-input-label for="gender" :value="__('What\'s your gender?')" class="pb-2 pt-2" />
            <div class="flex justify-start space-x-12">
                <label class="flex items-center space-x-2">
                    <input type="radio" name="gender" value="male" class="radio" />
                    <span>Male</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="radio" name="gender" value="female" class="radio" />
                    <span>Female</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="radio" name="gender" value="other" class="radio" />
                    <span>Non-binary</span>
                </label>
            </div>
        </div>

        <!-- Birthdate -->
        <div class="mt-4">
            <x-input-label for="birth_date" :value="__('Birthdate')" />
            <div class="flex mr-4 space-x-4 justify-center">
                <div class="w-1/3">
                    <x-selection id="birth_date_month" name="birth_date_month" class="" required>
                        <option value="">Month</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </x-selection>
                    <x-input-error :messages="$errors->get('birth_date_month')" class="mt-2" />
                </div>

                <div class="w-1/3">
                    <x-selection id="birth_date_day" name="birth_date_day" class="" required>
                        <option value="">Day</option>
                        @for ($i = 1; $i <= 31; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </x-select>
                    <x-input-error :messages="$errors->get('birth_date_day')" class="mt-2" />
                </div>
                
                <div class="w-1/3">
                    <x-selection id="birth_date_year" name="birth_date_year" class="" required>
                        <option value="">Year</option>
                        @for ($i = 1900; $i <= date('Y'); $i++)
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

                <input id="remember_me" type="checkbox" class="mt-1 checkbox-align rounded border-gray-300 text-custom-light-blue shadow-sm focus:ring-custom-light-blue" name="remember">

                <span class="ms-2 text-sm text-custom-header">{{ __('By creating an account, I agree to our ') }}
                <a href="/terms-of-use" class="text-custom-dark-text underline underline-offset-1">{{ __('Terms of use') }}</a>
                 {{ __(' and ') }}
                <a href="/privacy-policy" class="text-custom-dark-text underline underline-offset-1">{{ __('Privacy Policy') }}</a>
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

</x-guest-layout>
