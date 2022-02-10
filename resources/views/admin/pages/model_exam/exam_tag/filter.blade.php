<form action="">
    <div class="row">
        <div class="col-md-4">
            <div class="select2-purple d-flex align-middle py-0 pb-5">
                <select
                        class="select2 form-control"
                        name="query[topic]"
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
        <div class="col-md-4">
            <input type="text" name="query[tag]" placeholder="Tags name" class="form-control">
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary">Find</button>
        </div>
        <div class="col-md-2">
            <a href="{{route('exam.tags.index')}}" class="btn btn-outline-secondary">Clear</a>
        </div>

    </div>
</form>
