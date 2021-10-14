<div id="header" class="mdk-header mdk-header--bg-dark bg-dark js-mdk-header mb-0"
    data-effects="parallax-background waterfall" data-fixed data-condenses>
    @if (request()->is('/'))
        <div class="mdk-header__bg">
            <div class="mdk-header__bg-front"
                style="background-image: url({{ asset('student/public/images/back.jpg') }});">

            </div>
        </div>
    @endif
    <div class="mdk-header__content justify-content-center">
        <div class="navbar navbar-expand navbar-dark-pickled-bluewood bg-transparent will-fade-background"
            id="default-navbar" data-primary>
            <!-- Navbar toggler -->
            <button class="navbar-toggler w-auto mr-16pt d-block rounded-0" type="button" data-toggle="sidebar">
                <span class="material-icons">short_text</span>
            </button>
            <!-- Navbar Brand -->
            <a href="{{ route('home') }}" class="navbar-brand mr-16pt">
                <!-- <img class="navbar-brand-icon" src="../../public/images/logo/white-100@2x.png" width="30" alt="Luma"> -->
                <!-- <span class="avatar avatar-lg navbar-brand-icon mr-0 mr-lg-8pt"> -->
                <span class="rounded">
                    <img src="{{ asset('student/public/images/edventure-logo.png') }}" alt="logo"
                        class="logo" />
                </span>
                <!-- </span> -->
            </a>
            <ul class="nav navbar-nav text-primary d-none d-sm-flex flex justify-content-start ml-8pt">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('course') }}"
                        class="nav-link {{ request()->is('course') ? 'active' : '' }} 
                                                                    {{ request()->is('course/course-preview/*') ? 'active' : '' }} 
                                                                    ">
                        Courses
                    </a>
                </li>
                @auth
                    @if (auth()->user()->is_admin == 0)
                        <li
                            class="nav-item {{ request()->is('batch') ? 'active' : '' }} 
                                            {{ request()->is('batch/*') ? 'active' : '' }} 
                                            ">
                            <a href="{{ route('batch') }}" class="nav-link">Batches</a>
                        </li>
                        <li class="nav-item {{ request()->is('progress/*') ? 'active' : '' }}">
                            <a href="{{ route('enroll-course', Auth()->user()->id) }}"
                                class="nav-link">Progress</a>
                        </li>
                    @endif
                @endauth
            </ul>

            @if (Route::has('login'))
                @auth
                    <div class="nav navbar-nav flex-nowrap d-flex mr-16pt">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown"
                                data-caret="false">
                                <span class="avatar avatar-sm mr-8pt2">
                                    <span class="avatar-title rounded-circle bg-primary"><i
                                            class="material-icons">account_box</i></span>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header"><strong>Account</strong></div>
                                <a class="dropdown-item" href="{{ route('profile', Auth()->user()->id) }}">My
                                    Profile</a>
                                <a class="dropdown-item" href="{{ route('batch') }}">My Batch</a>
                                <a class="dropdown-item" href="billing.html">Billing</a>
                                <a class="dropdown-item" href="{{ route('payments', auth()->user()->id) }}">Payments</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); 
                                                                            this.closest('form').submit();">
                                        Log out
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <ul class="nav navbar-nav ml-auto mr-0">
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link" data-toggle="tooltip"
                                data-title="Login" data-placement="bottom" data-boundary="window">
                                <i class="fas fa-lock-open"></i>
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link" data-toggle="tooltip"
                                    data-title="Sign Up" data-placement="bottom" data-boundary="window">
                                    <i class="fas fa-sign-in-alt"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                @endauth
            @endif
        </div>
        @if (request()->is('/') || request()->is('student/index'))
            <div class="hero container page__container text-center py-112pt">
                <div class="row">
                    <div class="col-md-7">
                        <h1 class="text-white text-shadow animate__animated animate__fadeInDown text-left">Learn to
                            Code Now</h1>
                        <p
                            class="lead mx-4 mx-md-0 text-white text-shadow mb-48pt animate__animated animate__fadeInUp ">
                            Business, Technology and Creative Skills taught by industry experts. Explore a wide
                            range of skills with our professional tutorials.
                        </p>
                        <a href="{{ route('course') }}"
                            class="btn btn-lg btn-primary btn--raised mb-16pt animate__animated animate__fadeInUp">Browse
                            Courses</a>

                    </div>
                    <div class="col-5">
                        <img src="{{ asset('student/public/images/front.png') }}" alt=""
                            class="img-fluid animate__animated animate__fadeInRight fadeInRight ">
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
