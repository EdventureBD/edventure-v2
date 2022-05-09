@extends('admin.layouts.default', [
'title'=> 'Free Category Access',
'pageName'=> 'Free Category Access',
'secondPageName' => 'Free Category Access'
])

@section('content')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        .select2-purple .select2-container--default span span{
            padding-top: auto;
            padding-bottom: auto;
            height: 2.35rem;
        }
        div .select2 .selection .select2-selection{
            padding-top: auto;
            padding-bottom: auto;
            height: 2.35rem;
        }
    </style>
    <form action="{{route('category.access.confirm')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-3 mt-4">
                <div class="select2-purple d-flex align-middle py-0 pb-md-5">
                    <select
                        required
                        name="user_id"
                        class="select2 form-control"
                        id="student_selected"
                        data-placeholder="Select Student"
                        data-dropdown-css-class="select2-purple"
                        style="width: 100%; margin-top: -8px !important;">
                        @foreach ($users as $user)
                            <option value=""></option>
                            <option value="{{ $user->id }}">{{ $user->email }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3 mt-4">
                <div class="select2-purple d-flex align-middle py-0 pb-md-5">
                    <select
                        required
                        name="category_id"
                        class="select2 form-control"
                        id="category_selected"
                        data-placeholder="Choose Category"
                        data-dropdown-css-class="select2-purple"
                        style="width: 100%; margin-top: -8px !important;">
                        @foreach ($categories as $category)
                            <option value=""></option>
                            <option value="{{ $category->id }}">
                                {{ $category->name }} &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
                                <small class="text-right">Amount: &#160;{{$category->price}}</small>
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3 mt-4">
                <button type="submit" class="btn btn-outline-primary">Confirm</button>
            </div>
        </div>
    </form>

{{--    @include('admin.pages.model_exam.result.filter')--}}
    <table class="table table-responsive table-striped">

        @if(count($category_list) > 0)
            <thead>
            <tr>
                <th class="fit" scope="col">#</th>
                <th class="fit" scope="col">Student</th>
                <th class="fit" scope="col">Category</th>
                <th class="fit" scope="col">Amount</th>
                <th class="fit" scope="col">Created At</th>
            </tr>
            </thead>
        @endif
        <tbody>
        @forelse ($category_list as $list)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $list->user->name }}</td>
                <td>{{ $list->examCategory->name}}</td>
                <td>{{ $list->singlePayment->amount}}</td>
                <td>{{ date('F j, Y, g:i a', strtotime($list->created_at)) }}</td>
            </tr>
        @empty
            <div class="d-flex justify-content-center">
                <p>No List Found</p>
            </div>
            <div class="d-flex justify-content-center">
                <img src="{{asset('admin/notFound.svg')}}" width="193" height="130"/>
            </div>
        @endforelse
        </tbody>
    </table>
    @if ($category_list->hasPages())
        <div class="pagination-wrapper">
            {{ $category_list->withQueryString()->links() }}
        </div>
    @endif
@endsection

@section('js2')
    <script>
        $(function () {
            $('.select2').select2()
        })
    </script>
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection
