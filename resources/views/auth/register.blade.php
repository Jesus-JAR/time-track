<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-component-logo width="w-32"/>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />


        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="container mt-4 flex space-x-2">
                <div class="mt-4 relative">
                    <x-jet-label for="first_name" value="{{ __('First name:') }}" />
                    <x-jet-input id="first_name" maxlength="35" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
                </div>
                <div class="mt-4 relative pl-3">
                    <x-jet-label for="last_name" value="{{ __('Last name:') }}" />
                    <x-jet-input id="last_name" maxlength="35" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="name" />
                </div>
            </div>

            <div class="mt-4 relative">
                <x-jet-label for="email" value="{{ __('Email:') }}" />
                <x-jet-input id="email" maxlength="35" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4 relative">
                <x-jet-label for="phone" value="{{ __('Phone:') }}" />
                <x-jet-input id="phone" maxlength="12" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
            </div>

            <div class="mt-4 relative">
                <x-jet-label for="bussines" value="{{ __('Bussines:') }}" />
                <select name="business" id="business" class="block mt-1 w-full border-gray-300 focus:border-sea-300 focus:ring focus:ring-sea-200 focus:ring-opacity-50 rounded-md shadow-sm" placeholder="Regular input">
                    <option value="">Select Company</option>
                @foreach($business as $company)
                        <option value="{{$company->id}}">{{$company->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-4 relative">
                <x-jet-label for="dni" value="{{ __('Dni:') }}" />
                <x-jet-input id="dni" maxlength="12"  class="block mt-1 w-full" type="text" name="dni" :value="old('dni')" required />
            </div>

            <div class="container mt-4 flex space-x-2">
                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                </div>

                <div class="mt-4 relative pl-3">
                    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
