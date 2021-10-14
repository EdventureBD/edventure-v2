{{--previous student/pages/batch/batch_lecture.blade.php--}}

{{-- @extends('student.layouts.default', [
'title'=>'Batch Lecture',
'pageName'=>'Batch Lecture',
'secondPageName'=>'Batch Lecture'
]) --}}
{{-- @extends('layouts.landing')
@section('content') --}}
<x-landing-layout headerBg="white">
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.2/css/pro.min.css" rel="stylesheet">
    <div class="course-info bg-gradient-purple py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h2 class="text-white fw-800">Batch: {{ $batch->title }}</h2>
                    <p class="text-white">{{ $course->description }}</p>
                </div>
                <div class="col-md-5">
                    <p class="text-xsm text-white-50 font-weight-light m-0">
                        Your batch days running : {{ $accessedDays->individual_batch_days }} days <br>
                        You have bought : {{ $accessedDays->accessed_days }} days <br>
                        Days remaining :
                        @php
                            echo $accessedDays->accessed_days - $accessedDays->individual_batch_days . ' days';
                        @endphp
                    </p>
                </div>
            </div>
        </div>

    </div>
    <div class="page-section border-bottom-2 py-5">
        <div class="container page__container w-50">
            @if (count($specialExams) > 0)
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="accordion js-accordion accordion--boxed list-group-flush" id="parent">
                            <div class="accordion__item">
                                <div class="bg-purple-light text-center bradius-10">
                                    <a href="#" class="accordion__toggle collapsed py-3 d-inline-block w-100" data-toggle="collapse"
                                        data-target="#specialExams1" data-parent="#parent">
                                        <span class="text-gray text-sm fw-700">Mock Test</span>
                                        <span class="d-inline-block float-right text-gray text-sm">
                                            <span class="arrow-up text-gray"><i class="fas fa-angle-up"></i></span>
                                        <span class="arrow-down text-gray"><i class="fas fa-angle-down"></i></span></span>
                                    </a>
                                </div>
                                <div class="accordion__menu collapse show" id="specialExams1">
                                    @forelse ($specialExams as $specialExam)
                                        <div class="accordion__menu-link">
                                            <span
                                                class="icon-holder icon-holder--small icon-holder--dark rounded-circle d-inline-flex icon--left">
                                                <i class="fad fa-pen"></i>
                                            </span>
                                            <a class="flex" href="{{ route('question', [$batch->slug, $specialExam->exam->slug]) }}">
                                                {{ $specialExam->exam->title }}
                                                <span class="float-right text-primary">{{ $specialExam->exam->exam_type }}</span>
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

    
    <?php /* <link href="https://kit-pro.fontawesome.com/releases/v5.15.2/css/pro.min.css" rel="stylesheet">
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
    </div> */ ?>
    <!-- // END Header Layout Content -->
</x-landing-layout>


