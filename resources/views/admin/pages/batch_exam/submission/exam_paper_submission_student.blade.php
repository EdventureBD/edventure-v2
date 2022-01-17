@extends('admin.layouts.default', [
'title' => 'Exam Result',
'pageName'=>'Exam Result',
'secondPageName'=>'Exam Result'
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
                            <h3 class="card-title">Exam Result</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: auto;">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">SL. No</th>
                                        <th class="text-center">Student</th>
                                        <th class="text-center">Batch</th>
                                        <th class="text-center">Exam</th>
                                        <th class="text-center">Exam Type</th>
                                        <th class="text-center">Gain Marks</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($student_exam_attempts as $student_exam_attempt)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $student_exam_attempt->student->name }}</td>
                                            <td class="text-center">{{ $batch->title }}</td>
                                            <td class="text-center">{{ $student_exam_attempt->exam->title }}</td>
                                            <td class="text-center">
                                                <span
                                                    class="badge {{ $student_exam_attempt->exam->exam_type == 'MCQ' ? 'bg-primary' : '' }}
                                                                 {{ $student_exam_attempt->exam->exam_type == 'CQ' ? 'bg-warning' : '' }}
                                                                 {{ $student_exam_attempt->exam->exam_type == 'Assignment' ? 'bg-danger' : '' }}">
                                                    {{ $student_exam_attempt->exam->exam_type }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @foreach ($exam_results as $exam_result)
                                                    @if ($exam_result->student_id == $student_exam_attempt->student_id)
                                                        {{ $exam_result->gain_marks }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center">
                                                <a
                                                    href="{{ route('seeDetails', [
                                                    'batch' => $batch,
                                                    'student' => $student_exam_attempt->student,
                                                    'exam' => $student_exam_attempt->exam,
                                                    'exam_type' => $student_exam_attempt->exam->exam_type,
                                                ]) }}">See
                                                    Details</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">SL. No</th>
                                        <th class="text-center">Student</th>
                                        <th class="text-center">Batch</th>
                                        <th class="text-center">Exam</th>
                                        <th class="text-center">Exam Type</th>
                                        <th class="text-center">Gain Marks</th>
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
