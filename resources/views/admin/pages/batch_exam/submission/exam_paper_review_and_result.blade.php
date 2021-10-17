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
                            <h3 class="card-title strong">
                                |Student: {{ $student->name }}&nbsp;&nbsp;|
                                Exam: {{ $exam->title }}&nbsp;&nbsp;|
                                Exam Type: {{ $exam_type }}&nbsp;
                            </h3>|
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
                                            <td style="width: 70px">{{ $loop->iteration }}</td>
                                            <td title="View questions">
                                                <span>
                                                    {!! $exam_paper->creativeQuestion->creative_question !!}
                                                    @if ($exam_paper->creativeQuestion->image)
                                                        <img src="{{ Storage::url($exam_paper->creativeQuestion->image) }}"
                                                            alt="Avatar" class="avatar-img rounded" width="50px"
                                                            height="50px">
                                                    @endif
                                                </span>
                                                @foreach ($exam_paper->creativeQuestion->question as $key => $cq)
                                                    <span class="d-flex flex-row">
                                                        {{ $loop->iteration }}. &nbsp; {!! $cq->question !!}
                                                        @if ($cq->image)
                                                            <img src="{{ Storage::url($cq->image) }}" alt="Avatar"
                                                                class="avatar-img rounded" width="50px" height="50px">
                                                        @endif
                                                    </span><br>
                                                @endforeach
                                            </td>
                                            <td class="text-justify">
                                                @forelse($exam_results as $exam_result)
                                                    @if ($exam_paper->creative_question_id == $exam_result->cqQuestion->creativeQuestion->id)
                                                        @if ($exam_result->marks == 1)
                                                            জ্ঞানমূলক : {{ $exam_result->gain_marks }} /
                                                            {{ $exam_result->marks }} <br>
                                                        @endif
                                                        @if ($exam_result->marks == 2)
                                                            অনুধাবন :
                                                            {{ $exam_result->gain_marks }} / {{ $exam_result->marks }}
                                                            <br>
                                                        @endif
                                                        @if ($exam_result->marks == 3)
                                                            প্রয়োগমূলক :
                                                            {{ $exam_result->gain_marks }} / {{ $exam_result->marks }}
                                                            <br>
                                                        @endif
                                                        @if ($exam_result->marks == 4)
                                                            উচ্চতর দক্ষতা :
                                                            {{ $exam_result->gain_marks }} / {{ $exam_result->marks }}
                                                            <br>
                                                        @endif
                                                    @endif
                                                @empty
                                                    No marks
                                                @endforelse
                                            </td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#editMarks{{ $exam_paper->creative_question_id }}">
                                                    <i class="far fa-edit"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade"
                                                    id="editMarks{{ $exam_paper->creative_question_id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Modal
                                                                    title</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form role="form"
                                                                    action="{{ route('editMarks', [
    'batch' => $batch,
    'exam' => $exam,
    'exam_type' => $exam_type,
    'student' => $student,
    'creative_question' => $exam_paper->creativeQuestion->slug,
]) }}"
                                                                    method="POST">
                                                                    {{ csrf_field() }}
                                                                    Question {{ $loop->iteration }}
                                                                    {{-- @foreach ($exam_paper->creativeQuestion->question as $key => $cq)
                                                                        <div class="form-group row">
                                                                            <label for="exampleInputEmail1"
                                                                                class="h6 col-sm-4">
                                                                                @if ($cq->marks == 1)
                                                                                    জ্ঞানমূলক
                                                                                @elseif($cq->marks == 2) অনুধাবন
                                                                                @elseif($cq->marks == 3)প্রয়োগমূলক
                                                                                @elseif($cq->marks == 4)উচ্চতর
                                                                                    দক্ষতা
                                                                                @endif
                                                                            </label>
                                                                            <div class="col-sm-8">
                                                                                <input type="number"
                                                                                    name="m[{{ $cq->id }}]"
                                                                                    class="form-control"
                                                                                    id="exampleInputEmail1" value=""
                                                                                    placeholder="Enter marks for {{ $cq->marks == 1 ? 'জ্ঞানমূলক' : '' }} {{ $cq->marks == 2 ? 'অনুধাবন' : '' }} {{ $cq->marks == 3 ? 'প্রয়োগমূলক' : '' }} {{ $cq->marks == 4 ? 'উচ্চতর দক্ষতা' : '' }}"
                                                                                    required>
                                                                            </div>
                                                                            <input type="hidden" name="q[]"
                                                                                value="{{ $cq->id }}">
                                                                        </div>
                                                                    @endforeach --}}

                                                                    @forelse($exam_results as $exam_result)
                                                                        @if ($exam_paper->creative_question_id == $exam_result->cqQuestion->creativeQuestion->id)
                                                                            <div class="form-group row">
                                                                                @if ($exam_result->marks == 1)
                                                                                    <label for=""
                                                                                        class="h6 col-sm-4">জ্ঞানমূলক :
                                                                                    </label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text"
                                                                                            value="{{ $exam_result->gain_marks }}"
                                                                                            name="gyanMulok"
                                                                                            class="form-control" required>
                                                                                    </div>
                                                                                    <input type="hidden"
                                                                                        value="{{ $exam_result->question_id }}"
                                                                                        name="gyanMulokQuestionID" required>
                                                                                @endif
                                                                                @if ($exam_result->marks == 2)
                                                                                    <label for=""
                                                                                        class="h6 col-sm-4">অনুধাবন :
                                                                                    </label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text"
                                                                                            value="{{ $exam_result->gain_marks }}"
                                                                                            name="onudhabon"
                                                                                            class="form-control" required>
                                                                                        <br>
                                                                                    </div>
                                                                                    <input type="hidden"
                                                                                        value="{{ $exam_result->question_id }}"
                                                                                        name="onudhabonQuestionID" required>
                                                                                @endif
                                                                                @if ($exam_result->marks == 3)
                                                                                    <label for=""
                                                                                        class="h6 col-sm-4">প্রয়োগমূলক :
                                                                                    </label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text"
                                                                                            value="{{ $exam_result->gain_marks }}"
                                                                                            name="proyugMulok"
                                                                                            class="form-control" required>
                                                                                        <br>
                                                                                    </div>
                                                                                    <input type="hidden"
                                                                                        value="{{ $exam_result->question_id }}"
                                                                                        name="proyugMulokQuestionID"
                                                                                        required>
                                                                                @endif
                                                                                @if ($exam_result->marks == 4)
                                                                                    <label for="" class="h6 col-sm-4">
                                                                                        উচ্চতর দক্ষতা :
                                                                                    </label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text"
                                                                                            value="{{ $exam_result->gain_marks }}"
                                                                                            name="ucchotor"
                                                                                            class="form-control" required>
                                                                                        <br>
                                                                                    </div>
                                                                                    <input type="hidden"
                                                                                        value="{{ $exam_result->question_id }}"
                                                                                        name="ucchotorQuestionID" required>
                                                                                @endif
                                                                            </div>
                                                                        @endif
                                                                    @empty
                                                                        No marks
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
                            <button type="button" class="btn btn-info border border-primary ml-5 h2" data-toggle="modal"
                                data-target="#modal-default">
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
                                                action="{{ route('giveMarks', [
    'batch' => $batch,
    'exam' => $exam,
    'exam_type' => $exam_type,
    'student' => $student,
]) }}"
                                                method="POST">
                                                {{ csrf_field() }}
                                                @foreach ($exam_papers as $key => $exam_paper)
                                                    @php
                                                        $id = 1;
                                                    @endphp
                                                    Question {{ $loop->iteration }}
                                                    @foreach ($exam_paper->creativeQuestion->question as $key => $cq)
                                                        <div class="form-group row">
                                                            <label for="exampleInputEmail1" class="h6 col-sm-4">
                                                                @if ($cq->marks == 1)
                                                                    জ্ঞানমূলক
                                                                @elseif($cq->marks == 2) অনুধাবন
                                                                @elseif($cq->marks == 3)প্রয়োগমূলক
                                                                @elseif($cq->marks == 4)উচ্চতর দক্ষতা
                                                                @endif
                                                            </label>
                                                            <div class="col-sm-8">
                                                                <input type="number" name="m[{{ $cq->id }}]"
                                                                    class="form-control" id="exampleInputEmail1"
                                                                    placeholder="Enter marks for {{ $cq->marks == 1 ? 'জ্ঞানমূলক' : '' }} {{ $cq->marks == 2 ? 'অনুধাবন' : '' }} {{ $cq->marks == 3 ? 'প্রয়োগমূলক' : '' }} {{ $cq->marks == 4 ? 'উচ্চতর দক্ষতা' : '' }}"
                                                                    required>
                                                            </div>
                                                            <input type="hidden" name="q[]" value="{{ $cq->id }}">
                                                        </div>
                                                    @endforeach
                                                    <input type="hidden" name="loop" value="{{ $loop->iteration }}">
                                                    @php
                                                        $id = $id + 1;
                                                    @endphp
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
