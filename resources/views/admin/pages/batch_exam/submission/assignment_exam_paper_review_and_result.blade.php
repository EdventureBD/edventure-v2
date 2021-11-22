@extends('admin.layouts.default', [
'title' => 'Exam Result Details',
'pageName'=>'Exam Result Details',
'secondPageName'=>'Exam Result Details'
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
                            <h3 class="card-title strong">Student: {{ $student->name }}&nbsp;&nbsp;|
                                Exam: {{ $exam->title }}&nbsp;&nbsp;|
                                Exam Type: {{ $exam_type }}&nbsp;</h3>|
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: auto;">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">SL. No</th>
                                        <th class="text-center">Question</th>
                                        <th class="text-center">Gain Marks</th>
                                        <th class="text-center">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exam_papers as $exam_paper)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td title="View questions">{!! $exam_paper->question !!}</td>
                                            <td class="text-center">
                                                @forelse($exam_results as $exam_result)
                                                    @if ($exam_result->question_id == $exam_paper->question_id)
                                                        {{ $exam_result->gain_marks }} /
                                                        {{ $exam_paper->assignment->marks }}
                                                    @endif
                                                @empty
                                                    / {{ $exam_paper->marks }}
                                                @endforelse
                                            </td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#editMarks{{ $exam_paper->question_id }}">
                                                    <i class="far fa-edit"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="editMarks{{ $exam_paper->question_id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    Edit Marks
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form role="form"
                                                                    action="{{ route('editAssignmetnMarks', ['batch' => $batch, 'exam' => $exam, 'exam_type' => $exam_type, 'student' => $student, 'assignment' => $exam_paper->assignment->slug]) }}"
                                                                    method="POST">
                                                                    {{ csrf_field() }}
                                                                    @forelse($exam_results as $exam_result)
                                                                        <div class="form-group row">
                                                                            <label for="" class="h6 col-sm-4">Question :
                                                                            </label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text"
                                                                                    value="{{ $exam_result->gain_marks }}"
                                                                                    name="marks" class="form-control"
                                                                                    required>
                                                                            </div>
                                                                            <input type="hidden"
                                                                                value="{{ $exam_result->question_id }}"
                                                                                name="questionID" required>
                                                                        </div>
                                                                    @empty
                                                                    @endforelse

                                                                    <div class="card-footer">
                                                                        <button type="button"
                                                                            class="btn btn-danger float-right"
                                                                            data-dismiss="modal">Cancel</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">SL. No</th>
                                        <th class="text-center">Question</th>
                                        <th class="text-center">Gain Marks</th>
                                        <th class="text-center">Edit</th>
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
            <div class="row">
                <div class="col-md-12">
                    <h3>Submitted Answer
                        @forelse ($exam_results as $exam_result)

                        @empty
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                                Give marks
                            </button>
                            <div class="modal fade" id="modal-default">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Give Marks</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form"
                                                action="{{ route('giveMarks', ['batch' => $batch, 'exam' => $exam, 'exam_type' => $exam_type, 'student' => $student]) }}"
                                                method="POST">
                                                {{ csrf_field() }}
                                                @foreach ($exam_papers as $exam_paper)
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="h6">Question
                                                            {{ $loop->iteration }}</label>
                                                        <input type="number" name="m[{{ $loop->iteration }}]"
                                                            class="form-control" id="exampleInputEmail1"
                                                            placeholder="Enter marks for question {{ $loop->iteration }}"
                                                            required>
                                                        <input type="hidden" name="q[{{ $loop->iteration }}]"
                                                            value="{{ $exam_paper->question_id }}">
                                                    </div>
                                                @endforeach
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <button type="button" class="btn btn-danger float-right"
                                                        data-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                        @endforelse
                    </h3>
                    @foreach ($exam_papers as $exam_paper)
                        @if ($loop->iteration == 1)
                            @if ($exam_paper->submitted_text)
                                <textarea name="" id="" cols="30" rows="10">{{ $exam_paper->submitted_text }}</textarea>
                            @else
                                <iframe src="{{ Storage::url($exam_paper->submitted_pdf) }}" frameborder="0" width="100%"
                                    height="600px"></iframe>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Checked Paper
                        @forelse ($exam_papers as $exam_paper)
                            @if ($loop->iteration == 1)
                                <button type="button" class="btn btn-info border border-primary ml-5 h2" data-toggle="modal"
                                    data-target="#checkedPaper">
                                    {{ $exam_paper->checked_paper == null ? 'Upload' : 'Update' }} Checked Paper
                                </button>
                                <div class="modal fade" id="checkedPaper">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">
                                                    {{ $exam_paper->checked_paper == null ? 'Upload' : 'Update' }}
                                                    Checked Paper </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form role="form"
                                                    action="{{ route('checkedPaperOfAssignment', ['batch' => $batch, 'exam' => $exam, 'exam_type' => $exam_type, 'student' => $student]) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="form-group row">
                                                        <label for="exampleInputEmail1" class="h6 col-sm-6">
                                                            {{ $exam_paper->checked_paper == null ? 'Upload' : 'Update' }}
                                                            Checked Paper
                                                        </label>
                                                        <div class="col-sm-6">
                                                            <input type="file" name="checkedPaper" class="form-control"
                                                                id="exampleInputEmail1"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <button type="button" class="btn btn-danger float-right"
                                                            data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                                @if ($exam_paper->checked_paper != null)
                                    <iframe src="{{ Storage::url($exam_paper->checked_paper) }}" frameborder="0"
                                        width="100%" height="600px"></iframe>
                                @endif
                            @endif
                        @empty

                        @endforelse
                    </h3>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
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
