

<div>

    <style>
        .loading {
            width: 100vw;
            height: 100vh;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 50000;
            background: #fff;
        }

        .loading img {
            position: relative;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            height: 50px;
            width: 50px;
            color: #000;
        }

        .unload {
            display: none;
        }

    </style>

    <div class = "loading">
            <img src = "{{ asset('loading/loading.gif') }}">
    </div>

    <link rel="stylesheet" href = "{{ asset('css/background.css') }}" type="text/css">

    <div class="master-container">

        <div class="form-container">

            <x-guest-layout>
                <x-jet-authentication-card>
                    <x-slot name="logo">
                        <!-- <x-jet-authentication-card-logo /> -->
                    </x-slot>

                    <x-jet-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('register') }}" id="register-form">
                        @csrf

                        <div>
                            <x-jet-label for="name" value="{{ __('Name') }}" />
                            <x-jet-input id="name" class="block mt-1 w-full" type="text" 
                            name="name" :value="old('name')" required autofocus autocomplete="name" />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="email" value="{{ __('Email') }}" />
                            <x-jet-input id="email" class="block mt-1 w-full" 
                            type="email" name="email" :value="old('email')" required />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="username" value="{{ __('Username') }}" />
                            <x-jet-input id="username" class="block mt-1 w-full" 
                            type="text" name="username" :value="old('username')" required />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="password" value="{{ __('Password') }}" />
                            <x-jet-input id="password" class="block mt-1 w-full" 
                            type="password" name="password" required autocomplete="new-password" />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                            <x-jet-input id="password_confirmation" class="block mt-1 w-full" 
                            type="password" name="password_confirmation" required autocomplete="new-password" />
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="mt-4">
                                <x-jet-label for="terms">
                                    <div class="flex items-center">
                                        <x-jet-checkbox name="terms" id="terms"/>

                                        <div class="ml-2">
                                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" 
                                                    class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" 
                                                    class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                            ]) !!}
                                        </div>
                                    </div>
                                </x-jet-label>
                            </div>
                        @endif

                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" 
                            href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <x-jet-button class="ml-4">
                                {{ __('Register') }}
                            </x-jet-button>
                        </div>
                    </form>
                </x-jet-authentication-card>
            </x-guest-layout>

        </div>
    </div>

    <script type="text/javascript">

        document.getElementById("register-form").parentElement.style.backgroundColor = "#fff"

        onload = () => {
            document.getElementsByClassName("loading")[0].style.display = "none"
        }

    </script>

</div>

