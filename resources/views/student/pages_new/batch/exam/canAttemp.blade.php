<x-landing-layout headerBg="white">
    <div class="page-section ">
        <div class="container">
            <h2 class="text-purple text-lg text-center mt-4">Result Sheet</h2>
            <div class="result-sheet-table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="bg-purple text-white">Sl</th>
                            <th class="bg-purple text-white">Question</th>
                            <th class="bg-purple text-white">Your Answer</th>
                            <th class="bg-purple text-white">Correct Answer</th>
                            <th class="bg-purple text-white">Explanation</th>
                            <th class="bg-purple text-white">% got it right</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @foreach($detailsResult as $result)
                        @php
                            $field = 'field'.$result->mcq_ans;
                            $cfield = 'field'.$result->question->answer;
                            $cellcolor = $result->mcq_ans == $result->question->answer ? 'bg-green' : 'bg-red';
                        @endphp
                        <tr>
                            <td class="{{$cellcolor}}">{{$n}}</td>
                            <td class="{{$cellcolor}}">{!! $result->question->question !!}</td>
                            <td class="{{$cellcolor}}">{!! $result->question->$field !!}</td>
                            <td class="{{$cellcolor}}">{!! $result->question->$cfield !!}</td>
                            <td class="{{$cellcolor}}">{!! $result->question->explanation !!}</td>
                            <td class="{{$cellcolor}}">{{number_format(($result->question->gain_marks * 100 )/ $result->question->number_of_attempt, 2)}}%</td>
                        </tr>
                        @php $n++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-landing-layout>

<?php /* @extends('student.layouts.default', [
                                    'title'=>'Batch Exam',
                                    'pageName'=>'Batch Exam',
                                    'secondPageName'=>'Batch Exam'
])

@section('content')
    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content page-content ">
        <div class="bg-primary pb-lg-64pt py-32pt">
            <div class="container page__container">
                <div class="d-flex flex-wrap align-items-end justify-content-end mb-16pt">
                    <h1 class="text-white flex m-0">Course : {{ $batch->course->title }}</h1>
                </div>
                <p class="hero__lead measure-hero-lead text-white-50">
                    {{-- Topic : {{ $courseLecture->title }} <br> --}}
                    Batch : {{ $batch->title }} <br>
                    Exam : {{ $exam->title }} <br>
                    Marks : {{ $exam->marks }}
                </p>
            </div>
        </div>
        <div class="jumbotron jumbotron-fluid">
            <div class="container d-flex justify-content-center">
                @if ($exam->exam_type == 'MCQ')
                    <div class="card dashboard-area-tabs p-relative o-hidden mb-lg-32pt w-50">
                        <div class="table-responsive">
                            <table class="table mb-0 thead-border-top-0 table-nowrap">
                                {{-- <thead>
                                    <tr>
                                        <th>Name: </th>
                                        <tr>{{ auth()->user()->name }}</tr>
                                    </tr>
                                </thead> --}}
                                <tbody class="list" id="projects">
                                    <tr>
                                        <th>Name: </th>
                                        <td>{{ auth()->user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total: </th>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <th>Gained: </th>
                                        <td>{{ $canAttempt->gain_marks }}</td>
                                    </tr>
                                    <tr>
                                        <th>Percentage: </th>
                                        <td>
                                            @php
                                                echo round($canAttempt->gain_marks*100/10)
                                            @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Highest: </th>
                                        <td>{{ $max }}</td>
                                    </tr>
                                    <tr>
                                        <th>Lowest: </th>
                                        <td>{{ $min }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    @if (!$show)
                        <h1 class="display-5" style="text-align: center">Your submitted answer is being reviewed. Please wait</h1>
                    @else
                        <div class="card dashboard-area-tabs p-relative o-hidden mb-lg-32pt w-50">
                            <div class="table-responsive">
                                <table class="table mb-0 thead-border-top-0 table-nowrap">
                                    <tbody class="list" id="projects">
                                        <tr>
                                            <th>Name: </th>
                                            <td>{{ auth()->user()->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total: </th>
                                            <td>{{ $totalNumber }}</td>
                                        </tr>
                                        <tr>
                                            <th>Gained: </th>
                                            <td>{{ $canAttempt->gain_marks }}</td>
                                        </tr>
                                        <tr>
                                            <th>Percentage: </th>
                                            <td>
                                                @php
                                                    echo round($canAttempt->gain_marks*100/$totalNumber)
                                                @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Highest: </th>
                                            <td>{{ $max }}</td>
                                        </tr>
                                        <tr>
                                            <th>Lowest: </th>
                                            <td>{{ $min }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
    <!-- // END Header Layout Content -->

    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content page-content ">
        <div class="container page__container page-section">
            <div class="page-separator">
                <div class="page-separator__text">Exam: {{ $exam->title }}&nbsp;&nbsp; | Exam Type: {{ $exam->exam_type }}&nbsp;</div>
            </div>

            <div class="card dashboard-area-tabs p-relative o-hidden mb-lg-32pt">
                <div class="table-responsive">
                    <table class="table mb-0 thead-border-top-0 table-nowrap">
                        <thead>
                            <tr>
                                <th>SL. No</th>
                                <th>Question</th>
                                <th>Gain Marks</th>
                            </tr>
                        </thead>
                        <tbody class="list" id="projects">
                            @foreach($detailsResult as $details_result)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    @if ($exam->exam_type == 'MCQ')
                                        <td title="View questions">{{ $details_result->question->question }}</td>
                                    @elseif(($exam->exam_type == 'CQ'))
                                        <td title="View questions">{{ $details_result->cqQuestion->question }}</td>
                                    @elseif(($exam->exam_type == 'Assignment'))
                                        <td title="View questions">{{ $details_result->assignment->question }}</td>
                                    @endif
                                    <td class="text-center">{{ $details_result->gain_marks }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- // END Header Layout Content -->
@endsection */ ?>