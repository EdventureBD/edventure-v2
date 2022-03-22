<nav class="navbar top-nav-fixed navbar-expand-lg navbar-light w-100" style="background: #6400C8">
    <a class="navbar-brand" href="{{route('home')}}"><img src="/img/landing/edventureFinalLogo.png" width="220" alt="EdventureLogo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse  navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
            <li class="nav-item has-dot  {{Route::current()->getName() == 'home' ? 'active' : ''}}">
            <a class="nav-link text-purple-half" href="{{route('home')}}">HOME</a>
            </li>
            <li class="nav-item has-dot">
            </li>

            @if (Route::has('login'))
                @auth
                    <li class="nav-item has-dot {{ request()->is('profile') ? 'active' : '' }}
                                                {{ request()->is('profile/model-test') ? 'active' : '' }}">
                    <a class="nav-link text-purple-half "  href="{{route('profile.modelTest')}}">DASHBOARD</a>
                </li>
                @endauth
            @endif

            <li class="nav-item has-dot  {{ request()->is('course') ? 'active' : '' }}
                                            {{ request()->is('course/course-preview/*') ? 'active' : '' }}
                                            {{ request()->is('batch/*') ? 'active' : '' }}"
            >
            <a class="nav-link text-purple-half" href="{{route('course')}}">COURSES</a>
            </li>

            <li class="nav-item has-dot {{ request()->is('model-exam') ? 'active' : '' }}">
                <a class="nav-link text-purple-half"
                    href="{{route('model.exam')}}">EXAMS</a>
            </li>

            <li class="nav-item has-dot {{Route::current()->getName() == 'about_us' ? 'active' : ''}}">
                <a class="nav-link text-purple-half " href="{{route('about_us')}}">ABOUT US</a>
            </li>
            <li class="nav-item has-dot {{Route::current()->getName() == 'read-blog' ? 'active' : ''}}
                                        {{Route::current()->getName() == 'all-blogs' ? 'active' : ''}}
                ">
                <a class="nav-link text-purple-half " href="{{route('all-blogs')}}">BLOGS</a>
            </li>
            <li class="nav-item has-dot">
            <a class="nav-link text-purple-half" href="{{route('contact_us')}}">CONTACT US</a>
            </li>
            {{-- <li class="nav-item has-dot">
            <a class="nav-link text-purple-half" href="#">HELP</a>
            </li> --}}
        </ul>
        @if (Route::has('login'))
                @auth
                    <div class="nav navbar-nav flex-nowrap d-flex mr-16pt">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown"
                                data-caret="false" aria-expanded="false">
                                <span class="avatar avatar-sm mr-8pt2">
                                    <span class="avatar-title rounded-circle text-white" style="padding: 8px 10px; background:#FA9632"><i class="fas fa-user"></i></span>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header"><strong>Account</strong></div>
                                @if(Auth::user()->is_admin==1)
                                    <a class="dropdown-item" href="{{route('admin.index')}}">Admin Dashboard</a>
                                @else
                                <a class="dropdown-item" href="{{route('profile.modelTest')}}">My Dashboard</a>
                                @endif
{{--                                @if(Auth::user()->is_admin== 0 && request()->is('profile/model-test'))--}}
{{--                                    <a class="dropdown-item" href="{{route('student.model.test.result')}}">Exams</a>--}}
{{--                                @endif--}}
{{--                                <a class="dropdown-item" href="#">All courses</a>--}}

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
        <div class="my-2 my-lg-0">
            <a class="nav-item active my-2 my-sm-0 pr-3" href="{{route('register')}}">SIGN UP</a>
            <a class="btn my-2 my-sm-0 btn-orange-customed" href="{{route('login')}}">LOG IN</a>
        </div>
        @endauth
        @endif
    </div>
</nav>
