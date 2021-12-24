@extends('admin.layouts.default', [
                                    'title'=>'Payment', 
                                    'pageName'=>'Payment', 
                                    'secondPageName'=>'Payment'
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
                            <h3 class="card-title">Payment List</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <div>
                                        <a href="{{ route('payment.create') }}">
                                            <button class="btn btn-info"><i class="fas fa-plus-square"></i> Add payment</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: auto;" >
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Student</th>
                                        <th>Course</th>
                                        <th>Trx id</th>
                                        <th>Payment type</th>
                                        <th>Amount</th>
                                        <th>Account number</th>
                                        <th>Days</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payments as $payment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $payment->name }}</td>
                                            <td>{{ $payment->title }}</td>
                                            <td>{{ $payment->trx_id }}</td>
                                            <td>{{ $payment->payment_type }}</td>
                                            <td>{{ $payment->amount }}</td>
                                            <td>0{{ $payment->payment_account_number }}</td>
                                            <td>{{ $payment->days_for }}</td>
                                            <td>{{ $payment->created_at->format('H:m A D-M-Y') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('payment.edit', $payment->id) }}" title="Edit {{ $payment->title }}">
                                                        <button class="btn btn-info"><i class="far fa-edit"></i></button>
                                                    </a>
                                                    <a href="#deletePayment{{ $payment->id }}" data-toggle="modal" title="Delete {{ $payment->title }}">
                                                        <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                    </a>
                                                    <div class="modal fade" id="deletePayment{{ $payment->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content bg-danger">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Delete Payment</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure??</p>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                                    <form action="{{ route('payment.destroy', $payment->id) }}" method="POST">
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
                                        <th>Student</th>
                                        <th>Course</th>
                                        <th>Trx id</th>
                                        <th>Payment type</th>
                                        <th>Amount</th>
                                        <th>Account number</th>
                                        <th>Days</th>
                                        <th>Date</th>
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
