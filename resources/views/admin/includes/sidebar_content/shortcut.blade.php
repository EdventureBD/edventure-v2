                <li class="nav-item has-treeview {{ request()->is('admin/single/course/create') ? 'menu-open' : '' }} 
                                                {{ request()->is('admin/single/user/create') ? 'menu-open' : '' }} 
                                                {{ request()->is('admin/single/course-category/create') ? 'menu-open' : '' }} 
                                                {{ request()->is('admin/single/course-lecture/create') ? 'menu-open' : '' }} 
                                                {{ request()->is('admin/single/course-topic/create') ? 'menu-open' : '' }} 
                                                {{ request()->is('admin/single/exam/create') ? 'menu-open' : '' }}
                                                {{ request()->is('admin/single/content-tag/create') ? 'menu-open' : '' }} 
                                                {{ request()->is('admin/single/batch/create') ? 'menu-open' : '' }} 
                                                {{ request()->is('admin/single/batch-lecture/create') ? 'menu-open' : '' }} 
                                                {{ request()->is('admin/single/batch-exam/create') ? 'menu-open' : '' }}
                                                {{ request()->is('admin/single/batch-liveclass/create') ? 'menu-open' : '' }}
                                                ">
                    <a href="#" class="nav-link {{ request()->is('admin/single/course/create') ? 'active' : '' }} 
                                                {{ request()->is('admin/single/user/create') ? 'active' : '' }} 
                                                {{ request()->is('admin/single/single/course-category/create') ? 'active' : '' }} 
                                                {{ request()->is('admin/single/course-lecture/create') ? 'active' : '' }} 
                                                {{ request()->is('admin/single/course-topic/create') ? 'active' : '' }} 
                                                {{ request()->is('admin/single/exam/create') ? 'active' : '' }}
                                                {{ request()->is('admin/single/content-tag/create') ? 'active' : '' }} 
                                                {{ request()->is('admin/single/batch/create') ? 'active' : '' }} 
                                                {{ request()->is('admin/single/batch-lecture/create') ? 'active' : '' }} 
                                                {{ request()->is('admin/single/batch-exam/create') ? 'active' : '' }}
                                                {{ request()->is('admin/single/batch-liveclass/create') ? 'active' : '' }}
                                                ">
                        <i class="fas fa-radiation-alt"></i>
                        <p>&nbsp; Shortcut Create <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('singleUser.create') }}"
                                class="nav-link {{ request()->is('admin/single/user/create') ? 'active' : '' }} ">
                                &nbsp;<i class="fas fa-plus-circle"></i>
                                <p> &nbsp; User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('singleCourseCategory.create') }}"
                                class="nav-link {{ request()->is('admin/single/course-category/create') ? 'active' : '' }} ">
                                &nbsp;<i class="fas fa-plus-circle"></i>
                                <p> &nbsp; Course category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('singleCourse.create') }}"
                                class="nav-link {{ request()->is('admin/single/course/create') ? 'active' : '' }} ">
                                &nbsp;<i class="fas fa-plus-circle"></i>
                                <p> &nbsp; Course</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('singleCourseTopic.create') }}"
                                class="nav-link {{ request()->is('admin/single/course-topic/create') ? 'active' : '' }} ">
                                &nbsp;<i class="fas fa-plus-circle"></i>
                                <p> &nbsp; Curse Topic</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('singleCourseLecture.create') }}"
                                class="nav-link {{ request()->is('admin/single/course-lecture/create') ? 'active' : '' }} ">
                                &nbsp;<i class="fas fa-plus-circle"></i>
                                <p> &nbsp; Course Lecture</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('singleExam.create') }}"
                                class="nav-link {{ request()->is('admin/single/exam/create') ? 'active' : '' }} ">
                                &nbsp;<i class="fas fa-plus-circle"></i>
                                <p> &nbsp; Exam</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('singleContentTag.create') }}"
                                class="nav-link {{ request()->is('admin/single/content-tag/create') ? 'active' : '' }} ">
                                &nbsp;<i class="fas fa-plus-circle"></i>
                                <p> &nbsp; Content Tag</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('singleBatch.create') }}"
                                class="nav-link {{ request()->is('admin/single/batch/create') ? 'active' : '' }} ">
                                &nbsp;<i class="fas fa-plus-circle"></i>
                                <p> &nbsp; Batch</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('singleBatchLiveClass.create') }}"
                                class="nav-link {{ request()->is('admin/single/batch-liveclass/create') ? 'active' : '' }} ">
                                &nbsp;<i class="fas fa-plus-circle"></i>
                                <p> &nbsp; Batch Live class</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('singleBatchLecture.create') }}"
                                class="nav-link {{ request()->is('admin/single/batch-lecture/create') ? 'active' : '' }} ">
                                &nbsp;<i class="fas fa-plus-circle"></i>
                                <p> &nbsp; Batch Lecture</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('singleBatchExam.create') }}"
                                class="nav-link {{ request()->is('admin/single/batch-exam/create') ? 'active' : '' }} ">
                                &nbsp;<i class="fas fa-plus-circle"></i>
                                <p> &nbsp; Batch Exam</p>
                            </a>
                        </li>
                    </ul>
                </li>
