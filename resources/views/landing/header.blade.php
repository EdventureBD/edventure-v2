<nav class="navbar navbar-expand-lg navbar-light {{$headerBg == 'white' ? "position-relative bg-light " : "position-absolute"}} w-100">
    <a class="navbar-brand" href="#"><img src="/img/landing/logo.png" width="220" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
            <li class="nav-item has-dot  {{Route::current()->getName() == 'home' ? 'active' : ''}}">
            <a class="nav-link text-purple-half" href="{{route('home')}}">HOME</a>
            </li>
            <li class="nav-item has-dot">
            <a class="nav-link text-purple-half" href="#">EXAM</a>
            </li>
            <li class="nav-item has-dot">
            <a class="nav-link text-purple-half" href="#">RESOURCES</a>
            </li>
            <li class="nav-item has-dot {{Route::current()->getName() == 'about_us' ? 'active' : ''}}">
                <a class="nav-link text-purple-half " href="{{route('about_us')}}">ABOUT US</a>
            </li>
            <li class="nav-item has-dot">
            <a class="nav-link text-purple-half" href="#">CONTACT US</a>
            </li>
            <li class="nav-item has-dot">
            <a class="nav-link text-purple-half" href="#">HELP</a>
            </li>
        </ul>
        <div class="my-2 my-lg-0">
            <a class="nav-item active my-2 my-sm-0 pr-3" href="{{route('register')}}">SIGN UP</a>
            <a class="btn btn-purple my-2 my-sm-0" href="{{route('login')}}">LOG IN</a>
        </div>
    </div>
</nav>