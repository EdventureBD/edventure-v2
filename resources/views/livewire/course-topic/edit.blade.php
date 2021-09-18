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
                            <h3 class="card-title">Edit Topic </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="updateCourseTopic">
                                <div class="form-group">
                                    <label class="col-form-label" for="Title"> Course Topic Title  <span class="must-filled">*</span></label>
                                    <input type="text" wire:model="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        id="Title" placeholder="Enter your course topic title">
                                    @error('title')
                                        <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseName">Course</label>
                                            <select class="form-control" wire:model="courseId" disabled>
                                                <option value="" selected>Select Course</option>
                                                @foreach($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('courseId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="javascript:history.back()"><button type="button" class="btn btn-danger"> Back </button></a>
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
