@extends('admin.layouts.default', [
'title' => 'Batch Exam',
'pageName'=>'Batch Exam',
'secondPageName'=>'Batch Exam'
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
                            <h3 class="card-title">Batch Exam List</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <div>
                                        <a href="{{ route('batch-exam.create') }}">
                                            <button class="btn btn-info"><i
                                                    class="fas fa-plus-square"></i>&nbsp;&nbsp;Batch Exam </button>
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
                                        <th>Batch</th>
                                        <th>Exam</th>
                                        <th>Exam Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($batch_exams as $batch_exam)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td title="View Exam Result">
                                                <a href="{{ route('submission', [
                                                            'batch' => $batch_exam->batchSlug,
                                                            'exam' => $batch_exam->examSlug,
                                                            'exam_type' => $batch_exam->exam->exam_type,
                                                        ]) }}
                                                                            ">
                                                    {{ $batch_exam->batchTitle }}
                                                </a>
                                            </td>
                                            <td title="View Question">
                                                <a href="{{ route('exam.show', $batch_exam->examSlug) }}">
                                                    {{ $batch_exam->examTitle }}
                                                </a>
                                            </td>

                                            <td >
                                                @if ($batch_exam->exam->special)
                                                    <span class="badge bg-primary" > Special {{ $batch_exam->exam->exam_type }} </span>
                                                @else
                                                <span
                                                class="badge {{ $batch_exam->exam->exam_type == 'MCQ' ? 'bg-success' : '' }}
                                                                {{ $batch_exam->exam->exam_type == 'CQ' ? 'bg-warning' : '' }}
                                                                {{ $batch_exam->exam->exam_type == 'Assignment' ? 'bg-danger' : '' }}
                                                                {{ $batch_exam->exam->exam_type == 'Aptitude Test' ? 'bg-dark' : '' }}
                                                                {{ $batch_exam->exam->exam_type == 'Pop Quiz' ? 'bg-secondary' : '' }}
                                                                {{ $batch_exam->exam->exam_type == 'Topic End Exam' ? 'bg-info' : '' }}">
                                                {{ $batch_exam->exam->exam_type }}
                                                @endif
                                            </span>
                                            </td>

                                            <td>
                                                <input type="checkbox" class="customControlInput"
                                                    id="single-col-{{ $batch_exam->id }}"
                                                    data-id="{{ $batch_exam->id }}" data-onstyle="success"
                                                    data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                    data-off="InActive" {{ $batch_exam->status ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    {{-- <a href="{{ route('batch-lecture.edit', $batchlecture->id) }}" title="Edit {{ $batchlecture->title }}">
                                                        <button class="btn btn-info"><i class="far fa-edit"></i></button>
                                                    </a> --}}
                                                    <a class="mr-1"
                                                        href="#deleteBatchexam{{ $batch_exam->id }}" data-toggle="modal"
                                                        title="Delete {{ $batch_exam->title }}">
                                                        <button class="btn btn-danger"><i
                                                                class="far fa-trash-alt"></i></button>
                                                    </a>
                                                    <div class="modal fade"
                                                        id="deleteBatchexam{{ $batch_exam->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content bg-danger">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Delete
                                                                        {{ $batch_exam->batchTitle }} batch exam</h4>
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
                                                                        action="{{ route('batch-exam.destroy', $batch_exam->id) }}"
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
                                        <th>Batch</th>
                                        <th>Exam</th>
                                        <th>Exam Type</th>
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
                        url: "changeBatchExamStatus",
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
