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
                            <h3 class="card-title">Create Batch exam </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="saveBatchExam">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="batch">Batch <span
                                                    class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="batchId">
                                                <option value="null" disabled selected>Select Batch</option>
                                                @foreach ($batches as $batch)
                                                    <option value="{{ $batch->id }}">{{ $batch->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('batchId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="exam">Exam <span
                                                    class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="examId">
                                                <option value="" selected>Select Exam</option>
                                                @foreach ($exams as $exam)
                                                    <option value="{{ $exam->id }}">
                                                        {{ $exam->title }} ({{ $exam->exam_type }})
                                                        @if ($exam->special)
                                                            Special
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('examId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    <a href="{{ URL::previous() }}"><button type="button"
                                            class="btn btn-danger">Back</button></a>
                                </div>
                            </form>
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
