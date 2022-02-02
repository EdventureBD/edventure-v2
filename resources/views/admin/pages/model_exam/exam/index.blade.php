@extends('admin.layouts.default', [
'title'=> 'Model Exam',
'pageName'=> 'Exams',
'secondPageName' => 'Exams'
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

    <a
        href="#createExam"
        data-toggle="modal"
        title="Create Model Exam">
        <button class="btn btn-outline-primary"><i class="far fa-plus-square"></i> New Exam</button>
    </a>

    <div class="modal fade"
         id="createExam">
        <div class="modal-dialog">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <h4 class="modal-title">Create Model Exam</h4>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="select2-purple d-flex align-middle py-0 pb-5">
                                    <select required
                                            id="exam_category_selected"
                                            class="select2 form-control"
                                            name="exam_category_id"
                                            data-placeholder="Select a Category"
                                            data-dropdown-css-class="select2-purple"
                                            style="width: 100%; margin-top: -8px !important;">
                                        @foreach ($exam_categories as $category)
                                            <option value=""></option>
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="select2-purple d-flex align-middle py-0 pb-5">
                                    <select required
                                            class="select2 form-control"
                                            id="exam_topics"
                                            name="exam_topic_id"
                                            data-placeholder="Select a Topic"
                                            data-dropdown-css-class="select2-purple"
                                            style="width: 100%; margin-top: -8px !important;">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input required type="text" class="form-control" id="title" placeholder="Exam Title">
                            </div>
                            <div class="form-group col-md-6">
                                <select
                                    required
                                    class="form-control"
                                    id="exam_type"
                                    name="exam_type">
                                    <option selected value="">Select Exam Type</option>
                                    <option value="1">MCQ</option>
                                    <option value="2">CQ</option>
                                    <option value="3">BQ</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input
                                    required
                                    type="text"
                                    class="form-control"
                                    placeholder="Exam Duration"
                                    name="duration"
                                    id="duration">
                                <small
                                    id="emailHelp"
                                    class="form-text text-muted">
                                    <span class="text-red">N.B: </span> Enter duration in minute unit.
                                </small>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="d-flex">
                                    <p>Visible</p>
                                    <input name="visibility" type="checkbox">
                                </div>

                            </div>
                        </div>
                        <div class="form-row">
                            <div style="font-size: 15px" class="form-group col-md-6">
                                <div class="form-check form-check-inline">
                                    <span>Negative Marking</span>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input
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
                                        checked
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
                            <div class="form-group col-md-6">
                                <input type="text" id="negative_marking_value" name="negative_marking_value"
                                       class="form-control" placeholder="Negative Marking Value">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input
                                    class="form-control"
                                    type="text"
                                    placeholder="Per Question Marks"
                                    name="per_question_marks"
                                    id="per_question_marks">
                            </div>
                            <div class="form-group col-md-6">
                                <input
                                    class="form-control"
                                    type="text"
                                    placeholder="Total Exam Marks"
                                    name="total_exam_marks"
                                    id="total_exam_marks">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input
                                    class="form-control"
                                    type="file"
                                    name="solution_pdf"
                                    id="solution_pdf">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
{{--                                <input--}}
{{--                                    class="form-control"--}}
{{--                                    type="text"--}}
{{--                                    placeholder="Solution Video Url"--}}
{{--                                    name="solution_video"--}}
{{--                                    id="solution_video">--}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">https://youtube.com/watch?v=</span>
                                    </div>
                                    <input type="text"
                                           class="form-control"
                                           name="solution_video"
                                           id="solution_video"
                                           placeholder="Solution Video Url" />
                                </div>
                                <iframe
                                    style="overflow:hidden;height:100%;width:100%;top:0;left:0;right:0;bottom:0"
                                    class="d-none"
                                    id="iframe"
                                    src=""
                                    title="YouTube video player"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button"
                                class="btn btn-outline-secondary"
                                data-dismiss="modal">Close
                        </button>
                        <button type="submit"
                                class="btn btn-outline-success">Create
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js2')
    <script>
        $(function () {
            $('.select2').select2()
            $('#negative_marking_value').attr('disabled', true);
        })

        $('#solution_video').on('paste change keyup', function () {
            let code = $('#solution_video').val()
            if(code) {
                $('#iframe').removeAttr("class");
                $('#iframe').attr('src', "https://www.youtube-nocookie.com/embed/"+code)
            } else  {
                $('#iframe').attr('class', 'd-none')
            }


        });

        $('.negative_marking').on('click', function () {
            if ($('input[name="negative_marking"]:checked').val() == 0) {
                $('#negative_marking_value').attr('disabled', true);
            } else {
                $('#negative_marking_value').attr('disabled', false);
            }
        });

        $('#exam_category_selected').on("select2:selecting", function (e) {
            let category_id = e.params.args.data.id
            let url = window.location.origin + '/admin/model-exam/topics/' + category_id;
            $('#exam_topics').empty();
            $.ajax({
                type: "GET",
                url: url,
                success: function (response) {
                    let topicsObj = [];
                    for (const [key, value] of Object.entries(response)) {
                        topicsObj.push({"id": value.id, "text": value.name})
                    }
                    $('#exam_topics').select2({
                        data: topicsObj
                    });
                },
                error: function (e) {
                    console.log(e)
                }
            });
        });

    </script>
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection
