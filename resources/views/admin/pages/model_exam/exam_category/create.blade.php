<div style="justify-content: right;display: flex; text-align: end" class="mt-4">
    <a style="padding: 6px" class="mr-1 btn btn-outline-primary btn-sm"
       href="#createCategory"
       data-toggle="modal"
       title="Create Category">
        <i class="far fa-plus-square"></i> Create Category
    </a>
</div>

<div class="modal fade"
     id="createCategory">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Category</h4>
                <button type="button" class="close"
                        data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('exam.category.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <input
                                required
                                type="text"
                                class="form-control"
                                name="name"
                                placeholder="Category name"
                                aria-label="Category name"
                                aria-describedby="basic-addon2">
                        </div>
                        <div class="col-md-6">
                            <input type="number"
                                   name="price"
                                   class="form-control"
                                   placeholder="Price">
                        </div>
                        <div class="mt-3 col-md-12">
                            <textarea
                                id="details"
                                name="details"
                                class="form-control"
                                placeholder="Details"></textarea>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-outline-primary" type="submit">Create</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

