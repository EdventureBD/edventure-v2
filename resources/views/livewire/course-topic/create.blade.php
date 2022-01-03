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
                            <h3 class="card-title">Create Topic</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="saveCourseTopic">
                                <div class="form-group">
                                    <label class="col-form-label" for="courseTitle"> Course Topic Title <span class="must-filled">*</span> </label>
                                    <input type="text" wire:model="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        id="courseTitle" placeholder="Enter your course topic title">
                                    @error('title')
                                        <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                {{-- @if (!($show)) --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-form-label" for="courseCategory"> Category <span class="must-filled">*</span></label>
                                                <select class="form-control" wire:model="categoryId" id="courseCategory">
                                                    <option value="" selected>Select course category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                    @endforeach
                                                </select>
                                                <div>
                                                    @error('categoryId')
                                                        <p style="color: red;">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-form-label" for="intermediaryLevel"> Intermediate Levels <span class="must-filled">*</span></label>
                                                <select class="form-control" wire:model="intermediaryLevelId" id="intermediaryLevel">
                                                    <option value="" selected>Select Intermediary Level</option>
                                                        @foreach($intermediaryLevels as $intermediaryLevel)
                                                            <option wire:key="lang{{$intermediaryLevel}}" value="{{ $intermediaryLevel->id }}">{{ $intermediaryLevel->title }}</option>
                                                        @endforeach
                                                </select>
                                                <div>
                                                    @error('intermediaryLevelId')
                                                        <p style="color: red;">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-form-label" for="course"> Course <span class="must-filled">*</span></label>
                                                <select class="form-control" wire:model="courseId" id="course">
                                                    <option value="" selected>Select Course</option>
                                                        @foreach($courses as $course)
                                                            <option wire:key="lang{{$course}}" value="{{ $course->id }}">{{ $course->title }}</option>
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
                                {{-- @else
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label" for="courseName">Category</label>
                                                <select class="form-control" wire:model="categoryId" disabled>
                                                    <option value="{{ $categories->id }}">{{ $categories->title }}
                                                </select>
                                                @error('categoryId')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label" for="courseName">Course</label>
                                                <select class="form-control" wire:model="course_id" disabled>
                                                    @foreach($courses as $course)
                                                        <option value="{{ $course->id }}">{{ $course->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('course_id')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endif --}}

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    @if (!($show))
                                        <a href="{{ URL::previous() }}"><button type="button" class="btn btn-danger">Back</button></a>
                                    @endif
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
