<a class="mr-1 btn btn-outline-primary btn-sm"
   onclick="fetchData({{ $tag->id }});"
   href="#editTag{{ $tag->id }}"
   data-toggle="modal"
   title="Edit {{ $tag->name }}">
    <i class="far fa-edit"></i>
</a>

<div class="modal fade"
     id="editTag{{ $tag->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit
                    {{ $tag->name }}</h4>
                <button type="button" class="close"
                        data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('exam.tags.update',$tag->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="select2-purple">
                                <select required
                                        id="topic{{$tag->id}}"
                                        class="select2 form-control"
                                        name="exam_topic_id"
                                        data-placeholder="Select a Topic"
                                        data-dropdown-css-class="select2-purple"
                                        style="width: 100%;">
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
                                    id="tag_name{{$tag->id}}"
                                    class="form-control"
                                    name="name"
                                    placeholder="Topic name"
                                    aria-label="Topic name"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="submit">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="custom-file">
                                <input name="solution_pdf" accept="application/pdf" type="file" class="custom-file-input" id="customFileLangHTML">
                                <label class="custom-file-label" for="customFileLangHTML">Solution pdf</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">https://youtube.com/watch?v=</span>
                                </div>
                                <input type="text"
                                       class="form-control"
                                       name="solution_video"
                                       id="solution_video"
                                       value="{{$tag->solution_video}}"
                                       placeholder="Solution Video Url" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
