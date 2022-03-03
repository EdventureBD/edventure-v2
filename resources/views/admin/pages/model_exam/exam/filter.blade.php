<form action="">
    <div class="row">
        <div class="col-sm-3 mt-4">
            <div class="select2-purple d-flex align-middle py-0 pb-md-5">
                <select
                    name="query[category]"
                    class="select2 form-control"
                    id="query_category_selected"
                    data-placeholder="Select Category"
                    data-dropdown-css-class="select2-purple"
                    style="width: 100%; margin-top: -8px !important;">
                    @foreach ($exam_categories as $category)
                        <option value=""></option>
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-3 mt-4">
            <div class="select2-purple d-flex align-middle py-0 pb-md-5">
                <select
                        class="select2 selected_topic form-control"
                        id="query_topic_selected"
                        name="query[topic]"
                        data-placeholder="Select Topic"
                        data-dropdown-css-class="select2-purple"
                        style="width: 100%; margin-top: -8px !important;">
                </select>
            </div>
        </div>

        <div class="col-md-3 mt-4">
            <select
                class="select2 form-control"
                id="query_exam_selected"
                name="query[exam]"
                data-placeholder="Select Exam"
                data-dropdown-css-class="select2-purple"
                style="width: 100%; margin-top: -8px !important;">
            </select>
        </div>
        <div class="d-flex justify-content-between col-md-2 mt-4 pb-md-5">
            <div class="mx-md-2">
                <button type="submit" class="btn btn-outline-primary">Find</button>
            </div>
            <div class="">
                <a href="{{route('model.exam.index')}}" class="btn btn-outline-secondary">Clear</a>
            </div>
        </div>
    </div>
</form>
