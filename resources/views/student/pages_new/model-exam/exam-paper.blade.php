<x-landing-layout headerBg="white">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        body {
            background-color: #333
        }

        .container-2 {
            background-color: #555;
            color: #ddd;
            border-radius: 10px;
            padding: 20px;
            font-family: 'Montserrat', sans-serif;
        }

        .container-2>p {
            font-size: 32px
        }

        .question {
            width: 100%
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
            background-color: #555;
            border: 1px solid #ddd;
            border-radius: 50%
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
            background: #653092;
            transition: 300ms ease-in-out 0s
        }

        .options input[type="radio"]:checked~.checkmark:after {
            transform: translate(-50%, -50%) scale(1)
        }

        .btn-primary {
            background-color: #555;
            color: #ddd;
            border: 1px solid #ddd
        }

        .btn-primary:hover {
            background-color: #653092;
            border: 1px solid #653092
        }

        .btn-success {
            padding: 5px 25px;
            background-color: #653092
        }

        @media(max-width:576px) {
            .question {
                width: 100%;
                word-spacing: 2px
            }
        }
    </style>
    <div class="page-section">
        <div class="container-2">
            <div class="container-2 mt-sm-5 my-1">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('model.exam.mcq.submit',$exam->id)}}" method="POST">
                    @csrf
                    @foreach($exam->mcqQuestions as $q)
                        <div class="question ml-sm-5 pl-sm-5 pt-2">
                            <div class="py-2 h5"><b> Q. {!!strip_tags($q->question)!!}</b></div>
                            <div class="ml-md-3 ml-sm-3 pl-md-5 pt-sm-0 pt-3" id="options">
                                <input value="0" type="hidden" name="mcq[{{ $q->id }}]">
                                <label class="options">
                                    {!! strip_tags($q->field_1) !!}
                                    <input value="1" type="radio" name="mcq[{{ $q->id }}]">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="options">{!! strip_tags($q->field_2) !!}
                                    <input value="2" type="radio" name="mcq[{{ $q->id }}]">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="options">{!! strip_tags($q->field_3) !!}
                                    <input value="3" type="radio" name="mcq[{{ $q->id }}]">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="options">{!! strip_tags($q->field_4) !!}
                                    <input value="4" type="radio" name="mcq[{{ $q->id }}]">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    @endforeach


                <div class="d-flex align-items-center pt-3">
{{--                    <div id="prev"> <button class="btn btn-primary">Previous</button> </div>--}}
                    <div class="ml-auto mr-sm-5"> <button type="submit" class="btn btn-success">Submit</button> </div>
                </div>
                </form>
            </div>
        </div>
    </div>

</x-landing-layout>
