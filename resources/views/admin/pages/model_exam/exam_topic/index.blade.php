@extends('admin.layouts.default', [
'title'=> 'Model Exam',
'pageName'=> 'Exam Topic',
'secondPageName' => 'Exam Topic'
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
    <form action="{{route('exam.topic.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="select2-purple">
                    <select required class="select2 form-control" name="exam_category_id"
                            data-placeholder="Select a Category" data-dropdown-css-class="select2-purple"
                            style="width: 100%;">
                        @foreach ($exam_categories as $category)
                            <option value=""></option>
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                        placeholder="Topic name"
                        aria-label="Topic name"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <table class="table">

        @if(count($exam_topics) > 0)
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Topic</th>
                <th scope="col">Category</th>
                <th scope="col">Created at</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
        @endif
        <tbody>
        @forelse ($exam_topics as $topic)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $topic->name }}</td>
                <td>{{ $topic->examCategory->name }}</td>
                <td>{{ date('F j, Y, g:i a', strtotime($topic->created_at)) }}</td>
                <td>
                    <a class="mr-1"
                       onclick="fetchData({{ $topic->id }});"
                       href="#editCategory{{ $topic->id }}"
                       data-toggle="modal"
                       title="Edit {{ $topic->name }}">
                        <button class="btn btn-primary"><i
                                class="far fa-edit"></i></button>
                    </a>
                    <a class="mr-1"
                       href="#deleteCategory{{ $topic->id }}"
                       data-toggle="modal"
                       title="Delete {{ $topic->name }}">
                        <button class="btn btn-danger"><i
                                class="far fa-trash-alt"></i></button>
                    </a>
                    <div class="modal fade"
                         id="deleteCategory{{ $topic->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content bg-danger">
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete
                                        {{ $topic->name }}</h4>
                                    <button type="button" class="close"
                                            data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure??</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-light"
                                            data-dismiss="modal">Close</button>
                                    <form
                                        action="{{ route('exam.topic.destroy', $topic->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                                class="btn btn-outline-light">Delete</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <div class="modal fade"
                         id="editCategory{{ $topic->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit
                                        {{ $topic->name }}</h4>
                                    <button type="button" class="close"
                                            data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('exam.topic.update',$topic->id)}}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="select2-purple">
                                                <select required
                                                        id="category{{$topic->id}}"
                                                        class="select2 form-control"
                                                        name="exam_category_id"
                                                        data-placeholder="Select a Category"
                                                        data-dropdown-css-class="select2-purple"
                                                        style="width: 100%;">
                                                    @foreach ($exam_categories as $category)
                                                        <option value=""></option>
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <input
                                                    required
                                                    type="text"
                                                    id="topic_name{{$topic->id}}"
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
            {{ $exam_topics->links() }}
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
