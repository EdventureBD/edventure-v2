<a class="mr-1 btn btn-outline-danger btn-sm"
   href="#deleteAssignRole{{ $user->id }}"
   data-toggle="modal"
   title="Delete?">
    <i class="far fa-trash-alt"></i>
</a>
<div class="modal fade"
     id="deleteAssignRole{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">
                    Revoke Role For <b>{{ $user->name }}</b> as <b>{{$user->roles[0]->name}}</b>
                </h4>
                <button type="button" class="close"
                        data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure??</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-secondary"
                        data-dismiss="modal">Close</button>
                <form
                    action="{{ route('role.assign.delete',$user->id) }}"
                    method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit"
                            class="btn btn-outline-danger">Revoke</button>
                </form>
            </div>
        </div>
    </div>
</div>
