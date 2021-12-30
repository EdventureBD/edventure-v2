                <li class="nav-item has-treeview {{ request()->is('admin/course')? 'menu-open': '' }} 
                                                {{ request()->is('admin/course/create')? 'menu-open': '' }} 
                                                {{ request()->is('admin/course/*')? 'menu-open': '' }} 
                                                {{ request()->is('admin/course/*/edit')? 'menu-open': '' }} 
                                                {{ request()->is('admin/course-topic')? 'menu-open': '' }} 
                                                {{ request()->is('admin/course-topic/create')? 'menu-open': '' }} 
                                                {{ request()->is('admin/course-topic/*/edit')? 'menu-open': '' }} 
                                                {{ request()->is('admin/course-lecture')? 'menu-open': '' }}
                                                {{ request()->is('admin/course-lecture/create')? 'menu-open': '' }} 
                                                {{ request()->is('admin/course-lecture/*/edit')? 'menu-open': '' }} 
                                                {{ request()->is('admin/course-lecture/*')? 'menu-open': '' }} 
                                                {{ request()->is('admin/intermediary_level') ? 'menu-open': '' }} 
                                                {{ request()->is(' admin/intermediary_level/create') ? 'menu-open': '' }}
                                                {{ request()->is(' admin/intermediary_level/*/edit') ? 'menu-open': '' }} 
                                                ">
                    <a href="#" class="nav-link {{ request()->is('admin/course')? 'active': '' }} 
                                                {{ request()->is('admin/course/create')? 'active': '' }} 
                                                {{ request()->is('admin/course/*')? 'active': '' }} 
                                                {{ request()->is('admin/course/*/edit')? 'active': '' }} 
                                                {{ request()->is('admin/course-topic')? 'active': '' }} 
                                                {{ request()->is('admin/course-topic/create')? 'active': '' }} 
                                                {{ request()->is('admin/course-topic/*/edit')? 'active': '' }} 
                                                {{ request()->is('admin/course-lecture')? 'active': '' }}
                                                {{ request()->is('admin/course-lecture/create')? 'active': '' }} 
                                                {{ request()->is('admin/course-lecture/*/edit')? 'active': '' }} 
                                                {{ request()->is('admin/course-lecture/*')? 'active': '' }} 
                                                {{ request()->is('admin/intermediary_level') ? 'active': '' }} 
                                                {{ request()->is(' admin/intermediary_level/create') ? 'active': '' }} 
                                                {{ request()->is(' admin/intermediary_level/*/edit') ? 'active': '' }} 
                                                ">
                        <i class="fas fa-book-open"></i>
                        <p>&nbsp; Course <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('intermediary_level.index') }}" class="nav-link 
                            {{ request()->is('admin/intermediary_level') ? 'active': '' }} {{ request()->is(' admin/intermediary_level/create') ? 'active': '' }} {{ request()->is(' admin/intermediary_level/*/edit') ? 'active': '' }} 
                            ">
                                <i class="fas fa-chalkboard"></i>
                                <p>&nbsp; Intermediary Levels </p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('course.index') }}" class="nav-link {{ request()->is('admin/course')? 'active': '' }} {{ request()->is('admin/course/*')? 'active': '' }} {{ request()->is('admin/course/*/edit')? 'active': '' }}">
                                <i class="fas fa-chalkboard"></i>
                                <p>&nbsp; Courses </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('course-topic.index') }}" class="nav-link {{ request()->is('admin/course-topic')? 'active': '' }} {{ request()->is('admin/course-topic/create')? 'active': '' }} {{ request()->is('admin/course-topic/*/edit')? 'active': '' }}">
                                <i class="fas fa-layer-group"></i>
                                <p>&nbsp; Course Topics</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('course-lecture.index') }}" class="nav-link {{ request()->is('admin/course-lecture')? 'active': '' }} {{ request()->is('admin/course-lecture/create')? 'active': '' }} {{ request()->is('admin/course-lecture/*/edit')? 'active': '' }} {{ request()->is('admin/course-lecture/*')? 'active': '' }} ">
                                <i class="fas fa-photo-video "></i>
                                <p>&nbsp; Course Lectures</p>
                            </a>
                        </li>
                    </ul>
                </li>