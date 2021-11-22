@extends('admin.layouts.default', [
'title'=>'View Category',
'pageName'=>'View Course Lecture',
'secondPageName'=>'View Course Lecture'
])

@section('content')
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
                            <h3 class="card-title">View Course Lecture </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <label class="col-form-label" for="courseTitle">Lecture Title </label>
                                <input disabled type="text" wire:model="title"
                                    class="form-control @error('title') is-invalid @enderror" id="courseTitle"
                                    value="{{ $courseLecture->title }} ">
                                @error('title')
                                    <p style="color: red;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="courseName">Course</label>
                                        <select class="form-control" wire:model="courseId" disabled>
                                            <option value="{{ $course->title }}">{{ $course->title }} </option>
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
                                            <option value="{{ $topic->title }}">{{ $topic->title }} </option>
                                        </select>
                                        @error('topicId')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group container" wire:ignore>
                                <label class="col-form-label" for="markdownText">Markdown Text</label>
                                @if ($courseLecture->markdown_text)
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{!! $courseLecture->markdown_text !!}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="courseurl">Lecture Pdf </label> <br>
                                <div class="form-group container">
                                    @if ($courseLecture->pdf)
                                        <iframe src="{{ $courseLecture->pdf }}" width="1000"
                                            height="360" frameborder="0"></iframe>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label" for="courseurl">Lecture Video </label> <br>
                                <div class="form-group container">
                                    @if ($courseLecture->url)
                                        <iframe width="560" height="315"
                                            src="https://www.youtube-nocookie.com/embed/{{ $courseLecture->url }}"
                                            title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; 
                                            clipboard-write; encrypted-media; gyroscope;
                                            picture-in-picture" allowfullscreen>
                                        </iframe>
                                        {{-- <iframe src="https://player.vimeo.com/video/{{ $courseLecture->url }}"
                                            width="640" height="360" frameborder="0"
                                            allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe> --}}
                                    @endif
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="{{ URL::previous() }}"><button type="button"
                                        class="btn btn-danger">Back</button></a>
                            </div>

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
@endsection






@section('js1')
<!-- Summernote -->
<script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
{{-- <script>
    $(function () {
      // Summernote
        $('#markdownText').summernote({
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('markdownText', contents);
                }
            }
        })
    })
  </script> --}}
@endsection
