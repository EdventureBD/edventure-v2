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
                @canany([
                        'course_category',
                        'course_program',
                        'course_bundle',
                        'course',
                        'course_batch',
                        'course_island',
                        'course_add_batch_to_island',
                        'course_content_tag',
                        'course_exam',
                        'course_batch_exam',
                        'course_lecture',
                        ])
                    <li class="nav-item has-treeview
                            {{ request()->is('admin/course-category') ? 'menu-open' : '' }}
                    {{ request()->is('admin/course-category/create') ? 'menu-open' : '' }}
                    {{ request()->is('admin/course-category/*') ? 'menu-open' : '' }}
                    {{ request()->is('admin/intermediary_level') ? 'menu-open': '' }}
                    {{ request()->is('admin/intermediary_level/create') ? 'menu-open': '' }}
                    {{ request()->is('admin/intermediary_level/*/edit') ? 'menu-open': '' }}
                    {{ request()->is('admin/bundle') ? 'menu-open' : '' }}
                    {{ request()->is('admin/bundle/create') ? 'menu-open' : '' }}
                    {{ request()->is('admin/bundle/*') ? 'menu-open' : '' }}
                    {{ request()->is('admin/course')? 'menu-open': '' }}
                    {{ request()->is('admin/course/*')? 'menu-open': '' }}
                    {{ request()->is('admin/course/*/edit')? 'menu-open': '' }}
                    {{ request()->is('admin/course-topic')? 'menu-open': '' }}
                    {{ request()->is('admin/course-topic/create')? 'menu-open': '' }}
                    {{ request()->is('admin/course-topic/*/edit')? 'menu-open': '' }}
                    {{ request()->is('admin/batch') ? 'menu-open' : '' }}
                    {{ request()->is('admin/batch/create') ? 'menu-open' : '' }}
                    {{ request()->is('admin/batch/*/edit') ? 'menu-open' : '' }}
                    {{ request()->is('admin/batch/*') ? 'menu-open' : '' }}
                    {{ request()->is('admin/content-tag') ? 'menu-open' : '' }}
                    {{ request()->is('admin/content-tag/create') ? 'menu-open' : '' }}
                    {{ request()->is('admin/content-tag/*/edit') ? 'menu-open' : '' }}
                    {{ request()->is('admin/batch-exam') ? 'menu-open' : '' }}
                    {{ request()->is('admin/batch-exam/create') ? 'menu-open' : '' }}
                    {{ request()->is('admin/batch-exam/*/edit') ? 'menu-open' : '' }}
                    {{ request()->is('admin/batch-exam/*') ? 'menu-open' : '' }}
                    {{ request()->is('admin/course-lecture')? 'menu-open': '' }}
                    {{ request()->is('admin/course-lecture/create')? 'menu-open': '' }}
                    {{ request()->is('admin/course-lecture/*/edit')? 'menu-open': '' }}
                    {{ request()->is('admin/course-lecture/*')? 'menu-open': '' }}
                    {{ request()->is('admin/batch-lecture') ? 'menu-open' : '' }}
                    {{ request()->is('admin/batch-lecture/create') ? 'menu-open' : '' }}
                    {{ request()->is('admin/batch-lecture/*/edit') ? 'menu-open' : '' }}
                    {{ request()->is('admin/exam') ? 'menu-open' : '' }}
                    {{ request()->is('admin/exam/create') ? 'menu-open' : '' }}
                    {{ request()->is('admin/exam/*/edit') ? 'menu-open' : '' }}
                    {{ request()->is('admin/exam/*') ? 'menu-open' : '' }}
                    {{ request()->is('admin/add-mcq/*') ? 'menu-open' : '' }}
                    {{ request()->is('admin/student-exam-attempt') ? 'menu-open' : '' }}
                    {{ request()->is('admin/cq/*') ? 'menu-open' : '' }}
                    {{ request()->is('admin/mcq/*') ? 'menu-open' : '' }}
                    {{ request()->is('admin/all-mcq') ? 'menu-open' : '' }}
                    {{ request()->is('admin/all-cq') ? 'menu-open' : '' }}
                    {{ request()->is('admin/all-assignment') ? 'menu-open' : '' }}

                    {{-- NEW --}}
                    {{ request()->is('admin/all-aptitude-test/*') ? 'menu-open' : '' }}
                    {{ request()->is('admin/all-pop-quiz/*') ? 'menu-open' : '' }}
                    {{ request()->is('admin/all-topic-end-exam/*') ? 'menu-open' : '' }}

                    {{ request()->is('admin/all-aptitude-test') ? 'menu-open' : '' }}
                    {{ request()->is('admin/all-pop-quiz') ? 'menu-open' : '' }}
                    {{ request()->is('admin/all-topic-end-exam') ? 'menu-open' : '' }}
                    {{ request()->is('admin/live-class') ? 'menu-open' : '' }}
                    {{ request()->is('admin/live-class/create') ? 'menu-open' : '' }}
                    {{ request()->is('admin/live-class/*/edit') ? 'menu-open' : '' }}
                    {{ request()->is('admin/batch-student') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link
                            {{ request()->is('admin/course-category') ? 'active' : '' }}
                        {{ request()->is('admin/course-category/create') ? 'active' : '' }}
                        {{ request()->is('admin/course-category/*') ? 'active' : '' }}
                        {{ request()->is('admin/intermediary_level') ? 'active': '' }}
                        {{ request()->is('admin/intermediary_level/create') ? 'active': '' }}
                        {{ request()->is('admin/intermediary_level/*/edit') ? 'active': '' }}
                        {{ request()->is('admin/bundle') ? 'active' : '' }}
                        {{ request()->is('admin/bundle/create') ? 'active' : '' }}
                        {{ request()->is('admin/bundle/*') ? 'active' : '' }}
                        {{ request()->is('admin/course')? 'active': '' }}
                        {{ request()->is('admin/course/*')? 'active': '' }}
                        {{ request()->is('admin/course/*/edit')? 'active': '' }}
                        {{ request()->is('admin/course-topic')? 'active': '' }}
                        {{ request()->is('admin/course-topic/create')? 'active': '' }}
                        {{ request()->is('admin/course-topic/*/edit')? 'active': '' }}
                        {{ request()->is('admin/batch') ? 'active' : '' }}
                        {{ request()->is('admin/batch/create') ? 'active' : '' }}
                        {{ request()->is('admin/batch/*/edit') ? 'active' : '' }}
                        {{ request()->is('admin/batch/*') ? 'active' : '' }}
                        {{ request()->is('admin/content-tag') ? 'active' : '' }}
                        {{ request()->is('admin/content-tag/create') ? 'active' : '' }}
                        {{ request()->is('admin/content-tag/*/edit') ? 'active' : '' }}
                        {{ request()->is('admin/batch-exam') ? 'active' : '' }}
                        {{ request()->is('admin/batch-exam/create') ? 'active' : '' }}
                        {{ request()->is('admin/batch-exam/*/edit') ? 'active' : '' }}
                        {{ request()->is('admin/batch-exam/*') ? 'active' : '' }}
                        {{ request()->is('admin/course-lecture')? 'active': '' }}
                        {{ request()->is('admin/course-lecture/create')? 'active': '' }}
                        {{ request()->is('admin/course-lecture/*/edit')? 'active': '' }}
                        {{ request()->is('admin/course-lecture/*')? 'active': '' }}
                        {{ request()->is('admin/batch-lecture') ? 'active' : '' }}
                        {{ request()->is('admin/batch-lecture/create') ? 'active' : '' }}
                        {{ request()->is('admin/batch-lecture/*/edit') ? 'active' : '' }}
                        {{ request()->is('admin/exam') ? 'active' : '' }}
                        {{ request()->is('admin/exam/create') ? 'active' : '' }}
                        {{ request()->is('admin/exam/*/edit') ? 'active' : '' }}
                        {{ request()->is('admin/exam/*') ? 'active' : '' }}
                        {{ request()->is('admin/add-mcq/*') ? 'active' : '' }}
                        {{ request()->is('admin/student-exam-attempt') ? 'active' : '' }}
                        {{ request()->is('admin/cq/*') ? 'active' : '' }}
                        {{ request()->is('admin/mcq/*') ? 'active' : '' }}
                        {{ request()->is('admin/all-mcq') ? 'active' : '' }}
                        {{ request()->is('admin/all-cq') ? 'active' : '' }}
                        {{ request()->is('admin/all-assignment') ? 'active' : '' }}

                        {{-- NEW --}}
                        {{ request()->is('admin/all-aptitude-test/*') ? 'active' : '' }}
                        {{ request()->is('admin/all-pop-quiz/*') ? 'active' : '' }}
                        {{ request()->is('admin/all-topic-end-exam/*') ? 'active' : '' }}

                        {{ request()->is('admin/all-aptitude-test') ? 'active' : '' }}
                        {{ request()->is('admin/all-pop-quiz') ? 'active' : '' }}
                        {{ request()->is('admin/all-topic-end-exam') ? 'active' : '' }}
                        {{ request()->is('admin/live-class') ? 'active' : '' }}
                        {{ request()->is('admin/live-class/create') ? 'active' : '' }}
                        {{ request()->is('admin/live-class/*/edit') ? 'active' : '' }}
                        {{ request()->is('admin/batch-student') ? 'active' : '' }}">

                            <i class="fas fa-list-ol"></i>
                            <p>&nbsp; Course Section <i class="right fas fa-angle-left"></i></p>
                        </a>

                        <ul style="margin-left: 10px;" class="nav nav-treeview">
                            @can('course_category')
                            <li class="nav-item {{ request()->is('admin/course-category') ? 'menu-open' : '' }}">
                                <a href="{{ route('course-category.index') }}"

                                   class="nav-link {{ request()->is('admin/course-category') ? 'active' : '' }}
                                   {{ request()->is('admin/course-category/create') ? 'active' : '' }}
                                   {{ request()->is('admin/course-category/*') ? 'active' : '' }}">

                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p> Course Category </p>
                                </a>
                            </li>
                            @endcan
                            {{-- END OF COURSE CATEGORY --}}


                            {{-- START OF PROGRAMS/INTERMEDIARY LEVEL --}}
                                @can('course_program')
                            <li class="nav-item {{ request()->is('admin/intermediary_level') ? 'menu-open': '' }}">
                                <a href="{{ route('intermediary_level.index') }}"
                                   class="nav-link {{ request()->is('admin/intermediary_level') ? 'active': '' }}
                                   {{ request()->is('admin/intermediary_level/create') ? 'active': '' }}
                                   {{ request()->is('admin/intermediary_level/*/edit') ? 'active': '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Program</p>
                                </a>
                            </li>
                                @endcan
                            {{-- END OF PROGRAMS/INTERMEDIARY LEVEL --}}

                            {{-- START OF BUNDLE --}}
                                @can('course_bundle')
                            <li class="nav-item {{ request()->is('admin/bundle') ? 'menu-open' : '' }}">
                                <a href="{{ route('bundle.index') }}"
                                   class="nav-link {{ request()->is('admin/bundle') ? 'active' : '' }}
                                   {{ request()->is('admin/bundle/create') ? 'active' : '' }}
                                   {{ request()->is('admin/bundle/*') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>&nbsp; Bundle </p>
                                </a>
                            </li>
                                @endcan
                            {{-- END OF BUNDLE --}}

                            {{-- START OF COURSE --}}
                                @can('course')
                            <li class="nav-item {{ request()->is('admin/course')? 'menu-open': '' }}">
                                <a href="{{ route('course.index') }}"
                                   class="nav-link {{ request()->is('admin/course')? 'active': '' }}
                                   {{ request()->is('admin/course/*')? 'active': '' }}
                                   {{ request()->is('admin/course/*/edit')? 'active': '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>&nbsp; Course </p>
                                </a>
                            </li>
                                @endcan
                            {{-- END OF COURSE --}}

                            {{-- START OF BATCH --}}
                                @can('course_batch')
                            <li class="nav-item {{ request()->is('admin/batch')? 'menu-open': '' }}">
                                <a href="{{ route('batch.index') }}"
                                   class="nav-link {{ request()->is('admin/batch/create') ? 'active' : '' }}
                                   {{ request()->is('admin/batch') ? 'active' : '' }}
                                   {{ request()->is('admin/batch/*/edit') ? 'active' : '' }}
                                   {{ request()->is('admin/batch/*') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>&nbsp; Batch </p>
                                </a>
                            </li>
                                @endcan
                            {{-- END OF BATCH --}}

                            {{-- START OF COURSE TOPIC --}}
                                @can('course_island')
                            <li class="nav-item {{ request()->is('admin/course-topic') ? 'menu-open' : '' }}">
                                <a href="{{ route('course-topic.index') }}"
                                   class="nav-link {{ request()->is('admin/course-topic')? 'active': '' }}
                                   {{ request()->is('admin/course-topic/create')? 'active': '' }}
                                   {{ request()->is('admin/course-topic/*/edit')? 'active': '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>&nbsp; Island </p>
                                </a>
                            </li>
                                @endcan
                            {{-- END OF COURSE TOPIC --}}
                            {{-- START OF BATCH LECTURE --}}
                                @can('course_add_batch_to_island')
                            <li class="nav-item">
                                <a href="{{ route('batch-lecture.index') }}"
                                    class="nav-link {{ request()->is('admin/batch-lecture') ? 'active' : '' }} {{ request()->is('admin/batch-lecture/create') ? 'active' : '' }} {{ request()->is('admin/batch-lecture/*/edit') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>&nbsp; Add Batch to Island </p>
                                </a>
                            </li>
                                @endcan
                            {{-- END OF BATCH LECTURE --}}
                            {{-- START OF CONTENT TAG --}}
                                @can('course_content_tag')
                            <li class="nav-item {{ request()->is('admin/content-tag') ? 'menu-open' : '' }}">
                                <a href="{{ route('content-tag.index') }}"
                                   class="nav-link {{ request()->is('admin/content-tag') ? 'active' : '' }}
                                   {{ request()->is('admin/content-tag/create') ? 'active' : '' }}
                                   {{ request()->is('admin/content-tag/*/edit') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>&nbsp; Content Tag </p>
                                </a>
                            </li>
                                @endcan
                            {{-- END OF CONTENT TAG --}}

                            @can('course_exam')
                                {{-- START OF EXAM SIDEBAR --}}
                                @include('admin.includes.sidebar_content.exam')
                                {{-- END OF EXAM SIDEBAR --}}
                            @endcan

                            {{-- START OF BATCH EXAM --}}
                                @can('course_batch_exam')
                            <li class="nav-item {{ request()->is('admin/batch-exam') ? 'menu-open' : '' }}">
                                <a href="{{ route('batch-exam.index') }}"
                                   class="nav-link {{ request()->is('admin/batch-exam') ? 'active' : '' }}
                                   {{ request()->is('admin/batch-exam/create') ? 'active' : '' }}
                                   {{ request()->is('admin/batch-exam/*/edit') ? 'active' : '' }}
                                   {{ request()->is('admin/batch-exam/*') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>&nbsp; Batch Exam </p>
                                </a>
                            </li>
                                @endcan
                            {{-- END OF BATCH EXAM --}}

                            {{-- START OF COURSE LECTURE --}}
                                @can('course_lecture')
                            <li class="nav-item {{ request()->is('admin/course-lecture')? 'menu-open': '' }}">
                                <a href="{{ route('course-lecture.index') }}"
                                   class="nav-link {{ request()->is('admin/course-lecture')? 'active': '' }}
                                   {{ request()->is('admin/course-lecture/create')? 'active': '' }}
                                   {{ request()->is('admin/course-lecture/*/edit')? 'active': '' }}
                                   {{ request()->is('admin/course-lecture/*')? 'active': '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>&nbsp; Course Lecture </p>
                                </a>
                            </li>
                                @endcan
                            {{-- END OF COURSE LECTURE --}}


                            {{-- START OF COURSE --}}
                            {{-- @include('admin.includes.sidebar_content.course') --}}
                            {{-- END OF COURSE --}}


                            {{-- START OF BATCH --}}
                            {{-- @include('admin.includes.sidebar_content.batch') --}}
                            {{-- END OF BATCH --}}
                        {{-- </ul>
                    </li> --}}
                        </ul>

                @endcanany

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

                {{----------------------- START OF MODEL EXAM SIDEBAR ------------------------------------}}
                @canany([
                        'model_exam_category',
                        'model_exam_topics',
                        'model_exam_tags',
                        'model_exam',
                        'model_exam_result',
                        'model_exam_tag_analysis',
                        'model_exam_payment',
                        'coupon'
                        ])

                    <li class="nav-item has-treeview {{ request()->is('admin/exam-category') ||
                                                    request()->is('admin/exam-topic') ||
                                                    request()->is('admin/exam-tags') ||
                                                    request()->is('admin/model-exam') ||
                                                    request()->is('admin/model-exam/tag/analysis') ||
                                                    request()->is('admin/model-exam/result/list') ||
                                                    request()->is('admin/model-exam/payment/category') ||
                                                    request()->is('admin/coupon') ||
                                                    request()->is('admin/category-access') ||
                                                    request()->is('admin/model-exam/payment/exam') ? 'menu-open' : '' }}">
                        <a href="#"
                           class="nav-link {{ request()->is('admin/exam-category') ||
                                          request()->is('admin/exam-topic') ||
                                          request()->is('admin/exam-tags') ||
                                          request()->is('admin/model-exam/result/list') ||
                                          request()->is('admin/model-exam/tag/analysis') ||
                                          request()->is('admin/model-exam') ||
                                          request()->is('admin/model-exam/payment/category') ||
                                          request()->is('admin/coupon') ||
                                          request()->is('admin/category-access') ||
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

                            @can('coupon')
                                <li>
                                    <a href="{{ route('coupon.index') }}"
                                       class="nav-link {{ request()->is('admin/coupon') ? 'active' : '' }}
                                       {{ request()->is('admin/coupon') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Coupons</p>
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
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
