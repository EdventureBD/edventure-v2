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
                            <h3 class="card-title">Create Exam</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="saveExam">
                                <div class="row">
                                    <div class="col-md-7">
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
                                    <div class="col-md-4 mt-5 ml-4 {{ $showSpecialExam ? '' : 'd-none' }}">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox1"
                                                wire:model="special" value="1">
                                            <label for="customCheckbox1" class="custom-control-label">
                                                Special Exam
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-{{ $showAssignment ? '3' : '4' }}">
                                        <div class="form-group">
                                            <label class="col-form-label" for="batch">Course Category</label>
                                            <select class="form-control" wire:model="categoryId">
                                                <option value="" selected>Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option wire:key="{{ $category->slug.$category->id }}" value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('categoryId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-{{ $showAssignment ? '3' : '4' }}">
                                        <div class="form-group">
                                            <label class="col-form-label" for="batch">Intermediary Level</label>
                                            <select class="form-control" wire:model="intermediaryLevelId">
                                                <option value="" selected>Select intermediary level</option>
                                                @foreach ($intermediaryLevels as $intermediaryLevel)
                                                    <option wire:key="{{ $intermediaryLevel->slug.$intermediaryLevel->id }}" value="{{ $intermediaryLevel->id }}">{{ $intermediaryLevel->title }}</option>  
                                                @endforeach
                                            </select>
                                            @error('intermedairyLevelId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-{{ $showAssignment ? '3' : '4' }}">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseName">Course <span
                                                    class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="courseId">
                                                <option value="" selected>Select Course</option>
                                                @foreach ($courses as $course)
                                                    <option wire:key="{{ $course->slug.$course->id }}" value="{{ $course->id }}">{{ $course->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('courseId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 {{ $showAssignment ? '' : 'd-none' }}">
                                        <div class="form-group">
                                            <label class="col-form-label" for="topicName">Topic <span
                                                    class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="topicId">
                                                <option value="" selected>Select Topic</option>
                                                @foreach ($topics as $topic)
                                                    <option wire:key="{{ $topic->slug.$topic->id }}" value="{{ $topic->id }}">{{ $topic->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('topicId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-{{ $showAssignment ? '3' : '4' }}">
                                        <div class="form-group">
                                            <label class="col-form-label" for="topicName">Exam Type <span
                                                    class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="examType">
                                                <option value="" selected>Select Exam Type </option>
                                                <option value="Assignment"
                                                    class="{{ $showAssignment ? '' : 'd-none' }}">
                                                    Assignment</option>
                                                <option value="CQ">CQ</option>
                                                <option value="MCQ">MCQ</option>
                                                <option value="Aptitude Test">Aptitude Test</option>
                                                <option value="Pop Quiz">Pop Quiz</option>
                                                <option value="Topic End Exam">Topic End Exam</option>
                                            </select>
                                            @error('examType')
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
                                            <input type="number" min="1" class="form-control" wire:model="quesLimit"
                                                placeholder="Enter question limit" @if (!$showQuestionLimit) disabled @endif>
                                            @error('quesLimit')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">Marks <span
                                                    class="must-filled">*</span></label>
                                            <input type="number" min="1" class="form-control" wire:model="marks"
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
                                            <input type="number" min="1" class="form-control" wire:model="duration"
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

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">Threshold Marks<span
                                                    class="must-filled">*</span></label>
                                            <input type="number" min="0" class="form-control" wire:model="threshold_marks"
                                                placeholder="Enter Threshold Marks to pass to the next section">
                                            @error('threshold_marks')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">Order <span
                                                    class="must-filled">*</span></label>
                                            <input type="number" min="0" class="form-control" wire:model="order"
                                                placeholder="Enter order in which this appears on an island(course_topic)">
                                            @error('order')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                @error('aptitude_MCQ_exists')
                                    <p style="color: red;">{{ $message }}</p>
                                @enderror

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
