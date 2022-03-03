@section('css1')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.css') }}">
@endsection
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
                            <h3 class="card-title">Create Course Lecture</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="saveCourseLecture">
                                <div class="form-group">
                                    <label class="col-form-label" for="courseTitle">Lecture Title <span
                                            class="must-filled">*</span> </label>
                                    <input type="text" wire:model="title"
                                        class="form-control @error('title') is-invalid @enderror" id="courseTitle"
                                        placeholder="Enter your course lecture title">
                                        <div>
                                            @error('title')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="category">Category <span
                                                    class="must-filled">*</span></label>
                                            <select id="category" class="form-control" wire:model="categoryId">
                                                <option value="" selected>Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option wire:key="{{ $category->slug.$category->id }}" value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                            <div>
                                                @error('category_id')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="interemdiaryLevel">intermediary level <span
                                                    class="must-filled">*</span></label>
                                            <select id="interemdiaryLevel" class="form-control" wire:model="intermediaryLevelId">
                                                <option value="" selected>Select intermediary level</option>
                                                @foreach ($intermediaryLevels as $intermediaryLevel)
                                                    <option wire:key="{{ $intermediaryLevel->slug.$intermediaryLevel->id }}" value="{{ $intermediaryLevel->id }}">{{ $intermediaryLevel->title }}</option>
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
                                            <label class="col-form-label" for="courseName">Course <span
                                                    class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="courseId">
                                                <option value="" selected>Select Course</option>
                                                @foreach ($courses as $course)
                                                    <option wire:key="{{ $course->slug.$course->id }}" value="{{ $course->id }}">{{ $course->title }}</option>
                                                @endforeach
                                            </select>
                                            <div>
                                                @error('courseId')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseTopic">Course Topic <span
                                                    class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="topicId">
                                                <option value="" selected>Select Topic</option>
                                                @foreach ($course_topics as $course_topic)
                                                    <option wire:key="{{ $course_topic->slug.$course_topic->id }}" value="{{ $course_topic->id }}">{{ $course_topic->title }}</option>
                                                @endforeach
                                            </select>
                                            <div>
                                                @error('topicId')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="exam">Exam<span
                                                    class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="examId">
                                                <option value="" selected>Select Exam</option>
                                                @foreach ($exams as $exam)
                                                    <option wire:key="{{ $exam->slug.$exam->id }}" value="{{ $exam->id }}">{{ $exam->title }}</option>
                                                @endforeach
                                            </select>
                                            <div>
                                                @error('examId')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" wire:ignore>
                                    <label class="col-form-label" for="markdownText">Markdown Text</label>
                                    <textarea input="markdownText" id="markdownText" name="markdownText"
                                        placeholder="Place some text here"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        <div>
                                            @error('markdownText')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                </div>
                                <div class="form-group" wire:ignore>
                                    <label class="col-form-label" for="pdf">Pdf</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" wire:model="pdf">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    <div>
                                        @error('pdf')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label class="col-form-label" for="courseurl">Lecture Video <span
                                            class="must-filled">*</span> </label> <br>
                                    <div class="input-group">
                                        {{-- <label class="col-form-label" for="courseurl"> Video Url </label> <br> --}}
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">https://youtube.com/watch?v=</span>
                                        </div>
                                        <input type="text" wire:model="url"
                                            class="form-control @error('url') is-invalid @enderror"
                                            placeholder="Enter your youtube video id" />
                                    </div>
                                    <div>
                                        @error('url')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-group">
                                    @if ($url)
                                        <iframe width="560" height="315"
                                            src="https://www.youtube-nocookie.com/embed/{{ $url }}"
                                            title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; 
                                            clipboard-write; encrypted-media; gyroscope;
                                            picture-in-picture" allowfullscreen>
                                        </iframe>
                                        {{-- vimeo player
                                        <iframe src="https://player.vimeo.com/video/{{ $url }}" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe> --}}
                                    @endif
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

@section('js1')
    <!-- Summernote -->
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function() {
            // Summernote
            $('#markdownText').summernote({
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('markdownText', contents);
                    }
                }
            })
        })
    </script>
@endsection
