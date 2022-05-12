@extends('admin.layouts.default', [
                                    'title' => 'Add Batch to Island',
                                    'pageName'=>'Add Batch to Islands', 
                                    'secondPageName'=>'Add Batch to Islands'
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
                            <h3 class="card-title">List of Associations</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <div>
                                        <a href="{{ route('batch-lecture.create') }}">
                                            <button class="btn btn-info"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;Add Batch to Island</button>
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
                                        <th>Batch</th>
                                        <th>Course</th>
                                        <th>Island</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($batchlectures as $batchlecture)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $batchlecture->batchName }}</td>
                                            <td>{{ $batchlecture->courseName }}</td>
                                            <td>{{ $batchlecture->courseTopicName }}</td>
                                            <td>
                                                <input type="checkbox" class="customControlInput" id="single-col-{{ $batchlecture->id }}" data-id="{{ $batchlecture->id }}" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $batchlecture->status ? 'checked' : '' }} >
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    {{-- <a href="{{ route('batch-lecture.edit', $batchlecture->id) }}" title="Edit {{ $batchlecture->title }}">
                                                        <button class="btn btn-info"><i class="far fa-edit"></i></button>
                                                    </a> --}}
                                                    <a href="#deleteBatchlecture{{ $batchlecture->id }}" data-toggle="modal" title="Delete {{ $batchlecture->title }}">
                                                        <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                    </a>
                                                    <div class="modal fade" id="deleteBatchlecture{{ $batchlecture->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content bg-danger">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Delete {{ $batchlecture->batchName }} Add Batch to Island</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure??</p>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                                    <form action="{{ route('batch-lecture.destroy', $batchlecture->id) }}" method="POST">
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
                                        <th>batch</th>
                                        <th>Course</th>
                                        <th>Island</th>
                                        <th>Status</th>
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
    <script>
        $(function() {
            $('.customControlInput').change(function() {
                if(confirm("Do you want to change the status?")){
                    var status = $(this).prop('checked') == true ? 1 : 0; 
                    var id = $(this).data('id');     
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: "changeBatchLectureStatus",
                        data: {'status': status, 'id': id},
                        success: function(data){
                            console.log(data.success);
                        }
                    });
                } else {
                    if($("#single-col-"+$(this).data('id')).prop("checked") == true){
                         $("#single-col-"+$(this).data('id')).prop('checked', false);
                    }
                    else if($("#single-col-"+$(this).data('id')).prop("checked") == false){
                         $("#single-col-"+$(this).data('id')).prop('checked', true);
                    }
                }
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
