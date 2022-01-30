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
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Category</th>
                <th scope="col">Created at</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($exam_categories as $category)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->created_at }}</td>
            </tr>
        @empty
            <p>No Category Found</p>
        @endforelse
        </tbody>
    </table>
    @if ($exam_categories->hasPages())
        <div class="pagination-wrapper">
            {{ $exam_categories->links() }}
        </div>
    @endif
@endsection
