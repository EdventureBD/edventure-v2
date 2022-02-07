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
            href="#{{$exam->question_count === $exam->question_limit ? '' : 'createQuestion'}}"
            data-toggle="modal"
            title="Create Model Exam">
            <button class="{{$exam->question_count === $exam->question_limit ? 'disabled' : ''}} btn btn-outline-primary">
                <i class="far fa-plus-square"></i>
                Add Question
            </button>
        </a>
        @if($exam->question_count === $exam->question_limit)
            <small class="text-bold">You have added maximum number of question</small>
        @else
            <small>Maximum Question Limit: {{$exam->question_limit}}</small>
        @endif

    </div>
    @include('admin.pages.model_exam.mcq_question.create')

    <table class="table table-responsive">

        @if(count($exam_questions) > 0)
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Question</th>
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
                <td>{!! $q->field_1 !!}</td>
                <td>{!! $q->field_2 !!}</td>
                <td>{!! $q->field_3 !!}</td>
                <td>{!! $q->field_4 !!}</td>
                <td>{{ $q->answer }}</td>
                <td>{!! $q->explanation !!}</td>
                <td>{{ date('F j, Y, g:i a', strtotime($q->created_at)) }}</td>
                <td>
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
@section('js2')
    <script>
        $(function () {
            $('.select2').select2()

            $('#question').summernote({
                placeholder: 'Enter Question',
                height: 100,
            });

            $('#field_1').summernote({
                placeholder: 'Option 1',
            });

            $('#field_2').summernote({
                placeholder: 'Option 2',
            });

            $('#field_3').summernote({
                placeholder: 'Option 3',
            });

            $('#field_4').summernote({
                placeholder: 'Option 4',
            });

            $('#explanation').summernote({
                placeholder: 'Explanation',
            });
        })

        $('#question_form').on('submit', function(e) {

            if($('#question').summernote('isEmpty')) {
                $('#question_error').html('Question is required!')
                e.preventDefault();
            } else {
                $('#question_error').html('')
            }

            if($('#field_1').summernote('isEmpty')) {
                $('#field_1_error').html('This option is required!')
                e.preventDefault();
            } else {
                $('#field_1_error').html('')
            }

            if($('#field_2').summernote('isEmpty')) {
                $('#field_2_error').html('This option is required!')
                e.preventDefault();
            } else {
                $('#field_2_error').html('')
            }

            if($('#field_3').summernote('isEmpty')) {
                $('#field_3_error').html('This option is required!')
                e.preventDefault();
            } else {
                $('#field_3_error').html('')
            }

            if($('#field_4').summernote('isEmpty')) {
                $('#field_4_error').html('This option is required!')
                e.preventDefault();
            } else {
                $('#field_4_error').html('')
            }

            if($('#explanation').summernote('isEmpty')) {
                $('#explanation_error').html('Explanation is required!')
                e.preventDefault();
            } else {
                $('#explanation_error').html('')
            }
        })
    </script>
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection
