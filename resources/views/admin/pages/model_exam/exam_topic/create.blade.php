<div style="justify-content: right;display: grid; text-align: end">
    <a href="#createTopic"
       data-toggle="modal"
       title="Create Model Exam">
        <button class="btn btn-outline-primary"><i class="far fa-plus-square"></i> New Topic</button>
    </a>
</div>



<div class="modal fade"
     id="createTopic">
    <div class="modal-dialog">
        <div class="modal-content bg-light">
            <form action="{{route('exam.topic.store')}}" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Create New Topic</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="select2-purple d-flex align-middle py-0 pb-5">
                                <select required
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
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input
                                    required
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    placeholder="Topic name"
                                    aria-label="Topic name"
                                    aria-describedby="basic-addon2">
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
