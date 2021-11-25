<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="facebook-domain-verification" content="chfhwjh5xnvpwgn6v9nqy2wxv8pg55" />

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
 <!--favicon-->
    <link rel="icon" type="image/png" href="{{ asset('img/landing/fav.png') }}">
        <!-- Font Awesome Icons -->
        <link type="text/css" href="{{ asset('student/public/css/fontawesome.css') }}" rel="stylesheet">
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        {{-- <link rel="stylesheet" href="{{ asset('landing/landing.css') }}"> --}}
        @include('partials.facebook_pixel')
    </head>
    <body>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v12.0&appId=554702885532768&autoLogAppEvents=1" 
        nonce="QThp190A"></script>
        <script>
            if (location.protocol !== 'https:' && location.hostname !== '127.0.0.1') {  
                location.replace(`https:${location.href.substring(location.protocol.length)}`);
            }
        </script>
        <div class="font-sans text-gray-900 antialiased" id="app">
            <div class="landing-page">
                @include('landing.header', ['headerBg'=>$headerBg])
                {{ $slot }}
                {{-- @yield('content') --}}
                @include('landing.footer')
            </div>
        </div>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        @include('partials.custom_sctipt')
        @include('partials.after_body_analytics')
    </body>
</html>
