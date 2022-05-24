<x-landing-layout headerBg="white">
    <link rel="stylesheet" href="/css/tooltip.css">
    <style>
        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            width: 1%;
            background-color: #6400c8
        }
        thead tr td {
            font-weight: 800;
        }
    </style>
    <div class="page-section ">
        @if ($exam->exam_type == 'MCQ' || 'Aptitude Test')
            @php
                $total_marks = 0;
                $total_gain_marks = 0;
                foreach($detailsResults as $result){
                    $total_marks += 1;
                    $total_gain_marks += $result->gain_marks;
                }
            @endphp
            <div class="mx-md-5">
                <h4 class=" text-sm fw-800">Marks : {{$total_gain_marks." out of ".$total_marks}}</h4>

                <div class="d-flex justify-content-between">
                    <div class="text-right">
                        <a class="btn text-xxsm text-white fw-800 px-3 py-2 w-20 mb-3" href="{{route('batch-lecture', $batch->slug)}}" style="background: #6400c8"> Go Back <i class="fas fa-arrow-up ml-2"> </i></a>
                    </div>
                    <div class="text-right">
                        <a class="btn text-xxsm text-white fw-800 px-3 py-2 w-20 mb-3" href="{{ $next_link }}" style="background: #6400c8"> {{ $next_link_btn_text }} <i class="fas fa-angle-double-right ml-1"></i></a>
                    </div>
                </div>

                <div class="result-sheet-table overflow-x-scroll">
                    <table class="table table-responsive table-striped table-bordered max-w-100">
                        <thead>
                            <tr class="bg-purple text-white text-center">
                                <td class="fit">Sl</td>
                                <td class="fit">Question</td>
                                <td class="fit">Answer</td>
                                <td class="fit">Your Answer</td>
                                <td class="fit">Explanation</td>
                                <td class="fit">Success Rate
                                    <span style="color: #fa9632"
                                          class=""
                                          data-toggle="tooltip"
                                          data-placement="auto"
                                          title="This value shows the percentage  of students who got this particular question right"><i class="fa fa-info-circle"></i>
                                    </span>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @php $n = 1;@endphp
                            @foreach($detailsResults as $result)
                            @php
                                $field = 'field'.$result->mcq_ans;
                                $cfield = 'field'.$result->atQuestion->answer;
                                $cellcolor = $result->mcq_ans == $result->atQuestion->answer ? '#9DCA7B' : '#DD7575';
                            @endphp
                            <tr style="color: black" class="text-center">
                                <td>{{$n}}</td>
                                <td>{!! $result->atQuestion->question !!}</td>
                                <td>{!! $result->atQuestion->$cfield !!}</td>
                                <td style="background: {{$cellcolor}}; color: black; font-weight: 600">
                                    {!! $result->atQuestion->$field !!}
                                </td>
                                <td>{!! $result->atQuestion->explanation !!}</td>
                                {{-- @dd($result, $result->atQuestion->gain_marks, $result->atQuestion->number_of_attempt) --}}
                                <td>{{number_format(($result->atQuestion->gain_marks * 100 )/ $result->atQuestion->number_of_attempt, 2)}}%</td>
                            </tr>
                            @php $n++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            @if (!$show)
            <div class="course-info bg-gradient-purple py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-7">
                            <h3 class="text-white flex m-0">Course : {{ $batch->course->title }}</h3>
                        </div>
                    </div>
                    <p class="hero__lead measure-hero-lead text-white-50">Batch : {{ $batch->title }}</p>
                    {{-- <p class="hero__lead measure-hero-lead text-white-50">Topic : {{ $courseLecture->title }}</p> --}}
                    <p class="hero__lead measure-hero-lead text-white-50">Exam : {{ $exam->title }}</p>
                </div>
            </div>
            <div class="bg-light-gray">
                <div class="container">
                    <div class="py-5 ">
                        <h1 class="display-5 text-sm text-dark max-w-38 mx-auto fw-600" style="text-align: center">Your submitted answer is being reviewed. Please wait</h1>
                    </div>
                </div>
            </div>
            @else
            @php
                $total_marks = 0;
                $total_gain_marks = 0;
                foreach($detailsResult as $result){
                    $total_marks += $result->cqQuestion->marks;
                    $total_gain_marks += $result->gain_marks;
                }
            @endphp
            <div class="container">
                <h2 class="text-purple text-lg text-center mt-4">Result Sheet</h2>
                <p class="text-center text-sm">Marks : <b>{{$total_gain_marks." out of ".$total_marks}}</b></p>
                <div class="result-sheet-table overflow-x-scroll">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="bg-purple text-white text-center">Stem</th>
                                <th class="bg-purple text-white text-center">Question</th>
                                <th class="bg-purple text-white text-center">Ave<br/> Score</th>
                                <th class="bg-purple text-white text-center">Your Answer</th>
                                <th class="bg-purple text-white text-center">Correct Answer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $n = 1; @endphp
                            @foreach($detailsResult as $result)
                            @php

                                $cellcolor = "bg-purple2";
                                if ($n == 1) $creative = $result->cqQuestion->creativeQuestion->creative_question;
                                $avg = 0;

                                if (!empty($result->atQuestion) && $result->atQuestion->gain_marks > 0) {
                                    $avg = number_format(($result->atQuestion->gain_marks * 100 )/ $result->atQuestion->number_of_attempt, 2);
                                }

                            @endphp
                            <tr>
                                @if ($n==1 || $creative != $result->cqQuestion->creativeQuestion->creative_question)
                                <td rowSpan="4" class="{{$cellcolor}} text-white">{!! $result->cqQuestion->creativeQuestion->creative_question !!}</td>
                                @php $cretive = $result->cqQuestion->creativeQuestion->creative_question; @endphp
                                @endif
                                <td class="{{$cellcolor}} text-white">{!! $result->cqQuestion->question !!}</td>
                                <td class="{{$cellcolor}} text-white text-sm fw-600 bshadow">{{$avg}}%</td>
                                @if ($n==1)
                                <td rowSpan="4" class="{{$cellcolor}} v-align-middle">
                                    <a href="" class="btn text-xxsm text-white bg-purple px-3 py-2 " data-toggle="modal" data-target="#yourAnswerModal">View Pdf</a>
                                </td>
                                <td rowSpan="4" class="{{$cellcolor}} v-align-middle">
                                    <a href="" class="btn text-xxsm text-white bg-purple px-4 py-2 " data-toggle="modal" data-target="#correctAnswerModal">View Pdf</a>
                                </td>
                                @endif
                            </tr>
                            @php
                                $n++;
                                if ($n == 5) {
                                    $n = 1;
                                }
                            @endphp
                            @endforeach
                        </tbody>
                    </table>

                    <div class="modal fade" id="yourAnswerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Your Answer</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                @if ($exam_paper->submitted_text != null)
                                    <textarea name="" id="" cols="30" rows="10">{{ $exam_paper->submitted_text }}</textarea>
                                @elseif ($exam_paper->submitted_pdf != null)
                                    <iframe src="{{ Storage::url($exam_paper->submitted_pdf) }}" frameborder="0" width="100%" height="600px"></iframe>
                                @endif
                            </div>
                          </div>
                        </div>
                    </div>

                    <div class="modal fade" id="correctAnswerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Correct Answer</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                @if ($exam_paper->checked_paper != null)
                                    <iframe src="{{ Storage::url($exam_paper->checked_paper) }}" frameborder="0"
                                        width="100%" height="600px"></iframe>
                                @endif
                            </div>
                          </div>
                        </div>
                    </div>

                </div>
            </div>
            @endif
        @endif

    </div>
</x-landing-layout>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
 </script>
