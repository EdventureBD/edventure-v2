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
                            <h3 class="card-title">Create content tag</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="saveBatchLecture">
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="batch">Course Category <span class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="categoryId">
                                                <option value="" selected> Category</option>
                                                @foreach($categories as $category)
                                                    <option wire:key="{{ $category->slug.$category->id }}" value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('categoryId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="batch">Program <span class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="intermediaryLevelId">
                                                <option value="" selected>Select Program</option>
                                                @foreach($intermediaryLevels as $intermediaryLevel)
                                                    <option wire:key="{{ $intermediaryLevel->slug.$intermediaryLevel->id.$intermediaryLevel->title }}" value="{{ $intermediaryLevel->id }}">{{ $intermediaryLevel->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('categoryId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseName">Course <span class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="courseId">
                                                <option value="" selected>Select Course</option>
                                                @foreach($courses as $course)
                                                    <option wire:key="{{ $course->slug.$course->id.$course->title }}" value="{{ $course->id }}">{{ $course->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('courseId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="topicName"> Island <span class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="topicId">
                                                <option value="" selected>Select Island</option>
                                                @foreach($topics as $topic)
                                                    <option wire:key="{{ $intermediaryLevel->slug.$intermediaryLevel->id }}" value="{{ $topic->id }}">{{ $topic->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('topicId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseLecture">Lecture <span class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="lectureId">
                                                <option value="" selected>Select Lecture</option>
                                                @foreach($lectures as $lecture)
                                                    <option value="{{ $lecture->id }}">{{ $lecture->title }}</option>
                                                @endforeach
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
                                            <div class="custom-file" wire:ignore>
                                                <input type="file" class="custom-file-input" id="customFile" wire:model="solutionPdf">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
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
