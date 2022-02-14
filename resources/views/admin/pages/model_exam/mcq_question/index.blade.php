@extends('admin.layouts.default', [
'title'=> 'Model Exam',
'pageName'=> 'Mcq Question',
'secondPageName' => 'Mcq Question'
])

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <a href="{{route('model.exam.index')}}" title="Back to exams"> <i class="far fa-hand-point-left"></i> </a>
    <div style="justify-content: right;display: grid; text-align: end">
        <a
            href="#{{$exam->mcqQuestionsCount() === $exam->question_limit ? '' : 'createQuestion'}}"
            data-toggle="modal"
            title="Create Model Exam">
            <button class="{{$exam->mcqQuestionsCount() === $exam->question_limit ? 'disabled' : ''}} btn btn-outline-primary">
                <i class="far fa-plus-square"></i>
                Add Question
            </button>
        </a>
        @if($exam->mcqQuestionsCount() === $exam->question_limit)
            <small class="text-bold">You have added maximum number of question</small>
        @else
            <small>Maximum Question Limit: {{$exam->question_limit}}</small>
        @endif

    </div>
    @include('admin.pages.model_exam.mcq_question.create')

    <table class="table table-responsive table-striped">

        @if(count($exam_questions) > 0)
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Question</th>
                <th scope="col">Tag</th>
                <th scope="col">Option 1</th>
                <th scope="col">Option 2</th>
                <th scope="col">Option 3</th>
                <th scope="col">Option 4</th>
                <th scope="col">Answer</th>
                <th scope="col">Explanation</th>
                <th scope="col">Created at</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
        @endif
        <tbody>
        @forelse ($exam_questions as $q)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{!! $q->question !!}</td>
                <td class="badge badge-pill badge-info" style="margin-top: auto;padding:5px">
                    {{$q->examTag->name}}
                </td>
                <td>{!! $q->field_1 !!}</td>
                <td>{!! $q->field_2 !!}</td>
                <td>{!! $q->field_3 !!}</td>
                <td>{!! $q->field_4 !!}</td>
                <td>{{ $q->answer }}</td>
                <td>{!! $q->explanation !!}</td>
                <td>{{ date('F j, Y, g:i a', strtotime($q->created_at)) }}</td>
                <td class="d-flex justify-content-center">
                    <a class="mr-1 btn btn-sm btn-outline-primary"
                       href="{{ route('model.exam.question.edit',$q->slug) }}">
                        <i class="far fa-edit"></i>
                    </a>

                    @include('admin.pages.model_exam.mcq_question.delete')
                </td>
            </tr>
        @empty
            <div class="d-flex justify-content-center">
                <p>No Question Found</p>
            </div>
            <div class="d-flex justify-content-center">
                <img src="{{asset('admin/notFound.svg')}}" width="193" height="130" />
            </div>


        @endforelse
        </tbody>
    </table>
    @if ($exam_questions->hasPages())
        <div class="pagination-wrapper">
            {{ $exam_questions->links() }}
        </div>
    @endif
@endsection

@include('admin.pages.model_exam.mcq_question.utils')
