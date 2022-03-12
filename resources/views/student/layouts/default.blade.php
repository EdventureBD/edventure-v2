<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edventure | Home</title>
    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap" rel="stylesheet">
    <!-- Preloader -->
    <link type="text/css" href="{{ asset('student/public/vendor/spinkit.css') }}" rel="stylesheet">
    <!-- Perfect Scrollbar -->
    <link type="text/css" href="{{ asset('student/public/vendor/perfect-scrollbar.css') }}" rel="stylesheet">
    <!-- Material Design Icons -->
    <link type="text/css" href="{{ asset('student/public/css/material-icons.css') }}" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link type="text/css" href="{{ asset('student/public/css/fontawesome.css') }}" rel="stylesheet">
    <!-- Preloader -->
    <link type="text/css" href="{{ asset('student/public/css/preloader.css') }}" rel="stylesheet">
    <!-- App CSS -->
    <link type="text/css" href="{{ asset('student/public/css/app.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('student/public/css/custom.css') }}" rel="stylesheet">

    <!--favicon-->
    <link rel="icon" type="image/png" href="{{ asset('img/contact/mapLogo.png') }}">
    <!----style------>
    <link type="text/css" href="{{ asset('student/public/css/style.css') }}" rel="stylesheet">
    <!----flickity------>
    <!-- <link type="text/css" href="../../public/css/flickity.css" rel="stylesheet"> -->
    

    @yield('css1')
    @livewireStyles
</head>

<body class="layout-sticky-subnav layout-default">

    {{-- @include('student.includes.preloader') --}}

    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">
        <!-- Header -->

        @include('student.includes.navbar')
        @if (session()->has('status'))
            <div class="row mt-40pt w-50" style="margin-left: 22rem !important;">
                <div class="col-lg-12">
                    <div class="flex ml-4">

                        <div class="alert bg-primary alert-dismissible fade show mt-40pt"
                                role="alert">
                            <button type="button"
                                    class="close"
                                    data-dismiss="alert"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="d-flex flex-wrap align-items-start">
                                <div class="mr-8pt">
                                    <i class="material-icons">access_time</i>
                                </div>
                                <div class="flex">
                                    <small class="text-black-100">
                                        <strong>{{ session('status') }}</strong>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- // END Header -->
        <!-- Header Layout Content -->

            @yield('content')
        
        <!-- // END Header Layout Content -->

        <!-- Footer -->
            @include('student.includes.footer')
        <!-- // END Footer -->
    </div>
    <!-- // END Header Layout -->

    <div class="container-fluid bg-primary p-3 text-center">
        <div class="row">
            <div class="col">
                <div class="">
                    <p class="tetx-100 mt-n1 mb-0 text-white">Copyright 2021 - {{ date('Y') }} &copy; All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Drawer -->

        @include('student.includes.sidebar')

    <!-- // END Drawer -->

    @livewireScripts
    <!-- jQuery -->
    <script src="{{ asset('student/public/vendor/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('student/public/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('student/public/vendor/bootstrap.min.js') }}"></script>
    <!-- Perfect Scrollbar -->
    <script src="{{ asset('student/public/vendor/perfect-scrollbar.min.js') }}"></script>
    <!-- DOM Factory -->
    <script src="{{ asset('student/public/vendor/dom-factory.js') }}"></script>
    <!-- MDK -->
    <script src="{{ asset('student/public/vendor/material-design-kit.js') }}"></script>
    <!-- App JS -->
    <script src="{{ asset('student/public/js/app.js') }}"></script>
    <!-- Preloader -->
    <script src="{{ asset('student/public/js/preloader.js') }}"></script>
    

    @yield('js1')

</body>

</html>
