<a class="mr-1 btn btn-outline-primary btn-sm"
   href="#editPermission{{ $role->id }}"
   data-toggle="modal"
   title="Edit {{ $role->name }}">
    <i class="far fa-edit"></i>
</a>

<div class="modal fade"
     id="editPermission{{ $role->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit
                    {{ $role->name }}</h4>
                <button type="button" class="close"
                        data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('role.update',$role->id)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="">
                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <input
                                        readonly
                                        type="text"
                                        class="form-control"
                                        value="{{$role->name}}"
                                        placeholder="Role"
                                        aria-label="Role"
                                        aria-describedby="basic-addon2">
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <div class="row">
                                    @foreach(\App\Enum\Permission::List as $id => $permission)
                                        @php
                                          $checked = in_array($id,$role->permission_array) ? 'checked' : '';
                                        @endphp
                                        <div class="col-md-4">
                                            <input {{$checked}} value="{{$id}}" name="permissions[]" type="checkbox"> {{$permission}}
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
