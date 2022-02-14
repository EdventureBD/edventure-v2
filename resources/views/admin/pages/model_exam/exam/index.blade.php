@extends('admin.layouts.default', [
'title'=> 'Model Exam',
'pageName'=> 'Exams',
'secondPageName' => 'Exams'
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
        .zoom {
            transition: transform 1.5s; /* Animation */
            height: 50px;
            margin: 0 auto;
        }

        .zoom:hover {
            width: 250px;
            height: 100px;
            transform: scale(1.2); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }

        .iframe {
            overflow: hidden;
            height: 100%;
            width: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            transition: transform .2s; /* Animation */
            margin: 0 auto;
        }

        .iframe:hover {
            height: 120%;
            width: 80%;
            transform: scale(1.2);
        }
         .table td.fit,
         .table th.fit {
             white-space: nowrap;
             width: 1%;
         }
    </style>

    @include('admin.pages.model_exam.exam.filter')
    @include('admin.pages.model_exam.exam.create')

    <table class="table table-responsive table-striped">

        @if(count($exams) > 0)
            <thead>
            <tr>
                <th class="fit" scope="col">#</th>
                <th class="fit" scope="col">Title</th>
                <th class="fit" scope="col">Topic</th>
                <th class="fit" scope="col">Category</th>
                <th class="fit" scope="col">Question Limit</th>
                <th class="fit" scope="col">Exam type</th>
                <th class="fit" scope="col">Duration</th>
                <th class="fit" scope="col">Negative Marking Value</th>
                <th class="fit" scope="col">Visibility</th>
                <th class="fit" scope="col">Per Question Marks</th>
                <th class="fit" scope="col">Total Exam Marks</th>
                <th class="fit" scope="col">Solution Pdf</th>
                <th class="fit" scope="col">Solution Video</th>
                <th class="fit" scope="col">Price</th>
                <th class="fit" scope="col">Total Participation</th>
                <th class="fit" scope="col">Created</th>
                <th class="fit" scope="col">Questions</th>
                <th class="fit" scope="col">Action</th>
            </tr>
            </thead>
        @endif
        <tbody>
        @forelse ($exams as $exam)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $exam->title }}</td>
                <td>{{ $exam->topic->name }}</td>
                <td>{{ $exam->category->name }}</td>
                <td>{{ $exam->question_limit }}</td>
                <td>{{ \App\Enum\ExamType::Exam[$exam->exam_type] }}</td>
                <td>{{ $exam->duration }}</td>
                <td>{{ $exam->negative_marking_value }}</td>
                <td>
                    <input onclick="visibilityUpdate({{$exam->id}})"
                           {{ $exam->visibility == 1 ? 'checked' : '' }} type="checkbox">
                </td>
                <td>{{ $exam->per_question_marks }}</td>
                <td>{{ $exam->total_exam_marks }}</td>
                <td>
                    <a class="{{$exam->solution_pdf ? '' : 'disabled' }} btn btn-outline-danger btn-sm"
                       href="{{route('model.exam.pdf',$exam->id) }}">
                        <i class="far fa-file-pdf"></i>
                    </a>
                </td>
                <td>
                    @if($exam->solution_video)
                        <div class="zoom">
                            <iframe
                                class="iframe"
                                src="{{'https://www.youtube-nocookie.com/embed/'.$exam->solution_video}}"
                                title="YouTube video player"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>

                    @else
                        <span class="badge badge-primary">No Video</span>
                    @endif
                </td>
                <td>{{ $exam->exam_price ?? 0 }}</td>
                <td>{{ count($exam->mcqTotalResult) }}</td>
                <td class="text-sm">{{ date('F jS, Y', strtotime($exam->created_at)) }}</td>
                <td>
                    <a class="btn btn-outline-primary btn-sm" href="{{route('model.exam.question.index',$exam->id)}}">
                        <i class="far fa-copy"></i>
                    </a>
                </td>
                <td>
                    <div class="d-flex justify-content-center">
                        <a class="mr-1 btn btn-outline-primary btn-sm"
                           href="{{ route('model.exam.edit', $exam->id) }}">
                            <i class="far fa-edit"></i>
                        </a>
                        @include('admin.pages.model_exam.exam.delete')
                    </div>
                </td>
            </tr>
        @empty
            <div class="d-flex justify-content-center">
                <p>No Exam Found</p>
            </div>
            <div class="d-flex justify-content-center">
                <img src="{{asset('admin/notFound.svg')}}" width="193" height="130"/>
            </div>
        @endforelse
        </tbody>
    </table>
    @if ($exams->hasPages())
        <div class="pagination-wrapper">
            {{ $exams->withQueryString()->links() }}
        </div>
    @endif
@endsection

@include('admin.pages.model_exam.exam.utils')
