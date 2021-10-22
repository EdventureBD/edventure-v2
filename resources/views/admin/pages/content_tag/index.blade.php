@extends('admin.layouts.default', [
'title' => 'Content Tag',
'pageName'=>'Content Tag',
'secondPageName'=>'Content Tag'
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
                            <h3 class="card-title">Content Tag List</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <div>
                                        <a href="{{ route('tagEmptyExportCSV') }}">
                                            <button class="btn btn-info"><i class="fas fa-download"></i></i>&nbsp;&nbsp;
                                                Sample input CSV</button>
                                        </a>
                                        <a href="{{ route('contentTagExportCSV') }}">
                                            <button class="btn btn-info"><i class="fas fa-download"></i>&nbsp;&nbsp;
                                                Export content tags</button>
                                        </a>
                                        <button class="btn btn-info" type="button" data-toggle="modal"
                                            data-target="#modal-default">
                                            <i class="fas fa-upload"></i>&nbsp;&nbsp; Import content tags
                                        </button>
                                        <div class="modal fade" id="modal-default">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Import Content Tag Excel</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    {{-- <p><span class="must-filled">N.B: </span>PLEASE CAREFULL WHILE SELECTING THE FILE. YOU HAVE TO SELECT THE FILE CONTAINS THIS TOPIC REGARDING THIS TOPIC</p> --}}
                                                    <form action="{{ route('contentTagImportCSV') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="exampleInputFile">Choose file:</label>
                                                                <div class="input-group">
                                                                    <div class="custom-file">
                                                                        <input type="file" name="file"
                                                                            class="custom-file-input" id="exampleInputFile">
                                                                        <label class="custom-file-label"
                                                                            for="exampleInputFile">Choose file</label>
                                                                    </div>
                                                                </div>
                                                                @error('file')
                                                                    <p style="color: red;">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Upload</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <a href="{{ route('content-tag.create') }}">
                                            <button class="btn btn-info"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;
                                                Content Tag</button>
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
                                        <th>DB_ID</th>
                                        <th>Title</th>
                                        <th>Course</th>
                                        <th>Topic</th>
                                        <th>Lecture</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($content_tags as $content_tag)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $content_tag->id }}</td>
                                            <td>{{ $content_tag->title }}</td>
                                            <td>{{ $content_tag->courseName }}</td>
                                            <td>{{ $content_tag->topicName }}</td>
                                            <td>{{ $content_tag->courseLectureName }}</td>
                                            <td>
                                                <input type="checkbox" class="customControlInput"
                                                    id="single-col-{{ $content_tag->id }}"
                                                    data-id="{{ $content_tag->id }}" data-onstyle="success"
                                                    data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                    data-off="InActive" {{ $content_tag->status ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="mr-1"
                                                        href="{{ route('content-tag.edit', $content_tag->slug) }}"
                                                        title="Edit {{ $content_tag->title }}">
                                                        <button class="btn btn-info"><i
                                                                class="far fa-edit"></i></button>
                                                    </a>
                                                    <a class="mr-1"
                                                        href="#deleteContentTag{{ $content_tag->id }}"
                                                        data-toggle="modal" title="Delete {{ $content_tag->title }}">
                                                        <button class="btn btn-danger"><i
                                                                class="far fa-trash-alt"></i></button>
                                                    </a>
                                                    <div class="modal fade"
                                                        id="deleteContentTag{{ $content_tag->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content bg-danger">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Delete
                                                                        {{ $content_tag->title }} content tag</h4>
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
                                                                        action="{{ route('content-tag.destroy', $content_tag->slug) }}"
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
                                        <th>DB_ID</th>
                                        <th>Title</th>
                                        <th>Course</th>
                                        <th>Topic</th>
                                        <th>Lecture</th>
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
                        url: "changeContentTagStatus",
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
