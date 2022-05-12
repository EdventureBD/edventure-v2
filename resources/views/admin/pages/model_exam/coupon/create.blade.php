<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        margin-top: -8px !important;
    }
</style>

<div style="justify-content: right;display: flex; text-align: end" class="mt-4">
    <a
        href="#createModel"
        data-toggle="modal"
        title="Create Coupon">
        <button class="btn btn-outline-primary"><i class="far fa-plus-square"></i> Create Coupon</button>
    </a>
</div>

<div class="modal fade" id="createModel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <form action="{{route('coupon.store')}}" id="coupon_form" method="POST">
                @csrf
                <div class="modal-header">
                    <div style="display: block !important;">
                        <div class="modal-title" >
                            <h4>Create Coupon</h4>
                        </div>
                    </div>
                </div>
                <div class="modal-body">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="text"
                                   class="form-control"
                                   required
                                   placeholder="name"
                                   name="name">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <select
                                   class="form-control"
                                   required
                                   name="fixed">
                                <option value="">Choose type</option>
                                <option value="0">Percentage</option>
                                <option selected value="1">Fixed</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="number"
                                   class="form-control"
                                   required
                                   placeholder="amount"
                                   name="amount">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="date"
                                   class="form-control"
                                   required
                                   placeholder="Validated Till"
                                   name="validated_till">
                            <span>Date will be saved as example: 2022-01-01 00:00:00</span>
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
