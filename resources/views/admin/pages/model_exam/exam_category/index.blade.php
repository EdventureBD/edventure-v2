@extends('admin.layouts.default', [
'title'=> 'Model Exam',
'pageName'=> 'Exam Category',
'secondPageName' => 'Exam Category'
])

@section('content')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            width: 1%;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #683cb8;
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
                <th class="fit" scope="col">Offer price</th>
                <th class="fit" scope="col">Details</th>
                <th class="fit" scope="col">Image</th>
                <th class="fit" scope="col">Visible</th>
                <th class="fit" scope="col">Time allotted</th>
                <th class="fit" scope="col">Full solutions</th>
                <th style="width: 8% !important;" class="fit" scope="col">Includes</th>
                <th class="fit" scope="col">Teachers</th>
                <th class="fit" scope="col">Routine image</th>
                <th class="fit" scope="col">Category video</th>
                <th class="fit" scope="col">Created at</th>
                <th style="width: 3% !important;" class="fit" scope="col">Action</th>
            </tr>
        </thead>
        @endif
        <tbody>
        @forelse ($exam_categories as $category)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->price ?? 0}}</td>
                <td>{{ $category->offer_price ?? 0 }}</td>
                <td>{!! $category->details ?? 'N/a'  !!} </td>
                <td>
                    @if($category->image)
                        <img height="100" width="100" src="{{Storage::url('categoryImage/'.$category->image)}}" alt="">
                    @else
                        <div class="badge badge-info">No Image</div>
                    @endif
                </td>
                <td>
                    <input onclick="visibilityUpdate({{$category->id}})"
                           {{ $category->visibility == 1 ? 'checked' : '' }} type="checkbox">
                </td>
                <td>{{ $category->time_allotted ?? 0 }}</td>
                <td>{{ $category->full_solutions ?? 0 }}</td>
                <td>
                    Paper final : {{$category->paper_final ?? 0}}<br>
                    Subject final : {{$category->subject_final ?? 0}}<br>
                    Final exam : {{$category->final_exam ?? 0}}<br>
                </td>
                <td>
                    @if($category->teacher_lists)
                        <ul>
                        @foreach($category->teacher_lists as $teacher)
                                <li>{{$teacher->name}}</li>
                        @endforeach
                        </ul>
                    @else
                        <div class="badge badge-info">Not Assigned</div>
                    @endif
                </td>
                <td>
                    @if($category->routine_image)
                        <img height="100" width="100" src="{{Storage::url('categoryRoutine/'.$category->routine_image)}}" alt="">
                    @else
                        <div class="badge badge-info">No Image</div>
                    @endif
                </td>
                <td>
                    @if($category->category_video)
                        <iframe
                            class="iframe"
                            src="{{'https://www.youtube-nocookie.com/embed/'.$category->category_video}}"
                            title="YouTube video player"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    @else
                        <div class="badge badge-info">No Video</div>
                    @endif
                </td>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(function () {
            $('.select2').select2()
        })
        $('#details').summernote({
            placeholder: 'Details',
            height: 150,
        })
        $('.detailsEdit').summernote({
            placeholder: 'Details',
            height: 200,
        })

        function visibilityUpdate(categoryId) {
            url = window.location.origin +'/admin/exam-category/visibility/'+categoryId;
            $.ajax({
                url: url,
                type:"GET",
                success:function(response){
                    if(response == 'visible') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Visible...',
                            text: 'Category is now Visible!'
                        })
                        // alert('Exam is now Visible')
                    } else {
                        Swal.fire({
                            icon: 'info',
                            title: 'Invisible...',
                            text: 'Category is now Invisible!'
                        })
                        // alert('Exam is now Invisible')
                    }

                },
            });
        }
    </script>
@endsection
