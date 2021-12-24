<div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="card-header">
                            {{-- <h3 class="card-title">Topic</h3> --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="courseName">Courses</label>
                                        <select class="form-control" wire:model="courseId">
                                            <option value="" hidden>Select course</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}">
                                                    {{ $course->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="courseName">Batch</label>
                                        <select class="form-control" wire:model="batchId">
                                            <option value="" hidden>Select Batch</option>
                                            @if ($batches)
                                                @forelse ($batches as $batch)
                                                    <option value="{{ $batch->id }}">{{ $batch->title }}
                                                    </option>
                                                @empty
                                                    <option>No Batch</option>
                                                @endforelse
                                            @endif
                                        </select>
                                    </div>
                                </div>

                            </div>
                            @if ($students)
                                <div class="table-responsive p-0" style="height: auto;">
                                    <table class="table table-bordered table-striped example1">
                                        <thead>
                                            <tr>
                                                <th>SL. No</th>
                                                <th>Name</th>
                                                <th>Course Name</th>
                                                <th>Batch</th>
                                                <th>Individual Batch Days</th>
                                                <th>Reamining Batch Days</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($students as $student)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $student->student->name }}</td>
                                                    <td>{{ $student->course->title }}</td>
                                                    <td>{{ $student->batch->title }}</td>
                                                    <td>{{ $student->individual_batch_days }}</td>
                                                    <td>
                                                        @php
                                                            echo $student->accessed_days - $student->individual_batch_days . ' days';
                                                        @endphp
                                                    </td>
                                                    <td>
                                                        <a class="mr-1"
                                                            href="#deleteBatchStudent{{ $student->id }}"
                                                            data-toggle="modal" title="Delete {{ $batch->title }}">
                                                            <button class="btn btn-danger"><i
                                                                    class="far fa-trash-alt"></i></button>
                                                        </a>
                                                        <div class="modal fade"
                                                            id="deleteBatchStudent{{ $student->id }}">
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
                                                                        <button type="button"
                                                                            class="btn btn-outline-light"
                                                                            data-dismiss="modal">Close</button>
                                                                        <form
                                                                            action="{{ route('deleteStudentFromBatch', [$course, $batch, $student]) }}"
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
                                            @empty
                                                <tr>
                                                    <td class="py-16 text-center" colspan="5">No Records found!</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>SL. No</th>
                                                <th>Name</th>
                                                <th>Course Name</th>
                                                <th>Batch</th>
                                                <th>Individual Batch Days</th>
                                                <th>Reamining Batch Days</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
