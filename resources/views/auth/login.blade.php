<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
           <!-- <img src="img/logoPabuy.png" alt="" width="200">-->
           <h2 class="text-center">Log In</h2>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>


            <div class="flex items-center justify-center mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('register_page') }}"><p>Not yet registered? <u>Create an account</u></p></a>
            </div>

            <div class="text-center mt-4">
                <h4>OR</h4>
            </div>

            <div class="flex items-center justify-center mt-4">
                <a href="{{ url('auth/google') }}"> 
                   <div class="flex items-center bg-white border border-gray-300 text-gray-700 font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-gray-900">
                    <!-- Google "G" Logo SVG -->
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 150 150" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#4285F4" d="M120,76.1c0-3.1-0.3-6.3-0.8-9.3H75.9v17.7h24.8c-1,5.7-4.3,10.7-9.2,13.9l14.8,11.5C115,101.8,120,90,120,76.1L120,76.1z"/>
                        <path fill="#34A853" d="M75.9,120.9c12.4,0,22.8-4.1,30.4-11.1L91.5,98.4c-4.1,2.8-9.4,4.4-15.6,4.4c-12,0-22.1-8.1-25.8-18.9L34.9,95.6C42.7,111.1,58.5,120.9,75.9,120.9z"/>
                        <path fill="#FBBC05" d="M50.1,83.8c-1.9-5.7-1.9-11.9,0-17.6L34.9,54.4c-6.5,13-6.5,28.3,0,41.2L50.1,83.8z"/>
                        <path fill="#EA4335" d="M75.9,47.3c6.5-0.1,12.9,2.4,17.6,6.9L106.6,41C98.3,33.2,87.3,29,75.9,29.1c-17.4,0-33.2,9.8-41,25.3l15.2,11.8C53.8,55.3,63.9,47.3,75.9,47.3z"/>
                    </svg>
                    <span>Sign in with Google</span>
                   </div>
                </a>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
