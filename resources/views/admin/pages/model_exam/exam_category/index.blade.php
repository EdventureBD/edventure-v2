@extends('admin.layouts.default', [
'title'=> 'Model Exam',
'pageName'=> 'Exam Category',
'secondPageName' => 'Exam Category'
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
    <form action="#" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input
                required
                type="text"
                class="form-control"
                name="name"
                placeholder="Category name"
                aria-label="Category name"
                aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="submit">ADD</button>
            </div>
        </div>
    </form>
    <table class="table">

        @if(count($exam_categories) > 0)
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Category</th>
                <th scope="col">Created at</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        @endif
        <tbody>
        @forelse ($exam_categories as $category)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $category->name }}</td>
                <td>{{ date('F j, Y, g:i a', strtotime($category->created_at)) }}</td>
                <td>
                    <a class="mr-1"
                       href="#deleteCategory{{ $category->id }}"
                       data-toggle="modal" title="Delete {{ $category->name }}">
                        <button class="btn btn-danger"><i
                                class="far fa-trash-alt"></i></button>
                    </a>
                    <div class="modal fade"
                         id="deleteCategory{{ $category->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content bg-danger">
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete
                                        {{ $category->name }}</h4>
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
                                        action="{{ route('exam.category.destroy', $category->id) }}"
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
                </td>
            </tr>
        @empty
            <div class="d-flex justify-content-center">
                <p>No Category Found</p>
            </div>
            <div class="d-flex justify-content-center">
                <img src="{{asset('admin/notFound.svg')}}" width="193" height="130" />
            </div>


        @endforelse
        </tbody>
    </table>
    @if ($exam_categories->hasPages())
        <div class="pagination-wrapper">
            {{ $exam_categories->links() }}
        </div>
    @endif
@endsection
