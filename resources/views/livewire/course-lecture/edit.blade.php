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
                            <h3 class="card-title">Edit Course Lecture2 </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="updateCourseLecture">
                                <div class="form-group">
                                    <label class="col-form-label" for="courseTitle">Lecture Title </label>
                                    <input type="text" wire:model="title"
                                        class="form-control @error('title') is-invalid @enderror" id="courseTitle"
                                        placeholder="Enter your course topic title">
                                    @error('title')
                                        <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseName">Course</label>
                                            <select class="form-control" wire:model="courseId" disabled>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('courseId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseTopic">Course Topic</label>
                                            <select class="form-control" wire:model="topicId" disabled>
                                                @foreach ($topics as $topic)
                                                    <option value="{{ $topic->id }}">{{ $topic->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('topicId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="exams">Exams</label>
                                            <select class="form-control" wire:model="examId" disabled>
                                                @foreach ($exams as $exam)
                                                    <option value="{{ $exam->id }}">{{ $exam->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('examId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" wire:ignore>
                                    <label class="col-form-label" for="markdownText">Markdown Text</label>
                                    <textarea input="markdownText" id="markdownText" name="markdownText"
                                        placeholder="Place some text here"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $markdownText }}</textarea>
                                    @error('markdownText')
                                        <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group" wire:ignore>
                                    <label class="col-form-label" for="pdf">Pdf</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" wire:model="pdf">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    @error('pdf')
                                        <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                @if ($this->courseLecture->pdf)
                                    <div class="form-group container">
                                        <iframe src="{{$this->courseLecture->pdf}} " width="100%"
                                        height="360" frameborder="0"></iframe>
                                    </div>
                                @endif
                                <div>
                                    <label class="col-form-label" for="courseurl">Lecture Video </label> <br>
                                    <div class="input-group">
                                        {{-- <label class="col-form-label" for="courseurl"> Video Url </label> <br> --}}
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">https://youtube.com/watch?v=</span>
                                        </div>
                                        <input type="text" wire:model="url"
                                            class="form-control @error('url') is-invalid @enderror"
                                            placeholder="Enter your youtube video id" />
                                    </div>
                                    @error('url')
                                        <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    @if ($url)
                                        <iframe width="560" height="315"
                                            src="https://www.youtube-nocookie.com/embed/{{ $url }}"
                                            title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; 
                                        clipboard-write; encrypted-media; gyroscope;
                                        picture-in-picture" allowfullscreen></iframe>
                                        {{-- vimeo player
                                        <iframe src="https://player.vimeo.com/video/{{ $url }}" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe> --}}
                                    @endif
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
