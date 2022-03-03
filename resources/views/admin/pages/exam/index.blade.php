@extends('admin.layouts.default', [
'title' => 'Exam',
'pageName'=>'Exam list',
'secondPageName'=>'Exam'
])

@section('css1')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Exams</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <div>
                                        @if (Route::is('exam.index'))
                                            <a href="{{ route('examExportCSV') }}">
                                                <button class="btn btn-info"><i
                                                        class="fas fa-download"></i>&nbsp;&nbsp;Export Exams</button>
                                            </a>
                                        @endif
                                        <a href="{{ route('exam.create') }}">
                                            <button class="btn btn-info"><i
                                                    class="fas fa-plus-square"></i>&nbsp;&nbsp;Exam</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: auto;">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">SL. No</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Course</th>
                                        <th class="text-center">Topic</th>
                                        <th class="text-center">Exam Type</th>
                                        <th class="text-center">Threshold Marks</th>
                                        <th class="text-center">MCQ Limit</th>
                                        <th class="text-center">CQ Limit</th>
                                        <th class="text-center">Order</th>
                                        <th class="text-center">Add Question</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exams as $exam)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td title="View Questions">
                                                <a href="{{ route('exam.show', $exam->slug) }}">
                                                    @if($exam->special)<b>{{ $exam->title }}</b> @else{{ $exam->title }} @endif
                                                </a>
                                            </td>
                                            <td class="text-center"><a target="blank" href="/admin/course/{{ $exam->course->slug }}">{{ $exam->course->title }}</a></td>
                                            <td class="text-center">
                                                @if (!empty($exam->topic_id))
                                                    {{ $exam->topic->title }}
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                @if ($exam->special)
                                                    <span class="badge bg-primary" > Special {{ $exam->exam_type }} </span>
                                                @else
                                                    <span                                                   
                                                        class="badge
                                                                    {{-- {{ $exam->exam_type == 'MCQ' ? 'bg-success' : '' }}
                                                                    {{ $exam->exam_type == 'CQ' ? 'bg-warning' : '' }}
                                                                    {{ $exam->exam_type == 'Assignment' ? 'bg-danger' : '' }}
                                                                    {{ $exam->exam_type == 'Aptitude Test' ? 'bg-dark' : '' }}
                                                                    {{ $exam->exam_type == 'Pop Quiz' ? 'bg-secondary' : '' }}
                                                                    {{ $exam->exam_type == 'Topic End Exam' ? 'bg-info' : '' }}" --}}

                                                                    {{ $exam->exam_type == 'Aptitude Test' ? 'bg-success' : '' }}
                                                                    {{ $exam->exam_type == 'Pop Quiz' ? 'bg-warning' : '' }}
                                                                    {{ $exam->exam_type == 'Topic End Exam' ? 'bg-info' : '' }}"
                                                                    >
                                                        
                                                        {{ $exam->exam_type }}
                                                    </span>
                                                @endif
                                            </td>
                                            
                                            <td title="Duration: {{ $exam->duration }} Q-Limit: {{ $exam->question_limit }} " class="text-center">{{ $exam->threshold_marks }}</td>
                                            <td class="text-center">{{ $exam->question_limit }}</td>
                                            <td class="text-center"> @if($exam->exam_type == "Pop Quiz" || $exam->exam_type == "Topic End Exam") {{ $exam->question_limit_2 }} @else N/A @endif</td>

                                            <td class="text-center">
                                                @if($exam->exam_type === "Pop Quiz")
                                                    {{ $exam->order }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td class="text-center">

                                                @if ($exam->exam_type == "Pop Quiz")
                                                    <a href="{{ route('addQuestion_CQ_only', $exam->slug) }}">
                                                        <button class="btn btn-info"><i
                                                                class="fas fa-plus-square pr-1"></i>CQ</button>
                                                    </a>

                                                    <a href="{{ route('addQuestion_MCQ_only', $exam->slug) }}">
                                                        <button class="btn btn-info"><i
                                                                class="fas fa-plus-square pr-1"></i>MCQ</button>
                                                    </a>
                                                @elseif($exam->exam_type == "Topic End Exam")
                                                    <a href="{{ route('addQuestion_CQ_only', $exam->slug) }}">
                                                        <button class="btn btn-info"><i
                                                                class="fas fa-plus-square pr-1"></i>CQ</button> 
                                                    </a>

                                                    <a href="{{ route('addQuestion_MCQ_only', $exam->slug) }}">
                                                        <button class="btn btn-info"><i
                                                                class="fas fa-plus-square pr-1"></i>MCQ</button>
                                                    </a>
                                                @elseif($exam->exam_type == "MCQ")
                                                    <a href="{{ route('addQuestion', $exam->slug) }}">
                                                        <button class="btn btn-info"><i
                                                                class="fas fa-plus-square pr-1"></i>MCQ</button>
                                                    </a>
                                                @elseif($exam->exam_type == "CQ")
                                                    <a href="{{ route('addQuestion', $exam->slug) }}">
                                                        <button class="btn btn-info"><i
                                                                class="fas fa-plus-square pr-1"></i>CQ</button>
                                                    </a>
                                                @elseif($exam->exam_type == "Assignment")
                                                    <a href="{{ route('addQuestion', $exam->slug) }}">
                                                        <button class="btn btn-info"><i
                                                                class="fas fa-plus-square pr-1"></i>Assignment Paper</button>
                                                    </a>
                                                @elseif($exam->exam_type == "Aptitude Test")
                                                    <a href="{{ route('addQuestion', $exam->slug) }}">
                                                        <button class="btn btn-info"><i
                                                                class="fas fa-plus-square pr-1"></i>MCQ</button>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="mr-1"
                                                        href="{{ route('exam.edit', $exam->slug) }}"
                                                        title="Edit {{ $exam->title }}">
                                                        <button class="btn btn-info"><i
                                                                class="far fa-edit"></i></button>
                                                    </a>
                                                    <a class="mr-1" href="#deleteExam{{ $exam->id }}"
                                                        data-toggle="modal" title="Delete {{ $exam->title }}">
                                                        <button class="btn btn-danger"><i
                                                                class="far fa-trash-alt"></i></button>
                                                    </a>
                                                    <div class="modal fade" id="deleteExam{{ $exam->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content bg-danger">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Delete {{ $exam->title }}
                                                                    </h4>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure??</p>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-outline-light"
                                                                        data-dismiss="modal">Close</button>
                                                                    <form
                                                                        action="{{ route('exam.destroy', $exam->slug) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit"
                                                                            class="btn btn-outline-light">Delete</button>
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
                                        <th class="text-center">SL. No</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Course</th>
                                        <th class="text-center">Topic</th>
                                        <th class="text-center">Exam Type</th>
                                        <th class="text-center">Threshold Marks</th>
                                        <th class="text-center">MCQ Limit</th>
                                        <th class="text-center">CQ Limit</th>
                                        <th class="text-center">Order</th>                                   
                                        <th class="text-center">Add Question</th>
                                        <th class="text-center">Action</th>
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
    <script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}">
    </script>
@endsection

@section('js2')
    <script>
        $(function() {
            $("#example1").DataTable();
            $('#example2').DataTable({
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
