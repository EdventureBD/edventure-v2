<x-landing-layout headerBg="white">
    <div class="course-info py-5 border" style="background: #D5BDEA; box-shadow: 5px 10px 18px #888888">
        <div class="container pt-5">
            <div class="row">
                <div class="col-7">
                    <h3 class="text-gray d-flex m-0 fw-800">Course : {{ $batch->course->title }}</h3>
                </div>
                <div class="col-5 text-right mx-0 px-0">
                    <div id="parent-timer" class="timer d-flex justify-content-center rounded bg-purple">
                        <div id="innerParent">
                            <div id="timer" class="w-100 mx-0 px-0 d-flex justify-content-center">
                                <p class="text-white d-flex fw-500 m-0 rounded" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 20px;">
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
                                <a href="#"  class=" border rounded bg-secondary">
                                    <span>1</span>
                                </a>
                                <a href="#"  class="border rounded bg-secondary">
                                <span>2</span>
                                </a>
                                <a href="#"  class="border rounded bg-secondary">
                                    <span>3</span>
                                </a>
                                <a href="#"  class="border rounded bg-secondary">
                                    <span>4</span>
                                </a>
                                <a href="#"  class="border rounded bg-secondary">
                                    <span>5</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                <p class="h1 text-white-50 font-weight-light m-0 d-none"> <span id="countdownHour-xs"></span> : <span id="countdownMinuits-xs"></span> : <span id="countdownSecound-xs"></span></p>
            </div>
            <p class="hero__lead measure-hero-lead text-gray my-3 fw-800">Batch : {{ $batch->title }}</p>
            {{-- <p class="hero__lead measure-hero-lead text-white-50">Topic : {{ $courseLecture->title }}</p> --}}
            <p class="hero__lead measure-hero-lead text-gray my-3 fw-800">Exam : {{ $exam->title }}</p>
        </div>
    </div>
    <div class="py-5 border rounded border-dashed">
        <div class="container page__container">
            <div class="page-section">
                {{-- action="{{ route('submit', ['batch' => $batch, 'courseLecture' => $courseLecture, 'exam' => $exam]) }}" --}}


                



                <form action="{{ route('submit', ['batch' => $batch, 'exam' => $exam]) }}" id="cqFormSubmit" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    @foreach($mcq_questions as $mcq)
                        <div class="question mb-5" id="">
                            <div class="bg-purple-light p-2 mb-3 rounded d-flex" style="border: 1px solid gray; box-shadow:
                            inset 0 -3em 3em rgba(248, 245, 245, 0.384),
                                  0 0  0 2px #C8A2C8,
                                  0.3em 0.3em 1em rgba(247, 244, 244, 0.651);"><b class="pr-2">{{ $loop->iteration }}</b> <span>{!! $mcq->question !!} </span></div>
                            {{-- <div class="row"> --}}
                                @if($mcq->image)
                                    <div class="col-md-6 d-block d-md-none">
                                        <img class="img-fluid bradius-15 mb-2" src="{{ $mcq->image }}" alt="" />
                                    </div>
                                @endif
                                    {{-- <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
                                    <label class="btn btn-secondary" for="option1">Checked</label>

                                    <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
                                    <label class="btn btn-secondary" for="option2">Radio</label>

                                    <input type="radio" class="btn-check" name="options" id="option4" autocomplete="off">
                                    <label class="btn btn-secondary" for="option4">Radio</label> --}}

                                    {{-- <div class="bg-purple-light bg-light-gray bshadow bradius-15 p-2 mb-3 d-block">
                                        <label class="btn btn-info w-100">
                                            <input type="radio" name="options" id="option1" autocomplete="off"> Active
                                        </label>
                                        <label class="btn btn-info">
                                            <input type="radio" name="options" id="option2" autocomplete="off"> Radio
                                        </label>
                                        <label class="btn btn-info">
                                            <input type="radio" name="options" id="option3" autocomplete="off"> Radio
                                        </label>
                                    </div> --}}

                                    {{-- <fieldset class="form-group">
                                        <div class="row">
                                        <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                                            <label class="form-check-label" for="gridRadios1">
                                                First radio
                                            </label>
                                            </div>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                            <label class="form-check-label" for="gridRadios2">
                                                Second radio
                                            </label>
                                            </div>
                                            <div class="form-check disabled">
                                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>
                                            <label class="form-check-label" for="gridRadios3">
                                                Third disabled radio
                                            </label>
                                            </div>
                                        </div>
                                        </div>
                                    </fieldset> --}}

                                    <div class="container my-4">
                                        <div class="question d-flex justify-content-start">
                                            <div class="pt-sm-0 pt-3 form-group" id="options">
                                                <label class="options"> {!! $mcq->field1 !!}
                                                    <input type="radio" name="mcq_ques[{{ $mcq->id }}]" value="1">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="options"> {!! $mcq->field2 !!}
                                                    <input type="radio" name="mcq_ques[{{ $mcq->id }}]" value="2">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="options"> {!! $mcq->field3 !!}
                                                    <input type="radio" name="mcq_ques[{{ $mcq->id }}]" value="3">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="options"> {!! $mcq->field4 !!}
                                                    <input type="radio" name="mcq_ques[{{ $mcq->id }}]" value="4">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                {{-- <div class="col-md-6 d-none d-md-block">
                                    {question.image ? <img className="img-fluid bradius-15" src={question.image} alt="" /> : ""}
                                </div> --}}
                            {{-- </div> --}}
                        </div>
                    @endforeach






                    @forelse($cq_questions as $key => $question)
                        <div class="page-separator pt-4">
                            <div class="bg-purple-light rounded p-3" style="border : 1px solid gray; box-shadow:
                            inset 0 -3em 3em rgba(248, 245, 245, 0.384),
                                  0 0  0 2px #C8A2C8,
                                  0.3em 0.3em 1em rgba(247, 244, 244, 0.651);">
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
                                    <div class=" bg-purple-light p-3 bradius-15 bshadow mt-3">
                                        <img src="{{ Storage::url($cq->image) }}" alt="Avatar"
                                            class="avatar-img rounded img-fluid">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @empty
                        <div class="page-separator">
                            <div class="page-separator__text" style="font-family: 'SiyamRupali', sans-serif;">
                                <span class="badge badge-secondary">
                                    No question
                                </span>
                            </div>
                        </div>
                    @endforelse
                    <div>
                        <div class="d-flex flex-column justify-center">
                            <p class="h3 text-center pt-5 pb-3 text-dark fw-800">উত্তরঃ-</p>
                        </div>
                        <div class="form-group">
                            <label for="submitted_text" class="text-center w-100 fw-600">Write your answer here </label>
                            <textarea class="form-control" name="submitted_text" id="submitted_text" rows="3"></textarea>
                        </div>
                        <div class="d-flex justify-center">
                            <p class="mx-auto h5">Or Upload a PDF answer file:</p>
                        </div>
                        <div class="form-group m-0">
                            <div class="custom-file">
                                <input type="file" id="file" name="file" class="custom-file-input">
                                <label for="file" class="custom-file-label">Choose file</label>
                            </div>
                            @error('file')
                                <p style="color: red;font-weight: bold;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center px-5">
                            <button type="submit" class="btn text-xxsm fw-600 text-white bg-purple px-4 py-2 my-4">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script type="text/javascript">
    
        var timeleft = '<?php echo $exam->duration * 60; ?>';
        var downloadTimer = setInterval(function () {
            timeleft--;
            var hours = 0;
            var minH = 0;
            var min = 0;
            var sec = timeleft > 0 ? timeleft : 0;
            if (timeleft >=3600) {
                hours = Math.floor(timeleft/3600);
                minH = parseInt(timeleft % 3600) ;
                min = Math.floor(minH / 60);
                sec = parseInt(minH % 60);
            } else if (timeleft >= 60) {
                min = Math.floor(timeleft / 60);
                sec = parseInt(timeleft % 60);
            } 
            if (timeleft > 0) {
                document.getElementById('countdownMinuits').textContent = min;
                document.getElementById('countdownSecound').textContent = sec;
                document.getElementById('countdownHour').textContent = hours;
            } 
            
            if (timeleft <= 0) {
                clearInterval(downloadTimer);
            }
        }, 1000);

    </script>
    <script type="text/javascript">
        // var formSumit
        window.onbeforeunload = function() {
            // return "Dude, are you sure you want to leave? Think of the kittens!";
        }
        
    </script>

    <style>
        .question {
            width: 75%
        }

        .options {
            position: relative;
            padding-left: 40px
        }

        #options label {
            display: block;
            margin-bottom: 15px;
            font-size: 14px;
            cursor: pointer
        }

        .options input {
            opacity: 0
        }

        .checkmark {
            position: absolute;
            top: -1px;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #D5BDEA;
            border: 1px solid #ddd;
            border-radius: 50%;'
        }

        .options input:checked~.checkmark:after {
            display: block
        }

        .options .checkmark:after {
            content: "";
            width: 10px;
            height: 10px;
            display: block;
            background: white;
            position: absolute;
            top: 50%;
            left: 50%;
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: 300ms ease-in-out 0s
        }

        .options input[type="radio"]:checked~.checkmark {
            background: rgb(123, 69, 126);
            transition: 300ms ease-in-out 0s
            /* #D5BDEA */
        }

        .options input[type="radio"]:checked~.checkmark:after {
            transform: translate(-50%, -50%) scale(1)
        }

        .btn-primary {
            background-color: #D5BDEA;
            color: #ddd;
            border: 1px solid #ddd
        }

        .btn-primary:hover {
            background-color: #D5BDEA;
            border: 1px solid #D5BDEA;
        }

        .btn-success {
            padding: 5px 25px;
            background-color: #D5BDEA;
        }

        @media(max-width:576px) {
            .question {
                width: 100%;
                word-spacing: 2px
            }
        }
    </style>
    {{-- ------------------------Frontend Script part for Timer collapse and expand #start--------------------------------------- --}}
    <script>
         const closeCollapse = () => {
           questionMap.classList.add("d-none");
        //    openCollapseIcon.classList.add("d-none");
           closeCollapseIcon.classList.remove("d-block");
           closeCollapseIcon.classList.add("d-none");
           openCollapseIcon.classList.add("d-block");

        };
         const openCollapse = () => {
           questionMap.classList.remove("d-none");
           closeCollapseIcon.classList.remove("d-none");
           openCollapseIcon.classList.remove("d-block");
           openCollapseIcon.classList.add("d-none");
            
        };
        let closeCollapseIcon = document.getElementById("close_collapse_icon");
        let openCollapseIcon = document.getElementById("open_collapse_icon");
        let questionMap = document.getElementById("questionMap");
        closeCollapseIcon.addEventListener("click", closeCollapse);
        openCollapseIcon.addEventListener("click", openCollapse);
        
       

    </script>
    {{-- -----------------------------Frontend Script part for Timer collapse and expand # ends ----------------------------- --}}
</x-landing-layout>