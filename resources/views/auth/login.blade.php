<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Quick Login Buttons -->
    <div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Quick Login</h3>
        <div class="flex flex-wrap gap-2">
            <button onclick="fillLogin('admin@trustjobs.com', 'password')" class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition">
                Login as Admin
            </button>
            <button onclick="fillLogin('employer@trustjobs.com', 'password')" class="px-4 py-2 bg-green-600 text-white text-sm rounded hover:bg-green-700 transition">
                Login as Employer
            </button>
            <button onclick="fillLogin('worker@trustjobs.com', 'password')" class="px-4 py-2 bg-purple-600 text-white text-sm rounded hover:bg-purple-700 transition">
                Login as Worker
            </button>
        </div>
    </div>

    <form method="POST" action="{{ route('login') }}" id="loginForm">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600">Don't have an account?</span>
                <a href="{{ route('register') }}" class="text-sm text-blue-600 hover:text-blue-500 font-medium">
                    Register as Worker or Employer
                </a>
            </div>
            
            <div class="flex items-center space-x-3">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button>
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </div>
    </form>

    <script>
        function fillLogin(email, password) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;
            document.getElementById('loginForm').submit();
        }
    </script>
</x-guest-layout>
