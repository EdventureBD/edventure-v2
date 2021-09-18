@extends('admin.layouts.default', [
                                    'title'=>'Batch', 
                                    'pageName'=>'Batch', 
                                    'secondPageName'=>'Batch'
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

                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <div>
                                        <a href="{{ route('batch.create') }}">
                                            <button class="btn btn-info"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;Batch</button>
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
                                        <th>Title</th>
                                        <th>Batch Running Days</th>
                                        <th>Course</th>
                                        <th>Teacher</th>
                                        <th>Student Limit</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($batches as $batch)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="{{ route('batch.show', $batch->slug) }}">{{ $batch->title }}</a>
                                            </td>
                                            <td>@livewire('batch.increment', ['batch_running_days' => $batch->batch_running_days, 'batch_id' => $batch->id], key($batch->id))</td>
                                            <td>{{ $batch->courseName }}</td>
                                            <td>{{ $batch->userName }}</td>
                                            <td>{{ $batch->student_limit }}</td>
                                            <td>
                                                <input type="checkbox" class="customControlInput" id="single-col-{{ $batch->id }}" data-id="{{ $batch->id }}" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $batch->status ? 'checked' : '' }} >
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="mr-1" href="{{ route('batch.show', $batch->slug) }}" title="See Details">
                                                        <button type="button" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                                    </a>
                                                    <a class="mr-1" href="{{ route('batch.edit', $batch->slug) }}" title="Edit {{ $batch->title }}">
                                                        <button class="btn btn-info"><i class="far fa-edit"></i></button>
                                                    </a>
                                                    <a class="mr-1" href="#deleteBatch{{ $batch->id }}" data-toggle="modal" title="Delete {{ $batch->title }}">
                                                        <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                    </a>
                                                    <div class="modal fade" id="deleteBatch{{ $batch->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content bg-danger">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Delete {{ $batch->title }} batch</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure?? <br> If you delete this batch everything related to this batch will be deleted. Such as batch lectures, batch exam etc.</p>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                                    <form action="{{ route('batch.destroy', $batch->slug) }}" method="POST">
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
                                        <th>Title</th>
                                        <th>Batch Running Days</th>
                                        <th>Course</th>
                                        <th>Teacher</th>
                                        <th>Student Limit</th>
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
                        url: "changeBatchStatus",
                        data: {'status': status, 'id': id},
                        success: function(data){
                            console.log(data.success);
                        }
                    });k
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
