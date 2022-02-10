@extends('admin.layouts.default', [
'title'=> 'Model Exam',
'pageName'=> 'Exam Tag',
'secondPageName' => 'Exam Tag'
])

@section('content')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
    </style>
    @include('admin.pages.model_exam.exam_tag.filter')
    @include('admin.pages.model_exam.exam_tag.create')

    <table class="table table-responsive table-striped">

        @if(count($exam_tags) > 0)
            <thead>
            <tr>
                <th class="fit" scope="col">#</th>
                <th class="fit" scope="col">Tags</th>
                <th class="fit" scope="col">Topic</th>
                <th class="fit" scope="col">Category</th>
                <th class="fit" scope="col">Created at</th>
                <th class="fit" scope="col">Action</th>
            </tr>
            </thead>
        @endif
        <tbody>
        @forelse ($exam_tags as $tag)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $tag->name }}</td>
                <td>{{ $tag->examTopic->name }}</td>
                <td>{{ $tag->examTopic->examCategory->name }}</td>
                <td>{{ date('F j, Y, g:i a', strtotime($tag->created_at)) }}</td>
                <td style="display: inline-flex">
                    @include('admin.pages.model_exam.exam_tag.edit')
                    @include('admin.pages.model_exam.exam_tag.delete')
                    @include('admin.pages.model_exam.exam_tag.view')
                </td>
            </tr>
        @empty
            <div class="d-flex justify-content-center">
                <p>No Tags Found</p>
            </div>
            <div class="d-flex justify-content-center">
                <img src="{{asset('admin/notFound.svg')}}" width="193" height="130" />
            </div>


        @endforelse
        </tbody>
    </table>
    @if ($exam_tags->hasPages())
        <div class="pagination-wrapper">
            {{ $exam_tags->links() }}
        </div>
    @endif

@endsection
@section('js2')
    <script>
        $(function () {
            $('.select2').select2()
        })

        function fetchData(id) {
            let url = window.location.origin +'/admin/exam-tags/'+id;

            $.ajax({
                type: "GET",
                url: url,
                success: function(response){
                    $("#tag_name"+id).val(response.name);
                    $("#topic"+id).val(response.exam_topic_id).trigger('change');
                },
                error: function(e){
                    console.log(e)
                }
            });
        }
    </script>
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection
