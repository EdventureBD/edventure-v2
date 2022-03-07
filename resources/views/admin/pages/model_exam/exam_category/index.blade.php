@extends('admin.layouts.default', [
'title'=> 'Model Exam',
'pageName'=> 'Exam Category',
'secondPageName' => 'Exam Category'
])

@section('content')
    <style>
        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            width: 1%;
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
    @include('admin.pages.model_exam.exam_category.create')
    <table class="table table-responsive table-striped">

        @if(count($exam_categories) > 0)
        <thead>
            <tr>
                <th class="fit" scope="col">#</th>
                <th class="fit" scope="col">Category</th>
                <th class="fit" scope="col">Price</th>
                <th class="fit" scope="col">Details</th>
                <th class="fit" scope="col">Created at</th>
                <th class="fit" scope="col">Action</th>
            </tr>
        </thead>
        @endif
        <tbody>
        @forelse ($exam_categories as $category)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->price }}</td>
                <td>{!! $category->details ?? 'N/a'  !!} </td>
                <td>{{ date('F j, Y, g:i a', strtotime($category->created_at)) }}</td>
                <td>
                    @include('admin.pages.model_exam.exam_category.edit')
                    @include('admin.pages.model_exam.exam_category.delete')

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
            {{ $exam_categories->withQueryString()->links() }}
        </div>
    @endif
@endsection

@section('js2')
    <script>
        $('#details').summernote({
            placeholder: 'Details',
            height: 150,
        })
        $('.detailsEdit').summernote({
            placeholder: 'Details',
            height: 200,
        })
    </script>
@endsection
