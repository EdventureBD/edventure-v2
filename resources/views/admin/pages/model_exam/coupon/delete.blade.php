
<a class="mr-1 btn btn-sm btn-outline-danger"
   href="#deleteCoupon{{ $coupon->id }}"
   data-toggle="modal"
   title="Delete?">
    <i class="far fa-trash-alt"></i>
</a>

<div class="modal fade"
     id="deleteCoupon{{ $coupon->id }}">
    <div class="modal-dialog">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Delete
                    {{$coupon->name}} </h4>
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
                    action="{{ route('coupon.destroy', $coupon->id) }}"
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
