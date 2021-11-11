<x-landing-layout headerBg="white">
    <div class="course-info bg-gradient-purple py-5">
        <div class="container">
            <div class="row">
                <div class="col-7">
                    <h3 class="text-white flex m-0">Course : {{ $batch->course->title }}</h3>
                </div>
                <div class="col-5 text-right">
                    <p class="h2 text-white font-weight-light m-0 rounded timer">
                        <span id="countdownHour"></span>: <span
                        id="countdownMinuits"></span>:<span id="countdownSecound">

                        </p>
                </div>
                <p class="h1 text-white-50 font-weight-light m-0 d-none"> <span id="countdownHour-xs"></span> : <span id="countdownMinuits-xs"></span> : <span id="countdownSecound-xs"></span></p>
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
                <form action="{{ route('submit', ['batch' => $batch, 'exam' => $exam]) }}" id="cqFormSubmit" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @forelse($questions as $key => $question)
                    {{-- @php dd($question); @endphp --}}
                        <div class="page-separator">
                            <div class="bg-purple-light bradius-10 p-3">
                                <span class="badge badge-primary">
                                    Question {{ $key + 1 }}:
                                </span> {!! $question->question !!}
                            </div>
                            @if ($question->image)
                                <div class="avatar avatar-xxl avatar-4by3 bg-purple-light">
                                    <img src="{{ Storage::url($question->image) }}" alt="Avatar"
                                        class="avatar-img rounded img-fluid">
                                </div>
                            @endif
                            <input type="hidden" name="ques[{{ $loop->iteration }}]" value="{{ $question->id }}">
                        </div>
                        {{-- @foreach ($question->assignment as $key => $cq) --}}
                            {{-- <div class="page-separator mt-3">
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
                            </div> --}}
                        {{-- @endforeach --}}
                    @empty
                        <div class="page-separator">
                            <div class="page-separator__text" style="font-family: 'SiyamRupali', sans-serif;">
                                <span class="badge badge-secondary">
                                    No question
                                </span>
                            </div>
                        </div>
                    @endforelse
                    <p class="h3 text-center pt-5 pb-3 text-dark fw-800">উত্তরঃ-</p>
                    <div class="form-group">
                        <label for="submitted_text" class="text-center w-100 fw-600">Write your answer here </label>
                        <textarea class="form-control" name="submitted_text" id="submitted_text" rows="3"></textarea>
                    </div>
                    <p class="mx-auto h5">Or Upload a PDF answer file:</p>
                    <div class="form-group m-0">
                        <div class="custom-file">
                            <input type="file" id="file" name="file" class="custom-file-input">
                            <label for="file" class="custom-file-label">Choose file</label>
                        </div>
                        @error('file')
                            <p style="color: red;font-weight: bold;">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn text-xxsm fw-600 text-white bg-purple px-4 py-2 mx-auto mt-4">Submit</button>
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
</x-landing-layout>