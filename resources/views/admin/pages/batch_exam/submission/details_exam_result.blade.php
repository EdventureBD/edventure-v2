@extends('admin.layouts.default', [
                                    'title' => 'Exam Result Details',
                                    'pageName'=>'Exam Result Details', 
                                    'secondPageName'=>'Exam Result Details'
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
                            <h3 class="card-title strong">|Student: {{ $student->name }}&nbsp;&nbsp;|
                                Exam: {{ $exam->title }}&nbsp;&nbsp;|
                                Exam Type: {{ $exam_type }}&nbsp;</h3>|
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: auto;" >
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">SL. No</th>
                                        <th class="text-center">Question</th>
                                        <th class="text-center">Gain Marks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($details_result as $details_result)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td title="View questions">{{ $details_result->mcq }}</td>
                                            <td class="text-center">{{ $details_result->gain_marks }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">SL. No</th>
                                        <th class="text-center">Question</th>
                                        <th class="text-center">Gain Marks</th>
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
