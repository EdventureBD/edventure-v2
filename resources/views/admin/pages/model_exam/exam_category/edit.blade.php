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
                <form action="{{route('exam.category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
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
                            <input type="number"
                                   value="{{$category->time_allotted ?? 0}}"
                                   name="time_allotted"
                                   class="form-control"
                                   placeholder="Time allotted">
                        </div>
                        <div class="col-md-6 mt-3">
                            <input
                                type="number"
                                class="form-control"
                                value="{{$category->full_solutions ?? 0}}"
                                name="full_solutions"
                                placeholder="Full solutions">
                        </div>
                        <div class="col-md-6 mt-3">
                            <select
                                class="select2 form-control"
                                name="teachers[]"
                                multiple
                                data-placeholder="Choose Teachers"
                                data-dropdown-css-class="select2-purple"
                                style="width: 100%; margin-top: -8px !important;">
                                @foreach ($teachers as $teacher)
                                    <option value=""></option>
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <input
                                type="number"
                                class="form-control"
                                value="{{$category->paper_final ?? 0}}"
                                name="paper_final"
                                placeholder="Paper final">
                        </div>
                        <div class="col-md-4 mt-3">
                            <input

                                type="number"
                                class="form-control"
                                value="{{$category->subject_final ?? 0}}"
                                name="subject_final"
                                placeholder="Subject final">
                        </div>
                        <div class="col-md-4 mt-3">
                            <input
                                type="number"
                                class="form-control"
                                name="final_exam"
                                value="{{$category->final_exam ?? 0}}"
                                placeholder="Final exam">
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">https://youtube.com/watch?v=</span>
                                </div>
                                <input type="text"
                                       class="form-control"
                                       name="category_video"
                                       id="category_video"
                                       placeholder="Category video Url" />
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="custom-file">
                                <input type="file"
                                       accept="image/*"
                                       name="routine_image"
                                       class="custom-file-input"
                                       id="routine_image">
                                <label class="custom-file-label" for="image">Routine image</label>
                            </div>
                        </div>
                        <div class="mt-3 col-md-12">
                            <textarea
                                name="details"
                                class="form-control detailsEdit"
                                placeholder="Details">{!! $category->details !!}</textarea>
                        </div>

                        <div class="col-md-6 mt-3">
                            <input type="number"
                                   name="price"
                                   value="{{$category->price ?? 0}}"
                                   class="form-control"
                                   placeholder="Price">
                        </div>
                        <div class="col-md-6 mt-3">
                            <input
                                type="text"
                                class="form-control"
                                value="{{$category->offer_price ?? 0}}"
                                name="offer_price"
                                placeholder="Offer price">
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
