@extends('admin.layouts.default', [
'title'=> 'Model Exam',
'pageName'=> 'Exam Topic',
'secondPageName' => 'Exam Topic'
])

@section('content')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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

    <div class="row">
       <div class="col-md-9">
        @include('admin.pages.model_exam.exam_topic.filter')

       </div>
       <div class="col-md-3">
        @include('admin.pages.model_exam.exam_topic.create')
       </div>
    </div>

    <table class="table table-striped table-responsive">

        @if(count($exam_topics) > 0)
            <thead>
            <tr>
                <th class="fit" scope="col">#</th>
                <th class="fit" scope="col">Topic</th>
                <th class="fit" scope="col">Category</th>
                <th class="fit" scope="col">Multiple Subject</th>
                <th class="fit" scope="col">Created at</th>
                <th class="fit" scope="col">Action</th>
            </tr>
            </thead>
        @endif
        <tbody>
        @forelse ($exam_topics as $index => $topic)
            <tr>
                <td>{{$index + $exam_topics->firstItem()}}</td>
                <td>{{ $topic->name }}</td>
                <td>{{ $topic->examCategory->name }}</td>
                <td>{{ empty($topic->multiple_subject) ? 'No' : 'Yes' }}</td>
                <td>{{ date('F j, Y, g:i a', strtotime($topic->created_at)) }}</td>
                <td style="display: flex">
                    @include('admin.pages.model_exam.exam_topic.edit')
                    @include('admin.pages.model_exam.exam_topic.delete')
                </td>
            </tr>
        @empty
            <div class="d-flex justify-content-center">
                <p>No Topics Found</p>
            </div>
            <div class="d-flex justify-content-center">
                <img src="{{asset('admin/notFound.svg')}}" width="193" height="130" />
            </div>


        @endforelse
        </tbody>
    </table>
    @if ($exam_topics->hasPages())
        <div class="pagination-wrapper">
            {{ $exam_topics->withQueryString()->links() }}
        </div>
    @endif
@endsection
@section('js2')
    <script>
        $(function () {
            $('.select2').select2()
        })

        function fetchData(id) {
            let url = window.location.origin +'/admin/exam-topic/'+id;

            $.ajax({
                type: "GET",
                url: url,
                success: function(response){
                    $("#topic_name"+id).val(response.name);
                    $("#category"+id).val(response.exam_category_id).trigger('change');
                },
                error: function(e){
                    console.log(e)
                }
            });
        }
    </script>
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection
