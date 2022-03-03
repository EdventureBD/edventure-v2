@extends('student.layouts.default', [
'title'=>'Batch Lecture',
'pageName'=>'Batch Lecture',
'secondPageName'=>'Batch Lecture'
])

@section('content')
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.2/css/pro.min.css" rel="stylesheet">
    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content page-content ">

        <div class="mdk-box bg-primary js-mdk-box mb-0" data-effects="blend-background">
            <div class="mdk-box__content">
                <div class="hero py-64pt text-center text-sm-left">
                    <div class="container page__container">
                        {{-- <h2 class="text-white">Batch: {{ $batch->title }}</h2>
                        <p class="lead text-white-50 measure-hero-lead"> {{ $course->description }} </p> --}}
                        <div class="d-flex flex-wrap align-items-end justify-content-end mb-16pt">
                            <h1 class="text-white flex m-0">Batch: {{ $batch->title }}</h1>
                            <p class="h3 text-white-50 font-weight-light m-0">
                                Your batch days running : {{ $accessedDays->individual_batch_days }} days <br>
                                You have bought : {{ $accessedDays->accessed_days }} days <br>
                                Days remaining :
                                @php
                                    echo $accessedDays->accessed_days - $accessedDays->individual_batch_days . ' days';
                                @endphp
                            </p> <br>
                            {{-- <p class="h1 text-white-50 font-weight-light m-0"> <span id="countdownMinuits-xs"></span> : <span id="countdownSecound-xs"></span></p> --}}
                        </div>
                        <p class="hero__lead measure-hero-lead text-white-50">
                            {{ $course->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="navbar navbar-expand-sm navbar-light bg-white border-bottom-2 navbar-list p-0 m-0 align-items-center">
            <div class="container page__container">
                <ul class="nav navbar-nav flex align-items-sm-center">
                    <li class="nav-item navbar-list__item">
                        <i class="material-icons text-muted icon--left">schedule</i>
                        {{ $course->duration }} month
                    </li>
                    <li class="nav-item navbar-list__item">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M18.09,10.5V9H9.59V4.5A1.5,1.5 0 0,0 8.09,3A1.5,1.5 0 0,0 6.59,4.5A1.5,1.5 0 0,0 8.09,6V9H5.09V10.5H8.09V16.7C8.09,19.06 10,20.97 12.34,21C14.68,20.96 16.54,19.04 16.5,16.7C16.5,15.11 15.75,13.61 14.5,12.62C14.28,12.44 14.05,12.28 13.8,12.15C13.58,12.05 13.34,12 13.1,12C12.39,12 11.74,12.39 11.39,13C11.2,13.3 11.1,13.65 11.1,14C11.11,15.1 12,16 13.11,16C13.73,16 14.31,15.69 14.69,15.2C14.9,15.67 15,16.18 15,16.7C15.04,18.2 13.86,19.45 12.34,19.5C10.81,19.5 9.58,18.23 9.59,16.7V10.5H18.09Z" />
                        </svg>
                        {{ $course->price }}
                    </li>
                    <li class="nav-item ml-sm-auto text-sm-center flex-column navbar-list__item">
                        <div class="rating rating-24">
                            <div class="rating__item"><i class="material-icons">star</i></div>
                            <div class="rating__item"><i class="material-icons">star</i></div>
                            <div class="rating__item"><i class="material-icons">star</i></div>
                            <div class="rating__item"><i class="material-icons">star</i></div>
                            <div class="rating__item"><i class="material-icons">star_border</i></div>
                        </div>
                        <p class="lh-1 mb-0"><small class="text-muted">20 ratings</small></p>
                    </li>
                </ul>
            </div>
        </div> --}}

        <div class="page-section border-bottom-2">
            <div class="container page__container w-50">
                @if (count($specialExams) > 0)
                    {{-- @if ($specialExams->exam->special == 1) --}}
                    {{-- <div class="page-separator">
                        <div class="page-separator__text">Table of Contents</div>
                    </div> --}}
                    <div class="row mb-3">
                        <div class="col-lg-12">

                            <div class="accordion js-accordion accordion--boxed list-group-flush" id="parent">
                                <div class="accordion__item">
                                    <a href="#" class="accordion__toggle collapsed h3" data-toggle="collapse"
                                        data-target="#specialExams1" data-parent="#parent">
                                        <span class="flex">Special Exam</span>
                                        <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                                    </a>
                                    <div class="accordion__menu collapse show"
                                        id="specialExams1">
                                        @forelse ($specialExams as $specialExam)
                                            <div class="accordion__menu-link">
                                                <span
                                                    class="icon-holder icon-holder--small icon-holder--dark rounded-circle d-inline-flex icon--left">
                                                    <i class="fad fa-pen"></i>
                                                </span>
                                                <a class="flex"
                                                    href="{{ route('question', [$batch->slug, $specialExam->exam->slug]) }}">
                                                    {{ $specialExam->exam->title }}
                                                    <span
                                                        class="float-right text-primary">{{ $specialExam->exam->exam_type }}</span>
                                                </a>
                                            </div>
                                        @empty
                                            No Topics found
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @endif --}}
                @endif

                <div class="page-separator mt-5">
                    <div class="page-separator__text">Table of Contents</div>
                </div>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="accordion js-accordion accordion--boxed list-group-flush" id="parent">
                            @forelse ($batchTopics as $batchTopic)
                                <div class="accordion__item {{ $loop->iteration == 1 ? 'open' : '' }}">
                                    <a href="#" class="accordion__toggle collapsed h3" data-toggle="collapse"
                                        data-target="#course-toc-{{ $batchTopic->id }} " data-parent="#parent">
                                        <span class="flex">Topic : {{ $batchTopic->title }} </span>
                                        <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                                    </a>
                                    <div class="accordion__menu collapse {{ $loop->iteration == 1 ? 'show' : '' }}"
                                        id="course-toc-{{ $batchTopic->id }}">
                                        @livewire('student.batch.lectures', ['batchTopic' => $batchTopic->id, 'batch' =>
                                        $batch], key($batchTopic->id))
                                    </div>
                                </div>
                            @empty
                                No Topics found
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- // END Header Layout Content -->
@endsection
