<x-landing-layout headerBg="white">
    <style>
        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            max-width: 2%;
        }
    </style>
    <div class="mt-5 pt-5 p-5">
            <div class="container">

                <table class="table table-striped table-responsive align-content-center">
                    <thead>
                    <tr>
                        <td class="fit col">Exams</td>
                        <td class="fit col">Gain Marks</td>
                        <td class="fit col">Details</td>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($exam_results as $result)
                    <tr>
                        <td>{{$result->modelExam->title}}</td>
                        <td>{{$result->total_marks}}</td>
                        <td>
                            <a target="_blank" href="{{route('model.exam.paper.mcq',['id'=>\Illuminate\Support\Facades\Crypt::encrypt($result->modelExam->id)])}}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-info-circle"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td></td>
                            <td>You have not attended to any exam yet!</td>
                            <td></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
    </div>

</x-landing-layout>
