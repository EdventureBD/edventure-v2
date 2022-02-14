@extends('admin.layouts.default', [
'title'=> 'Model Exam',
'pageName'=> 'Exams Result',
'secondPageName' => 'Exams Result'
])

@section('content')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <style>
        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            width: 1%;
        }
        .select2-purple .select2-container--default span span{
            padding-top: auto;
            padding-bottom: auto;
            height: 2.35rem;
        }
        div .select2 .selection .select2-selection{
            padding-top: auto;
            padding-bottom: auto;
            height: 2.35rem;
        }
    </style>
    @include('admin.pages.model_exam.result.filter')
    <table class="table table-responsive table-striped">

        @if(count($results) > 0)
            <thead>
            <tr>
                <th class="fit" scope="col">#</th>
                <th class="fit" scope="col">Student</th>
                <th class="fit" scope="col">Email</th>
                <th class="fit" scope="col">Exam</th>
                <th class="fit" scope="col">Category</th>
                <th class="fit" scope="col">Topic</th>
                <th class="fit" scope="col">Exam Type</th>
                <th class="fit" scope="col">Total Marks</th>
                <th class="fit" scope="col">Gain Marks</th>
                <th class="fit" scope="col">Payment Status</th>
                <th class="fit" scope="col">Action</th>
            </tr>
            </thead>
        @endif
        <tbody>
        @forelse ($results as $result)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $result->student->name }}</td>
                <td>{{ $result->student->email }}</td>
                <td>{{ $result->modelExam->title }}</td>
                <td>{{ $result->modelExam->category->name }}</td>
                <td>{{ $result->modelExam->topic->name }}</td>
                <td>{{ \App\Enum\ExamType::Exam[$result->modelExam->exam_type]  }}</td>
                <td>{{ $result->modelExam->mcqQuestionsCount() }}</td>
                <td>{{ $result->total_marks }}</td>
                <td style="width: 30%; border-radius: 25px; padding: 5px; margin: 8% 15%" class="badge badge-info">
                    {{ !is_null($result->modelExam->exam_price) && $result->modelExam->exam_price != 0 ? 'PAID' : 'FREE' }}
                </td>
                <td>
                    <a href="{{route('model.exam.paper.mcq',['id'=>$result->modelExam->id, 'student_id'=> $result->student->id])}}" class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </td>
            </tr>
        @empty
            <div class="d-flex justify-content-center">
                <p>No Result Found</p>
            </div>
            <div class="d-flex justify-content-center">
                <img src="{{asset('admin/notFound.svg')}}" width="193" height="130"/>
            </div>
        @endforelse
        </tbody>
    </table>
    @if ($results->hasPages())
        <div class="pagination-wrapper">
            {{ $results->withQueryString()->links() }}
        </div>
    @endif
@endsection

@include('admin.pages.model_exam.result.utils')
