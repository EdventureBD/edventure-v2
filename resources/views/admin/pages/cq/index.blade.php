@extends('admin.layouts.default', [
'title' => 'CQ',
'pageName'=>'CQ Questions',
'secondPageName'=>'CQ'
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
                            <h3 class="card-title"><b>Course :</b> {{ $exam->course->title }}<br>
                                @if (!empty($exam->topic) && !is_null($exam->topic))<b>Topic :</b> {{ $exam->topic->title }} <br> @endif
                                <b>Exam :</b> {{ $exam->title }}
                            </h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <div>
                                        {{-- <a href="{{ route('slugExport') }}">
                                            <button class="btn btn-info">
                                                <i class="fas fa-download"></i>&nbsp;&nbsp;Export Slug
                                            </button>
                                        </a> --}}

                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#slug">
                                            <i class="fas fa-plus-square"></i> Create slugs
                                        </button>
                                        <div class="modal fade" id="slug">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Created Slug</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <di class="row">
                                                        <div class="modal-body">
                                                            <form action="{{ route('slugExport') }}">
                                                                {{ csrf_field() }}
                                                                <div class="form-group">
                                                                    <label for="slug">Slug Creations</label>
                                                                    <input class="form-control form-control-lg"
                                                                        type="number" name="slug" id="slug" required>
                                                                    <small class="form-text text-muted">
                                                                        Enter how many slugs do you need
                                                                    </small>
                                                                </div>
                                                                <button type="submit"
                                                                    class="btn btn-primary float-right">Export</button>
                                                            </form>
                                                        </div>
                                                    </di>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <a href="{{ route('emptyCQ') }}">
                                            <button type="button" class="btn btn-info">
                                                <i class="fas fa-download"></i> Download an empty csv file
                                            </button>
                                        </a>
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#modal-default">
                                            <i class="fas fa-plus-square"></i> Import from excel
                                        </button>

                                        <div class="modal fade" id="modal-default">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Import Question from Excel</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <p><span class="must-filled">N.B: </span>PLEASE CAREFULL WHILE
                                                        SELECTING THE FILE. YOU HAVE TO SELECT THE FILE CONTAINS THIS TOPIC
                                                        REGARDING THIS TOPIC</p>
                                                    <form action="{{ route('excelAddQuestion', $exam->slug) }}"
                                                        method="POST" enctype="multipart/form-data">
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
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Import</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                        <a href="{{ route('addQuestion', $exam->slug) }}">
                                            <button class="btn btn-info"><i
                                                    class="fas fa-plus-square"></i>&nbsp;&nbsp;CQ</button>
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
                                        <th>উদ্দীপক</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cqs as $cq)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{-- <a href="{{  }}"></a> --}}
                                                {!! $cq->creative_question !!}
                                            </td>
                                            <td>
                                                <img class="product-image-thumb" src="{{ Storage::url($cq->image) }}"
                                                    alt="">
                                                {{-- <img src="{{ Storage::url($cq->image) }}" alt="{{ $cq->question }}"> --}}
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="mr-1"
                                                        href="{{ route('cq.show', [$exam->slug, $cq->slug]) }}"
                                                        title="See Details">
                                                        <button type="button" class="btn btn-info">
                                                            <i class="fas fa-eye"></i></button>
                                                    </a>
                                                    <a class="mr-1"
                                                        href="{{ route('cq.edit', [$exam->slug, $cq->slug]) }}"
                                                        title="Edit">
                                                        <button class="btn btn-info">
                                                            <i class="far fa-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a class="mr-1" href="#deletecq{{ $cq->id }}"
                                                        data-toggle="modal" title="Delete">
                                                        <button class="btn btn-danger"><i
                                                                class="far fa-trash-alt"></i></button>
                                                    </a>
                                                    <div class="modal fade" id="deletecq{{ $cq->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content bg-danger">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Delete cq</h4>
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
                                                                        action="{{ route('cq.destroy', [$exam->slug, $cq->slug]) }}"
                                                                        method="POST">
                                                                        {{ csrf_field() }}
                                                                        @method('delete')
                                                                        <button type="submit"
                                                                            class="btn btn-outline-light">Delete
                                                                        </button>
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
                                        <th>Question</th>
                                        <th>Image</th>
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
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                // console.log(id);
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
