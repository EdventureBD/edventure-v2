<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="{{!empty($metadesc) ? $metadesc : 'A group of passionate educators striving to make education easy, fun, and personal with the help of technology. We want to increase the accessibility of quality education while empowering learners, parents, and teachers alike.'}}">
        <meta name="keywords" content="{{!empty($metatag) ? $metatag : 'Edventurebd Edventure Edtech'}}">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="facebook-domain-verification" content="chfhwjh5xnvpwgn6v9nqy2wxv8pg55" />

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
 <!--favicon-->
    <link rel="icon" type="image/png" href="{{ asset('img/contact/mapLogo.png') }}">
        <!-- Font Awesome Icons -->
        <link type="text/css" href="{{ asset('student/public/css/fontawesome.css') }}" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        {{-- <link rel="stylesheet" href="{{ asset('landing/landing.css') }}"> --}}
{{--        @include('partials.facebook_pixel')--}}
    </head>
    <body>

        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v12.0&appId=842032013135226&autoLogAppEvents=1"
        nonce="2W2mmhKE"></script>


        <script>
            if (location.protocol !== 'https:' && location.hostname !== '127.0.0.1') {
                location.replace(`https:${location.href.substring(location.protocol.length)}`);
            }
        </script>

        <div class="font-sans text-gray-900 antialiased" id="app">
            <div class="landing-page">
                @if(!request()->is("batch/*") && !request()->is("bundle/*"))
                    @include('landing.header', ['headerBg'=>$headerBg])
                @endif
                {{ $slot }}
                {{-- @yield('content') --}}
                @include('landing.footer')
            </div>
        </div>
        <!-- Scripts -->

        <script src="{{ asset('js/app.js') }}"></script>
        @yield('js')
        @include('partials.custom_sctipt')
        @include('partials.after_body_analytics')
    </body>
</html>
