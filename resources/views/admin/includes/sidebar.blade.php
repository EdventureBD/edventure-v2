<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.index') }}" class="brand-link">
        <img src="{{ asset('logo2.png') }}" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Edventure</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (auth()->user()->image)
                    <img src="{{ Storage::url(auth()->user()->image) }}" class="img-circle elevation-2"
                         alt="User Image">
                @else
                    <img src="{{ asset('profile.png') }}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                {{-- START OF DASHBOARD --}}
                <li class="nav-item {{ request()->is('admin/activity') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.index') }}"
                       class="nav-link {{ request()->is('admin/index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                {{-- END OF DASHBOARD --}}

                {{-- START OF USER --}}
                @can('user')
                    <li
                        class="nav-item has-treeview {{ request()->is('admin/user') ? 'menu-open' : '' }}
                        {{ request()->is('admin/user/create') ? 'menu-open' : '' }}
                        {{ request()->is('admin/user/*/edit') ? 'menu-open' : '' }}
                        {{ request()->is('admin/allAdmin') ? 'menu-open' : '' }}
                        {{ request()->is('admin/allTeacher') ? 'menu-open' : '' }}
                        {{ request()->is('admin/allStudent') ? 'menu-open' : '' }}
                            ">
                        <a href="#"
                           class="nav-link {{ request()->is('admin/user') ? 'active' : '' }}
                           {{ request()->is('admin/user/create') ? 'active' : '' }}
                           {{ request()->is('admin/user/*/edit') ? 'active' : '' }}
                           {{ request()->is('admin/allAdmin') ? 'active' : '' }}
                           {{ request()->is('admin/allTeacher') ? 'active' : '' }}
                           {{ request()->is('admin/allStudent') ? 'active' : '' }}
                               ">
                            <i class="fas fa-user-friends"></i>
                            <p>&nbsp; User <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul style="margin-left: 10px;" class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('allAdmin') }}"
                                   class="nav-link {{ request()->is('admin/allAdmin') ? 'active' : '' }} ">
                                    <i class="fas fa-user-shield"></i>
                                    <p>&nbsp; Admin</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('allTeacher') }}"
                                   class="nav-link {{ request()->is('admin/allTeacher') ? 'active' : '' }} ">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <p>&nbsp; Teacher</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('allStudent') }}"
                                   class="nav-link {{ request()->is('admin/allStudent') ? 'active' : '' }} ">
                                    <i class="fas fa-user-graduate"></i>
                                    <p>&nbsp; Students</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}"
                                   class="nav-link {{ request()->is('admin/user') ? 'active' : '' }}">
                                    <i class="fas fa-users"></i>
                                    <p>&nbsp; All User</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                {{-- END OF USER --}}

                {{-- Start Role Section --}}
                @can('role_permission')
                    <li
                        class="nav-item has-treeview {{ request()->is('admin/role') ? 'menu-open' : '' }}
                        {{ request()->is('admin/role/assign') ? 'menu-open' : '' }}
                            ">
                        <a href="#"
                           class="nav-link {{ request()->is('admin/role') ? 'active' : '' }}
                           {{ request()->is('admin/role/assign') ? 'active' : '' }}
                               ">
                            <i class="fas fa-user-lock"></i>
                            <p>&nbsp;Role & Permission <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul style="margin-left: 10px;" class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('role.index') }}"
                                   class="nav-link {{ request()->is('admin/role') ? 'active' : '' }} ">
                                    <i class="fas fa-user-tie"></i>
                                    <p>Role</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('role.assign.index') }}"
                                   class="nav-link {{ request()->is('admin/role/assign') ? 'active' : '' }} ">
                                    <i class="fas fa-users"></i>
                                    <p>Assigned Role</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                {{-- End Role Section--}}

                {{-- START OF COURSE CATEGORY --}}
                @can('course')
                    <li class="nav-item {{ request()->is('admin/course-category') ? 'menu-open' : '' }}">
                        <a href="{{ route('course-category.index') }}"
                           class="nav-link {{ request()->is('admin/course-category') ? 'active' : '' }} {{ request()->is('admin/course-category/create') ? 'active' : '' }}  {{ request()->is('admin/course-category/*') ? 'active' : '' }}">
                            <i class="fas fa-list-ol"></i>
                            <p>&nbsp; Course Category</p>
                        </a>
                    </li>
                    {{-- END OF COURSE CATEGORY --}}

                    {{-- START OF COURSE --}}
                    @include('admin.includes.sidebar_content.course')
                    {{-- END OF COURSE --}}

                    {{-- START OF BATCH --}}
                    @include('admin.includes.sidebar_content.batch')
                    {{-- END OF BATCH --}}
                @endcan

                @can('payment')
                    {{-- START OF PAYMENTS --}}
                    <li
                        class="nav-item has-treeview {{ request()->is('admin/payment') ? 'menu-open' : '' }}
                        {{ request()->is('admin/payment/create') ? 'menu-open' : '' }}
                        {{ request()->is('admin/payment/*/edit') ? 'menu-open' : '' }}
                            ">
                        <a href="#"
                           class="nav-link {{ request()->is('admin/payment') ? 'active' : '' }}
                           {{ request()->is('admin/payment/create') ? 'active' : '' }}
                           {{ request()->is('admin/payment/*/edit') ? 'active' : '' }}
                               ">
                            <i class="fas fa-boxes"></i>
                            <p>&nbsp; Payments<i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul style="margin-left: 10px;" class="nav nav-treeview">
                            <li class="nav-item {{ request()->is('admin/payment') ? 'menu-open' : '' }}">
                                <a href="{{ route('payment.index') }}"
                                   class="nav-link {{ request()->is('admin/payment') ? 'active' : '' }}
                                   {{ request()->is('admin/payment/*/edit') ? 'active' : '' }}">
                                    <i class="fas fa-file-invoice"></i>
                                    <p>&nbsp; Payment index</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('payment.create') }}"
                                   class="nav-link {{ request()->is('admin/payment/create') ? 'active' : '' }}">
                                    <i class="fas fa-archive"></i>
                                    <p>&nbsp; Create Payment</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- END OF PAYMENTS --}}
                @endcan

                @can('course')
                    {{-- START OF CONTENT TAGS --}}
                    <li
                        class="nav-item has-treeview {{ request()->is('admin/content-tag') ? 'menu-open' : '' }}
                        {{ request()->is('admin/content-tag/create') ? 'menu-open' : '' }}
                        {{ request()->is('admin/content-tag/*/edit') ? 'menu-open' : '' }}
                        {{ request()->is('admin/question-content-tag') ? 'menu-open' : '' }}
                        {{ request()->is('admin/question-content-tag/create') ? 'menu-open' : '' }}
                        {{ request()->is('admin/question-content-tag/*/edit') ? 'menu-open' : '' }}
                            ">
                        <a href="#"
                           class="nav-link {{ request()->is('admin/content-tag') ? 'active' : '' }}
                           {{ request()->is('admin/content-tag/create') ? 'active' : '' }}
                           {{ request()->is('admin/content-tag/*/edit') ? 'active' : '' }}
                           {{ request()->is('admin/question-content-tag') ? 'active' : '' }}
                           {{ request()->is('admin/question-content-tag/create') ? 'active' : '' }}
                           {{ request()->is('admin/question-content-tag/*/edit') ? 'active' : '' }}
                               ">
                            <i class="fas fa-chart-bar"></i>
                            <p>&nbsp; Tags<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul style="margin-left: 10px;" class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('content-tag.index') }}"
                                   class="nav-link {{ request()->is('admin/content-tag') ? 'active' : '' }} {{ request()->is('admin/content-tag/create') ? 'active' : '' }} {{ request()->is('admin/content-tag/*/edit') ? 'active' : '' }}">
                                    <i class="fas fa-clipboard-list"></i>
                                    <p>&nbsp; Content Tag</p>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="{{ route('question-content-tag.index') }}" class="nav-link {{ request()->is('admin/question-content-tag')? 'active': '' }} {{ request()->is('admin/question-content-tag/create')? 'active': '' }} {{ request()->is('admin/question-content-tag/*/edit')? 'active': '' }}">
                                    <i class="fas fa-question-circle"></i>
                                    <p>&nbsp; Ques-Content Tag</p>
                                </a>
                            </li> --}}
                        </ul>
                    </li>
                    {{-- END OF CONTENT TAG --}}
                @endcan

                @can('course')
                    {{-- START OF COURSE CATEGORY --}}
                    <li class="nav-item {{ request()->is('admin/bundle') ? 'menu-open' : '' }}">
                        <a href="{{ route('bundle.index') }}"
                           class="nav-link {{ request()->is('admin/bundle') ? 'active' : '' }} {{ request()->is('admin/bundle/create') ? 'active' : '' }}  {{ request()->is('admin/bundle/*') ? 'active' : '' }}">
                            <i class="fas fa-list-ol"></i>
                            <p>&nbsp; Bundles </p>
                        </a>
                    </li>
                    {{-- END OF COURSE CATEGORY --}}
                @endcan

                @can('course_exam')
                    {{-- START OF EXAM SIDEBAR --}}
                    @include('admin.includes.sidebar_content.exam')
                    {{-- END OF EXAM SIDEBAR --}}
                @endcan
                {{----------------------- START OF MODEL EXAM SIDEBAR ------------------------------------}}
                @canany([
                        'model_exam_category',
                        'model_exam_topics',
                        'model_exam_tags',
                        'model_exam',
                        'model_exam_result',
                        'model_exam_tag_analysis',
                        'model_exam_payment'
                        ])

                    <li class="nav-item has-treeview {{ request()->is('admin/exam-category') ||
                                                    request()->is('admin/exam-topic') ||
                                                    request()->is('admin/exam-tags') ||
                                                    request()->is('admin/model-exam') ||
                                                    request()->is('admin/model-exam/tag/analysis') ||
                                                    request()->is('admin/model-exam/result/list') ||
                                                    request()->is('admin/model-exam/payment/category') ||
                                                    request()->is('admin/model-exam/payment/exam') ? 'menu-open' : '' }}">
                        <a href="#"
                           class="nav-link {{ request()->is('admin/exam-category') ||
                                          request()->is('admin/exam-topic') ||
                                          request()->is('admin/exam-tags') ||
                                          request()->is('admin/model-exam/result/list') ||
                                          request()->is('admin/model-exam/tag/analysis') ||
                                          request()->is('admin/model-exam') ||
                                          request()->is('admin/model-exam/payment/category') ||
                                          request()->is('admin/model-exam/payment/exam')? 'active' : '' }}">
                            <i class="fas fa-paste"></i>
                            <p>&nbsp;&nbsp;Model Exam <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul style="margin-left: 10px;" class="nav nav-treeview">
                            @can('model_exam_category')
                                <li>
                                    <a href="{{ route('exam.category.index') }}"
                                       class="nav-link {{ request()->is('admin/exam-category') ? 'active' : '' }} ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Exam Category</p>
                                    </a>
                                </li>
                            @endcan

                            @can('model_exam_topics')
                                <li>
                                    <a href="{{ route('exam.topic.index') }}"
                                       class="nav-link {{ request()->is('admin/exam-topic') ? 'active' : '' }} ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Exam Topics</p>
                                    </a>
                                </li>
                            @endcan

                            @can('model_exam_tags')
                                <li>
                                    <a href="{{ route('exam.tags.index') }}"
                                       class="nav-link {{ request()->is('admin/exam-tags') ? 'active' : '' }} ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Exam Tags</p>
                                    </a>
                                </li>
                            @endcan

                            @can('model_exam')
                                <li>
                                    <a href="{{ route('model.exam.index') }}"
                                       class="nav-link {{ request()->is('admin/model-exam') ? 'active' : '' }} ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Exams</p>
                                    </a>
                                </li>
                            @endcan

                            @can('model_exam_result')
                                <li>
                                    <a href="{{ route('model.exam.result') }}"
                                       class="nav-link {{ request()->is('admin/model-exam/result/list') ? 'active' : '' }} ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Results</p>
                                    </a>
                                </li>
                            @endcan

                            @can('model_exam_tag_analysis')
                                <li>
                                    <a href="{{ route('model.exam.tag.analysis') }}"
                                       class="nav-link {{ request()->is('admin/model-exam/tag/analysis') ? 'active' : '' }} ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Exam Tag Analysis</p>
                                    </a>
                                </li>

                            @endcan

                            @can('model_exam_payment')
                                <li>
                                    <a href="{{ route('model.exam.payment.category') }}"
                                       class="nav-link {{ request()->is('admin/model-exam/payment/category') ? 'active' : '' }}
                                       {{ request()->is('admin/model-exam/payment/exam') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Payments</p>
                                    </a>
                                </li>
                            @endcan

                            @can('free_category_access')
                                <li>
                                    <a href="{{ route('category.access.index') }}"
                                       class="nav-link {{ request()->is('admin/category-access') ? 'active' : '' }}
                                       {{ request()->is('admin/category-access') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Free Category Access</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                {{----------------------------- END OF MODEL EXAM SIDEBAR -------------------------------}}

                {{-- START OF EXAM SIDEBAR --}}
                {{-- @include('admin.includes.sidebar_content.special-exam') --}}
                {{-- END OF EXAM SIDEBAR --}}

                @can('other')
                    {{-- START OF BLOG SIDEBAR --}}
                    <li
                        class="nav-item has-treeview {{ request()->is('admin/blog') ? 'menu-open' : '' }}
                        {{ request()->is('admin/blog/create') ? 'menu-open' : '' }}
                        {{ request()->is('admin/blog/*/edit') ? 'menu-open' : '' }}
                            ">
                        <a href="#"
                           class="nav-link {{ request()->is('admin/blog') ? 'active' : '' }}
                           {{ request()->is('admin/blog/create') ? 'active' : '' }}
                           {{ request()->is('admin/blog/*/edit') ? 'active' : '' }}
                               ">
                            <i class="fas fa-chart-bar"></i>
                            <p>&nbsp; Blog <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul style="margin-left: 10px;" class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('blog.index') }}"
                                   class="nav-link {{ request()->is('admin/blog') ? 'active' : '' }} ">
                                    <i class="fas fa-align-center"></i>
                                    <p>&nbsp; Index</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('blog.create') }}"
                                   class="nav-link {{ request()->is('admin/blog/create') ? 'active' : '' }} ">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <p>&nbsp; Create</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- END OF BLOG SIDEBAR --}}

                    {{-- START OF SHORTCUT CREATE --}}
                    <li class="nav-item {{ request()->is('admin/upload-image') ? 'menu-open' : '' }}">
                        <a href="{{ route('upload-image.index') }}"
                           class="nav-link {{ request()->is('admin/upload-image') ? 'active' : '' }}">
                            <i class="fas fa-images"></i>
                            <p>&nbsp;&nbsp;Upload Images</p>
                        </a>
                    </li>
                @endcan
                {{-- END OF SHORTCUT CREATE --}}

                {{-- START OF SETTINGS --}}
                <li class="nav-item {{ request()->is('admin/settings') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.settings') }}"
                       class="nav-link {{ request()->is('admin/settings') ? 'active' : '' }}">
                        <i class="fas fa-cog"></i>
                        <p>&nbsp;&nbsp;Settings</p>
                    </a>
                </li>
                {{-- END OF SETTINGS --}}

                {{-- START OF CONTACT-US --}}
                @can('contact_us')
                    <li class="nav-item {{ request()->is('admin/contact-us') ? 'menu-open' : '' }}">
                        <a href="{{ route('contact.us.index') }}"
                           class="nav-link {{ request()->is('admin/contact-us') ? 'active' : '' }}">
                            <i class="fas fa-address-card"></i>
                            <p>&nbsp;&nbsp;Contacted-us</p>
                        </a>
                    </li>
                @endcan
                {{-- END OF CONTACT-US --}}

                @can('other')
                    {{-- START OF SETTINGS --}}
                    <li class="nav-item {{ request()->is('admin/social-group') ? 'menu-open' : '' }}">
                        <a href="{{ route('social.group.index') }}"
                           class="nav-link {{ request()->is('admin/social-group') ? 'active' : '' }}">
                            <img
                                src="https://img.icons8.com/external-obvious-flat-kerismaker/30/000000/external-internet-marketing-internet-marketing-flat-obvious-flat-kerismaker-9.png"/>
                            <p>&nbsp;&nbsp;Social Group</p>
                        </a>
                    </li>
                    {{-- END OF SETTINGS --}}
                @endcan

                {{-- START OF ACTIVITY --}}
                {{-- <li class="nav-item {{ request()->is('admin/activity') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.activity') }}"
                        class="nav-link {{ request()->is('admin/activity') ? 'active' : '' }}">
                        <i class="fas fa-hiking"></i>
                        <p>&nbsp; Activity</p>
                    </a>
                </li> --}}
                {{-- END OF ACTIVITY --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
