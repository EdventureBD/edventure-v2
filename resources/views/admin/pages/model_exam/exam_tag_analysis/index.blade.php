@extends('admin.layouts.default', [
'title'=> 'Model Exam',
'pageName'=> 'Exam Tag Analysis',
'secondPageName' => 'Exam Tag Analysis'
])

@section('content')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .select2-purple .select2-container--default span span{
            height: 2.35rem;
        }
        div .select2 .selection .select2-selection{
            height: 2.35rem;
        }
    </style>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="">
        <div class="row">
            <div class="col-md-6">
                <div class="select2-purple d-flex align-middle py-0 pb-md-5">
                    <select
                        name="query[exam]"
                        class="select2 form-control"
                        id="query_category_selected"
                        data-placeholder="Choose Exam"
                        data-dropdown-css-class="select2-purple"
                        style="width: 100%; margin-top: -8px !important;">
                        @foreach ($exams as $exam)
                            <option value=""></option>
                            <option value="{{ $exam->id }}">{{ $exam->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <button class="btn btn-outline-primary">Analyse</button>
            </div>

            <div class="col-md-3">
                <a href="{{route('model.exam.tag.analysis')}}" class="btn btn-outline-secondary">Clear</a>
            </div>
        </div>

    </form>
    <table class="table">

        @if(count($tags) > 0)
            <b>Exam:</b> {{$selectedExam->title}}<br>
            <b>Student Attempted:</b> {{$studentCount}}
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tag</th>
                <th scope="col">Question</th>
                <th scope="col">Accuracy</th>
            </tr>
        </thead>
        @endif
        <tbody>
        @forelse ($tags as $tag)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$tag->name}}</td>
                <td>{{$tag->usedInNumberOfQuestions($selectedExam->id)}}</td>
                <td>{{$tag->accuracy}} %</td>
            </tr>
        @empty
            <div class="d-flex justify-content-center">
                <p>Select Exams To See Analysis</p>
            </div>
            <div class="d-flex justify-content-center">
                <img src="{{asset('admin/notFound.svg')}}" width="193" height="130" />
            </div>


        @endforelse
        </tbody>
    </table>
{{--    @if ($tags->hasPages())--}}
{{--        <div class="pagination-wrapper">--}}
{{--            {{ $tags->links() }}--}}
{{--        </div>--}}
{{--    @endif--}}
@endsection
@section('js2')
    <script>
        $(function () {
            $('.select2').select2()
        })
    </script>
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection
