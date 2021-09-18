@extends('admin.layouts.default', [
                                    'title'=>'Request', 
                                    'pageName'=>'Request', 
                                    'secondPageName'=>'Request'
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
                            <h3 class="card-title">Request List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: auto;" >
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Name</th>
                                        <th>Course</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Payment Type</th>
                                        <th>Payment Account Number</th>
                                        <th>TRX ID</th>
                                        <th>Amount</th>
                                        <th>Days For</th>
                                        <th>Assign to a batch</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($enrollRequests as $enrollRequest)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $enrollRequest->name }}</td>
                                            <td>{{ $enrollRequest->courseTitle }}</td>
                                            <td>{{ $enrollRequest->email }}</td>
                                            <td>{{ $enrollRequest->contact }}</td>
                                            <td>{{ $enrollRequest->payment_type }}</td>
                                            <td>0{{ $enrollRequest->payment_account_number }}</td>
                                            <td>{{ $enrollRequest->trx_id }}</td>
                                            <td>{{ $enrollRequest->amount }}</td>
                                            <td>{{ $enrollRequest->days_for }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#e{{ $enrollRequest->id }}">
                                                    Assign
                                                </button>
                                                <div class="modal fade" id="e{{ $enrollRequest->id }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                @livewire('batch.assign-student',   ['studentId' => $enrollRequest->student_id, 
                                                                                                    'courseId' => $enrollRequest->course_id, 
                                                                                                    'paymentId' => $enrollRequest->id,
                                                                                                    'enrollRequest' => $enrollRequest], key($enrollRequest->student_id->id))
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.modal -->
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Name</th>
                                        <th>Course</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Payment Type</th>
                                        <th>Payment Account Number</th>
                                        <th>TRX ID</th>
                                        <th>Amount</th>
                                        <th>Days For</th>
                                        <th>Assign to a batch</th>
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
    <script>
        $(function() {
            $('.customControlInput').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0; 
                var id = $(this).data('id'); 
                // console.log(id);
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "changerequestStatus",
                    data: {'status': status, 'id': id},
                    success: function(data){
                        console.log(data.success);
                    }
                });
            })
        })
    </script>
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
