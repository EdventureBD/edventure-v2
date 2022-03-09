@extends('admin.layouts.default', [
'title'=> 'Model Exam',
'pageName'=> 'Exam Tag Analysis',
'secondPageName' => 'Exam Tag Analysis'
])

@section('content')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .select2-purple .select2-container--default span span{
            height: 2.35rem;
        }
        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            width: 1%;
        }
        div .select2 .selection .select2-selection{
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
{{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">--}}
    <form action="">
        <div class="row">
            <div class="col-md-6">
                <div class="select2-purple d-flex align-middle py-0 pb-md-5">
                    <select
                        name="query[exam]"
                        class="select2 form-control"
                        id="query_category_selected"
                        data-placeholder="Choose Exam"
                        data-dropdown-css-class="select2-purple"
                        style="width: 100%; margin-top: -8px !important;">
                        @foreach ($exams as $exam)
                            <option value=""></option>
                            <option value="{{ $exam->id }}">{{ $exam->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <button class="btn btn-outline-primary">Analyse</button>
            </div>

            <div class="col-md-3">
                <a href="{{route('model.exam.tag.analysis')}}" class="btn btn-outline-secondary">Clear</a>
            </div>
        </div>

    </form>
    <table class="table table-striped table-responsive" id="tagsTable">

        @if(count($tags) > 0)
            <b>Exam:</b> {{$selectedExam->title}}<br>
            <b>Student Attempted:</b> {{$studentCount}}
        <thead>
            <tr>
                <th class="fit" scope="col">#</th>
                <th class="fit" scope="col">Tag</th>
                <th class="fit" scope="col">Question</th>
                <th class="fit" scope="col">Accuracy</th>
            </tr>
        </thead>
        @endif
        <tbody>
        @forelse ($tags as $tag)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$tag->name}}</td>
                <td>{{$tag->usedInNumberOfQuestions($selectedExam->id)}}</td>
                <td>{{$tag->accuracy}} %</td>
            </tr>
        @empty
            <div class="d-flex justify-content-center">
                <p>Select Exams To See Analysis</p>
            </div>
            <div class="d-flex justify-content-center">
                <img src="{{asset('admin/notFound.svg')}}" width="193" height="130" />
            </div>


        @endforelse
        </tbody>
    </table>
{{--    @if ($tags->hasPages())--}}
{{--        <div class="pagination-wrapper">--}}
{{--            {{ $tags->links() }}--}}
{{--        </div>--}}
{{--    @endif--}}
@endsection
@section('js2')
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script>
        $(function () {
            $('.select2').select2()
        })
        $('#tagsTable').DataTable({
            // dom: 'Bfrtip',
            // buttons: [
            //     'copy', 'csv', 'excel'
            // ]
        });
    </script>




@endsection
