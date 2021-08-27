

<div>

    <link rel="stylesheet" href = "{{ asset('css/background.css') }}" type="text/css">
    
    <div class="master-container">

        <div class="form-container">

            <x-guest-layout class="">
                <x-jet-authentication-card class="">
                    <x-slot name="logo">
                        <!-- <x-jet-authentication-card-logo /> -->
                    </x-slot>

                    <x-jet-validation-errors class="" />

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" id="login-form">
                        @csrf

                        <div>
                            <x-jet-label for="email" value="{{ __('Username') }}" />
                            <x-jet-input id="username" class="block mt-1 w-full" 
                            type="text" name="username" :value="old('username')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="password" value="{{ __('Password') }}" />
                            <x-jet-input id="password" class="block mt-1 w-full" 
                            type="password" name="password" required autocomplete="current-password" />
                        </div>

                        <div class="block mt-4">
                            <label for="remember_me" class="flex items-center">
                                <x-jet-checkbox id="remember_me" name="remember" />
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                            @if (Route::has('password.request'))
                            <div class="flex items-center justify-start mt-4">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            </div>    
                            @endif

                            <div class="flex items-center justify-start mt-4">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                                    {{ __('Not have an account? Sign up here') }}
                                </a>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-jet-button class="ml-4">
                                    {{ __('Log in') }}
                                </x-jet-button>
                            </div>
                    </form>
                </x-jet-authentication-card>
            </x-guest-layout>

        </div>

    </div>


    <script type="text/javascript">

        Array.from(document.querySelectorAll("#login-form label"))
        .forEach(label => label.classList = "block text-xl text-gray-800")

        document.getElementById("login-form").parentElement.style.backgroundColor = "#fff"

    </script>

</div>



