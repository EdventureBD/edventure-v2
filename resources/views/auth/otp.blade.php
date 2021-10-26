<link rel="icon" type="image/png" href="/img/landing/fav.png">

<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="otp" :value="__('Confirm your mobile')" />
                <x-input id="otp" placeholder="Enter your OTP" class="block mt-1 w-full" type="text" name="otp" :value="old('otp')" required
                    autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4" type="submit" style="background-color: #663193;">
                    {{ __('Confirm') }}
                </x-button>
            </div>
        </form>
        
        
        <script>
            function togglePassword(type)
            {
                $("#password").attr("type", type);
                $("#password_confirmation").attr("type", type);
                $(".eye-icon").toggle();
                $(".eye-icon-blind").toggle();
            }
        </script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.0.1/firebase.js"></script>
        <script src="{{asset("js/firebase.js")}}"></script> --}}
    </x-auth-card>
</x-guest-layout>
