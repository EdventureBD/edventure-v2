<div style="justify-content: right;display: flex; text-align: end" class="mt-4">
    <a href="#createTag"
       data-toggle="modal"
       title="Create Model Exam">
        <button class="btn btn-outline-primary"><i class="far fa-plus-square"></i> New Tag</button>
    </a>
</div>

<div class="modal fade" id="createTag">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <form action="{{route('exam.tags.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="modal-body">
                    <div class="d-flex flex-column my-2">
                        <div class="">
                            <div class="select2-purple d-flex align-middle py-0 pb-2">
                                <select required
                                        class="select2 form-control"
                                        name="exam_topic_id"
                                        data-placeholder="Select a Topic"
                                        data-dropdown-css-class="select2-purple"
                                        style="width: 100%; margin-top: -8px !important;">
                                    @foreach ($exam_topics as $topic)
                                        <option value=""></option>
                                        <option value="{{ $topic->id }}">{{ $topic->name.' ('.$topic->examCategory->name.')' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="my-2">
                            <div class="input-group">
                                <input
                                    required
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    placeholder="Tags name"
                                    aria-label="Tags name"
                                    aria-describedby="basic-addon2">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="my-2">
                            <div class="custom-file">
                                <input name="solution_pdf" accept="application/pdf" type="file" class="custom-file-input" id="customFileLangHTML">
                                <label class="custom-file-label" for="customFileLangHTML">Solution pdf</label>
                            </div>
                        </div>
                        <div class="my-2">
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
