@extends('admin.layouts.default', [
                                    'title'=>'Activity', 
                                    'pageName'=>'Activity', 
                                    'secondPageName'=>'Activity'
                                   ])

@section('css1')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DataTable with default features</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Log Name</th>
                                    <th>Date and time</th>
                                    <th>Description</th>
                                    <th>Subject</th>
                                    <th>Ip</th>
                                    <th>Agent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activites as $activity)
                                    <tr>
                                        <td>{{ $activity->log_name }}</td>
                                        <td>{{ $activity->created_at->format('d-M-Y') }} at {{ $activity->created_at->format('G:i a') }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $activity->description == 'created' ? 'bg-primary': '' }}
                                                                {{ $activity->description == 'updated' ? 'bg-warning': '' }}
                                                                {{ $activity->description == 'deleted' ? 'bg-danger': '' }}">
                                                {{ $activity->description }}
                                            </span>
                                        </td>
                                        <td>{{ $activity->subject_type }}</td>
                                        <td>{{ $activity->causer_type }}</td>
                                        <td>{{ $activity->causer }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Log Name</th>
                                    <th>Date and time</th>
                                    <th>Description</th>
                                    <th>Subject</th>
                                    <th>Ip</th>
                                    <th>Agent</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
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
