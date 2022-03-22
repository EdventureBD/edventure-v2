<x-landing-layout>
    <style>
        .examBtn{
            border-radius: 25px;
            /*background: #6400c8;*/
            background: white;
            color: #6400c8;
            border-color: #6400c8;
        }
        .examBtn:hover{
            background: #6400c8;
            color: white;
            border-color: #6400c8;
        }
    </style>
   <div class="container my-5">
       <div class="my-5 py-5 d-flex justify-content-center">
            <div id="successfully_submitted_section">
                <h1 class="text-success"><i class="far fa-check-circle"></i>  Thanks.</h1>
                <div class="d-flex text-purple">
                    <h5>Your script has been submitted successfully!</h5>
                </div>

                <div class="d-flex mt-5">
                    <a class="btn btn-sm" style="background: #FA9632; color: white; border-radius: 25px"
                       href="{{route('student.model.test.result')}}">Let's see your performance!</a>
                </div>
                @if(count($topics) > 0)
                    <div class="d-flex mt-3">
                        <div>
                            Related Exam :
                        </div>
                        <div class="row">
                            @foreach($topics as $topic)

                            <div class="ml-4">
                                <a href="{{route('model.exam',['t' => $topic->id])}}"
                                   class="examBtn btn btn-sm btn-outline-primary">
                                    {{$topic->name}}
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
       </div>

   </div>
</x-landing-layout>
