<a class="mr-1 btn btn-outline-primary btn-sm"
   href="#editCategory{{ $category->id }}"
   data-toggle="modal"
   title="Edit {{ $category->name }}">
    <i class="far fa-edit"></i>
</a>

<div class="modal fade"
     id="editCategory{{ $category->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit
                    {{ $category->name }}</h4>
                <button type="button" class="close"
                        data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('exam.category.update',$category->id)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <input
                                required
                                type="text"
                                class="form-control"
                                name="name"
                                value="{{$category->name}}"
                                placeholder="Category name"
                                aria-label="Category name"
                                aria-describedby="basic-addon2">
                        </div>
                        <div class="col-md-6">
                            <input type="text"
                                   name="price"
                                   value="{{$category->price}}"
                                   class="form-control"
                                   placeholder="Price">
                        </div>
                        <div class="mt-3 col-md-12">
                            <textarea
                                name="details"
                                class="form-control detailsEdit"
                                placeholder="Details">{!! $category->details !!}</textarea>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-outline-success" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
