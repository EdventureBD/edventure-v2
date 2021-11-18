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
    {{-- BATCH LECTURE START --}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">Batch: <span style="color: lightskyblue">{{ $batch->title }}</span>
                            </h1> <br>
                            <h1 class="card-title">Course: <span
                                    style="color: lightskyblue">{{ $batch->course->title }}</span></h1>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-info float-right mt-2 mb-2 mr-2" data-toggle="modal"
                                    data-target="#course-topic">
                                    <i class="fas fa-plus-square"></i>
                                    Add batch lecture
                                </button>
                                <div class="modal fade" id="course-topic">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                {{-- @livewire('batch-lecture.create', ['batch' => $batch]) --}}
                                                <form role="form" action="{{ route('batch-lecture.store') }}"
                                                    method="POST">
                                                    {{ csrf_field() }}
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="col-form-label" for="batch">Batch
                                                                    <span class="must-filled">*</span>
                                                                </label>
                                                                <select class="form-control" name="batchId" disabled>
                                                                    <option value="{{ $batch->id }}" selected>
                                                                        {{ $batch->title }}
                                                                    </option>
                                                                </select>
                                                                @error('batchId')
                                                                    <p style="color: red;">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="col-form-label" for="course">Course
                                                                    <span class="must-filled">*</span>
                                                                </label>
                                                                <select class="form-control" name="courseId" id="course"
                                                                    disabled>
                                                                    <option value="{{ $batch->course->id }}" selected>
                                                                        {{ $batch->course->title }}
                                                                    </option>
                                                                </select>
                                                                @error('courseId')
                                                                    <p style="color: red;">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="topic">Topics
                                                            <span class="must-filled">*</span>
                                                        </label>
                                                        <select class="form-control" name="topicId" id="topic">
                                                            <option value="" selected hidden> Select topic </option>
                                                            @foreach ($topics as $topic)
                                                                <option value="{{ $topic->id }}">
                                                                    {{ $topic->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('topicId')
                                                            <p style="color: red;">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" value="{{ $batch->id }}" name="batchId">
                                                    <input type="hidden" value="{{ $batch->course->id }}"
                                                        name="courseId">


                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-primary">Create</button>
                                                        <a href="javascript:history.back()"><button type="button"
                                                                class="btn btn-danger">Back</button></a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0" style="height: auto;">
                            <table class="table table-bordered table-striped example1">
                                <thead>
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Batch</th>
                                        <th>Course</th>
                                        <th>Topic</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($batch_lectures as $batch_lecture)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $batch->title }}
                                            </td>
                                            <td>
                                                {{ $batch_lecture->courseTitle }}
                                            </td>
                                            <td>
                                                {{ $batch_lecture->courseTopicsTitle }}
                                            </td>
                                            <td>
                                                <a href="#deleteBatchlecture{{ $batch_lecture->id }}" data-toggle="modal"
                                                    title="Delete {{ $batch_lecture->title }}">
                                                    <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                </a>
                                                <div class="modal fade"
                                                    id="deleteBatchlecture{{ $batch_lecture->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content bg-danger">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Delete batch lecture</h4>
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
                                                                    action="{{ route('batch-lecture.destroy', $batch_lecture->id) }}"
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
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Batch</th>
                                        <th>Course</th>
                                        <th>Topic</th>
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
    {{-- BATCH LECTURE END --}}
    <!-- /.content -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">Students</h1>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-info float-right mt-2 mb-2 mr-2" data-toggle="modal"
                                    data-target="#addStudent">
                                    <i class="fas fa-plus-square"></i>
                                    Add student to batch
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="addStudent" tabindex="-1" role="dialog"
                                    aria-labelledby="addStudent" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addStudent">Add student to batch</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('addStudentToBatch', [$batch->course, $batch]) }}"
                                                    method="POST">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <label for="studentId">Example select</label>
                                                        <select class="form-control" id="studentId" name="studentId">
                                                            <option value="" hidden required>
                                                                Select Student
                                                            </option>
                                                            @foreach ($studentsToAdd as $studentsAdd)
                                                                <option value="{{ $studentsAdd->id }}"
                                                                    {{ old('studentId') == $studentsAdd->id ? 'selected' : '' }}>
                                                                    {{ $studentsAdd->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('studentId')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="trx_id">TRX id</label>
                                                                <input type="text" class="form-control" id="trx_id"
                                                                    name="trx_id" required value="{{ old('trx_id') }}">
                                                                <small id="emailHelp" class="form-text text-muted">
                                                                    If no trx id is provided. type free
                                                                </small>
                                                            </div>
                                                            @error('trx_id')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="paymentType">Payment Type</label>
                                                                <input type="text" class="form-control" id="paymentType"
                                                                    name="paymentType" required
                                                                    value="{{ old('paymentType') }}">
                                                                <small id="emailHelp" class="form-text text-muted">
                                                                    If no payment type is provided. type free
                                                                </small>
                                                            </div>
                                                            @error('paymentType')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="amount">Amount</label>
                                                                <input type="number" class="form-control" id="amount"
                                                                    name="amount" required value="{{ old('amount') }}">
                                                                <small id="emailHelp" class="form-text text-muted">
                                                                    if no amount input 0
                                                                </small>
                                                            </div>
                                                            @error('amount')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="accesddedDays">Accessed Days</label>
                                                                <input type="number" class="form-control"
                                                                    id="accesddedDays" placeholder="e.g 30"
                                                                    name="accesddedDays" required
                                                                    value="{{ old('accesddedDays') }}">
                                                                <small id="emailHelp" class="form-text text-muted">
                                                                    Input how many days this user can access this batch
                                                                </small>
                                                            </div>
                                                            @error('accesddedDays')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="note">Note</label>
                                                        <textarea class="form-control" id="note" rows="3"
                                                            name="note">{{ old('note') }}</textarea>
                                                    </div>
                                                    @error('note')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                    <button type="submit"
                                                        class="btn btn-primary float-right">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: auto;">
                            <table class="table table-bordered table-striped example1">
                                <thead>
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Reamining Batch Days</th>
                                        {{-- <th>Contact</th> --}}
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student->student->name }}</td>
                                            <td>{{ $student->student->email }}</td>
                                            {{-- <td>{{ $student->user->studentDetails->contact }}</td> --}}
                                            <td>
                                                {{ $student->accessed_days }}
                                                <button class="btn btn-info mt-2 mb-2 mr-2" data-toggle="modal"
                                                    data-target="#addAccessDays{{ $student->id }}">
                                                    <i class="fas fa-plus-square"></i>
                                                </button>
                                                <div class="modal fade" id="addAccessDays{{ $student->id }}"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="addAccessDays{{ $student->id }}" aria-hidden="true">
                                                    <div class="modal-dialog  modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="addStudent">Add more access
                                                                    days </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {{-- Are you sure want to add more access days to
                                                                {{ $student->student->name }} --}}
                                                                @livewire('payment.create', ['batch'=> $batch->id, 'student'
                                                                => $student->student->id],, key($student->student->id))
                                                            </div>
                                                            {{-- <div class="modal-footer">
                                                                <a href="" type="button" class="btn btn-primary">Yes</a>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="checkbox" class="customControlInput"
                                                    id="single-col-{{ $student->id }}" data-id="{{ $student->id }}"
                                                    data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                    data-on="Active" data-off="InActive"
                                                    {{ $student->status ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <a class="mr-1" href="#deleteBatchStudent{{ $student->id }}"
                                                    data-toggle="modal" title="Delete {{ $batch->title }}">
                                                    <button class="btn btn-danger"><i
                                                            class="far fa-trash-alt"></i></button>
                                                </a>
                                                <div class="modal fade" id="deleteBatchStudent{{ $student->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content bg-danger">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">
                                                                    Delete {{ $student->student->name }}
                                                                </h4>
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
                                                                    action="{{ route('deleteStudentFromBatch', [$batch->course, $batch, $student]) }}"
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
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        {{-- <th>Contact</th> --}}
                                        <th>Reamining Batch Days</th>
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
                        url: "{{ route('changeStudentStatus') }}",
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
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
@endsection

@section('js2')
    <script>
        $(function() {
            $(".example1").DataTable();
            $('.example2').DataTable({
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
