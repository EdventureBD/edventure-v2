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
        <style>
            
            @media (max-width: 992px) {
                .navbar-collapse {
                    position: fixed;
                    top: 50px;
                    left: 0;
                    padding-left: 24px;
                    padding-right: 15px;
                    padding-bottom: 15px;
                    width: 75%;
                    height: 100%;
                }
                .navbar-collapse.collapsing {
                    left: -75%;
                    transition: height 0s ease;
                }
                .navbar-collapse.show {
                    left: 0;
                    transition: left 300ms ease-in-out;
                }
                .navbar-toggler.collapsed ~ .navbar-collapse {
                    transition: left 700ms ease-in-out;
                }
            }
            .glass {
                /*background-color: rgba(255, 255, 255, .15);*/
                /*backdrop-filter: blur(5px);*/
                filter: blur(5px);
            }
            .navbar-toggler-icon {
                background-image: none;
            }
            .test::before {
                font-family: "Font Awesome 5 Free";
                content: "\f805"; /* fa-bars, fa-navicon */
            }
            .bg-purple-customed {
                background-color: #6400C8 !important;
            }
            .bg-dark {
                background-color: #953dd2!important;
            }
        </style>
    </head>
    <body>
    <!-- Messenger Chat plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "104157968710619");
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
            js.src = 'https://connect.facebook.net/en_GB/sdk/xfbml.customerchat.js';
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
                <div class="wholeBody">
                    {{ $slot }}
                    {{-- @yield('content') --}}
                    @include('landing.footer')
                </div>
                
            </div>
        </div>
        <!-- Scripts -->

        <script src="{{ asset('js/app.js') }}"></script>
        @yield('js')
        @include('partials.custom_sctipt')
        @include('partials.after_body_analytics')
        {{-- new navbar collapse code  --}}
        <script>
            $('.navbar-collapse').on('show.bs.collapse', function () {
                $('.wholeBody').addClass('glass');
                $('.wholeBody').css('pointer-events','none');
            });
            $('.navbar-collapse').on('hide.bs.collapse', function () {
                $('.wholeBody').removeClass('glass');
                $('.wholeBody').css('pointer-events','auto');
            });
            /* $('.hey').on('click', function () {
                $('.navbar-collapse').removeClass('show');
                $('.hey').removeClass('glass');
            }); */
        </script>
        {{-- new navbar collapse code ends  --}}
    </body>
</html>
