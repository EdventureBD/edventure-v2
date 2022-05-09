<li
    class="nav-item has-treeview 
                                {{-- {{ request()->is('admin/batch') ? 'menu-open' : '' }}
                                {{ request()->is('admin/batch/create') ? 'menu-open' : '' }}
                                {{ request()->is('admin/batch/*/edit') ? 'menu-open' : '' }}
                                {{ request()->is('admin/batch/*') ? 'menu-open' : '' }} --}}
                                {{-- {{ request()->is('admin/batch-lecture') ? 'menu-open' : '' }}
                                {{ request()->is('admin/batch-lecture/create') ? 'menu-open' : '' }}
                                {{ request()->is('admin/batch-lecture/*/edit') ? 'menu-open' : '' }} --}}
                                {{-- {{ request()->is('admin/batch-exam') ? 'menu-open' : '' }}
                                {{ request()->is('admin/batch-exam/create') ? 'menu-open' : '' }}
                                {{ request()->is('admin/batch-exam/*/edit') ? 'menu-open' : '' }}
                                {{ request()->is('admin/batch-exam/*') ? 'menu-open' : '' }} --}}
                                {{ request()->is('admin/live-class') ? 'menu-open' : '' }}
                                {{ request()->is('admin/live-class/create') ? 'menu-open' : '' }}
                                {{ request()->is('admin/live-class/*/edit') ? 'menu-open' : '' }}
                                {{ request()->is('admin/batch-student') ? 'menu-open' : '' }}
                                ">
    <a href="#"
        class="nav-link 
                        {{-- {{ request()->is('admin/batch') ? 'active' : '' }}
                        {{ request()->is('admin/batch/create') ? 'active' : '' }}
                        {{ request()->is('admin/batch/*/edit') ? 'active' : '' }}
                        {{ request()->is('admin/batch/*') ? 'active' : '' }} --}}
                        {{-- {{ request()->is('admin/batch-lecture') ? 'active' : '' }}
                        {{ request()->is('admin/batch-lecture/create') ? 'active' : '' }}
                        {{ request()->is('admin/batch-lecture/*/edit') ? 'active' : '' }} --}}
                        {{-- {{ request()->is('admin/batch-exam') ? 'active' : '' }}
                        {{ request()->is('admin/batch-exam/create') ? 'active' : '' }}
                        {{ request()->is('admin/batch-exam/*/edit') ? 'active' : '' }}
                        {{ request()->is('admin/batch-exam/*') ? 'active' : '' }} --}}
                        {{ request()->is('admin/live-class') ? 'active' : '' }}
                        {{ request()->is('admin/live-class/create') ? 'active' : '' }}
                        {{ request()->is('admin/live-class/*/edit') ? 'active' : '' }}
                        {{ request()->is('admin/batch-student') ? 'active' : '' }}
                        ">
        <i class="fas fa-address-book"></i>
        <p>&nbsp; Batch Details <i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav ml-5 nav-treeview">
        {{-- <li class="nav-item">
            <a href="{{ route('batch.index') }}"
                class="nav-link {{ request()->is('admin/batch/create') ? 'active' : '' }} {{ request()->is('admin/batch') ? 'active' : '' }} {{ request()->is('admin/batch/*/edit') ? 'active' : '' }} {{ request()->is('admin/batch/*') ? 'active' : '' }} ">
                <i class="fab fa-bootstrap"></i>
                <p>&nbsp; Batches </p>
            </a>
        </li> --}}
        {{-- <li class="nav-item">
            <a href="{{ route('batch-lecture.index') }}"
                class="nav-link {{ request()->is('admin/batch-lecture') ? 'active' : '' }} {{ request()->is('admin/batch-lecture/create') ? 'active' : '' }} {{ request()->is('admin/batch-lecture/*/edit') ? 'active' : '' }}">
                <i class="fas fa-photo-video"></i>
                <p>&nbsp; Batch lecture</p>
            </a>
        </li> --}}

        {{-- <li class="nav-item">
            <a href="{{ route('batch-exam.index') }}"
                class="nav-link {{ request()->is('admin/batch-exam') ? 'active' : '' }}
                {{ request()->is('admin/batch-exam/create') ? 'active' : '' }}
                {{ request()->is('admin/batch-exam/*/edit') ? 'active' : '' }}
                {{ request()->is('admin/batch-exam/*') ? 'active' : '' }}
                ">
                <i class="fas fa-paste"></i>
                <p>&nbsp; Batch Exam</p>
            </a>
        </li> --}}

        <li class="nav-item">
            <a href="{{ route('batch-student.index') }}"
                class="nav-link {{ request()->is('admin/batch-student') ? 'active' : '' }}">
                <i class="fas fa-user-graduate"></i>
                <p>&nbsp; Batch Student</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('live-class.index') }}"
                class="nav-link {{ request()->is('admin/live-class') ? 'active' : '' }} {{ request()->is('admin/live-class/create') ? 'active' : '' }} {{ request()->is('admin/live-class/*/edit') ? 'active' : '' }}">
                <i class="far fa-dot-circle"></i>
                <p>&nbsp; Live Class</p>
            </a>
        </li>
    </ul>
</li>
