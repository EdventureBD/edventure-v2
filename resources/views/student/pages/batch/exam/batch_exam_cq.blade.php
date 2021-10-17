<x-landing-layout headerBg="white">
    <div class="course-info bg-gradient-purple py-5">
        <div class="container">
            <div class="row">
                <div class="col-7">
                    <h3 class="text-white flex m-0">Course : {{ $batch->course->title }}</h3>
                </div>
                <div class="col-5 text-right">
                    <p class="h2 text-white-50 font-weight-light m-0">Time Left : <span id="countdownHour"></span>: <span
                        id="countdownMinuits"></span>:<span id="countdownSecound"></p>
                </div>
                {{-- <p class="h1 text-white-50 font-weight-light m-0"> <span id="countdownMinuits-xs"></span> : <span id="countdownSecound-xs"></span></p> --}}
            </div>
            <p class="hero__lead measure-hero-lead text-white-50">Batch : {{ $batch->title }}</p>
            {{-- <p class="hero__lead measure-hero-lead text-white-50">Topic : {{ $courseLecture->title }}</p> --}}
            <p class="hero__lead measure-hero-lead text-white-50">Exam : {{ $exam->title }}</p>
        </div>
    </div>
    <div class="bg-light-gray py-5">
        <div class="container page__container">
            <div class="page-section">
                {{-- action="{{ route('submit', ['batch' => $batch, 'courseLecture' => $courseLecture, 'exam' => $exam]) }}" --}}
                <form action="{{ route('submit', ['batch' => $batch, 'exam' => $exam]) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @forelse($questions as $key => $question)
                        <div class="page-separator">
                            <div class="page-separator__text" style="font-family: 'SiyamRupali', sans-serif;">
                                <span class="badge badge-primary">
                                    Question {{ $key + 1 }}:
                                </span> {!! $question->creative_question !!}
                            </div>
                            @if ($question->image)
                                <div class="avatar avatar-xxl avatar-4by3">
                                    <img src="{{ Storage::url($question->image) }}" alt="Avatar"
                                        class="avatar-img rounded">
                                </div>
                            @endif
                            <input type="hidden" name="ques[{{ $loop->iteration }}]" value="{{ $question->id }}">
                        </div>
                        @foreach ($question->question as $key => $cq)
                            <div class="page-separator ml-5">
                                <div class="page-separator__text" style="font-family: 'SiyamRupali', sans-serif;">
                                    <span class="badge badge-info">
                                        {{ $key + 1 }}:
                                    </span> {!! $cq->question !!}
                                </div>
                                @if ($cq->image)
                                    <div class="avatar avatar-xxl avatar-4by3">
                                        <img src="{{ Storage::url($cq->image) }}" alt="Avatar"
                                            class="avatar-img rounded">
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
                    <p class="h3 text-info">You can write your answer in the textbox or upload your pdf ans paper.</p>
                    <div class="form-group">
                        <label for="submitted_text">Answer: </label>
                        <textarea class="form-control" name="submitted_text" id="submitted_text" rows="3"></textarea>
                    </div>
                    <p class="mx-auto h5">Or Upload a PDF file:</p>
                    <div class="form-group m-0">
                        <div class="custom-file">
                            <input type="file" id="file" name="file" class="custom-file-input">
                            <label for="file" class="custom-file-label">Choose file</label>
                        </div>
                        @error('file')
                            <p style="color: red;font-weight: bold;">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-outline-primary mt-3">Submit</button>
                </form>
            </div>
        </div>

    </div>


    <script type="text/javascript">
        var timeleft = '<?php echo $exam->duration * 60; ?>';
        var downloadTimer = setInterval(function() {
            timeleft--;
            let hour = Math.floor(timeleft / 3600);
            let min = Math.floor(timeleft / 60) >= 60 ? Math.floor(timeleft / 60) - 60 : Math.floor(timeleft / 60);
            let sec = timeleft % 60;
            if (hour < 10) {
                hour = `0${hour}`;
            }
            if (min < 10) {
                min = `0${min}`;
            }
            if (sec < 10) {
                sec = `0${sec}`;
            }

            document.getElementById('countdownMinuits').textContent = min;
            document.getElementById('countdownSecound').textContent = sec;
            document.getElementById('countdownHour').textContent = hour;
            document.getElementById('countdownMinuits-xs').textContent = min;
            document.getElementById('countdownSecound-xs').textContent = sec;
            document.getElementById('countdownHour-xs').textContent = hour;

            if (timeleft <= 0) {
                document.getElementById('exam-form').submit();
                clearInterval(downloadTimer);
            }

        }, 1000);
    </script>
</x-landing-layout>


<?php /*@extends('student.layouts.default', [
'title'=>'Batch Exam',
'pageName'=>'Batch Exam',
'secondPageName'=>'Batch Exam'
])

@section('css1')
    <style>
        .cq-header p {
            margin-bottom: 0 !important;
        }

    </style>
@endsection

@section('content')
    <link href="https://fonts.maateen.me/siyam-rupali/font.css" rel="stylesheet">
    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content page-content ">
        <div class="cq-header bg-primary pb-lg-64pt py-32pt">
            <div class="container page__container">
                <div class="d-flex flex-wrap align-items-end justify-content-end mb-16pt">
                    <h3 class="text-white flex m-0">Course : {{ $batch->course->title }}</h3>
                    <p class="h2 text-white-50 font-weight-light m-0">Time Left : <span id="countdownHour"></span>: <span
                            id="countdownMinuits"></span>:<span id="countdownSecound"></p> <br>
                    {{-- <p class="h1 text-white-50 font-weight-light m-0"> <span id="countdownMinuits-xs"></span> : <span id="countdownSecound-xs"></span></p> --}}
                </div>
                <p class="hero__lead measure-hero-lead text-white-50">Batch : {{ $batch->title }}</p>
                {{-- <p class="hero__lead measure-hero-lead text-white-50">Topic : {{ $courseLecture->title }}</p> --}}
                <p class="hero__lead measure-hero-lead text-white-50">Exam : {{ $exam->title }}</p>
            </div>
        </div>
        <div class="container page__container">
            <div class="page-section">
                {{-- action="{{ route('submit', ['batch' => $batch, 'courseLecture' => $courseLecture, 'exam' => $exam]) }}" --}}
                <form action="{{ route('submit', ['batch' => $batch, 'exam' => $exam]) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @forelse($questions as $key => $question)
                        <div class="page-separator">
                            <div class="page-separator__text" style="font-family: 'SiyamRupali', sans-serif;">
                                <span class="badge badge-primary">
                                    Question {{ $key + 1 }}:
                                </span> {!! $question->creative_question !!}
                            </div>
                            @if ($question->image)
                                <div class="avatar avatar-xxl avatar-4by3">
                                    <img src="{{ Storage::url($question->image) }}" alt="Avatar"
                                        class="avatar-img rounded">
                                </div>
                            @endif
                            <input type="hidden" name="ques[{{ $loop->iteration }}]" value="{{ $question->id }}">
                        </div>
                        @foreach ($question->question as $key => $cq)
                            <div class="page-separator ml-5">
                                <div class="page-separator__text" style="font-family: 'SiyamRupali', sans-serif;">
                                    <span class="badge badge-info">
                                        {{ $key + 1 }}:
                                    </span> {!! $cq->question !!}
                                </div>
                                @if ($cq->image)
                                    <div class="avatar avatar-xxl avatar-4by3">
                                        <img src="{{ Storage::url($cq->image) }}" alt="Avatar"
                                            class="avatar-img rounded">
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
                    <p class="h3 text-info">You can write your answer in the textbox or upload your pdf ans paper.</p>
                    <div class="form-group">
                        <label for="submitted_text">Answer: </label>
                        <textarea class="form-control" name="submitted_text" id="submitted_text" rows="3"></textarea>
                    </div>
                    <p class="mx-auto h5">Or Upload a PDF file:</p>
                    <div class="form-group m-0">
                        <div class="custom-file">
                            <input type="file" id="file" name="file" class="custom-file-input">
                            <label for="file" class="custom-file-label">Choose file</label>
                        </div>
                        @error('file')
                            <p style="color: red;font-weight: bold;">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-outline-primary mt-3">Submit</button>
                </form>
            </div>
        </div>

    </div>
    <!-- // END Header Layout Content -->

    <script type="text/javascript">
        var timeleft = '<?php echo $exam->duration * 60; ?>';
        var downloadTimer = setInterval(function() {
            timeleft--;
            let hour = Math.floor(timeleft / 3600);
            let min = Math.floor(timeleft / 60) >= 60 ? Math.floor(timeleft / 60) - 60 : Math.floor(timeleft / 60);
            let sec = timeleft % 60;
            if (hour < 10) {
                hour = `0${hour}`;
            }
            if (min < 10) {
                min = `0${min}`;
            }
            if (sec < 10) {
                sec = `0${sec}`;
            }

            document.getElementById('countdownMinuits').textContent = min;
            document.getElementById('countdownSecound').textContent = sec;
            document.getElementById('countdownHour').textContent = hour;
            document.getElementById('countdownMinuits-xs').textContent = min;
            document.getElementById('countdownSecound-xs').textContent = sec;
            document.getElementById('countdownHour-xs').textContent = hour;

            if (timeleft <= 0) {
                document.getElementById('exam-form').submit();
                clearInterval(downloadTimer);
            }

        }, 1000);
    </script>
@endsection
*/ ?>