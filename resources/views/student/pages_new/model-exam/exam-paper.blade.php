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
    <div class="py-5 border rounded border-dashed">
        <div class="container page__container">
            <div class="page-section">
                <form action="{{route('model.exam.mcq.submit',$exam->id)}}" id="cqFormSubmit" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="exam_end_time" name="exam_end_time">
                    @foreach($exam->mcqQuestions as $mcq)
                        <div class="question mb-5 popUpMcqParentDiv" id="q_{{$mcq->id}}">
                            <div class="bg-purple-light p-3 d-flex rounded popUpExamMcqTitle"><b class="pr-2">{{ $loop->iteration }}</b> <span>{!! $mcq->question !!} </span></div>

                            <div class="container my-4">
                                <div class="question d-flex justify-content-start">
                                    <div class="row row-cols-1 pt-sm-0 pt-3 form-group mx-0 px-0 popUpMcqOptions" id="options_{{$mcq->id}}">
                                        <input type="hidden" name="mcq[{{ $mcq->id }}]" value="0">
                                        <label class="options"> {!! $mcq->field_1 !!}
                                            <input type="radio" name="mcq[{{ $mcq->id }}]" value="1" id="mcqOp1">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="options"> {!! $mcq->field_2 !!}
                                            <input type="radio" name="mcq[{{ $mcq->id }}]" value="2" id="mcqOp2">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="options"> {!! $mcq->field_3 !!}
                                            <input type="radio" name="mcq[{{ $mcq->id }}]" value="3" id="mcqOp3">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="options"> {!! $mcq->field_4 !!}
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


    <script type="text/javascript">
        var timeleft = {{$exam->duration * 60}};
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
            $('#exam_end_time').val(timeleft)

            if (timeleft <= 0) {
                clearInterval(downloadTimer);
                $('#cqFormSubmit').submit()
            }
        }, 1000);

    </script>
    <script type="text/javascript">
        window.onbeforeunload = function() {
            // if(!$('#cqFormSubmit').submit()) {
            //     return "Are you sure you want to leave?";
            // }

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
    <script type="text/javascript">

        let closeCollapseIcon = document.getElementById("close_collapse_icon");
        let openCollapseIcon = document.getElementById("open_collapse_icon");
        let questionMap = document.getElementById("questionMap");

        /* timer's part starts  */

        const closeCollapse = () => {
            questionMap.classList.add("d-none");
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
        closeCollapseIcon.addEventListener("click", closeCollapse);
        openCollapseIcon.addEventListener("click", openCollapse);

        /* timer's part ends  */

        /* Question Mapping part starts */
        let mcqQuestions = <?php echo json_encode($exam->mcqQuestions)?>;

        let questionCount = 0;
        if (mcqQuestions.length > 0) {
            mcqQuestions.forEach(mcqQuestion => {
                questionCount++;
                let a = document.createElement("a");
                a.className = ("border rounded bg-secondary");
                let span = document.createElement("span");
                span.innerText = questionCount;
                a.setAttribute("id", `map_${mcqQuestion.id}`);
                a.setAttribute("href", `#q_${mcqQuestion.id}`)
                a.appendChild(span);
                questionMap.append(a);
                let optionFiledID = document.getElementById("options_" + mcqQuestion.id);
                optionFiledID.addEventListener("click", () => {
                    let optionIdInMap = document.getElementById(`map_${mcqQuestion.id}`);
                    optionIdInMap.classList.remove("bg-secondary");
                    optionIdInMap.classList.add("bg-success");
                });
            });
        }
        /* Question Mapping part ends */

        // if(document.getElementById("mcqOp1_").checked) {
        //     console.log("ckecked");
        // }
        // else console.log("unchecked");


    </script>
    {{-- -----------------------------Frontend Script part for Timer collapse and expand # ends ----------------------------- --}}
</x-landing-layout>
