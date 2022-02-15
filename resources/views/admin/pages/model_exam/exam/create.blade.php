<div style="justify-content: right;display: flex; text-align: end" class="mt-4">
    <a
        href="#createExam"
        data-toggle="modal"
        title="Create Model Exam">
        <button class="btn btn-outline-primary"><i class="far fa-plus-square"></i> New Exam</button>
    </a>
</div>

<div class="modal fade"
     id="createExam">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <form action="{{route('model.exam.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Create Model Exam</h4>
                    <div class="d-flex align-items-middle">
                        <p>Visible</p>
                        <input class="mt-2 ml-2" id="checkBoxValue" value="false" name="visibility" type="checkbox">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="select2-purple d-flex align-middle py-1">
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
                            <div class="select2-purple d-flex align-middle py-1">
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
                    <div class="form-row py-1">
                        <div class="form-group col-md-6">
                            <input required name="title" type="text" class="form-control" id="title" placeholder="Exam Title">
                        </div>
                        <div class="form-group col-md-6">
                            <select
                                required
                                class="form-control"
                                id="exam_type"
                                name="exam_type">
                                <option selected value="">Select Exam Type</option>
                                <option value="{{\App\Enum\ExamType::MCQ}}">MCQ</option>
                                <option value="{{\App\Enum\ExamType::CQ}}">CQ</option>
                                <option value="{{\App\Enum\ExamType::BQ}}">BQ</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input
                                required
                                type="number"
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
                            <input
                                type="number"
                                required
                                id="question_limit"
                                name="question_limit"
                                class="form-control"
                                placeholder="Question Limit">
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
                            <input type="number"
                                   id="negative_marking_value"
                                   name="negative_marking_value"
                                   class="form-control"
                                   placeholder="Negative Marking Value">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input
                                class="form-control"
                                type="number"
                                placeholder="Per Question Marks"
                                name="per_question_marks"
                                id="per_question_marks">
                        </div>
                        <div class="form-group col-md-6">
                            <input
                                class="form-control"
                                type="number"
                                placeholder="Total Exam Marks"
                                name="total_exam_marks"
                                id="total_exam_marks">
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
                                       placeholder="Solution Video Url" />
                            </div>
                            <div style="overflow:hidden;height:100%;width:100%;top:0;left:0;right:0;bottom:0" id="iframe_div">
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

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input
                                class="form-control"
                                type="number"
                                value=""
                                placeholder="Enter exam price"
                                name="exam_price"
                                id="exam_price">
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
