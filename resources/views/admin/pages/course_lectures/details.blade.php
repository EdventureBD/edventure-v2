@extends('admin.layouts.default', [
                                    'title'=>'Course Lecture Details', 
                                    'pageName'=>'Course Lecture Details', 
                                    'secondPageName'=>'Course Lecture Details'
                                ])

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lectures: <span style="color: rgb(18, 160, 61)">{{ $courseLecture->title }}</span></h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                        <h3 class="text-primary"> Course Lecture 
                            <a class="mr-1" href="{{ route('course-lecture.edit', $courseLecture->slug) }}" title="Edit {{ $courseLecture->title }}">
                                <button class="btn btn-info"><i class="far fa-edit"></i></button>
                            </a>
                        </h3>
                        <h4 class="text-muted">
                            <span style="text-decoration: underline;text-decoration-color: rgb(115, 87, 242);font-weight: bolder">
                                Lecture
                            </span>:  {{ $courseLecture->title }}
                        </h4>
                        <div class="row">
                            <div class="col-md-6 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Course</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{ $course->courseName }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Topic</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{ $topic->topicName }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-{{ $courseLecture->markdown_text ? 6:12 }} col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">
                                            Video
                                        </span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                            <iframe src="https://player.vimeo.com/video/{{ $courseLecture->url}}" width="440" height="260" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @if ($courseLecture->markdown_text)
                            <div class="col-md-6 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Markdown Text</span>
                                        <span class="info-box-number text-center text-muted mb-0">{!! $courseLecture->markdown_text !!}</span>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
