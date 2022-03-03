<a class="mr-1 btn btn-outline-primary btn-sm"
   onclick="fetchData({{ $topic->id }});"
   href="#editCategory{{ $topic->id }}"
   data-toggle="modal"
   title="Edit {{ $topic->name }}">
    <i class="far fa-edit"></i>
</a>

<div class="modal fade"
     id="editCategory{{ $topic->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit
                    {{ $topic->name }}</h4>
                <button type="button" class="close"
                        data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('exam.topic.update',$topic->id)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="select2-purple">
                                <select required
                                        id="category{{$topic->id}}"
                                        class="select2 form-control"
                                        name="exam_category_id"
                                        data-placeholder="Select a Category"
                                        data-dropdown-css-class="select2-purple"
                                        style="width: 100%;">
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
                                    id="topic_name{{$topic->id}}"
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
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input
                                    value="{{$topic->multiple_subject}}"
                                    type="checkbox"
                                    {{ $topic->multiple_subject == 1 ? 'checked' : '' }}
                                    class="form-control"
                                    name="multiple_subject">Multiple Subjects
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
