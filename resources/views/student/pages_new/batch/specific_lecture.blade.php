<x-landing-layout headerBg="white">
    <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page-content ">
            <div class="container lecture-page page__container page-section position-relative">
                {{-- <a class="btn text-xxsm text-white bg-purple fw-800 px-3 py-2 w-20 mb-3 mt-4" href="{{ route('course-preview', $course->slug) }}"><i class="fas fa-arrow-up mr-2"></i> Go Back to Journey </a> --}}
                <div class="d-flex justify-content-between pt-5">
                    <div>
                        {{-- @if(!empty($prev_link))<a href="{{$prev_link}}" class="btn text-xxxsm text-white bg-purple fw-800 px-3 py-2 w-20"><i class="fas fa-angle-left"></i> Prev Lecture</a>@endif --}}
                        <a href="{{ route('course-preview', $course->slug) }}" class="btn text-xxsm text-white bg-purple fw-800 px-3 py-2 w-20 mb-3"><i class="fas fa-arrow-up mr-2"></i> Go Back to Journey </a>
                    </div>
                    <div>
                        @if(!empty($next_link))<a id="next-btn" href="{{$next_link}}" class="btn text-xxsm text-white bg-purple fw-800 px-3 py-2 w-20 mb-3 d-none">{{ $next_link_btn_text }}<i class="fas fa-angle-double-right ml-1"></i></a>@endif
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="m-4">
                            <label class="container"> Please click this checkbox after finishing the lecture to proceed to the next parts
                                <input type="checkbox" id="lecture_viewed">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center my-3">
                    <div class="col-lg-12">
                        <div class="flex" style="max-width: 100%">
                            <div class="card card-primary card-tabs">
                                <div class="lecture-tab card-header bg-purple-light p-0 pt-1">
                                    <ul class="nav nav-tabs justify-content-center" id="custom-tabs-one-tab" role="tablist">
                                        {{-- <li class="nav-item mr-md-5 mr-2">
                                            <a class="nav-link active h3 text-purple" id="markdownText" data-toggle="pill" href="#custom-tabs-one-note" role="tab" aria-controls="custom-tabs-one-note" aria-selected="true">Note</a>
                                        </li>
                                        <li class="nav-item mx-md-5 mx-2">
                                            <a class="nav-link h3 text-purple" id="lecture" data-toggle="pill" href="#custom-tabs-one-lecture" role="tab" aria-controls="custom-tabs-one-lecture" aria-selected="false">Lecture</a>
                                        </li>
                                        <li class="nav-item ml-md-5 ml-2">
                                            <a class="nav-link h3 text-purple" id="liveClass" data-toggle="pill" href="#custom-tabs-one-liveClass" role="tab" aria-controls="custom-tabs-one-liveClass" aria-selected="false">Live Class</a>
                                        </li> --}}
                                        <li class="nav-item mr-md-5 mr-2">
                                            <a class="nav-link active h3 text-purple" id="markdownText" data-toggle="pill" href="#custom-tabs-one-note" role="tab" aria-controls="custom-tabs-one-note" aria-selected="true">Solution pdf</a>
                                        </li>
                                        <li class="nav-item mx-md-5 mx-2">
                                            <a class="nav-link h3 text-purple" id="lecture" data-toggle="pill" href="#custom-tabs-one-lecture" role="tab" aria-controls="custom-tabs-one-lecture" aria-selected="false">Solution Video</a>
                                        </li>
                                        <li class="nav-item ml-md-5 ml-2">
                                            <a class="nav-link h3 text-purple" id="liveClass" data-toggle="pill" href="#custom-tabs-one-liveClass" role="tab" aria-controls="custom-tabs-one-liveClass" aria-selected="false">Relevant Notes</a>
                                        </li>
                                    </ul>
                                    
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        <div class="tab-pane fade show active" id="custom-tabs-one-note" role="tabpanel" aria-labelledby="markdownText">
                                            @if ($courseLecture->pdf != null)
                                                <iframe src="{{ $courseLecture->pdf }}" frameborder="0" width="100%" height="600px"></iframe>
                                            @else
                                                {!! $courseLecture->markdown_text !!}
                                            @endif
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-one-lecture" role="tabpanel" aria-labelledby="lecture">
                                            <div class="embed-responsive embed-responsive-16by9 mb-32pt">
                                                <div class="player embed-responsive-item">
                                                    {{-- <div class="player__content">
                                                        <div class="player__image"
                                                            style="--player-image: url({{ asset('student/public/images/illustration/teacher/128/black.svg') }})">
                                                        </div>
                                                        <a href=""
                                                            class="player__play bg-primary">
                                                            <span class="material-icons">play_arrow</span>
                                                        </a>
                                                    </div> --}}
                                                    <div class="player__embed ">
                                                        <iframe width="100%" height="315"
                                                            src="https://www.youtube-nocookie.com/embed/{{ $courseLecture->url }}"
                                                            title="YouTube video player" frameborder="0" allow="accelerometer; autoplay;
                                                        clipboard-write; encrypted-media; gyroscope;
                                                        picture-in-picture" allowfullscreen></iframe>
                                                        {{-- <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/{{ $courseLecture->url }}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe> --}}
                                                        {{-- <iframe class="embed-responsive-item"
                                                                src="https://player.vimeo.com/video/{{ $courseLecture->url }}"
                                                                allowfullscreen=""></iframe> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-one-liveClass" role="tabpanel" aria-labelledby="liveClass">
                                            <div class="row mb-lg-8pt">
                                                <div class="col-sm-12" >
                                                    <div class="">
                                                        @if(isset($liveClass) && !empty($liveClass))
                                                        <div class="mx-auto mt-5 mb-5 text-center">
                                                            <p class="h2 text-xsm text-gray-50 text-purple font-weight-light m-0 text-center">{{$liveClass->title}}</p>
                                                            
                                                            <div id="countdownTimer" class="text-center text-gray-50 count-timer my-4 font-arial"></div>
                                                            <a class="btn text-xxxsm text-white bg-purple fw-800 px-3 py-2 w-20" target="blank" href="{{$liveClass->live_link}}">View Content </a>
                                                        </div>
                                                        @else 
                                                        <div class="mx-auto mt-5 mb-5 text-center">
                                                            <p class="h2 text-xsm text-gray-50 text-purple font-weight-light m-0 text-center">When live class will be scheduled, you will get the class link here</p>                                                            
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="tab-pane fade" id="custom-tabs-one-otherLectures" role="tabpanel" aria-labelledby="otherLectures">
                                            Other Lectures
                                        </div> --}}
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- // END Header Layout Content -->

<script type="text/javascript">
    var timeleft = "<?php echo $timeleft; ?>";
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
            document.getElementById('countdownTimer').innerHTML = "<p class='h2 text-xsm text-gray-50 font-weight-light m-0 text-center my-4'>Time Left </p><span> "+hours+" Hour </span><span> "+min+" Min </span><span> "+sec+" Sec </span>";
        } 
        

        if (timeleft <= 0) {
            // document.getElementById('exam-form').submit();
            clearInterval(downloadTimer);
        }

    }, 1000);
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function(){
        var get_request_url = "/batch/{{ $batch->id }}/ajax/get/{{ $courseLecture->id }}";
        $.ajax({
            url: get_request_url,
            type: 'GET',
            data: { },
            success: function(response)
            {
                if(response){
                    $("#lecture_viewed").attr("checked", true);
                    // $("#lecture_viewed").attr("disabled", true);
                    $('#next-btn').removeClass('d-none')
                }

                var confirm_request_url = "/batch/{{ $batch->id }}/ajax/confirm/{{ $courseLecture->id }}";
                $(document).on('click', '#lecture_viewed', function(){
                    $.ajax({
                        url: confirm_request_url,
                        type: 'GET',
                        data: { },
                        success: function(response)
                        {
                            console.log(response.success, response.completed);
                            if(response.success){
                                $("#lecture_viewed").attr("checked", true);
                                // $("#lecture_viewed").attr("disabled", true);
                                if(response.completed)
                                    $('#next-btn').removeClass('d-none')
                                else
                                    $('#next-btn').addClass('d-none')
                            }
                        }
                    });
                });
            }
        });
    });
    
    // function enable_cb() {
    //     if (this.checked) {
    //         $("#lecture_viewed").attr("disabled", true);
    //     }
    // }
        // else {
        //     $("input.group1").attr("disabled", true);
        // }

    // $(function() {
    //     // enable_cb();
    //     $("#lecture_viewed").click(enable_cb);


    // });
</script>

<style>
    .container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    }

    /* Hide the browser's default checkbox */
    .container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input ~ .checkmark {
    background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .container input:checked ~ .checkmark {
    background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
    content: "";
    position: absolute;
    display: none;
    }

    /* Show the checkmark when checked */
    .container input:checked ~ .checkmark:after {
    display: block;
    }

    /* Style the checkmark/indicator */
    .container .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
</style>
</x-landing-layout>