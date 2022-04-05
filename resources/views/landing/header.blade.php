{{-- new navbar part's code  --}}
<nav class="navbar fixed-top navbar-expand-lg navbar-dark fixed-top bg-purple-customed">
    <a class="navbar-brand" href="{{route('home')}}"><img src="/img/landing/edventureFinalLogo.png" width="220px" alt="EdventureLogo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse  navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
            <li class="nav-item has-dot  {{Route::current()->getName() == 'home' ? 'active' : ''}}">
            <a class="nav-link text-white" href="{{route('home')}}">{{__('index.home')}}</a>
            </li>
            <li class="nav-item has-dot">
            </li>

            <li class="nav-item has-dot  {{ request()->is('course') ? 'active' : '' }}
                                            {{ request()->is('course/course-preview/*') ? 'active' : '' }}
                                            {{ request()->is('batch/*') ? 'active' : '' }}"
            >
            <a class="nav-link text-white" href="{{route('course')}}">{{__('index.courses')}}</a>
            </li>

            <li class="nav-item has-dot {{ request()->is('model-exam') ? 'active' : '' }}">
                <a class="nav-link text-white"
                    href="{{route('model.exam')}}">{{__('index.exams')}}</a>
            </li>

            <li class="nav-item has-dot {{Route::current()->getName() == 'about_us' ? 'active' : ''}}">
                <a class="nav-link text-white " href="{{route('about_us')}}">{{__('index.about_us')}}</a>
            </li>
            <li class="nav-item has-dot {{Route::current()->getName() == 'read-blog' ? 'active' : ''}}
                                        {{Route::current()->getName() == 'all-blogs' ? 'active' : ''}}
                ">
                <a class="nav-link text-white " href="{{route('all-blogs')}}">{{__('index.blog')}}</a>
            </li>
            <li class="nav-item has-dot {{Route::current()->getName()=='contact_us' ? 'active' : ''}}">
                <a class="nav-link text-white" href="{{route('contact_us')}}">{{__('index.contact_us')}}</a>
            </li>
            <li class="nav-item has-dot {{request()->is('profile/*') ? 'active' : ''}}">
                @if(auth()->check() && auth()->user()->user_type == 1)
                    <a class="nav-link text-white" href="{{route('admin.index')}}">{{__('index.admin_dashboard')}}</a>
                @elseif(auth()->check() && auth()->user()->user_type == 3)
                    <a class="nav-link text-white" href="{{route('profile.modelTest')}}">{{__('index.my_dashboard')}}</a>
                @endif
            </li>
            {{-- <li class="nav-item has-dot">
            <a class="nav-link text-purple-half" href="#">HELP</a>
            </li> --}}
        </ul>

        <li class="nav-item dropdown" style="list-style-type: none;">
            <a class="nav-link dropdown-toggle text-white font-weight-bolder text-decoration-none"
               href="Javascript:void(0)"
               id="lang_dropDown"
               data-toggle="dropdown"
               aria-haspopup="true"
               aria-expanded="false">
                {{ config('language')[app()->getLocale()] }}
            </a>
            <div style="background: #fa9632; " class="dropdown-menu" aria-labelledby="lang_dropDown">
                @foreach (config('language') as $lang => $language)
                    @if ($lang != app()->getLocale())
                        <a class="dropdown-item" id="language-dropdown" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
                    @endif
                @endforeach
            </div>
        </li>

        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                    {{__('index.log_out')}}
                </a>
            </form>
        @endauth

        @guest
        <div class="my-2 my-lg-0" id="login-signup-btn-parent-div">
            <a class="nav-item active my-2 my-sm-0 pr-3" href="{{route('register')}}">{{__('index.sign_up')}}</a>
            <a class="btn my-2 my-sm-0 btn-orange-customed" href="{{route('login')}}">{{__('index.log_in')}}</a>
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
