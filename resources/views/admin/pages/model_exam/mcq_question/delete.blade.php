
<a class="mr-1 btn btn-sm btn-outline-danger"
   href="#deleteQuestion{{ $q->id }}"
   data-toggle="modal"
   title="Delete {!! $q->question !!}">
    <i class="far fa-trash-alt"></i>
</a>

<div class="modal fade"
     id="deleteQuestion{{ $q->id }}">
    <div class="modal-dialog">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Delete
                    {!! $q->question !!} </h4>
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
                    action="{{ route('model.exam.question.destroy', $q->slug) }}"
                    method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit"
                            class="btn btn-outline-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
