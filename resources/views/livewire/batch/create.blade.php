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
                            <h3 class="card-title">Create Batch</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="saveBatch">
                                <div class="form-group">
                                    <label class="col-form-label" for="courseTitle"> Batch Title <span class="must-filled">*</span></label>
                                    <input id="courseTitle" type="text" wire:model="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        id="courseTitle" placeholder="Enter your course batch title">
                                        <div>
                                            @error('title')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="studentLimit"> Student Limit  <span class="must-filled">*</span></label>
                                            <input wire:key="studentLimit" id="studentLimit" type="number" wire:model="student_limit"
                                                class="form-control @error('student_limit') is-invalid @enderror"
                                                id="courseTitle" placeholder="Enter batch student limit">
                                                <div>
                                                    @error('student_limit')
                                                        <p style="color: red;">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="batchRunningDays"> Batch running days<span class="must-filled">*</span></label>
                                            <input wire:key="batchRunningDays" id="batchRunningDays" type="number" wire:model="batch_running_days"
                                                class="form-control @error('batch_running_days') is-invalid @enderror"
                                                id="courseTitle" placeholder="Enter how many days the batch are running" disabled>
                                                <div>
                                                    @error('batch_running_days')
                                                        <p style="color: red;">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseTopic">Teacher <span class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="teacher_id">
                                                <option value="" selected>Select teacher</option>
                                                @foreach($teachers as $teacher)
                                                    <option wire:key={{ $teacher->email.$teacher->id }} value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                @endforeach
                                            </select>
                                            <div>
                                                @error('teacher_id')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="category">Category</label>
                                            <select id="category" class="form-control" wire:model="categoryId">
                                                <option value="" selected>Select category</option>
                                                @foreach($categories as $category)
                                                    <option wire:key={{ $category->slug.$category->id }} value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                            <div>
                                                @error('categoryId')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="intermediaryLevel">Intermediary Level</label>
                                            <select id="intermediaryLevel" class="form-control" wire:model="intermediaryLevelId">
                                                <option value="" selected>Select intermedairy ievel</option>
                                                @foreach($intermediaryLevels as $intermediaryLevel)
                                                    <option wire:key={{ $intermediaryLevel->slug.$intermediaryLevel->id }} value="{{ $intermediaryLevel->id }}">{{ $intermediaryLevel->title }}</option>
                                                @endforeach
                                            </select>
                                            <div>
                                                @error('intermediaryLevelId')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="course">Course <span class="must-filled">*</span></label>
                                            <select id="course" class="form-control" wire:model="courseId">
                                                <option value="" selected>Select Course</option>
                                                @foreach($courses as $course)
                                                    <option wire:key={{ $course->slug.$course->id }} value="{{ $course->id }}">{{ $course->title }}</option>
                                                @endforeach
                                            </select>
                                            <div>
                                                @error('courseId')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
