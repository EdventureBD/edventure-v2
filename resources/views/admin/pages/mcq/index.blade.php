@extends('admin.layouts.default', [
'title' => 'MCQ',
'pageName'=>'MCQ Questions',
'secondPageName'=>'MCQ'
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
                                        <a href="{{ route('emptyMCQ') }}">
                                            <button type="button" class="btn btn-info">
                                                <i class="fas fa-download"></i> Sample Excel
                                            </button>
                                        </a>
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#modal-default">
                                            <i class="fas fa-plus-square"></i> Import Ques
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
                                                    class="fas fa-plus-square"></i>&nbsp;&nbsp;MCQ</button>
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
                                        <th>Question</th>
                                        <th>Image</th>
                                        <th>Field 1</th>
                                        <th>Field 2</th>
                                        <th>Field 3</th>
                                        <th>Field 4</th>
                                        <th>Answer</th>
                                        <th>Exam</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mcqs as $mcq)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{!! $mcq->question !!}</td>
                                            <td>
                                                <img class="product-image-thumb" src="{{ $mcq->image }}"
                                                    alt="">
                                            </td>
                                            <td>{!! $mcq->field1 !!}</td>
                                            <td>{!! $mcq->field2 !!}</td>
                                            <td>{!! $mcq->field3 !!}</td>
                                            <td>{!! $mcq->field4 !!}</td>
                                            <td>
                                                @if ($mcq->answer == 1)
                                                    {!! $mcq->field1 !!}
                                                @elseif(($mcq->answer) == 2)
                                                    {!! $mcq->field2 !!}
                                                @elseif(($mcq->answer) == 3)
                                                    {!! $mcq->field3 !!}
                                                @elseif(($mcq->answer) == 4)
                                                    {!! $mcq->field4 !!}
                                                @endif
                                            </td>
                                            <td>{{ $mcq->examTitle }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="mr-1"
                                                        href="{{ route('mcq.show', [$exam->slug, $mcq->slug]) }}"
                                                        title="See Details">
                                                        <button type="button" class="btn btn-info"><i
                                                                class="fas fa-eye"></i></button>
                                                    </a>
                                                    <a class="mr-1"
                                                        href="{{ route('mcq.edit', [$exam->slug, $mcq->slug]) }}"
                                                        title="Edit {{ $mcq->question }}">
                                                        <button class="btn btn-info"><i
                                                                class="far fa-edit"></i></button>
                                                    </a>
                                                    <a class="mr-1" href="#deleteMCQ{{ $mcq->id }}"
                                                        data-toggle="modal" title="Delete {{ $mcq->question }}">
                                                        <button class="btn btn-danger"><i
                                                                class="far fa-trash-alt"></i></button>
                                                    </a>
                                                    <div class="modal fade" id="deleteMCQ{{ $mcq->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content bg-danger">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Delete MCQ
                                                                        {!! $mcq->question !!}</h4>
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
                                                                        action="{{ route('mcq.destroy', [$exam->slug, $mcq->slug]) }}"
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
                                        <th>Question</th>
                                        <th>Image</th>
                                        <th>Field 1</th>
                                        <th>Field 2</th>
                                        <th>Field 3</th>
                                        <th>Field 4</th>
                                        <th>Ansewer</th>
                                        <th>Exam</th>
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
