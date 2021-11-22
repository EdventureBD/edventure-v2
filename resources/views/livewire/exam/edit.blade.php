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
                            <h3 class="card-title">Edit Exam</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="saveExam">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">Title <span
                                                    class="must-filled">*</span></label>
                                            <input type="text" class="form-control" wire:model="title"
                                                placeholder="Enter exam title">
                                            @error('title')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-{{ $show ? '4' : '6' }}">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseName">Course <span
                                                    class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="courseId" disabled>
                                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                                            </select>
                                            @error('courseId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    @if ($show)
                                        <div class="col-md-4 {{ $show ? '' : 'd-none' }}">
                                            <div class="form-group">
                                                <label class="col-form-label" for="topicName">Topic <span
                                                        class="must-filled">*</span></label>
                                                <select class="form-control" wire:model="topicId" disabled>
                                                    <option value="{{ $topic->id }}">{{ $topic->title }}</option>
                                                </select>
                                                @error('topicId')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-{{ $show ? '4' : '6' }}">
                                        <div class="form-group">
                                            <label class="col-form-label" for="topicName">Exam Type <span
                                                    class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="examType" disabled>
                                                <option value="{{ $examType }}">{{ $examType }}</option>
                                            </select>
                                            @error('examTypeId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">Question Limit <span
                                                    class="must-filled">*</span></label>
                                            <input type="text" class="form-control" wire:model="quesLimit"
                                                placeholder="Enter question limit" @if (!$showQuestionLimit) disabled

                                            @endif>
                                            @error('quesLimit')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">Marks <span
                                                    class="must-filled">*</span></label>
                                            <input type="text" class="form-control" wire:model="marks"
                                                placeholder="Enter marks">
                                            @error('marks')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">Duration <span
                                                    class="must-filled">*</span></label>
                                            <input type="text" class="form-control" wire:model="duration"
                                                placeholder="Enter exam duration">
                                            <small id="passwordHelpBlock" class="form-text text-muted">
                                                <span class="must-filled">N.B:</span>
                                                Enter duration in minute unit. If you need in hours format multiply it
                                                with 60. ex: 5 hours = 300. Input 300 here.
                                            </small>
                                            @error('duration')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
