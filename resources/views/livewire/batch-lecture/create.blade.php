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
                            <h3 class="card-title">Add Batch Lectures</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="saveBatchLecture">
                                @if (($show))
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-form-label" for="batch">Batch <span class="must-filled">*</span></label>
                                                <select class="form-control" wire:model="batchId" disabled>
                                                    <option value="{{ $batches->id }}">{{ $batches->title }}</option>
                                                </select>
                                                @error('batchId')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label" for="courseName">Course</label>
                                                <select class="form-control" wire:model="courseId" disabled>
                                                    <option value="{{ $courses->id }}">{{ $courses->title }}</option>
                                                </select>
                                                @error('courseId')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label" for="courseName">Topic <span class="must-filled">*</span></label>
                                                <select class="form-control" wire:model="topicId">
                                                    <option value="" selected>Select Topic</option>
                                                    @foreach($topics as $topic)
                                                        <option value="{{ $topic->id }}">{{ $topic->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('topicId')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-form-label" for="batch">Batch <span class="must-filled">*</span></label>
                                                <select class="form-control" wire:model="batchId">
                                                    <option value="" selected>Select Batch</option>
                                                    @foreach($batches as $batch)
                                                        <option value="{{ $batch->id }}">{{ $batch->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('batchId')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label" for="courseName">Course <span class="must-filled">*</span></label>
                                                <select class="form-control" wire:model="courseId" disabled>
                                                    <option>Courses</option>
                                                    @if ($batchId)
                                                        <option value="{{ $courses->id }}">{{ $courses->title }}</option>
                                                    @endif
                                                </select>
                                                @error('courseId')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label" for="courseName">Topic <span class="must-filled">*</span></label>
                                                <select class="form-control" wire:model="topicId" @if (!$courseId)
                                                    disabled
                                                @endif>
                                                    <option value="" selected>Select Topic</option>
                                                    @if ($courseId)
                                                        @foreach($topics as $topic)
                                                            <option value="{{ $topic->id }}">{{ $topic->title }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('topicId')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    <a href="{{ URL::previous() }}"><button type="button" class="btn btn-danger">Back</button></a>
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
