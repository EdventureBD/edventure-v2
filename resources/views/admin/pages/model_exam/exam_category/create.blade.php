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
                <form action="{{route('exam.category.store')}}" method="POST" enctype="multipart/form-data">
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
                                   name="time_allotted"
                                   class="form-control"
                                   placeholder="Time allotted">
                        </div>

                        <div class="col-md-6 mt-3">
                            <input
                                type="number"
                                class="form-control"
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
                                @foreach ($teachers as $key => $teacher)
                                    @php($value = json_encode(['id' =>$teacher->id, 'order' => $key]))
                                    <option value=""></option>
                                    <option value="{{$value}}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <input

                                type="number"
                                class="form-control"
                                name="paper_final"
                                placeholder="Paper final">
                        </div>
                        <div class="col-md-4 mt-3">
                            <input

                                type="number"
                                class="form-control"
                                name="subject_final"
                                placeholder="Subject final">
                        </div>
                        <div class="col-md-4 mt-3">
                            <input

                                type="number"
                                class="form-control"
                                name="final_exam"
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
                                id="details"
                                name="details"
                                class="form-control"
                                placeholder="Details"></textarea>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="custom-file">
                                <input type="file"
                                       accept="image/*"
                                       name="image"
                                       class="custom-file-input"
                                       id="image">
                                <label class="custom-file-label" for="image">Image</label>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <input
                                type="text"
                                class="form-control"
                                name="price"
                                placeholder="Price">
                        </div>
                        <div class="col-md-6 mt-3">
                            <input
                                type="text"
                                class="form-control"
                                name="offer_price"
                                placeholder="Offer price">
                        </div>
                        <div class="col-md-12 mt-3">
                            <button class="btn btn-outline-primary" type="submit">Create</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

