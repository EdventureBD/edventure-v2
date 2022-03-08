<x-landing-layout>
    <style>
        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            width: 1%;
        }
        thead tr td {
            font-weight: 800;
        }
    </style>
    <div class="mx-md-5 mx-sm-0 my-5" style="max-width: 100%">
        <div class="my-5 py-5">
            <div>
                <h4 class="fw-800">Exam Result: {{$result->total_marks > 0 ? $result->total_marks : 0}} out of {{count($exam_answer)}}</h4>
                <table class="table table-responsive table-striped table-bordered max-w-100">
                    <thead class="text-white text-center" style="background: #6400c8">
                        <tr>
                            <td class="fit">SL</td>
                            <td class="fit">Question</td>
                            <td class="fit">Answer</td>
                            <td class="fit">Your Answer</td>
                            <td class="fit">Explanation</td>
                            <td class="fit">Success Rate</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($exam_answer as $key => $answer)
                        <tr>
                            <td class="text-center">
                                {{$loop->iteration}}
                            </td>
                            <td class="text-center">{!! $answer->mcqQuestion->question !!}</td>
                            <td class="text-center">
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
                            <td class="text-center"
                                style="background:{{empty($answer->mcq_ans) && !empty($exam->negative_marking) ? '' : ($answer->mcqQuestion->answer == $answer->mcq_ans ? '#9DCA7B' : '#DD7575')}}; color: black; font-weight: 600">
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
                            <td class="text-center">{!! $answer->mcqQuestion->explanation  !!}</td>
                            <td class="text-center">{{number_format(($answer->mcqQuestion->modelMcqQuestionAnalysis->correct/$answer->mcqQuestion->modelMcqQuestionAnalysis->attempted) * 100, 2).' %'}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-landing-layout>
