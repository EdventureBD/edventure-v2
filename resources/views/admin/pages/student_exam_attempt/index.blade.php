@extends('admin.layouts.default', [
                                    'title'=>'Student Exam Attempt', 
                                    'pageName'=>'Student Exam Attempt', 
                                    'secondPageName'=>'Student Exam Attempt'
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
                            <h3 class="card-title">Batch List</h3>

                            {{-- <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <div>
                                        <a href="{{ route('batch.create') }}">
                                            <button class="btn btn-info"><i class="fas fa-plus-square"></i> Add Batch</button>
                                        </a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: auto;" >
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Exam</th>
                                        <th>Student</th>
                                        <th>Completed</th>
                                        <th>Attended At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($student_exam_attempts as $student_exam_attempt)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student_exam_attempt->examTitle }}</td>
                                            <td>{{ $student_exam_attempt->userName }}</td>
                                            <td>{{ $student_exam_attempt->is_completed }}</td>
                                            <td>{{ $student_exam_attempt->created_at->format('d-M-Y') }} at {{ $student_exam_attempt->created_at->format('H:i:s A') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    {{-- <a href="{{ route('batch.edit', $batch->slug) }}" title="Edit {{ $batch->title }}">
                                                        <button class="btn btn-info"><i class="far fa-edit"></i></button>
                                                    </a> --}}
                                                    <a href="#deleteStudentExamAttempt{{ $student_exam_attempt->id }}" data-toggle="modal" title="Delete student exam attempt">
                                                        <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                    </a>
                                                    <div class="modal fade" id="deleteStudentExamAttempt{{ $student_exam_attempt->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content bg-danger">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Delete student exam attempt</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure??</p>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                                    <form action="{{ route('student-exam-attempt.destroy', $student_exam_attempt->id) }}" method="POST">
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
                                        <th>Exam</th>
                                        <th>Student</th>
                                        <th>Completed</th>
                                        <th>Attended At</th>
                                        <th>Action</th>
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
        $(function () {
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
