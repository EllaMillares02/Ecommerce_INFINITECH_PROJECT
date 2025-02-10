<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <!-- <img src="img/logoPabuy.png" alt="" width="200">-->
            <h2 class="text-center">Register</h2>
         </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
        
            <div class="row">
                <div class="col-6">
                    <x-label for="first_name" value="{{ __('First Name') }}" />
                    <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="given-name" />
                </div>
                
                <div class="col-6">
                    <x-label for="last_name" value="{{ __('Last Name') }}" />
                    <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autocomplete="family-name" />
                </div>            
            </div>
        
            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>
        
            <div class="mt-4">
                <x-label for="phone" class="block text-sm font-medium text-gray-700" value="{{ __('Phone') }}" />
                <div class="flex items-center border border-gray-300 rounded-md shadow-sm">
                    <!-- Philippine Flag -->
                    <span class="inline-flex items-center px-3 bg-gray-100 border-r border-gray-300 rounded-l-md">
                        <img src="https://flagcdn.com/w40/ph.png" alt="Philippine Flag" class="w-6 h-4" />
                    </span>
                    <!-- +63 Prefix -->
                    <span class="inline-flex items-center px-3 bg-gray-100 border-r border-gray-300">
                        +63
                    </span>
                    <!-- Phone Number Input -->
                    <input 
                        type="text" 
                        id="phone" 
                        name="phone" 
                        class="block w-full border-none rounded-r-md focus:ring-0" 
                        placeholder="9XXXXXXXXX" 
                        pattern="9[0-9]{9}" 
                        required 
                    />
                </div>
            </div>
        
            <div class="mt-4">
                <x-label for="province" value="{{ __('Province') }}" />
                <x-input id="province" class="block mt-1 w-full" type="text" name="province" :value="old('province')" required />
            </div>
            
            <div class="mt-4">
                <x-label for="city_municipality" value="{{ __('City/Municipality') }}" />
                <x-input id="city_municipality" class="block mt-1 w-full" type="text" name="city_municipality" :value="old('city_municipality')" required />
            </div>

            <div class="mt-4">
                <x-label for="barangay" value="{{ __('Barangay') }}" />
                <x-input id="barangay" class="block mt-1 w-full" type="text" name="barangay" :value="old('barangay')" required />
            </div>
            <div class="mt-4">
                <x-label for="street" value="{{ __('Street') }}" />
                <x-input id="street" class="block mt-1 w-full" type="text" name="street" :value="old('street')" required />
            </div>
            
            <div class="mt-4">
                <x-label for="postal_code" value="{{ __('Postal Code') }}" />
                <x-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" :value="old('postal_code')" required />
            </div>
        
            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>
        
            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
        
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />
        
                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif
        
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login_page') }}">
                    {{ __('Already registered?') }}
                </a>
        
                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>                
    </x-authentication-card>
</x-guest-layout>
