@extends('student.layouts.default', [
                                    'title'=>'Batch Lecture',
                                    'pageName'=>'Batch Lecture',
                                    'secondPageName'=>'Batch Lecture'
                                ])
@section('content')
    <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page-content ">
            <div class="container page__container page-section">
                <div class="row mb-32pt">
                    <div class="col-lg-12 d-flex align-items-center">
                        <div class="flex" style="max-width: 100%">
                            <div class="card card-primary card-tabs">
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs justify-content-center" id="custom-tabs-one-tab" role="tablist">
                                        <li class="nav-item mr-5">
                                            <a class="nav-link active h3 text-info" id="markdownText" data-toggle="pill" href="#custom-tabs-one-note" role="tab" aria-controls="custom-tabs-one-note" aria-selected="true">Note</a>
                                        </li>
                                        <li class="nav-item ml-5 mr-5">
                                            <a class="nav-link h3 text-info" id="lecture" data-toggle="pill" href="#custom-tabs-one-lecture" role="tab" aria-controls="custom-tabs-one-lecture" aria-selected="false">Lecture</a>
                                        </li>
                                        <li class="nav-item ml-5">
                                            <a class="nav-link h3 text-info" id="liveClass" data-toggle="pill" href="#custom-tabs-one-liveClass" role="tab" aria-controls="custom-tabs-one-liveClass" aria-selected="false">Live Class</a>
                                        </li>
                                        {{-- <li class="nav-item">
                                            <a class="nav-link h3 text-info" id="otherLectures" data-toggle="pill" href="#custom-tabs-one-otherLectures" role="tab" aria-controls="custom-tabs-one-otherLectures" aria-selected="false">Other Lectures</a>
                                        </li> --}}
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        <div class="tab-pane fade show active" id="custom-tabs-one-note" role="tabpanel" aria-labelledby="markdownText">
                                            {!! $courseLecture->markdown_text !!}
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-one-lecture" role="tabpanel" aria-labelledby="lecture">
                                            <div class="js-player embed-responsive embed-responsive-16by9 mb-32pt">
                                                <div class="player embed-responsive-item">
                                                    <div class="player__content">
                                                        <div class="player__image"
                                                            style="--player-image: url({{ asset('student/public/images/illustration/teacher/128/black.svg') }})">
                                                        </div>
                                                        <a href=""
                                                            class="player__play bg-primary">
                                                            <span class="material-icons">play_arrow</span>
                                                        </a>
                                                    </div>
                                                    <div class="player__embed d-none">
                                                        <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/{{ $courseLecture->url }}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
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
                                                    <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1">
                                                        <div class="card-body d-flex flex-column mx-auto mt-5 mb-5">
                                                            {{-- <p class="h2 text-gray-50 font-weight-light m-0">Time Left : 1 Day <span id="countdownMinuits"></span> Min <span id="countdownSecound"></p> <br> --}}
                                                            <p class="h2 text-gray-50 font-weight-light m-0">
                                                                You have Live Class on 
                                                                @php
                                                                    echo $start_date . ' at ';
                                                                    echo $start_time;
                                                                @endphp
                                                            </p> <br>
                                                            <button class="btn btn-outline-info h3">Join Live Class</button>
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
    var timeleft = '<?php echo 50*60;?>';
    var downloadTimer = setInterval(function () {
        timeleft--;
        if (timeleft >= 60) {
            var min = parseInt(timeleft / 60);
            var sec = timeleft % 60;
            document.getElementById('countdownMinuits').textContent = min;
            document.getElementById('countdownSecound').textContent = sec;
            document.getElementById('countdownMinuits-xs').textContent = min;
            document.getElementById('countdownSecound-xs').textContent = sec;
        } else {
            document.getElementById('countdownMinuits').textContent = 0;
            document.getElementById("countdownSecound").textContent = timeleft;
            document.getElementById('countdownMinuits-xs').textContent = 0;
            document.getElementById("countdownSecound-xs").textContent = timeleft;
        }

        if (timeleft <= 0) {
            document.getElementById('exam-form').submit();
            clearInterval(downloadTimer);
        }

    }, 1000);

</script>
@endsection