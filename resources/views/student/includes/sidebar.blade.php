<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-dark-pickled-bluewood sidebar-left" data-perfect-scrollbar>
            <!-- Sidebar Content -->
            {{-- <div class="d-flex align-items-center navbar-height">
                <form action="index.html" class="search-form search-form--black mx-16pt pr-0 pl-16pt">
                    <input type="text" class="form-control pl-0" placeholder="Search">
                    <button class="btn" type="submit"><i class="material-icons">search</i></button>
                </form>
            </div> --}}
            <a href="{{ route('/') }}" class="sidebar-brand ">
                <!-- <img class="sidebar-brand-icon" src="{{ asset('student/') }}public/images/illustration/student/128/white.svg" alt="Luma"> -->
                <span class="avatar avatar-xl sidebar-brand-icon h-auto">
                    <span class="avatar-title rounded bg-primary"><img
                            src="{{ asset('student/public/images/illustration/student/128/white.svg') }}"
                            class="img-fluid" alt="logo" /></span>
                </span>
                <span>eDventure</span>
            </a>
            @auth
                @if (auth()->user()->is_admin == 1)
                    <div class="sidebar-heading">Admin</div>
                @endif
                @if (auth()->user()->is_admin == 0)
                    <div class="sidebar-heading">Student</div>
                @endif
            @endauth
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item {{ request()->is('/') ? 'active':'' }}">
                    <a class="sidebar-menu-button" href="{{ route('/') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
                        <span class="sidebar-menu-text">Home</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ request()->is('course') ? 'active':'' }}
                                                {{ request()->is('course-preview/*') ? 'active':'' }} 
                                            ">
                    <a class="sidebar-menu-button" href="{{ route('course') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">import_contacts</span>
                        <span class="sidebar-menu-text">Browse Courses</span>
                    </a>
                </li>
                @auth
                    @if (auth()->user()->is_admin == 1)
                        <li class="sidebar-menu-item {{ request()->is('course') ? 'active':'' }}
                                                            {{ request()->is('course-preview/*') ? 'active':'' }} 
                                                            ">
                            <a class="sidebar-menu-button" href="{{ route('admin.index') }}">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">format_shapes</span>
                                <span class="sidebar-menu-text">Admin Panel</span>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->is_admin == 0)
                        <li class="sidebar-menu-item {{ request()->is('batch') ? 'active' : '' }} 
                                                            {{ request()->is('batch/*') ? 'active' : '' }} 
                                                            ">
                            <a class="sidebar-menu-button" href="{{ route('batch') }}">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">format_bold</span>
                                <span class="sidebar-menu-text">Batches</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item  {{ request()->is('progress/*') ? 'active' : '' }}">
                            <a class="sidebar-menu-button" href="{{ route('enroll-course', Auth()->user()->id) }}">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">assessment</span>
                                <span class="sidebar-menu-text">Progress</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item  {{ request()->is('payments/*') ? 'active' : '' }}">
                            <a class="sidebar-menu-button" href="{{ route('payments', auth()->user()->id) }}">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">payment</span>
                                <span class="sidebar-menu-text">Payments</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="sidebar-menu-button" href="{{ route('logout') }}" onclick="event.preventDefault(); 
                                                                        this.closest('form').submit();">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">lock</span>
                                    <span class="sidebar-menu-text">Log out</span>
                                </a>
                            </form>
                        </li>
                    @endif
                @endauth
            </ul>
            <!-- // END Sidebar Content -->
        </div>
    </div>
</div>
