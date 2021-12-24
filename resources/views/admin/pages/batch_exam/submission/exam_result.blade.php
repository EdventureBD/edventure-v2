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
                        <div class="card-body table-responsive p-0" style="height: auto;" >
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
                                    @foreach($exam_results as $exam_result)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $exam_result->student->name }}</td>
                                            <td class="text-center">{{ $exam_result->batch->title }}</td>
                                            <td class="text-center">{{ $exam_result->exam->title }}</td>
                                            <td class="text-center">
                                                <span
                                                    class="badge {{ $exam_result->exam->exam_type == 'MCQ' ? 'bg-primary': '' }}
                                                                 {{ $exam_result->exam->exam_type == 'CQ' ? 'bg-warning': '' }}
                                                                 {{ $exam_result->exam->exam_type == 'Assignment' ? 'bg-danger': '' }}">
                                                    {{ $exam_result->exam->exam_type }}
                                                </span>
                                            </td>
                                            <td class="text-center">{{ $exam_result->gain_marks }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('seeDetails', [
                                                    'batch' => $exam_result->batch,
                                                    'student' => $exam_result->student,
                                                    'exam' => $exam_result->exam,
                                                    'exam_type' => $exam_result->exam->exam_type
                                                ]) }}">See Details</a>
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
