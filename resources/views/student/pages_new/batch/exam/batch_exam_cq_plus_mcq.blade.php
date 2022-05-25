<x-landing-layout headerBg="white">
    <link rel="stylesheet" href="/css/mcq-plus-timer.css">
    <div class="course-info py-5 border-secondary" id="popUpExamPageBanner">
        <div class="container pt-5">
            <div class="row">
                <div class="col-12">
                    <h3 class="text-gray d-flex justify-content-center m-0 fw-800">Exam : {{ $exam->title }}</h3>
                    {{-- <span style="color: red" class="mx-auto d-flex justify-content-center mt-3 fw-800">
                        {{$exam->negative_marking ?  'Caution: This exam contains '.$exam->negative_marking_value.' negative marking for every wrong answer. Please be careful while answering' : ''}}
                    </span> --}}
                    {{-- <h6 class="hero__lead measure-hero-lead text-gray my-3 fw-800 d-flex justify-content-center">Batch : {{ $batch->title }}</h6> --}}
                    <h6 class="hero__lead measure-hero-lead text-gray my-3 fw-800 d-flex justify-content-center"> Course : {{ $batch->course->title }}</h6>
                </div>
            </div>
        </div>
    </div>
<div class="py-5">
    <div class="container page__container">
        
        <div class="row">
            <div class="col-12 mx-0 px-0">
                <div id="parent-timer" class="timer d-flex justify-content-center flex-column">
                    <div id="innerParent" class="d-flex container">
                        <div class="d-flex" >
                            <p  class="my-auto fw-600" id="question-palette" style="width: max-content">QUESTION PALETTE</p>
                        </div>
                        <div id="timer" class="w-100 mx-md-5 px-0 d-flex justify-content-center">
                            <p class="d-flex fw-500 m-0 rounded">
                                <span id="countdownHour"></span>:
                                <span id="countdownMinuits"></span>:
                                <span id="countdownSecound"></span>
                            </p>
                        </div>
                        <div id="dropdownIcon-questionMap-parent">
                            <div id="dropdownIcon" >
                                <a href="javascript:void(0)" id="close_collapse_icon" class="d-none px-2 my-auto">
                                    <img src="/img/exam-page/drop_down_off.png" alt="" class="img-fluid">
                                </a>
                                <a href="javascript:void(0)" id="open_collapse_icon" class="d-block px-2 my-auto">
                                    <img src="/img/exam-page/drop_down_on.png" alt="" class="img-fluid">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="questionMap" class="mx-0 px-0 text-center d-none overflow-auto w-100" >

                    </div>
                </div>


            </div>
            <p class="h1 text-white-50 font-weight-light m-0 d-none"> <span id="countdownHour-xs"></span>:<span id="countdownMinuits-xs"></span>:<span id="countdownSecound-xs"></span></p>
        </div>
        
        <div class="page-section">

            <form action="{{ route('submit', ['batch' => $batch, 'exam' => $exam]) }}" id="cqFormSubmit" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                @if($mcq_questions->count() > 0)
                    @foreach($mcq_questions as $mcq)
                        <div class="question mb-5 popUpMcqParentDiv" id="q_{{$mcq->id}}">
                            <div class="bg-purple-light d-flex justify-content-start align-items-middle popUpExamMcqTitle"><b class="ml-2 my-auto px-2" style="word-break: initial !important">{{ $loop->iteration }}</b> <span class="mr-2 px-2 text-wrap">{!! $mcq->question !!} </span></div>
                                @if($mcq->image)
                                    <div class="col-md-6 d-block d-md-none">
                                        <img class="img-fluid bradius-15 mb-2" src="{{ $mcq->image }}" alt="mcq-question's image" />
                                    </div>
                                @endif

                                <div class="container my-4">
                                    <div class="question d-flex justify-content-start">
                                        <div class="row row-cols-1 pt-sm-0 pt-3 form-group mx-0 px-0 popUpMcqOptions" id="options_{{$mcq->id}}">
                                            <label class="options" id="mcq_{{$mcq->id}}_op1"> {!! $mcq->field1 !!}
                                                <input type="radio" name="mcq_ques[{{ $mcq->id }}]" value="1" id="mcqOp1">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="options" id="mcq_{{$mcq->id}}_op2"> {!! $mcq->field2 !!}
                                                <input type="radio" name="mcq_ques[{{ $mcq->id }}]" value="2" id="mcqOp2">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="options" id="mcq_{{$mcq->id}}_op3"> {!! $mcq->field3 !!}
                                                <input type="radio" name="mcq_ques[{{ $mcq->id }}]" value="3" id="mcqOp3">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="options" id="mcq_{{$mcq->id}}_op4"> {!! $mcq->field4 !!}
                                                <input type="radio" name="mcq_ques[{{ $mcq->id }}]" value="4" id="mcqOp4">
                                                <span class="checkmark"></span>
                                            </label>
                                                <input type="radio" name="mcq_ques[{{ $mcq->id }}]" checked value="0" style="display: none">
                                        </div>
                                    </div>
                                </div>
                        </div>
                    @endforeach
                @endif

                @foreach($cq_questions as $key => $question)
                    <div class="page-separator pt-4">
                        <div class="bg-purple-light rounded p-3 popUpExamCqTitle">
                            <span class="badge badge-primary">
                                Question {{ $key + 1 }}:
                            </span> {!! $question->creative_question !!}
                        </div>
                        @if ($question->image)
                            <div class="avatar avatar-xxl avatar-4by3 bg-purple-light">
                                <img src="{{ Storage::url($question->image) }}" alt="Avatar"
                                    class="avatar-img rounded img-fluid">
                            </div>
                        @endif
                        <input type="hidden" name="cq_ques[{{ $loop->iteration }}]" value="{{ $question->id }}">
                    </div>
                    @foreach ($question->question as $key => $cq)
                        <div class="page-separator mt-3">
                            <div class="page-separator__text bg-light-gray bradius-15 bshadow p-3 single-question">
                                <span class="">
                                    {{ $key + 1 }}:
                                </span> <div class="d-inline-block"> {!!$cq->question !!}</div>
                            </div>
                            @if ($cq->image)
                                <div class="bg-purple-light p-3 bradius-15 bshadow mt-3">
                                    <img src="{{ Storage::url($cq->image) }}" alt="Avatar"
                                        class="avatar-img rounded img-fluid">
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endforeach

                @if($cq_questions->count() > 0)
                    <p class="h3 text-center pt-5 pb-3 text-dark fw-800">উত্তরঃ-</p>
                    <div class="form-group" style="padding-left: 0% !important">
                        {{-- <label for="submitted_text" class="text-center w-100 fw-600">Write your answer here </label> --}}
                        <textarea class="form-control" name="submitted_text" id="submitted_text" rows="3" placeholder="Write your CQ's answer here."></textarea>
                    </div>
                    <div class="d-flex justify-center">
                        <p class="mx-auto h5">Or Upload a PDF answer file:</p>
                    </div>
                    <div class="form-group m-0" style="padding-left: 0% !important">
                        <div class="custom-file">
                            <input type="file" id="file" name="file" class="custom-file-input">
                            <label for="file" class="custom-file-label">Choose file</label>
                        </div>
                        @error('file')
                            <p style="color: red;font-weight: bold;">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
                
                <div class="d-flex justify-content-center px-5">
                    <button type="submit" class="btn text-xxsm fw-600 text-white custom-submit-btn px-4 py-2 my-4">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <script type="text/javascript">

        var timeleft = {{$exam->duration * 60}};

        // forontend design part's js starts
        let mcqQuestions = <?php echo json_encode($mcq_questions)?>;
        //frontend design part's js ends
    </script>

    <script src="/js/mcqExamPlusTimer.js"></script>
</x-landing-layout>
<script>
    $(window).scroll(function(){
        if($(this).scrollTop() > 1){
            $('#parent-timer').addClass('sticky-top')
        } else{
            $('#parent-timer').removeClass('sticky-top')
        }
    });
</script>