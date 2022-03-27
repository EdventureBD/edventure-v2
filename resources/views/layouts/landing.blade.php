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
    <!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "1353963408033833");
        chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml            : true,
                version          : 'v13.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

{{--        <div id="fb-root"></div>--}}
{{--        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v12.0&appId=842032013135226&autoLogAppEvents=1"--}}
{{--        nonce="2W2mmhKE"></script>--}}


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
