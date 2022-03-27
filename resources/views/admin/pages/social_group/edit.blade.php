<a class="mr-1 btn btn-outline-primary btn-sm"
   href="#editGroup{{ $list->id }}"
   data-toggle="modal"
   title="Edit {{ $list->id }}">
    <i class="far fa-edit"></i>
</a>

<div class="modal fade"
     id="editGroup{{ $list->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit
                    {{ $list->title }}</h4>
                <button type="button" class="close"
                        data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('social.group.update',$list->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="">
                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <input
                                        required
                                        type="text"
                                        class="form-control"
                                        name="title"
                                        value="{{$list->title}}"
                                        placeholder="Title"
                                        aria-label="Title"
                                        aria-describedby="basic-addon2">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="custom-file">
                                    <input type="file"
                                           accept="image/*"
                                           name="banner"
                                           class="custom-file-input banner-edit"
                                           id="banner-edit">
                                    <label class="custom-file-label" for="banner">Image</label>
                                </div>
                                <div class="mt-3">
                                    <div class="imagePreview-edit" id="imagePreview-edit">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <input
                                    required
                                    type="text"
                                    class="form-control"
                                    name="link"
                                    value="{{$list->link}}"
                                    placeholder="link"
                                    aria-label="link"
                                    aria-describedby="basic-addon2">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button"
                                class="btn btn-outline-secondary"
                                data-dismiss="modal">Close
                        </button>
                        <button type="submit"
                                class="btn btn-outline-success">Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
