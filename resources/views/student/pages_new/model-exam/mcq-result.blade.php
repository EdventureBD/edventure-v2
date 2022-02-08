<x-landing-layout>
    <div class="container my-5">
        <div class="my-5 py-5 d-flex justify-content-center">
            <div>
                <h4>Exam Result: <b>{{(int)$result->total_marks}}</b> Out of <b>{{$exam->total_exam_marks}}</b></h4>
                <table class="table table-responsive table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Question</td>
                            <td>Answer</td>
                            <td>Your Answer</td>
                            <td>Explanation</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($exam_answer as $key => $answer)
                        <tr>
                            <td style="background: {{$answer->mcqQuestion->answer == $answer->mcq_ans ? 'lime' : 'red'}}">
                                {{$loop->iteration}}
                            </td>
                            <td>{!! $answer->mcqQuestion->question !!}</td>
                            <td>
                                @if($answer->mcqQuestion->answer == 1)
                                    {!! $answer->mcqQuestion->field_1 !!}
                                @elseif($answer->mcqQuestion->answer == 2)
                                    {!! $answer->mcqQuestion->field_2 !!}
                                @elseif($answer->mcqQuestion->answer == 3)
                                    {!! $answer->mcqQuestion->field_3 !!}
                                @elseif($answer->mcqQuestion->answer == 4)
                                    {!! $answer->mcqQuestion->field_4 !!}
                                @endif
                            </td>
                            <td>
                                @if($answer->mcq_ans == 1)
                                    {!! $answer->mcqQuestion->field_1 !!}
                                @elseif($answer->mcq_ans == 2)
                                    {!! $answer->mcqQuestion->field_2 !!}
                                @elseif($answer->mcq_ans == 3)
                                    {!! $answer->mcqQuestion->field_3 !!}
                                @elseif($answer->mcq_ans == 4)
                                    {!! $answer->mcqQuestion->field_4 !!}
                                @endif
                            </td>
                            <td>{!! $answer->mcqQuestion->explanation  !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-landing-layout>
