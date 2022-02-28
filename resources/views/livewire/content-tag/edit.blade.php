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
                            <h3 class="card-title">Edit content tag</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="updateContentTag">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">Title <span class="must-filled">*</span></label>
                                            <input type="text" class="form-control" wire:model="title" placeholder="Enter content tag name">
                                            @error('title')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseName">Course</label>
                                            <select class="form-control" wire:model="courseId" disabled>
                                                <option value="{{ $course->id }}">{{ $course->title }}
                                                </option>
                                            </select>
                                            @error('courseId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="topicName">Topic</label>
                                            <select class="form-control" wire:model="topicId" disabled>
                                                <option value="{{ $topic->id }}">{{ $topic->title }}
                                                </option>
                                            </select>
                                            @error('topicId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseLecture">Lecture</label>
                                            <select class="form-control" wire:model="lectureId" disabled>
                                                <option value="{{ $lecture->id }}">{{ $lecture->title }}
                                                </option>
                                            </select>
                                            @error('lectureId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    {{-- Solution PDF --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="pdf">Solution Pdf</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile" wire:model="solutionPdf">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                <span> {{ $solutionPdf->temporaryUrl() }} </span>
                                            </div>
                                            <div>
                                                @error('solutionPdf')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- Solution Video --}}
                                    <div class="col-md-6">
                                        <div>
                                            <label class="col-form-label" for="solutionVideo">Lecture Video</label> <br>
                                            <div class="input-group">
                                                {{-- <label class="col-form-label" for="courseurl"> Video Url </label> <br> --}}
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">https://youtube.com/watch?v=</span>
                                                </div>
                                                <input type="text" wire:model="solutionVideo"
                                                    class="form-control @error('solutionVideo') is-invalid @enderror"
                                                    placeholder="Enter your youtube video id" />
                                            </div>
                                            <div>
                                                @error('solutionVideo')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            @if ($solutionVideo)
                                                <iframe width="560" height="315"
                                                    src="https://www.youtube-nocookie.com/embed/{{ $solutionVideo }}"
                                                    title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; 
                                                    clipboard-write; encrypted-media; gyroscope;
                                                    picture-in-picture" allowfullscreen>
                                                </iframe>
                                                {{-- vimeo player
                                                <iframe src="https://player.vimeo.com/video/{{ $url }}" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe> --}}
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
