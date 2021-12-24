@extends('admin.layouts.default', [
'title'=>'Course',
'pageName'=>'Course',
'secondPageName'=>'Course'
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
                            <h3 class="card-title">Courses</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <div>
                                        <a href="{{ route('courseCSV') }}">
                                            <button class="btn btn-info"><i class="fas fa-download"></i>&nbsp;&nbsp;
                                                Export Courses
                                            </button>
                                        </a>
                                        <a href="{{ route('course.create') }}">
                                            <button class="btn btn-info"><i
                                                    class="fas fa-plus-square"></i>&nbsp;&nbsp;Course</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: auto;">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Icon</th>
                                        <th>Price</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="{{ route('course.show', $course->slug) }}" title="See Details">
                                                    {{ $course->title }}
                                                </a>
                                            </td>
                                            <td>{{ $course->name }}</td>
                                            <td>
                                                <img class="product-image " src="{{$course->icon}}" alt=""
                                                    srcset="">
                                            </td>

                                            <td>{{ $course->price }} taka</td>
                                            <td>{{ $course->duration }} month</td>
                                            <td>
                                                <input type="checkbox" class="customControlInput"
                                                    id="single-col-{{ $course->id }}" data-id="{{ $course->id }}"
                                                    data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                    data-on="Active" data-off="InActive"
                                                    {{ $course->status ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="mr-1"
                                                        href="{{ route('course.show', $course->slug) }}"
                                                        title="See Details">
                                                        <button type="button" class="btn btn-success"><i
                                                                class="fas fa-eye"></i></button>
                                                    </a>
                                                    <a class="mr-1"
                                                        href="{{ route('course.edit', $course->slug) }}"
                                                        title="Edit {{ $course->title }}">
                                                        <button type="button" class="btn btn-info"><i
                                                                class="far fa-edit"></i></button>
                                                    </a>
                                                    <a class="mr-1" href="#deleteCourse{{ $course->id }}"
                                                        data-toggle="modal" title="Delete {{ $course->title }}">
                                                        <button type="button" class="btn btn-danger"><i
                                                                class="far fa-trash-alt"></i></button>
                                                    </a>
                                                    <div class="modal fade" id="deleteCourse{{ $course->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content bg-danger">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Delete
                                                                        {{ $course->title }} Course</h4>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure??</p>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-outline-light"
                                                                        data-dismiss="modal">Close</button>
                                                                    <form
                                                                        action="{{ route('course.destroy', $course->slug) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit"
                                                                            class="btn btn-outline-light">Delete</button>
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
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Icon</th>
                                        <th>Price</th>
                                        <th>Duration</th>
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
                if (confirm("Do you want to change the status?")) {
                    var status = $(this).prop('checked') == true ? 1 : 0;
                    var id = $(this).data('id');
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: "changeCourseStatus",
                        data: {
                            'status': status,
                            'id': id
                        },
                        success: function(data) {
                            console.log(data.success);
                        }
                    });
                } else {
                    if ($("#single-col-" + $(this).data('id')).prop("checked") == true) {
                        $("#single-col-" + $(this).data('id')).prop('checked', false);
                    } else if ($("#single-col-" + $(this).data('id')).prop("checked") == false) {
                        $("#single-col-" + $(this).data('id')).prop('checked', true);
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
