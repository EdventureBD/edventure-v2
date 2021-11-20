@extends('admin.layouts.default', [
                                    'title'=>'Course Details', 
                                    'pageName'=>'Course Details', 
                                    'secondPageName'=>'Course Details'
                                ])

@section('css1')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
    <!-- Main content -->
    {{-- COURSE TOPIC START --}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">Course: <span style="color: lightskyblue">{{ $course->title }}</span></h1>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="row">
                           <div class="col-md-12">
                                <button class="btn btn-info float-right mt-2 mb-2 mr-2" data-toggle="modal" data-target="#course-topic">
                                    <i class="fas fa-plus-square"></i>
                                    Add Course Topic
                                </button>
                                <div class="modal fade" id="course-topic">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                @livewire('course-topic.create', ['courses' => $course])
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                           </div>
                        </div>
                        <div class="card-body table-responsive p-0" style="height: auto;" >
                            <table class="table table-bordered table-striped example1">
                                <thead>
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Name</th>
                                        <th>Course</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($course_topics as $course_topic)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                               {{ $course_topic->title }}
                                            </td>
                                            <td>{{ $course->title }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Name</th>
                                        <th>Course</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">Lectures</h1>

                            <div class="card-tools">
                               <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                               </button>
                            </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                                <a href="{{ route('addCourseLecture', $course) }}">
                                    <button class="btn btn-info float-right mt-2 mb-2 mr-2">
                                        <i class="fas fa-plus-square"></i>
                                        Add Course Lecture
                                    </button>
                                </a>
                           </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: auto;" >
                            <table class="table table-bordered table-striped example1">
                                <thead>
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Leture Title</th>
                                        <th>Topic</th>
                                        <th>Video</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lectures as $lecture)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $lecture->lectureTitle }}</td>
                                            <td>
                                               {{ $lecture->title }}
                                            </td>
                                            <td class="text-center">
                                                <iframe width="224" height="126" src="https://www.youtube-nocookie.com/embed/{{$lecture->url }}"
                                                    title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; 
                                                    clipboard-write; encrypted-media; gyroscope;
                                                    picture-in-picture" allowfullscreen></iframe>
                                                {{-- <iframe src="https://player.vimeo.com/video/{{ $lecture->url}}" width="100" frameborder="0" 
                                                    allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Leture Title</th>
                                        <th>Topic</th>
                                        <th>Video</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('js1')
    <!-- DataTables -->
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}">
    </script>
@endsection

@section('js2')
    <script>
        $(function () {
            $(".example1").DataTable();
            $('.example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });

    </script>
@endsection
