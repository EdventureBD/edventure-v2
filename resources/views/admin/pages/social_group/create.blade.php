<div style="justify-content: right;display: flex; text-align: end" class="mt-4">
    <a href="#addGroup"
       data-toggle="modal"
       title="Add new group">
        <button class="btn btn-outline-primary"><i class="far fa-plus-square"></i> Add New Group</button>
    </a>
</div>

<div class="modal fade" id="addGroup">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <form action="{{route('social.group.store')}}" method="POST" enctype="multipart/form-data">
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
                                    placeholder="Title"
                                    aria-label="Title"
                                    aria-describedby="basic-addon2">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="custom-file">
                                <input type="file"
                                       required
                                       accept="image/*"
                                       name="banner"
                                       class="custom-file-input"
                                       id="banner">
                                <label class="custom-file-label" for="banner">Image</label>
                            </div>
                            <div class="mt-3">
                                <div id="imagePreview"></div>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <input
                                required
                                type="text"
                                class="form-control"
                                name="link"
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
                            class="btn btn-outline-success">Create
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
