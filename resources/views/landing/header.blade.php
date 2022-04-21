{{-- new navbar part's code  --}}
<nav class="navbar fixed-top navbar-expand-lg navbar-dark fixed-top bg-purple-customed">
    <a class="navbar-brand" href="{{route('home')}}"><img src="/img/landing/edventureFinalLogo.png" width="220px" alt="EdventureLogo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse  navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
            <li class="nav-item has-dot  {{Route::current()->getName() == 'home' ? 'active' : ''}}">
            <a class="nav-link text-white" href="{{route('home')}}">HOME</a>
            </li>
            <li class="nav-item has-dot">
            </li>

{{--            <li class="nav-item has-dot  {{ request()->is('course') ? 'active' : '' }}--}}
{{--                                            {{ request()->is('course/course-preview/*') ? 'active' : '' }}--}}
{{--                                            {{ request()->is('batch/*') ? 'active' : '' }}"--}}
{{--            >--}}
{{--            <a class="nav-link text-white" href="{{route('course')}}">COURSES</a>--}}
{{--            </li>--}}

            <li class="nav-item has-dot {{ request()->is('model-exam') ? 'active' : '' }}">
                <a class="nav-link text-white"
                    href="{{route('model.exam')}}">EXAMS</a>
            </li>

            <li class="nav-item has-dot {{Route::current()->getName() == 'about_us' ? 'active' : ''}}">
                <a class="nav-link text-white " href="{{route('about_us')}}">ABOUT US</a>
            </li>
            <li class="nav-item has-dot {{Route::current()->getName() == 'read-blog' ? 'active' : ''}}
                                        {{Route::current()->getName() == 'all-blogs' ? 'active' : ''}}
                ">
                <a class="nav-link text-white " href="{{route('all-blogs')}}">BLOGS</a>
            </li>
            <li class="nav-item has-dot {{Route::current()->getName()=='contact_us' ? 'active' : ''}}">
                <a class="nav-link text-white" href="{{route('contact_us')}}">CONTACT US</a>
            </li>
            <li class="nav-item has-dot {{request()->is('profile/*') ? 'active' : ''}}">
                @if(auth()->check() && auth()->user()->user_type == 1)
                    <a class="nav-link text-white" href="{{route('admin.index')}}">ADMIN DASHBOARD</a>
                @elseif(auth()->check() && auth()->user()->user_type == 3)
                    <a class="nav-link text-white" href="{{route('profile.modelTest')}}">MY DASHBOARD</a>
                @endif
            </li>
            {{-- <li class="nav-item has-dot">
            <a class="nav-link text-purple-half" href="#">HELP</a>
            </li> --}}
        </ul>
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                    LOG OUT
                </a>
            </form>
        @endauth

        @guest
        <div class="my-2 my-lg-0" id="login-signup-btn-parent-div">
            <a class="nav-item active my-2 my-sm-0 pr-3" href="{{route('register')}}">SIGN UP</a>
            <a class="btn my-2 my-sm-0 btn-orange-customed" href="{{route('login')}}">LOG IN</a>
        </div>
        @endguest
    </div>
</nav>
{{-- new navbar part's code ends --}}
{{-- <nav class="navbar top-nav-fixed navbar-expand-lg navbar-light w-100" style="background: #6400C8">
    <a class="navbar-brand" href="{{route('home')}}"><img src="/img/landing/edventureFinalLogo.png" width="220" alt="EdventureLogo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

</nav> --}}
