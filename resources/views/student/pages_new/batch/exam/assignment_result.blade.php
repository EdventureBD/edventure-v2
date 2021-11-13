<x-landing-layout headerBg="white">
    <div class="page-section ">
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
        //  dd($detailsResult->question);
        @endphp
        <div class="container">
            <h2 class="text-purple text-lg text-center mt-4">Result Sheet</h2>
            <div class="result-sheet-table overflow-x-scroll">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            {{-- <th class="bg-purple text-white text-center">Stem</th> --}}
                            <th class="bg-purple text-white text-center">Question</th>
                            <th class="bg-purple text-white text-center">Score</th>
                            <th class="bg-purple text-white text-center">Your Answer</th>
                            <th class="bg-purple text-white text-center">Correct Answer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @foreach($detailsResult as $result)
                        @php
                        // dd($result->assignment);
                            $cellcolor = "bg-purple2";
                            // if ($n == 1) $creative = $result->cqQuestion->creativeQuestion->creative_question;
                            $avg = 0;
                            
                            // if (!empty($result->question) && $result->question->gain_marks > 0) {
                            //     $avg = number_format(($result->question->gain_marks * 100 )/ $result->question->number_of_attempt, 2);
                            // }
                            
                        @endphp
                        <tr>
                            {{-- @if ($n==1 || $creative != $result->cqQuestion->creativeQuestion->creative_question)
                            <td rowSpan="4" class="{{$cellcolor}} text-white">{!! $result->cqQuestion->creativeQuestion->creative_question !!}</td>
                            @php $cretive = $result->cqQuestion->creativeQuestion->creative_question; @endphp
                            @endif --}}
                            <td class="{{$cellcolor}} text-white">{!! $result->assignment->question !!}</td>
                            <td class="{{$cellcolor}} text-white text-sm fw-600 bshadow">{{$result->gain_marks}}</td>
                            @if ($n==1)
                            <td rowSpan="4" class="{{$cellcolor}} v-align-middle">
                                <a href="" class="btn text-xxsm text-white bg-purple px-3 py-2 " data-toggle="modal" data-target="#yourAnswerModal">View Pdf</a>
                            </td>
                            <td rowSpan="4" class="{{$cellcolor}} v-align-middle">
                                <a href="" class="btn text-xxsm text-white bg-purple px-4 py-2 " data-toggle="modal" data-target="#correctAnswerModal">View Pdf</a>
                            </td>
                            @endif
                        </tr>
                        @php $n++; @endphp
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
                                <textarea name="" id="" class="form-control" rows="10">{{ $exam_paper->submitted_text }}</textarea>
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
    </div>
</x-landing-layout>

