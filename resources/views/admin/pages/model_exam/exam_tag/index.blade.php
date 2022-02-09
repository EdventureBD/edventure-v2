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
    <form action="{{route('exam.tags.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="select2-purple d-flex align-middle py-0 pb-5">
                    <select required
                            class="select2 form-control"
                            name="exam_topic_id"
                            data-placeholder="Select a Topic"
                            data-dropdown-css-class="select2-purple"
                            style="width: 100%; margin-top: -8px !important;">
                        @foreach ($exam_topics as $topic)
                            <option value=""></option>
                            <option value="{{ $topic->id }}">{{ $topic->name.' ('.$topic->examCategory->name.')' }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input
                        required
                        type="text"
                        class="form-control"
                        name="name"
                        placeholder="Tags name"
                        aria-label="Tags name"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit">Create</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
    <table class="table">

        @if(count($exam_tags) > 0)
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tags</th>
                <th scope="col">Topic</th>
                <th scope="col">Category</th>
                <th scope="col">Created at</th>
                <th scope="col">Action</th>
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
                <td>
                    <a class="mr-1 btn btn-outline-primary btn-sm"
                       onclick="fetchData({{ $tag->id }});"
                       href="#editTag{{ $tag->id }}"
                       data-toggle="modal"
                       title="Edit {{ $tag->name }}">
                        <i class="far fa-edit"></i>
                    </a>
                    <a class="mr-1 btn btn-outline-danger btn-sm"
                       href="#deleteTag{{ $tag->id }}"
                       data-toggle="modal"
                       title="Delete {{ $tag->name }}">
                        <i class="far fa-trash-alt"></i>
                    </a>
                    <div class="modal fade"
                         id="deleteTag{{ $tag->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content bg-light">
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete
                                        {{ $tag->name }}</h4>
                                    <button type="button" class="close"
                                            data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure??</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-secondary"
                                            data-dismiss="modal">Close</button>
                                    <form
                                        action="{{ route('exam.tags.destroy', $tag->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                                class="btn btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <div class="modal fade"
                         id="editTag{{ $tag->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit
                                        {{ $tag->name }}</h4>
                                    <button type="button" class="close"
                                            data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('exam.tags.update',$tag->id)}}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="select2-purple">
                                                    <select required
                                                            id="topic{{$tag->id}}"
                                                            class="select2 form-control"
                                                            name="exam_topic_id"
                                                            data-placeholder="Select a Topic"
                                                            data-dropdown-css-class="select2-purple"
                                                            style="width: 100%;">
                                                        @foreach ($exam_topics as $topic)
                                                            <option value=""></option>
                                                            <option value="{{ $topic->id }}">{{ $topic->name.' ('.$topic->examCategory->name.')' }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group mb-3">
                                                    <input
                                                        required
                                                        type="text"
                                                        id="tag_name{{$tag->id}}"
                                                        class="form-control"
                                                        name="name"
                                                        placeholder="Topic name"
                                                        aria-label="Topic name"
                                                        aria-describedby="basic-addon2">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-primary" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
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
