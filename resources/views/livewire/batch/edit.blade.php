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
                            <h3 class="card-title">Edit Batch</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="updateBatch">
                                <div class="form-group">
                                    <label class="col-form-label" for="courseTitle"> Batch Title  <span class="must-filled">*</span></label>
                                    <input type="text" wire:model.lazy="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        id="courseTitle" placeholder="Enter your course batch title">
                                    @error('title')
                                        <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseTitle"> Student Limit  <span class="must-filled">*</span></label>
                                            <input type="number" wire:model.lazy="student_limit"
                                                class="form-control @error('student_limit') is-invalid @enderror"
                                                id="courseTitle" placeholder="Enter batch student limit">
                                            @error('student_limit')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseTitle"> Batch running days  <span class="must-filled">*</span></label>
                                            <input type="number" wire:model.lazy="batch_running_days"
                                                class="form-control @error('batch_running_days') is-invalid @enderror"
                                                id="courseTitle" placeholder="Enter how many days the batch are running">
                                            @error('batch_running_days')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseTopic">Teacher <span class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="teacher_id">
                                                @foreach($teachers as $teacher)
                                                    <option value="{{ $teacher['id'] }}">{{ $teacher['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('teacher_id')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseName">Course <span class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="course_id" disabled>
                                                @foreach($courses as $course)
                                                    <option value="{{ $course['id'] }}">{{ $course['title'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('course_id')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="javascript:history.back()"><button type="button" class="btn btn-danger">Back</button></a>
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
