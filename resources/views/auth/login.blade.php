<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    <div class="text-2xl text-center text-custom-header">Login</div>

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email address')" />
            <x-text-input id="email" class="block mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Forgot Password Link -->
        <div class="flex items-center justify-end mt-2">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- Remember Me Checkbox -->
        <div class="block mb-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Login Button -->
        <x-primary-button class="h-12 w-full justify-center text-white text-xl border-transparent">
            {{ __('Log in') }}
        </x-primary-button>
    </form>

    <!-- Sign Up Link -->
    <div class="text-center justify-center mt-4">
        <div class="border-t my-4 relative text-center"></div>
        <div class="pb-2">
            <span class="justify-center px-2 text-custom-header text-xl">Don't have an account?</span>
        </div>
        <a href="{{ route('register') }}">
            <x-primary-button class="h-12 w-full justify-center text-xl bg-transparent border-2 border-custom-dark-blue text-custom-dark-blue hover:border-transparent hover:text-white">
                {{ __('Sign up') }}
            </x-primary-button>
        </a>
    </div>
</x-guest-layout>
