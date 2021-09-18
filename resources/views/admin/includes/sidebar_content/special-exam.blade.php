<li
    class="nav-item has-treeview {{ request()->is('admin/special-exam') ? 'menu-open' : '' }} 
                                {{ request()->is('admin/special-exam/create') ? 'menu-open' : '' }} 
                                {{ request()->is('admin/special-exam/*/edit') ? 'menu-open' : '' }} 
                                {{ request()->is('admin/special-exam/*') ? 'menu-open' : '' }} 
                                {{ request()->is('admin/add-mcq/*') ? 'menu-open' : '' }} 
                                {{ request()->is('admin/student-exam-attempt') ? 'menu-open' : '' }} 
                                {{ request()->is('admin/cq/*') ? 'menu-open' : '' }} 
                                {{ request()->is('admin/mcq/*') ? 'menu-open' : '' }} 
                                {{ request()->is('admin/all-special-exam-mcq') ? 'menu-open' : '' }} 
                                {{ request()->is('admin/all-special-exam-cq') ? 'menu-open' : '' }} 
">
    <a href="#"
        class="nav-link {{ request()->is('admin/special-exam') ? 'active' : '' }} 
                        {{ request()->is('admin/special-exam/create') ? 'active' : '' }} 
                        {{ request()->is('admin/special-exam/*/edit') ? 'active' : '' }} 
                        {{ request()->is('admin/special-exam/*') ? 'active' : '' }} 
                        {{ request()->is('admin/add-mcq/*') ? 'active' : '' }} 
                        {{ request()->is('admin/student-exam-attempt') ? 'active' : '' }} 
                        {{ request()->is('admin/cq/*') ? 'active' : '' }} 
                        {{ request()->is('admin/mcq/*') ? 'active' : '' }} 
                        {{ request()->is('admin/all-special-exam-mcq') ? 'active' : '' }} 
                        {{ request()->is('admin/all-special-exam-cq') ? 'active' : '' }} 
                        ">
        <i class="fas fa-paste"></i>
        <p>&nbsp; Special Exam<i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">

        <li
            class="nav-item has-treeview {{ request()->is('admin/special-exam') ? 'menu-open' : '' }} 
        {{ request()->is('admin/special-exam/all-special-exam-mcq') ? 'menu-open' : '' }} 
        {{ request()->is('admin/special-exam/all-cq') ? 'menu-open' : '' }} 
        ">
            <a href="{{ route('showAllSpecialExamMCQ') }}"
                class="nav-link {{ request()->is('admin/all-special-exam-mcq') ? 'active' : '' }} ">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>MCQ</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('showAllSpecialExamCQ') }}"
                class="nav-link {{ request()->is('admin/all-special-exam-cq') ? 'active' : '' }} ">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>CQ</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('special-exam.index') }}"
                class="nav-link {{ request()->is('admin/special-exam') ? 'active' : '' }}">
                &nbsp;<i class="fas fa-volleyball-ball"></i>
                <p>&nbsp; All Exam</p>
            </a>
        </li>
    </ul>
</li>
