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
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" placeholder="e.g. Fahim khan ridoy" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input placeholder="e.g. yourmail@test.com" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div>
                <x-label for="phone" :value="__('Phone')" />

                <x-input placeholder="e.g. 016xxxxxxxx" id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required
                    autofocus />
            </div>

            <!-- Password -->
            {{-- <div class="mt-4">
                <x-label  for="password" :value="__('Password')" />

                <x-input  id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div> --}}

            <div class="py-2" x-data="{ show: true }">
                <span for="password" class="px-1 text-sm text-gray-600">Password</span>
                <div class="relative">
                    <input placeholder="" type="password"
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                        id="password" name="password" required autocomplete="current-password">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">

                        <svg class="h-5 text-gray-700 eye-icon" onclick="togglePassword('text')" fill="none" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 576 512">
                            <path fill="currentColor"
                                d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                            </path>
                        </svg>

                        <svg class="h-5 text-gray-700 eye-icon-blind" onclick="togglePassword('password')" fill="none" xmlns="http://www.w3.org/2000/svg"
                            viewbox="0 0 640 512">
                            <path fill="currentColor"
                                d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Confirm Password -->
            {{-- <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div> --}}

            <div class="py-2" x-data="{ show: true }">
                <span for="password_confirmation" class="px-1 text-sm text-gray-600">Confirm Password</span>
                <div class="relative">
                    <input placeholder="" type="password" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                        id="password_confirmation" name="password_confirmation" required
                        autocomplete="confirm-password">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                        <svg class="h-5 text-gray-700 eye-icon" onclick="togglePassword('text')" fill="none" xmlns="http://www.w3.org/2000/svg"
                            viewbox="0 0 576 512">
                            <path fill="currentColor"
                                d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                            </path>
                        </svg>

                        <svg class="h-5 text-gray-700 eye-icon-blind" onclick="togglePassword('password')" fill="none" xmlns="http://www.w3.org/2000/svg"
                            viewbox="0 0 640 512">
                            <path fill="currentColor"
                                d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" style="text-decoration:none;" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4" type="submit" style="background-color: #663193;">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
        <div id="recaptcha-container"></div>

        <div class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="confirmMobile">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
              <!--
                Background overlay, show/hide based on modal state.
          
                Entering: "ease-out duration-300"
                  From: "opacity-0"
                  To: "opacity-100"
                Leaving: "ease-in duration-200"
                  From: "opacity-100"
                  To: "opacity-0"
              -->
              <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
          
              <!-- This element is to trick the browser into centering the modal contents. -->
              <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
          
              <!--
                Modal panel, show/hide based on modal state.
          
                Entering: "ease-out duration-300"
                  From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                  To: "opacity-100 translate-y-0 sm:scale-100"
                Leaving: "ease-in duration-200"
                  From: "opacity-100 translate-y-0 sm:scale-100"
                  To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
              -->
              <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-6 pt-5 pb-4 sm:p-8 sm:pb-4">
                  <div class="">
                    
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                      <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        Confirm your mobile
                      </h3>
                      <div class="mt-2">
                        <form action="">
                            <div class="form-group">
                                <input type="text" id="codeToVerify" class="w-full rounded" placeholder="OTP">
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                  <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-purple-600 text-base font-medium text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:ml-3 sm:w-auto sm:text-sm" id="verifPhNum">
                    Submit
                  </button>
                  <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" id="cancelModal">
                    Cancel
                  </button>
                </div>
              </div>
            </div>
          </div>
        
        <script>
            function togglePassword(type)
            {
                $("#password").attr("type", type);
                $("#password_confirmation").attr("type", type);
                $(".eye-icon").toggle();
                $(".eye-icon-blind").toggle();
            }
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.0.1/firebase.js"></script>
        <script src="{{asset("js/firebase.js")}}"></script>
    </x-auth-card>
</x-guest-layout>
