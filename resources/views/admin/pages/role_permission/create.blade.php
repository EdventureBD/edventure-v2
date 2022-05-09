<div style="justify-content: right;display: flex; text-align: end" class="mt-4">
    <a href="#createRole"
       data-toggle="modal"
       title="Create new group">
        <button class="btn btn-outline-primary"><i class="far fa-plus-square"></i> Create New Role</button>
    </a>
</div>

<div class="modal fade" id="createRole">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <form action="{{route('role.create')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="modal-body">
                    <div class="">
                        <div class="form-group col-md-12">
                            <div class="input-group">
                                <input
                                    required
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    placeholder="Role"
                                    aria-label="Role"
                                    aria-describedby="basic-addon2">
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="row">
                                @foreach(\App\Enum\Permission::List as $id => $permission)
                                <div class="col-md-4">
                                    <input value="{{$id}}" name="permissions[]" type="checkbox"> {{$permission}}
                                </div>
                                @endforeach
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
