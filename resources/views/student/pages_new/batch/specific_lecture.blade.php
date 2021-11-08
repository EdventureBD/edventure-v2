<x-landing-layout headerBg="white">
    <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page-content ">
            <div class="container lecture-page page__container page-section position-relative">
                <a class="btn text-xxsm text-white bg-purple fw-800 px-2 py-2 w-20 mb-3 mt-4" href="{{ route('course-preview', $course->slug) }}"><i class="fas fa-angle-double-left"></i> Back to course</a>
                <div class="d-flex justify-content-between">
                    <div>
                @if(!empty($prev_lecture_link))<a href="{{$prev_lecture_link}}" class="btn text-xxxsm text-white bg-purple fw-800 px-2 py-2 w-20"><i class="fas fa-angle-left"></i> Prev Lecture</a>@endif
                    </div>
                <div>
                @if(!empty($next_lecture_link))<a href="{{$next_lecture_link}}" class="btn text-xxxsm text-white bg-purple fw-800 px-2 py-2 w-20">Next Lecture <i class="fas fa-angle-right"></i></a>@endif
                </div>
                </div>
                <div class="row justify-content-center my-3">
                    <div class="col-lg-12">
                        <div class="flex" style="max-width: 100%">
                            <div class="card card-primary card-tabs">
                                <div class="lecture-tab card-header bg-purple-light p-0 pt-1">
                                    <ul class="nav nav-tabs justify-content-center" id="custom-tabs-one-tab" role="tablist">
                                        <li class="nav-item mr-md-5 mr-2">
                                            <a class="nav-link active h3 text-purple" id="markdownText" data-toggle="pill" href="#custom-tabs-one-note" role="tab" aria-controls="custom-tabs-one-note" aria-selected="true">Note</a>
                                        </li>
                                        <li class="nav-item mx-md-5 mx-2">
                                            <a class="nav-link h3 text-purple" id="lecture" data-toggle="pill" href="#custom-tabs-one-lecture" role="tab" aria-controls="custom-tabs-one-lecture" aria-selected="false">Lecture</a>
                                        </li>
                                        <li class="nav-item ml-md-5 ml-2">
                                            <a class="nav-link h3 text-purple" id="liveClass" data-toggle="pill" href="#custom-tabs-one-liveClass" role="tab" aria-controls="custom-tabs-one-liveClass" aria-selected="false">Live Class</a>
                                        </li>
                                        {{-- <li class="nav-item">
                                            <a class="nav-link h3 text-purple" id="otherLectures" data-toggle="pill" href="#custom-tabs-one-otherLectures" role="tab" aria-controls="custom-tabs-one-otherLectures" aria-selected="false">Other Lectures</a>
                                        </li> --}}
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        <div class="tab-pane fade show active" id="custom-tabs-one-note" role="tabpanel" aria-labelledby="markdownText">
                                            {!! $courseLecture->markdown_text !!}
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
                                                        <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/66140585" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
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
                                                        <div class="mx-auto mt-5 mb-5 text-center">
                                                            <p class="h2 text-xsm text-gray-50 text-purple font-weight-light m-0 text-center">Topic: {{$liveClass->title}}</p>
                                                            <p class="h2 text-xsm text-gray-50 font-weight-light m-0 text-center my-4">Time Left </p>
                                                            <div id="countdownTimer" class="text-center text-gray-50 count-timer my-4 font-arial"></div>
                                                            <a class="btn text-xxxsm text-white bg-purple fw-800 px-2 py-2 w-20" href="{{$liveClass->live_link}}">View Live Class </a>
                                                        </div>
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
        var sec = timeleft;
        if (timeleft >=3600) {
             hours = Math.floor(timeleft/3600);
             minH = parseInt(timeleft % 3600) ;
             min = Math.floor(minH / 60);
             sec = parseInt(minH % 60);
        } else if (timeleft >= 60) {
            min = Math.floor(timeleft / 60);
             sec = parseInt(timeleft % 60);
        }
            // var min = Math.floor(minH / 60);
            // var sec = parseInt(minH % 60);
            // document.getElementById('countdownTimer').innerHTML = "<span> "+hours+" Hour </span><span> "+min+" Min </span><span> "+sec+" Sec </span>";
            // document.getElementById('countdownMinuits').textContent = min;
            // document.getElementById('countdownSecound').textContent = sec;
        // } 
        document.getElementById('countdownTimer').innerHTML = "<span> "+hours+" Hour </span><span> "+min+" Min </span><span> "+sec+" Sec </span>";

        if (timeleft <= 0) {
            // document.getElementById('exam-form').submit();
            clearInterval(downloadTimer);
        }

    }, 1000);

</script>
</x-landing-layout>