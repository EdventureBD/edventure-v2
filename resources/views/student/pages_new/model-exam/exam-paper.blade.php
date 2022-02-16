<x-landing-layout headerBg="white">
    <link rel="stylesheet" href="/css/mcq-plus-timer.css">
    <div class="course-info py-5 border-secondary" id="popUpExamPageBanner">
        <div class="container pt-5">
            <div class="row">
                <div class="col-7">
                    <h3 class="text-gray d-flex m-0 fw-800">Exam : {{ $exam->title }}</h3>
                </div>
                <div class="col-5 text-right mx-0 px-0">
                    <div id="parent-timer" class="timer d-flex justify-content-center rounded bg-purple">
                        <div id="innerParent">
                            <div id="timer" class="w-100 mx-0 px-0 d-flex justify-content-center">
                                <p class="text-white d-flex fw-500 m-0 rounded">
                                    <span id="countdownHour"></span>:
                                    <span id="countdownMinuits"></span>:
                                    <span id="countdownSecound"></span>
                                </p>
                            </div>
                            <div id="dropdownIcon" >
                                <a href="#" id="close_collapse_icon" class="d-none">
                                    <i class="c-point fas fa-angle-up"></i>
                                </a>
                                <a href="#" id="open_collapse_icon" class="d-block">
                                    <i class="c-point fas fa-angle-down"></i>
                                </a>
                            </div>
                            <div id="questionMap" class="row row-cols-3 mx-0 px-0 text-center d-none">

                            </div>
                        </div>
                    </div>


                </div>
                <p class="h1 text-white-50 font-weight-light m-0 d-none"> <span id="countdownHour-xs"></span>:<span id="countdownMinuits-xs"></span>:<span id="countdownSecound-xs"></span></p>
            </div>
        </div>
    </div>
    <div class="py-5">
        <div class="container page__container">
            <div class="page-section">
                <form action="{{route('model.exam.mcq.submit',$exam->id)}}" id="cqFormSubmit" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="exam_end_time" name="exam_end_time">
                    @foreach($exam->mcqQuestions as $mcq)
                        <div class="question mb-5 popUpMcqParentDiv" id="q_{{$mcq->id}}">
                            <div class="bg-purple-light p-3 d-flex popUpExamMcqTitle"><b class="pr-2">{{ $loop->iteration }}</b> <span>{!! $mcq->question !!} </span></div>

                            <div class="container my-4">
                                <div class="question d-flex justify-content-start">
                                    <div class="row row-cols-1 pt-sm-0 pt-3 form-group mx-0 px-0 popUpMcqOptions" id="options_{{$mcq->id}}">
                                        <input type="hidden" name="mcq[{{ $mcq->id }}]" value="0">
                                        <label class="options" id="mcq_{{$mcq->id}}_op1"> {!! $mcq->field_1 !!}
                                            <input type="radio" name="mcq[{{ $mcq->id }}]" value="1" id="mcqOp1">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="options" id="mcq_{{$mcq->id}}_op2"> {!! $mcq->field_2 !!}
                                            <input type="radio" name="mcq[{{ $mcq->id }}]" value="2" id="mcqOp2">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="options" id="mcq_{{$mcq->id}}_op3"> {!! $mcq->field_3 !!}
                                            <input type="radio" name="mcq[{{ $mcq->id }}]" value="3" id="mcqOp3">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="options" id="mcq_{{$mcq->id}}_op4"> {!! $mcq->field_4 !!}
                                            <input type="radio" name="mcq[{{ $mcq->id }}]" value="4" id="mcqOp4">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-center px-5">
                        <button type="submit" class="btn text-xxsm fw-600 text-white bg-purple px-4 py-2 my-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- new vendor's code part starts --}}
    <script type="text/javascript">
        
        var timeleft = {{$exam->duration * 60}};
        

        // forontend design part's js starts
        let mcqQuestions = <?php echo json_encode($exam->mcqQuestions)?>;
        //frontend design part's js ends
    </script>
     {{-- new vendor's code part ends --}}

    <script src="/js/mcqExamPlusTimer.js"></script>
</x-landing-layout>
