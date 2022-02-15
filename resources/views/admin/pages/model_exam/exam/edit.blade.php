@extends('admin.layouts.default', [
'title'=> 'Model Exam',
'pageName'=> 'Edit Exam',
'secondPageName' => 'Edit Exam'
])

@section('content')
    <a href="{{route('model.exam.index')}}" title="Back to exams"> <i class="far fa-hand-point-left"></i> </a>
    <form action="{{route('model.exam.update',$exam->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-12">
                <input class="form-control"
                       title="Exam Title"
                       placeholder="Exam Title"
                       type="text"
                       name="title"
                       required
                       value="{{$exam->title}}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <input class="form-control"
                       title="Exam Category"
                       placeholder="Exam Category"
                       type="text"
                       readonly
                       value="{{$exam->category->name}}">
            </div>

            <div class="form-group col-md-6">
                <select required
                        class="select2 form-control"
                        name="exam_topic_id"
                        data-placeholder="Select a Topic"
                        data-dropdown-css-class="select2-purple"
                        style="width: 100%;">
                    @foreach ($exam_topics as $topic)
                        <option value=""></option>
                        <option {{$topic->id == $exam->exam_topic_id ? 'selected' : ''}} value="{{ $topic->id }}">{{ $topic->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <input class="form-control"
                       title="Question Limit"
                       placeholder="Question Limit"
                       type="text"
                       required
                       name="question_limit"
                       id="question_limit"
                       value="{{$exam->question_limit}}">
            </div>

            <div class="form-group col-md-6">
                <input class="form-control"
                       title="Exam Duration"
                       placeholder="Exam Duration"
                       type="text"
                       required
                       name="duration"
                       value="{{$exam->duration}}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <input
                    class="form-control"
                    type="number"
                    title="Per Question Marks"
                    placeholder="Per Question Marks"
                    name="per_question_marks"
                    id="per_question_marks"
                    value="{{$exam->per_question_marks}}">
            </div>
            <div class="form-group col-md-6">
                <input
                    class="form-control"
                    type="number"
                    title="Total Exam Marks"
                    placeholder="Total Exam Marks"
                    name="total_exam_marks"
                    id="total_exam_marks"
                    value="{{$exam->total_exam_marks}}">
            </div>
        </div>

        <div class="form-row">
            <div style="font-size: 15px" class="form-group col-md-3">
                <div class="form-check form-check-inline">
                    <span>Negative Marking</span>
                </div>
                <div class="form-check form-check-inline">
                    <input
                        {{$exam->negative_marking == 1 ? 'checked' : ''}}
                        class="negative_marking form-check-input"
                        type="radio"
                        name="negative_marking"
                        id="negative_marking_1"
                        value="1">
                    <label
                        class="form-check-label"
                        for="negative_marking_1">
                        Yes
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input
                        {{$exam->negative_marking == 0 ? 'checked' : ''}}
                        class="negative_marking form-check-input"
                        type="radio"
                        name="negative_marking"
                        id="negative_marking_2"
                        value="0">
                    <label
                        class="form-check-label"
                        for="negative_marking_2">
                        No
                    </label>
                </div>
            </div>
            <div class="form-group col-md-3">
                <input type="number"
                       step="0.01"
                       id="negative_marking_value"
                       name="negative_marking_value"
                       class="form-control"
                       placeholder="Negative Marking Value">
            </div>
            <div class="form-group col-md-6">
                <input type="number"
                       id="exam_price"
                       name="exam_price"
                       class="form-control"
                       value="{{$exam->exam_price}}"
                       placeholder="Exam Price">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <div class="custom-file">
                    <input type="file"
                           name="solution_pdf"
                           class="custom-file-input"
                           accept="application/pdf"
                           id="solution_pdf">
                    <label class="custom-file-label" for="solution_pdf">Solution pdf</label>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">https://youtube.com/watch?v=</span>
                    </div>
                    <input type="text"
                           class="form-control"
                           name="solution_video"
                           id="solution_video"
                           value="{{$exam->solution_video}}"
                           placeholder="Solution Video Url" />
                </div>


                    <iframe
                        style="overflow:hidden;height:300px;width:100%;top:0;left:0;right:0;bottom:0"
                        class="d-none"
                        id="iframe"
                        src=""
                        title="YouTube video player"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>

            </div>
        </div>


        <div class="d-flex justify-content-end">
            <button class="btn btn-outline-success" type="submit">Update</button>
        </div>
    </form>
@endsection

@section('js2')
    <script>
        $(function () {
            $('.select2').select2()

            if($('input[name="negative_marking"]:checked').val() == 0) {
                $('#negative_marking_value').attr('disabled', true);
                $('#negative_marking_value').val(null);
            } else {
                $('#negative_marking_value').attr('disabled', false);
            }

            if($('#solution_video').val()) {
                $('#iframe').removeAttr("class");
                $('#iframe_div').attr('class', 'mt-3 mb-3')
                $('#iframe').attr('src', "https://www.youtube-nocookie.com/embed/"+$('#solution_video').val())
            }
        })

        $('.negative_marking').on('click', function () {
            if ($('input[name="negative_marking"]:checked').val() == 0) {
                $('#negative_marking_value').attr('disabled', true);
                $('#negative_marking_value').val(null);
            } else {
                $('#negative_marking_value').attr('disabled', false);
            }
        });

        $('#solution_video').on('paste change keyup', function () {
            let code = $('#solution_video').val()
            if(code) {
                $('#iframe').removeAttr("class");
                $('#iframe_div').attr('class', 'mt-3 mb-3')
                $('#iframe').attr('src', "https://www.youtube-nocookie.com/embed/"+code)
            } else  {
                $('#iframe_div').attr('class', 'd-none')
            }
        });

        $("#question_limit").on('change keyup', function() {
            $("#per_question_marks").val(1)
            $("#total_exam_marks").val($("#per_question_marks").val() * $("#question_limit").val())
        });
    </script>
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection
