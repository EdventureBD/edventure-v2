<div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Course Lecture</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="courseCategory">Category</label>
                                        <select class="form-control" id="courseCategory" wire:model="categoryId">
                                            <option value="" selected>Select course category</option>
                                            @foreach($categories as $category)
                                                <option wire:key="{{ $category->slug.$category->id }}" value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="intermediaryLevel">Intermediary Level</label>
                                        <select class="form-control" id="intermediaryLevel" wire:model="intermediaryLevelId">
                                            <option value="" selected>Select intermediary level</option>
                                            @foreach($intermediaryLevels as $intermediaryLevel)
                                                <option wire:key="{{ $intermediaryLevel->slug.$intermediaryLevel->id }}" value="{{ $intermediaryLevel->id }}">{{ $intermediaryLevel->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="course">Course</label>
                                        <select class="form-control" id="course" wire:model="courseId">
                                            <option value="" selected>Select Course</option>
                                            @foreach($courses as $course)
                                                <option wire:key="{{ $course->slug.$course->id }}" value="{{ $course->id }}">{{ $course->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="topic">Topics</label>
                                        <select class="form-control" id="topic" wire:model="topicId">
                                            <option value="" selected>Select Topic</option>
                                            @foreach($topics as $topic)
                                                <option wire:key="{{ $topic->slug.$topic->id }}" value="{{ $topic->id }}">{{ $topic->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @if ($lectures)
                                <div class="card-body table-responsive p-0" style="height: auto;" >
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SL. No</th>
                                                <th>Title</th>
                                                <th>Course</th>
                                                <th>Topic</th>
                                                <th>Exam</th>
                                                <th>video</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($lectures as $lecture)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $lecture->title }}</td>
                                                    <td>{{ $lecture->courseName }}</td>
                                                    <td>{{ $lecture->topicName }}</td>
                                                    <td>{{ $lecture->exam->title }}</td>
                                                    <td> 
                                                        <iframe width="224" height="126" src="https://www.youtube-nocookie.com/embed/{{$lecture->url }}"
                                                            title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; 
                                                            clipboard-write; encrypted-media; gyroscope;
                                                            picture-in-picture" allowfullscreen></iframe>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="customControlInput" id="single-col-{{ $lecture->id }}" data-id="{{ $lecture->id }}" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $lecture->status ? 'checked' : '' }} >
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a class="mr-1" href="{{ route('course-lecture.show', $lecture->slug) }}" title="See Details">
                                                                <button type="button" class="btn btn-primary"><i class="fas fa-eye"></i></button>
                                                            </a>
                                                            <a class="mr-1" href="{{ route('course-lecture.edit', $lecture->slug) }}" title="Edit {{ $lecture->title }}">
                                                                <button class="btn btn-info"><i class="far fa-edit"></i></button>
                                                            </a>
                                                            <a class="mr-1" href="#deleteLecture{{ $lecture->id }}" data-toggle="modal" title="Delete {{ $lecture->title }}">
                                                                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                            </a>
                                                            <div class="modal fade" id="deleteLecture{{ $lecture->id }}">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content bg-danger">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Delete {{ $lecture->title }} from {{ $lecture->courseName }} - {{ $lecture->topicName }}</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Are you sure??</p>
                                                                        </div>
                                                                        <div class="modal-footer justify-content-between">
                                                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                                            <form action="{{ route('course-lecture.destroy', $lecture->slug) }}" method="POST">
                                                                                @csrf
                                                                                @method('delete')
                                                                                    <button type="submit" class="btn btn-outline-light">Delete</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                            <!-- /.modal -->
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>SL. No</th>
                                                <th>Title</th>
                                                <th>Course</th>
                                                <th>Topic</th>
                                                <th>Exam</th>
                                                <th>video</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
