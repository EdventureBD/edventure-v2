{{--previous student/pages/course/course_preview.blade.php--}}
<?php /*@extends('student.layouts.default', [
'title'=>'Preview Course',
'pageName'=>'Preview Course',
'secondPageName'=>'Preview Course'
])

@section('content')
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.2/css/pro.min.css" rel="stylesheet">
    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content page-content ">

        <div class="mdk-box bg-primary js-mdk-box mb-0" data-effects="blend-background">
            <div class="mdk-box__content">
                <div class="hero py-64pt text-center text-sm-left">
                    <div class="container page__container">
                        <h1 class="text-white">{{ $course->title }}</h1>
                        <p class="lead text-white-50 measure-hero-lead">{{ $course->description }}</p>
                        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-start">
                            <a href="student-lesson.html" class="btn btn-outline-white mb-16pt mb-sm-0 mr-sm-16pt">Watch
                                trailer <i class="material-icons icon--right">play_circle_outline</i>
                            </a>
                            @if ($enrolled)
                                @if ($enrolled->accepted == 1)
                                    <a href="{{ route('batch-lecture', $batch->slug) }}" class="btn btn-white">Go to your
                                        batch</a>
                                @elseif($enrolled->accepted == 0)
                                    <a href="#" class="btn btn-white">Admin will accept your request. Please wait</a>
                                @endif
                            @else
                                <a href="{{ route('enroll', $course->slug) }}" class="btn btn-white">Enroll Now</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="navbar navbar-expand-sm navbar-light bg-white border-bottom-2 navbar-list p-0 m-0 align-items-center">
            <div class="container page__container">
                <ul class="nav navbar-nav flex align-items-sm-center">
                    <li class="nav-item navbar-list__item">
                        <i class="material-icons text-muted icon--left">schedule</i>
                        {{ $course->duration }} month
                    </li>
                    <li class="nav-item navbar-list__item">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M18.09,10.5V9H9.59V4.5A1.5,1.5 0 0,0 8.09,3A1.5,1.5 0 0,0 6.59,4.5A1.5,1.5 0 0,0 8.09,6V9H5.09V10.5H8.09V16.7C8.09,19.06 10,20.97 12.34,21C14.68,20.96 16.54,19.04 16.5,16.7C16.5,15.11 15.75,13.61 14.5,12.62C14.28,12.44 14.05,12.28 13.8,12.15C13.58,12.05 13.34,12 13.1,12C12.39,12 11.74,12.39 11.39,13C11.2,13.3 11.1,13.65 11.1,14C11.11,15.1 12,16 13.11,16C13.73,16 14.31,15.69 14.69,15.2C14.9,15.67 15,16.18 15,16.7C15.04,18.2 13.86,19.45 12.34,19.5C10.81,19.5 9.58,18.23 9.59,16.7V10.5H18.09Z" />
                        </svg>
                        {{ $course->price }}
                    </li>

                </ul>
            </div>
        </div>

        <div class="page-section border-bottom-2">
            <div class="container page__container w-50">

                <div class="page-separator">
                    <div class="page-separator__text">Table of Contents</div>
                </div>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="accordion js-accordion accordion--boxed list-group-flush" id="parent">
                            @forelse ($course_topics as $course_topic)
                                <div class="accordion__item">
                                    <a href="#" class="accordion__toggle collapsed" data-toggle="collapse"
                                        data-target="#course-toc-{{ $course_topic->id }}" data-parent="#parent">
                                        <span class="flex">Topic: {{ $course_topic->title }}</span>
                                        {{-- <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span> --}}
                                    </a>
                                    {{-- <div class="accordion__menu collapse {{ ($loop->iteration)==1? 'show':'' }}" id="course-toc-{{ $course_topic->id }}">
                                        @forelse ($course_topic_lectures[$course_topic->id] as $course_topic_lecture)
                                           <div class="accordion__menu-link">
                                                <span
                                                    class="icon-holder icon-holder--small icon-holder--dark rounded-circle d-inline-flex icon--left">
                                                    <i class="material-icons icon-16pt">play_circle_outline</i>
                                                </span>
                                                <a class="flex" href="student-lesson.html">{{ $course_topic_lecture->title }}</a>
                                                <span class="text-muted">1m 10s</span>
                                            </div>
                                        @empty
                                            <div class="accordion__menu-link">
                                                <span
                                                    class="icon-holder icon-holder--small icon-holder--dark rounded-circle d-inline-flex icon--left">
                                                    <i class="fad fa-empty-set"></i>
                                                </span>
                                                <a class="flex" href="#">No lectures found </a>
                                            </div>
                                        @endforelse
                                    </div> --}}
                                </div>
                            @empty
                                No Topics found
                            @endforelse
                        </div>

                    </div>
                    {{-- <div class="col-lg-5 justify-content-center">
                        <div class="card">
                            <div class="card-body py-16pt text-center">
                                <span
                                    class="icon-holder icon-holder--outline-secondary rounded-circle d-inline-flex mb-8pt">
                                    <i class="material-icons">timer</i>
                                </span>
                                <h4 class="card-title"><strong>Unlock Course</strong></h4>
                                <p class="card-subtitle text-70 mb-24pt">Get access to all videos in the course</p>
                                <a href="pricing.html" class="btn btn-accent mb-8pt">Buy this course - Only {{ $course->price }} ৳</a>
                                <p class="mb-0">Already enrolled? <a href="{{ route('login') }}">Login</a></p>
                            </div>
                        </div>

                    </div> --}}
                </div>
            </div>
        </div>

    </div>
    <!-- // END Header Layout Content -->
@endsection
*/ ?>

<x-landing-layout headerBg="white">
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.2/css/pro.min.css" rel="stylesheet">
    <div class="course-info bg-gradient-purple py-5">
        <div class="container">
            <div class="row">
                <h1 class="text-white">{{ $course->title }}</h1>
                <p class="lead text-white-50 measure-hero-lead">{{ $course->description }}</p>
                <div class="d-flex flex-column flex-sm-row align-items-center justify-content-start">
                    <a href="student-lesson.html" class="d-inline-block text-dark bg-light-gray bradius-15 bshadow px-3 fw-600 py-2">Watch
                        trailer <i class="fas fa-play ml-2"></i>
                    </a>
                    @if ($enrolled)
                        @if ($enrolled->accepted == 1)
                            <a href="{{ route('batch-lecture', $batch->slug) }}" class="d-inline-block text-dark bg-light-gray bradius-15 bshadow px-3 fw-600 py-2 ml-3">Go to your
                                batch</a>
                        @elseif($enrolled->accepted == 0)
                            <a href="#" class="d-inline-block text-dark bg-light-gray bradius-15 bshadow px-3 fw-600 py-2 ml-3">Admin will accept your request. Please wait</a>
                        @endif
                    @else
                        <a href="{{ route('enroll', $course->slug) }}" class="d-inline-block text-dark bg-light-gray bradius-15 bshadow px-3 fw-600 py-2 ml-3">Enroll Now</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-expand-sm navbar-light bg-white border-bottom-2 navbar-list p-0 m-0 align-items-center">
        <div class="container page__container">
            <ul class="nav navbar-nav flex align-items-sm-center my-3">
                <li class="nav-item navbar-list__item">
                    <i class="far fa-clock"></i>
                    {{ $course->duration }} month
                </li>
                <li class="nav-item navbar-list__item ml-4">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M18.09,10.5V9H9.59V4.5A1.5,1.5 0 0,0 8.09,3A1.5,1.5 0 0,0 6.59,4.5A1.5,1.5 0 0,0 8.09,6V9H5.09V10.5H8.09V16.7C8.09,19.06 10,20.97 12.34,21C14.68,20.96 16.54,19.04 16.5,16.7C16.5,15.11 15.75,13.61 14.5,12.62C14.28,12.44 14.05,12.28 13.8,12.15C13.58,12.05 13.34,12 13.1,12C12.39,12 11.74,12.39 11.39,13C11.2,13.3 11.1,13.65 11.1,14C11.11,15.1 12,16 13.11,16C13.73,16 14.31,15.69 14.69,15.2C14.9,15.67 15,16.18 15,16.7C15.04,18.2 13.86,19.45 12.34,19.5C10.81,19.5 9.58,18.23 9.59,16.7V10.5H18.09Z" />
                    </svg>
                    {{ $course->price }}
                </li>

            </ul>
        </div>
    </div>


    <div class="page-section border-bottom-2 py-5 bg-light">
        <div class="container page__container w-50">
            <div class="page-separator">
                <div class="page-separator__text bg-purple-light text-center bradius-10 py-3 d-inline-block w-100 text-gray text-sm fw-700">Table of Contents</div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="accordion js-accordion accordion--boxed list-group-flush" id="parent">
                        @forelse ($course_topics as $batchTopic)
                            <div class="accordion__item  ">
                                <div class="row no-gutters accordion__toggle bg-light-gray mt-3 py-3 px-3 bradius-15 bshadow text-dark fw-600" data-toggle="collapse" data-target="#course-toc-{{ $batchTopic->id }} " data-parent="#parent">
                                    <div class="col-11 title text-left">
                                        <span class="pl-4">{{ $batchTopic->title }} </span>
                                    </div>
                                    {{-- <div class="col-1 text-right">
                                        <span class="d-inline-block text-gray text-sm">
                                            <span class="arrow-up text-gray"><i class="fas fa-angle-up"></i></span>
                                            <span class="arrow-down text-gray"><i class="fas fa-angle-down"></i></span>
                                        </span>
                                    </div> --}}
                                </div>
                                {{-- <div class="accordion__menu collapse {{ $loop->iteration == 1 ? 'show' : '' }} "
                                    id="course-toc-{{ $batchTopic->id }}">
                                    @livewire('student.batch.lectures', ['batchTopic' => $batchTopic->id, 'batch' =>
                                    $batch], key($batchTopic->id))
                                </div> --}}
                            </div>
                        @empty
                            No Topics found
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-landing-layout>