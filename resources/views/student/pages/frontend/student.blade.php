@extends('student.layouts.default', [
'title'=>'Home',
'pageName'=>'Home',
'secondPageName'=>'Home'
])

@section('css1')
    <!-- Bootstrap CSS -->
    <link type="text/css" href="{{ asset('student/public/css/bootstrap-responsive.css') }}" rel="stylesheet">

    <style>
        html {
            scroll-behavior: smooth;
        }

        < !-- sticky header color -->< !-- [dir] .navbar-dark-pickled-bluewood {
            background: #f7ddff !important;
        }

        -->[dir] .bg-primary {
            background-color: #81007F !important;
        }

        .text-primary {
            color: #81007F !important;
        }

        [dir] .btn-primary {
            background-color: #81007F !important;
            border-color: #81007F !important;

        }

        [dir] .btn-primary:hover {
            background-color: #DB9BDA !important;
            border-color: #DB9BDA !important;
        }

        .btn-outline-white:hover {
            color: #DB9BDA !important;
        }

        div.col-12.col-md-12.mdk-carousel__item {}

        [dir] .preloader {
            background: #81007F !important;
        }

        [dir] .card-subtitle1 {
            padding-right: 60px !important;
            margin-bottom: 6px !important;

        }

        [dir] .fnav-link {
            padding: 0.4rem 1rem !important;
        }

        < !-----big carousel before footer ---------->#2ndcarousel-22 {
            height: 400px !important;
            display: block !important;
            overflow: hidden !important;
        }

        .img-wh11 {
            width: 80% !important;
            height: 50% !important;
            display: flex !important;
            align-items: center !important;
            margin-left: auto;
            margin-right: auto;
            margin-top: auto;
            margin-bottom: auto;
            display: block !important;
        }

        .left-icon-move-30px {
            margin-left: -9px !important;
        }

        < !----- Subject zoom rotate effect start ---------->#img-zoom-rotate-custom {
            < !-- overflow: hidden;
            -->transition: all 9s;
        }

        #img-zoom-rotate-custom:hover {
            transform: rotate(-2deg) scale(1.08);
        }

    </style>
@endsection

@section('content')
    <div class="mdk-header-layout__content page-content ">

        <div class="border-bottom-2 py-16pt navbar-light bg-white border-bottom-2">
            <div class="container page__container">
                <div class="row align-items-center">
                    <div class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt mb-md-0 pb-16pt pb-md-0">
                        <div
                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                            <i class="material-icons text-white">subscriptions</i>
                        </div>
                        <div class="flex">
                            <div class="card-title mb-4pt animate__animated animate__fadeInDown">
                                <span class="counter">{{ $courseCount }}</span>+ Courses
                            </div>
                            <p class="card-subtitle text-70 animate__animated animate__fadeInUp">Explore a wide
                                range of skills.</p>
                        </div>
                    </div>
                    <div class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt mb-md-0 pb-16pt pb-md-0">
                        <div
                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                            <i class="material-icons text-white">verified_user</i>
                        </div>
                        <div class="flex">
                            <div class="card-title mb-4pt animate__animated animate__fadeInDown">By Industry Experts
                            </div>
                            <p class="card-subtitle text-70 animate__animated animate__fadeInUp">Professional
                                development from the best people.</p>
                        </div>
                    </div>
                    <div class="d-flex col-md align-items-center">
                        <div
                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                            <i class="material-icons text-white">update</i>
                        </div>
                        <div class="flex">
                            <div class="card-title mb-4pt animate__animated animate__fadeInDown">Unlimited Access
                            </div>
                            <p class="card-subtitle text-70 animate__animated animate__fadeInUp">Unlock Library and
                                learn any topic with one subscription.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-section border-bottom-2">
            <div class="container page__container pt-3">
                <div class="page-separator">
                    <div class="page-separator__text">Latest Courses</div>
                </div>
                <div class="row card-group-row">

                    @forelse ($courses as $course)
                        <div class="col-md-6 col-lg-4 card-group-row__col fade-in" id="img-zoom-rotate-custom">
                            <div class="card card--elevated posts-card-popular overlay card-group-row__card">
                                <img src="{{ asset('student/public/images/paths/sketch_430x168.png') }}" alt=""
                                    class="card-img img-zoom-rotate-custom">
                                <div class="fullbleed bg-primary" style="opacity: .3"></div>
                                <div class="posts-card-popular__content">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="avatar-group flex">
                                            <!-- <div class="avatar avatar-xs" data-toggle="tooltip" data-placement="top" title="Janell D."> -->
                                            <!--<a href="">
                                                        <img src="../../public/images/256_luke-porter-261779-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                                    </a>-->
                                            <!--  </div> -->
                                        </div>
                                        <a style="text-decoration: none;" class="d-flex align-items-center" href="">
                                            <i class="material-icons mr-1" style="font-size: inherit;">remove_red_eye</i>
                                            <small>{{ $course->student->count() }}</small>
                                        </a>
                                    </div>
                                    <div class="posts-card-popular__title card-body">
                                        <a href="{{ route('course-preview', $course->slug) }}">
                                            <small
                                                class="text-white font-weight-bold h2 text-uppercase">{{ $course->title }}</small>
                                        </a>
                                        {{-- <a class="card-title" href="blog-post.html">Merge Duplicates Inconsistent Symbols</a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12 col-lg-12 card-group-row__col fade-in" id="img-zoom-rotate-custom">
                            <div class="card card--elevated posts-card-popular overlay card-group-row__card mx-auto">
                                <img src="{{ asset('student/public/images/paths/sketch_430x168.png') }}" alt=""
                                    class="card-img">
                                <div class="fullbleed bg-primary" style="opacity: .7"></div>
                                <div class="posts-card-popular__content">
                                    <div class="card-body d-flex align-items-center">
                                        <h1 style="color: white;font-family: Rockwell;" class="mx-auto">No courses found
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse

                    {{-- <div class="col-md-6 col-lg-4 card-group-row__col fade-in" id="img-zoom-rotate-custom">
                    <div class="card card--elevated posts-card-popular overlay card-group-row__card">
                        <img src="{{ asset('student/public/images/paths/swift_430x168.png') }}" alt=""
                            class="card-img img-zoom-rotate-custom">
                        <div class="fullbleed bg-primary" style="opacity: .5"></div>
                        <div class="posts-card-popular__content">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar-group flex">
                                    <!--  <div class="avatar avatar-xs" data-toggle="tooltip"  data-placement="top" title="Janell D."> -->
                                    <!--<a href="">
                                            <img src="../../public/images/256_rsz_sharina-mae-agellon-377466-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                        </a>-->
                                    <!-- </div> -->
                                </div>
                                <a style="text-decoration: none;" class="d-flex align-items-center" href="">
                                    <i class="material-icons mr-1" style="font-size: inherit;">remove_red_eye</i>
                                    <small>551</small>
                                </a>
                            </div>
                            <div class="posts-card-popular__title card-body">
                                <small class="text-muted text-uppercase">Swift</small>
                                <a class="card-title" href="blog-post.html">Advance With Swift</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 card-group-row__col fade-in" id="img-zoom-rotate-custom">
                    <div class="card card--elevated posts-card-popular overlay card-group-row__card">
                        <img src="{{ asset('student/public/images/paths/invision_430x168.png') }}" alt=""
                            class="card-img img-zoom-rotate-custom">
                        <div class="fullbleed bg-primary" style="opacity: .3"></div>
                        <div class="posts-card-popular__content">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar-group flex">
                                    <!--  <div class="avatar avatar-xs"  data-toggle="tooltip" data-placement="top" title="Janell D."> -->
                                    <!-- <a href=""><img src="../../public/images/256_michael-dam-258165-unsplash.jpg"  alt="Avatar" class="avatar-img rounded-circle"></a>-->
                                    <!-- </div> -->
                                </div>
                                <a style="text-decoration: none;" class="d-flex align-items-center" href="">
                                    <i class="material-icons mr-1" style="font-size: inherit;">remove_red_eye</i>
                                    <small>927</small>
                                </a>
                            </div>
                            <div class="posts-card-popular__title card-body">
                                <small class="text-muted text-uppercase">invision</small>
                                <a class="card-title" href="blog-post.html">Design Systems Essentials</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 card-group-row__col fade-in" id="img-zoom-rotate-custom">
                    <div class="card card--elevated posts-card-popular overlay card-group-row__card">
                        <img src="{{ asset('student/public/images/paths/photoshop_430x168.png') }}" alt=""
                            class="card-img img-zoom-rotate-custom">
                        <div class="fullbleed bg-primary" style="opacity: .3"></div>
                        <div class="posts-card-popular__content">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar-group flex">
                                    <!-- <div class="avatar avatar-xs" data-toggle="tooltip"  data-placement="top" title="Janell D."> -->
                                    <!--<a href="">
                                            <img src="../../public/images/256_rsz_1andy-lee-642320-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                        </a>-->
                                    <!-- </div> -->
                                </div>
                                <a style="text-decoration: none;" class="d-flex align-items-center" href="">
                                    <i class="material-icons mr-1" style="font-size: inherit;">remove_red_eye</i>
                                    <small>1257</small>
                                </a>
                            </div>
                            <div class="posts-card-popular__title card-body">
                                <small class="text-muted text-uppercase">photoshop</small>
                                <a class="card-title" href="blog-post.html">Semantic Logo Design</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 card-group-row__col fade-in" id="img-zoom-rotate-custom">
                    <div class="card card--elevated posts-card-popular overlay card-group-row__card">
                        <img src="{{ asset('student/public/images/paths/xd_430x168.png') }}" alt=""
                            class="card-img img-zoom-rotate-custom">
                        <div class="fullbleed bg-primary" style="opacity: .3"></div>
                        <div class="posts-card-popular__content">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar-group flex">
                                    <!-- <div class="avatar avatar-xs" data-toggle="tooltip"  data-placement="top" title="Janell D."> -->
                                    <!--<a href="">
                                            <img src="../../public/images/256_rsz_90-jiang-640827-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                        </a>-->
                                    <!--  </div> -->
                                </div>
                                <a style="text-decoration: none;" class="d-flex align-items-center" href="">
                                    <i class="material-icons mr-1" style="font-size: inherit;">remove_red_eye</i>
                                    <small>667</small>
                                </a>
                            </div>
                            <div class="posts-card-popular__title card-body">
                                <small class="text-muted text-uppercase">Adobe XD</small>
                                <a class="card-title" href="blog-post.html">UI UX Design</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 card-group-row__col fade-in" id="img-zoom-rotate-custom">
                    <div class="card card--elevated posts-card-popular overlay card-group-row__card">
                        <img src="{{ asset('student/public/images/paths/wordpress_430x168.png') }}" alt=""
                            class="card-img img-zoom-rotate-custom">
                        <div class="fullbleed bg-primary" style="opacity: .3"></div>
                        <div class="posts-card-popular__content">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar-group flex">
                                    <!-- <div class="avatar avatar-xs" data-toggle="tooltip"  data-placement="top" title="Janell D."> -->
                                    <!--<a href="">
                                            <img src="../../public/images/256_rsz_1andy-lee-642320-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                        </a>-->
                                    <!-- </div> -->
                                </div>
                                <a style="text-decoration: none;" class="d-flex align-items-center" href="">
                                    <i class="material-icons mr-1" style="font-size: inherit;">remove_red_eye</i>
                                    <small>327</small>
                                </a>
                            </div>
                            <div class="posts-card-popular__title card-body">
                                <small class="text-muted text-uppercase">Wordpress</small>
                                <a class="card-title" href="blog-post.html">Learn Advance Wordpress</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 card-group-row__col fade-in" id="img-zoom-rotate-custom">
                    <div class="card card--elevated posts-card-popular overlay card-group-row__card">
                        <img src="{{ asset('student/public/images/paths/figma_430x168.png') }}" alt=""
                            class="card-img img-zoom-rotate-custom">
                        <div class="fullbleed bg-primary" style="opacity: .5"></div>
                        <div class="posts-card-popular__content">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar-group flex">
                                    <!--  <div class="avatar avatar-xs" data-toggle="tooltip"  data-placement="top" title="Janell D."> -->
                                    <!--<a href="">
                                            <img src="../../public/images/256_rsz_sharina-mae-agellon-377466-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                        </a>-->
                                    <!--    </div> -->
                                </div>
                                <a style="text-decoration: none;" class="d-flex align-items-center" href="">
                                    <i class="material-icons mr-1" style="font-size: inherit;">remove_red_eye</i>
                                    <small>878</small>
                                </a>
                            </div>
                            <div class="posts-card-popular__title card-body">
                                <small class="text-muted text-uppercase">Figma</small>
                                <a class="card-title" href="blog-post.html">Figma Design A-Z</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 card-group-row__col fade-in" id="img-zoom-rotate-custom">
                    <div class="card card--elevated posts-card-popular overlay card-group-row__card">
                        <img src="{{ asset('student/public/images/paths/mailchimp_430x168.png') }}" alt=""
                            class="card-img img-zoom-rotate-custom">
                        <div class="fullbleed bg-primary" style="opacity: .5"></div>
                        <div class="posts-card-popular__content">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar-group flex">
                                    <!--  <div class="avatar avatar-xs" data-toggle="tooltip"  data-placement="top" title="Janell D."> -->
                                    <!-- <a href="">
                                            <img src="../../public/images/256_rsz_florian-perennes-594195-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                        </a>-->
                                    <!--  </div> -->
                                </div>
                                <a style="text-decoration: none;" class="d-flex align-items-center" href="">
                                    <i class="material-icons mr-1" style="font-size: inherit;">remove_red_eye</i>
                                    <small>117</small>
                                </a>
                            </div>
                            <div class="posts-card-popular__title card-body">
                                <small class="text-muted text-uppercase">Mailchimp</small>
                                <a class="card-title" href="blog-post.html">Mailchimp Integration</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 card-group-row__col fade-in" id="img-zoom-rotate-custom">
                    <div class="card card--elevated posts-card-popular overlay card-group-row__card">
                        <img src="{{ asset('student/public/images/paths/angular_430x168.png') }}" alt=""
                            class="card-img img-zoom-rotate-custom">
                        <div class="fullbleed bg-primary" style="opacity: .5"></div>
                        <div class="posts-card-popular__content">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar-group flex">
                                    <!--  <div class="avatar avatar-xs" data-toggle="tooltip"  data-placement="top" title="Janell D."> -->
                                    <!--<a href="">
                                            <img src="../../public/images/256_rsz_nicolas-horn-689011-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                        </a>-->
                                    <!--  </div> -->
                                </div>
                                <a style="text-decoration: none;" class="d-flex align-items-center" href="">
                                    <i class="material-icons mr-1" style="font-size: inherit;">remove_red_eye</i>
                                    <small>427</small>
                                </a>
                            </div>
                            <div class="posts-card-popular__title card-body">
                                <small class="text-muted text-uppercase">Angular</small>
                                <a class="card-title" href="blog-post.html">Angular Advance Routing</a>
                            </div>
                        </div>
                    </div>
                </div> --}}

                    <div class="card-body d-flex align-items-end">
                        <div class="col-md-4 offset-md-5">
                            <a href="{{ route('course') }}">
                                <button class="btn btn-md btn-primary fade-in ">Browse Courses</button>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="page-section border-bottom-2 bg-white">
            <div class="container page__container pt-3">
                <div class="page-separator">
                    <div class="page-separator__text">Category</div>
                </div>
                <div class="row card-group-row">
                    <div class="col-sm-3 card-group-row__col fade-in">
                        <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card"
                            data-toggle="popover" data-trigger="click">
                            <a href="#">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <div class="flex">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle mr-12pt z-0 o-hidden">
                                                    <div class="overlay">
                                                        <img src="{{ asset('student/public/images/paths/react_40x40@2x.png') }}"
                                                            width="40" height="40" alt="Angular" class="rounded">
                                                    </div>
                                                </div>
                                                <div class="flex">
                                                    <div class="card-title">React Native</div>
                                                    <p class="flex text-50 lh-1 mb-0"><small>40 courses</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-3 card-group-row__col fade-in">
                        <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card"
                            data-toggle="popover" data-trigger="click">
                            <a href="#">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <div class="flex">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle mr-12pt z-0 o-hidden">
                                                    <div class="overlay">
                                                        <img src="{{ asset('student/public/images/paths/devops_40x40@2x.png') }}"
                                                            width="40" height="40" alt="Angular" class="rounded">
                                                    </div>
                                                </div>
                                                <div class="flex">
                                                    <div class="card-title">Dev Ops</div>
                                                    <p class="flex text-50 lh-1 mb-0"><small>70 courses</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-3 card-group-row__col fade-in">
                        <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card"
                            data-toggle="popover" data-trigger="click">
                            <a href="#">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <div class="flex">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle mr-12pt z-0 o-hidden">
                                                    <div class="overlay">
                                                        <img src="{{ asset('student/public/images/paths/redis_40x40@2x.png') }}"
                                                            width="40" height="40" alt="Angular" class="rounded">
                                                    </div>
                                                </div>
                                                <div class="flex">
                                                    <div class="card-title">Redis</div>
                                                    <p class="flex text-50 lh-1 mb-0"><small>30 courses</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-3 card-group-row__col fade-in">
                        <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card"
                            data-toggle="popover" data-trigger="click">
                            <a href="#">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <div class="flex">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle mr-12pt z-0 o-hidden">
                                                    <div class="overlay">
                                                        <img src="{{ asset('student/public/images/paths/mailchimp_40x40@2x.png') }}"
                                                            width="40" height="40" alt="Angular" class="rounded">
                                                    </div>
                                                </div>
                                                <div class="flex">
                                                    <div class="card-title">MailChimp</div>
                                                    <p class="flex text-50 lh-1 mb-0"><small>35 courses</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row card-group-row mb-lg-8pt">

                    <div class="col-sm-3 card-group-row__col fade-in">
                        <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card"
                            data-toggle="popover" data-trigger="click">
                            <a href="#">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <div class="flex">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle mr-12pt z-0 o-hidden">
                                                    <div class="overlay">
                                                        <img src="{{ asset('student/public/images/paths/swift_40x40@2x.png') }}"
                                                            width="40" height="40" alt="Angular" class="rounded">
                                                    </div>
                                                </div>
                                                <div class="flex">
                                                    <div class="card-title">Swift</div>
                                                    <p class="flex text-50 lh-1 mb-0"><small>15 courses</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-3 card-group-row__col fade-in">
                        <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card"
                            data-toggle="popover" data-trigger="click">
                            <a href="#">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <div class="flex">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle mr-12pt z-0 o-hidden">
                                                    <div class="overlay">
                                                        <img src="{{ asset('student/public/images/paths/wordpress_40x40@2x.png') }}"
                                                            width="40" height="40" alt="Angular" class="rounded">
                                                    </div>
                                                </div>
                                                <div class="flex">
                                                    <div class="card-title">WordPress</div>
                                                    <p class="flex text-50 lh-1 mb-0"><small>81 courses</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-3 card-group-row__col fade-in">
                        <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card"
                            data-toggle="popover" data-trigger="click">
                            <a href="#">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <div class="flex">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle mr-12pt z-0 o-hidden">
                                                    <div class="overlay">
                                                        <img src="{{ asset('student/public/images/paths/angular_40x40@2x.png') }}"
                                                            width="40" height="40" alt="Angular" class="rounded">
                                                    </div>
                                                </div>
                                                <div class="flex">
                                                    <div class="card-title">Angular</div>
                                                    <p class="flex text-50 lh-1 mb-0"><small>19 courses</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-3 card-group-row__col fade-in">
                        <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card"
                            data-toggle="popover" data-trigger="click">
                            <a href="#">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <div class="flex">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle mr-12pt z-0 o-hidden">
                                                    <div class="overlay">
                                                        <img src="{{ asset('student/public/images/paths/photoshop_40x40@2x.png') }}"
                                                            width="40" height="40" alt="Angular" class="rounded">
                                                    </div>
                                                </div>
                                                <div class="flex">
                                                    <div class="card-title">Photoshop</div>
                                                    <p class="flex text-50 lh-1 mb-0"><small>100 courses</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row card-group-row mb-lg-8pt">

                    <div class="col-sm-3 card-group-row__col fade-in">
                        <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card"
                            data-toggle="popover" data-trigger="click">
                            <a href="#">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <div class="flex">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle mr-12pt z-0 o-hidden">
                                                    <div class="overlay">
                                                        <img src="{{ asset('student/public/images/paths/figma_40x40@2x.png') }}"
                                                            width="40" height="40" alt="Angular" class="rounded">
                                                    </div>
                                                </div>
                                                <div class="flex">
                                                    <div class="card-title">Figma</div>
                                                    <p class="flex text-50 lh-1 mb-0"><small>22 courses</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-3 card-group-row__col fade-in">
                        <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card"
                            data-toggle="popover" data-trigger="click">
                            <a href="#">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <div class="flex">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle mr-12pt z-0 o-hidden">
                                                    <div class="overlay">
                                                        <img src="{{ asset('student/public/images/paths/sketch_40x40@2x.png') }}"
                                                            width="40" height="40" alt="Angular" class="rounded">
                                                    </div>
                                                </div>
                                                <div class="flex">
                                                    <div class="card-title">Sketch</div>
                                                    <p class="flex text-50 lh-1 mb-0"><small>11 courses</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-3 card-group-row__col fade-in">
                        <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card"
                            data-toggle="popover" data-trigger="click">
                            <a href="#">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <div class="flex">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle mr-12pt z-0 o-hidden">
                                                    <div class="overlay">
                                                        <img src="{{ asset('student/public/images/paths/redis_40x40@2x.png') }}"
                                                            width="40" height="40" alt="Angular" class="rounded">
                                                    </div>
                                                </div>
                                                <div class="flex">
                                                    <div class="card-title">Redis</div>
                                                    <p class="flex text-50 lh-1 mb-0"><small>19 courses</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-3 card-group-row__col fade-in">
                        <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card"
                            data-toggle="popover" data-trigger="click">
                            <a href="#">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <div class="flex">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle mr-12pt z-0 o-hidden">
                                                    <div class="overlay">
                                                        <img src="{{ asset('student/public/images/paths/xd_40x40@2x.png') }}"
                                                            width="40" height="40" alt="Angular" class="rounded">
                                                    </div>
                                                </div>
                                                <div class="flex">
                                                    <div class="card-title">Adobe XD</div>
                                                    <p class="flex text-50 lh-1 mb-0"><small>90 courses</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body d-flex align-items-end">
                    <div class="col-md-4 offset-md-4">
                        <a href="#">
                            <button class="btn btn-md btn-primary fade-in">Browse Categories</button>
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <div class="page-section border-bottom-2">
            <div class="container page__container">
                <div class="row card-group-row p-4">
                    <div class="col-md-3 fade-in">
                        <div
                            class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt mb-md-0 pb-16pt pb-md-0">
                            <div
                                class="rounded-circle bg-primary wh-64 d-inline-flex align-items-center justify-content-center mr-16pt ">
                                <i class="material-icons text-white">subscriptions</i>
                            </div>
                            <div class="flex">

                                <div class="card-title mb-4pt ">
                                    <h3 class="timer count-title count-number m-0 pl-2" data-to="{{ $courseCount }}"
                                        data-speed="8000">
                                    </h3>
                                    <span>+ Courses</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 fade-in">
                        <div
                            class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt mb-md-0 pb-16pt pb-md-0">
                            <div
                                class="rounded-circle bg-primary wh-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                <i class="material-icons text-white">school</i>
                            </div>
                            <div class="flex">

                                <div class="card-title mb-4pt  ">
                                    <h3 class="timer count-title count-number m-0 pl-2" data-to="{{ $totalStudent }}"
                                        data-speed="8000">
                                    </h3>
                                    <span>+Student</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 fade-in">
                        <div
                            class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt mb-md-0 pb-16pt pb-md-0">
                            <div
                                class="rounded-circle bg-primary wh-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                <i class="material-icons text-white">group</i>
                            </div>
                            <div class="flex">
                                <div class="card-title mb-4pt ">
                                    <h3 class="timer count-title count-number m-0 pl-2" data-to="{{ $totalTeacher }}"
                                        data-speed="8000">
                                    </h3>
                                    <span>+ Teacher</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 fade-in">
                        <div
                            class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt mb-md-0 pb-16pt pb-md-0">
                            <div
                                class="rounded-circle bg-primary wh-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                <i class="material-icons text-white">check_box</i>
                            </div>
                            <div class="flex">
                                <div class="card-title mb-4pt nav flex-column ">
                                    <h3 class="timer count-title count-number m-0 pl-2" data-to="{{ $totalExams }}"
                                        data-speed="8000">
                                        <span></span>
                                    </h3>
                                    <span>+ Exams</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="page-section border-bottom-2 bg-white">
            <div class="container page__container">
                <div class="page-separator">
                    <div class="page-separator__text">Best Instructor</div>
                </div>
            </div>
        </div>

        <!----------bootstrap carousel for Instructors start---------------------->

        <div class="page-section " id="">
            <div class="container page__container">
                <div class="container">
                    <br>
                    <div id="myCarousel2" class="carousel slide" data-ride="carousel" style="padding-left:70px;">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <!-- 1st slide -->
                                <div class="row card-group-row p-4">

                                    <div class="d-flex col-md border-bottom border-md-0 card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_s-a-r-a-h-s-h-a-r-p-764291-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Akib Abdullah</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>

                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>

                                    <div class="d-flex col-md border-bottom border-md-0 card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_jeremy-banks-798787-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Inan Hasan</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>

                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>

                                    <div class="d-flex col-md border-bottom border-md-0 card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_rsz_90-jiang-640827-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Mhamudul Hasan</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>

                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>

                                    <div class="d-flex col-md border-bottom border-md-0 mb-16pt card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_rsz_clem-onojeghuo-150467-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Forkan Mia</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>

                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="row card-group-row p-4">

                                    <div class="d-flex col-md border-bottom border-md-0 card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_rsz_sharina-mae-agellon-377466-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Kelly</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>

                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>

                                    <div class="d-flex col-md border-bottom border-md-0 card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_rsz_james-gillespie-714755-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Tammana</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>

                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>

                                    <div class="d-flex col-md border-bottom border-md-0 card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_rsz_nicolas-horn-689011-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Rakhib Khan</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>

                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>

                                    <div class="d-flex col-md border-bottom border-md-0 mb-16pt card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_s-a-r-a-h-s-h-a-r-p-764291-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Atik Ullah</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>

                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="item">
                                <!-- 2nd slide -->

                                <div class="row card-group-row p-4">

                                    <div class="d-flex col-md border-bottom border-md-0 card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_s-a-r-a-h-s-h-a-r-p-764291-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Akib Abdullah</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>

                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>

                                    <div class="d-flex col-md border-bottom border-md-0 card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_jeremy-banks-798787-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Inan Hasan</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>

                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>

                                    <div class="d-flex col-md border-bottom border-md-0 card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_rsz_90-jiang-640827-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Mhamudul Hasan</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>

                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>

                                    <div class="d-flex col-md border-bottom border-md-0 mb-16pt card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_rsz_clem-onojeghuo-150467-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Forkan Mia</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>

                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="row card-group-row p-4">

                                    <div class="d-flex col-md border-bottom border-md-0 card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_rsz_sharina-mae-agellon-377466-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Kelly</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>

                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>

                                    <div class="d-flex col-md border-bottom border-md-0 card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_rsz_james-gillespie-714755-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Tammana</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>

                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>

                                    <div class="d-flex col-md border-bottom border-md-0 card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_rsz_nicolas-horn-689011-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Rakhib Khan</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>

                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>

                                    <div class="d-flex col-md border-bottom border-md-0 mb-16pt card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_s-a-r-a-h-s-h-a-r-p-764291-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Atik Ullah</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>
                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <!-- 3rd slide -->


                                <div class="row card-group-row p-4">

                                    <div class="d-flex col-md border-bottom border-md-0 card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_s-a-r-a-h-s-h-a-r-p-764291-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Akib Abdullah</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>

                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>

                                    <div class="d-flex col-md border-bottom border-md-0 card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_jeremy-banks-798787-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Inan Hasan</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>

                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>

                                    <div class="d-flex col-md border-bottom border-md-0 card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_rsz_90-jiang-640827-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Mhamudul Hasan</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>

                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>

                                    <div class="d-flex col-md border-bottom border-md-0 mb-16pt card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_rsz_clem-onojeghuo-150467-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Forkan Mia</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>

                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="row card-group-row p-4">

                                    <div class="d-flex col-md border-bottom border-md-0 card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_rsz_sharina-mae-agellon-377466-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Kelly</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>

                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>

                                    <div class="d-flex col-md border-bottom border-md-0 card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_rsz_james-gillespie-714755-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Tammana</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>

                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>

                                    <div class="d-flex col-md border-bottom border-md-0 card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_rsz_nicolas-horn-689011-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Rakhib Khan</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>
                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>
                                    <div class="d-flex col-md border-bottom border-md-0 mb-16pt card-group-row__col ">
                                        <div
                                            class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                            <a href="">
                                                <img src="{{ asset('student/public/images/256_s-a-r-a-h-s-h-a-r-p-764291-unsplash.jpg') }}"
                                                    alt="Avatar" class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title mb-4pt">Atik Ullah</div>
                                            <p class="card-subtitle1 text-70">Premier University</p>

                                            <p class="card-subtitle1 text-70">Cse</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel2" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel2" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <!-------------bootstrap carousel for Instructors end------------------------------------------------------------>

        <!----------bootstrap carousel for image start---------------------->
        <div class="page-section " id="2ndcarousel-22">
            <div class="container page__container">
                <div class="container">
                    <br>
                    <div id="myCarousel3" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <div class="col-12 col-md-12">
                                    <div class="card  card-body" id="last-carousel">
                                        <img src="{{ asset('student/public/images/1280_writing-down-goals_4460x4460.jpg') }}"
                                            class="img-wh11" alt="" style=" ">
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-12 col-md-12">
                                    <div class="card  card-body" id="last-carousel">
                                        <img src="{{ asset('student/public/images/photodune-4161018-group-of-students-m.jpg') }}"
                                            class="img-wh11" alt="" style="">
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-12 col-md-12">
                                    <div class="card  card-body" id="last-carousel">
                                        <img src="{{ asset('student/public/images/photodune-6745579-modern-creative-man-relaxing-on-workspace-m.jpg') }}"
                                            class="img-wh11" alt="" style=" ">
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-12 col-md-12">
                                    <div class="card  card-body" id="last-carousel">
                                        <img src="{{ asset('student/public/images/1280_work-station-straight-on-view.jpg') }}"
                                            class="img-wh11" alt="" style="">
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-12 col-md-12">
                                    <div class="card  card-body" id="last-carousel">
                                        <img src="{{ asset('student/public/images/hasan.jpg') }}" class="img-wh11" alt=""
                                            style="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left left-icon-move-30px" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-------------bootstrap carousel for image end--------------------->
        <!-- // END Header Layout Content -->
    </div>
@endsection

@section('js1')
<script src="{{ asset('student/public/js/bootstrap.js') }}"></script>

<script>
    (function() {
        'use strict';
        var headerNode = document.querySelector('.mdk-header')
        var layoutNode = document.querySelector('.mdk-header-layout')
        var componentNode = layoutNode ? layoutNode : headerNode
        componentNode.addEventListener('domfactory-component-upgraded', function() {
            headerNode.mdkHeader.eventTarget.addEventListener('scroll', function() {
                var progress = headerNode.mdkHeader.getScrollState().progress
                var navbarNode = headerNode.querySelector('#default-navbar')
                navbarNode.classList.toggle('bg-transparent', progress <= 0.2)
            })
        })
    })()

    $(window).scroll(function() {
        $('.fade-in, .fade-out').each(function() {
            var top_of_element = $(this).offset().top;
            var bottom_of_element = $(this).offset().top + $(this).outerHeight();
            var bottom_of_screen = $(window).scrollTop() + $(window).innerHeight();
            var top_of_screen = $(window).scrollTop();

            if ((bottom_of_screen > top_of_element) && (top_of_screen < bottom_of_element) && !$(this)
                .hasClass('is-visible')) {
                $(this).addClass('is-visible');
            }
        });
    });

    (function($) {
        $.fn.countTo = function(options) {
            options = options || {};

            return $(this).each(function() {
                // set options for current element
                var settings = $.extend({},
                    $.fn.countTo.defaults, {
                        from: $(this).data("from"),
                        to: $(this).data("to"),
                        speed: $(this).data("speed"),
                        refreshInterval: $(this).data("refresh-interval"),
                        decimals: $(this).data("decimals")
                    },
                    options
                );

                // how many times to update the value, and how much to increment the value on each update
                var loops = Math.ceil(settings.speed / settings.refreshInterval),
                    increment = (settings.to - settings.from) / loops;

                // references & variables that will change with each update
                var self = this,
                    $self = $(this),
                    loopCount = 0,
                    value = settings.from,
                    data = $self.data("countTo") || {};

                $self.data("countTo", data);

                // if an existing interval can be found, clear it first
                if (data.interval) {
                    clearInterval(data.interval);
                }
                data.interval = setInterval(updateTimer, settings.refreshInterval);

                // initialize the element with the starting value
                render(value);

                function updateTimer() {
                    value += increment;
                    loopCount++;

                    render(value);

                    if (typeof settings.onUpdate == "function") {
                        settings.onUpdate.call(self, value);
                    }

                    if (loopCount >= loops) {
                        // remove the interval
                        $self.removeData("countTo");
                        clearInterval(data.interval);
                        value = settings.to;

                        if (typeof settings.onComplete == "function") {
                            settings.onComplete.call(self, value);
                        }
                    }
                }

                function render(value) {
                    var formattedValue = settings.formatter.call(self, value, settings);
                    $self.html(formattedValue);
                }
            });
        };

        $.fn.countTo.defaults = {
            from: 0, // the number the element should start at
            to: 0, // the number the element should end at
            speed: 1000, // how long it should take to count between the target numbers
            refreshInterval: 100, // how often the element should be updated
            decimals: 0, // the number of decimal places to show
            formatter: formatter, // handler for formatting the value before rendering
            onUpdate: null, // callback method for every time the element is updated
            onComplete: null // callback method for when the element finishes updating
        };

        function formatter(value, settings) {
            return value.toFixed(settings.decimals);
        }
    })(jQuery);

    jQuery(function($) {
        // custom formatting example
        $(".count-number").data("countToOptions", {
            formatter: function(value, options) {
                return value
                    .toFixed(options.decimals)
                    .replace(/\B(?=(?:\d{3})+(?!\d))/g, ",");
            }
        });

        // start all the timers
        $(".timer").each(count);

        function count(options) {
            var $this = $(this);
            options = $.extend({}, options || {}, $this.data("countToOptions") || {});
            $this.countTo(options);
        }
    });

    $('.carousel').carousel({
        interval: 3000,
        cycle: true
    });
    $('.carousel').carousel({
        ride: true,
    });

</script>
@endsection
