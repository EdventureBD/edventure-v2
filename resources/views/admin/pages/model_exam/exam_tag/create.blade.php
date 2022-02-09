<form action="{{route('exam.tags.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <input class="form-control" name="solution_pdf" accept="application/pdf" type="file">
        </div>
        <div class="col-md-6">
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
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="select2-purple d-flex align-middle py-0 pb-5">
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
        <div class="col-md-6">
            <div class="input-group mb-3">
                <input
                    required
                    type="text"
                    class="form-control"
                    name="name"
                    placeholder="Tags name"
                    aria-label="Tags name"
                    aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit">Create</button>
                </div>
            </div>
        </div>
    </div>
</form>
