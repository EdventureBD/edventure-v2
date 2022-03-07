<x-landing-layout headerBg="white">
    <style>
        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            max-width: 2%;
            border: 1px solid rgba(0, 0, 0, 0.185);
            text-align: center;
            font-weight: bold;
        }
        tbody td {
            border: 1px solid rgba(0, 0, 0, 0.185);
            text-align: center
        }
    </style>
    <div class="mt-5 px-md-5">
            <div class="py-md-5 my-md-5 mt-6">
                <h3>Result Details:</h3>
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
                <div class="py-5 py-md-1 text-center d-flex justify-content-center">
                    <p class="text-center">{{ $exam_results->withQueryString()->links('vendor.pagination.custom') }}</p>
                </div>
            </div>
    </div>

</x-landing-layout>
