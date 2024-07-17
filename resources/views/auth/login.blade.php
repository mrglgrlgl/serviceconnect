<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="grid grid-cols-1 md:grid-cols-2 w-full mx-auto pb-6">
        <!-- Login Form on the Left -->
        <div class="md:col-span-1 order-1 md:order-1 rounded-t-lg md:rounded-none p-6">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="text-3xl text-center text-custom-header mb-4">Login</div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email address')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-2">
                    <!-- Remember Me -->
                    <div class="block">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 shadow-sm" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <!-- Forgot Password -->
                    <div>
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Login button -->
                <div class="mt-4">
                    <x-primary-button class="h-12 w-full justify-center text-white text-xl border-transparent hover:bg-blue-700">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        <!-- Sign Up Section on the Right -->
        <div class="md:col-span-1 order-2 md:order-2 p-6 rounded-b-lg md:rounded-none flex flex-col justify-center items-center">
            <div class="text-center justify-center">

                <div class="pb-2">
                    <span class="justify-center px-2 text-custom-header text-xl">Don't have an account?</span>
                </div>
                <div class="pb-8">
                    <span class="justify-center px-2 text-custom-header text-xl">Register as a</span>
                </div>
                <x-primary-button :href="route('register')" class="h-12 w-full justify-center text-xl text-custom-dark-blue bg-transparent border-2 border-custom-dark-blue hover:border-transparent hover:text-white hover:bg-custom-lightest-blue">
                    {{ __('Seeker') }}
                </x-primary-button>
                <div class="border-t my-4 relative text-center"></div>
                <x-primary-button :href="route('register')" class="h-12 w-full justify-center text-xl text-custom-dark-blue bg-transparent border-2 border-custom-dark-blue hover:border-transparent hover:text-white hover:bg-custom-light-blue">
                    {{ __('Provider') }}
                </x-primary-button>
            </div>
        </div>
    </div>
</x-guest-layout>