@extends('admin.layouts.default', [
                                    'title'=>'Course Category', 
                                    'pageName'=>'Course Category', 
                                    'secondPageName'=>'Course Category'
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
                        <h3 class="card-title"> Total category: {{ $total }}</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <div>
                                    <a href="{{ route('course-category.create') }}">
                                        <button class="btn btn-info"><i class="fas fa-plus-square"></i> Course Category</button>
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
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ route('course-category.show', $category->slug) }}">
                                                {{ $category->title }}
                                            </a>
                                        </td>                                    
                                        <td>
                                              <input type="checkbox" class="customControlInput" id="single-col-{{ $category->id }}" data-id="{{ $category->id }}" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $category->status ? 'checked' : '' }} >
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group ">
                                                <a class="mr-1" href="{{ route('course-category.edit', $category->slug) }}" title="Edit {{ $category->title }}">
                                                    <button class="btn btn-info"><i class="far fa-edit"></i></button>
                                                </a>
                                                <a class="mr-1" href="#deleteCourseCategory{{ $category->id }}" data-toggle="modal" title="Delete {{ $category->title }}">
                                                    <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                </a>
                                                <div class="modal fade" id="deleteCourseCategory{{ $category->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content bg-danger">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Delete {{$category->title}} Category</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>
                                                                    Are you sure?
                                                                    <br> If you delete this category anything related to this category will be deleted. Such as Course, Course lecture, Course topics, Batches etc.
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                                <form action="{{ route('course-category.destroy', $category->slug) }}" method="POST">
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
                        url: "changeCoursCategoryStatus",
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
