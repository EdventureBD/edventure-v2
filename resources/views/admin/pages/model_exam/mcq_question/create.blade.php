<div class="modal fade"
     id="createQuestion">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <form action="" id="question_form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <div style="display: block !important;">
                        <div class="modal-title" >
                            <h4>Create Question</h4>
                        </div>
                        <span>Exam : {{$exam->title}}</span>
                    </div>
                    @if(count($tags) == 0)
                    <a href="{{route('exam.tags.index')}}"
                        class="btn btn-sm btn-outline-primary pull-right">Create tag first</a>
                    @endif
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="select2-purple">
                                <select required
                                        class="select2 form-control"
                                        name="exam_tag_id"
                                        data-placeholder="Select a tag"
                                        data-dropdown-css-class="select2-purple"
                                        style="width: 100%;">
                                    @foreach ($tags as $tag)
                                        <option value=""></option>
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                           <textarea id="question"
                                     input="question"
                                     name="question"
                                     class="form-control"
                                     placeholder="Enter Question">{{ old('question') }}</textarea>
                            <span class="text-red" id="question_error"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                           <textarea id="field_1"
                                     input="field_1"
                                     name="field_1"
                                     placeholder="Enter Option 1"
                                     class="form-control">{{ old('field_1') }}</textarea>
                            <span class="text-red" id="field_1_error"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                           <textarea id="field_2"
                                     name="field_2"
                                     placeholder="Enter Option 2"
                                     class="form-control">{{ old('field_2') }}</textarea>
                            <span class="text-red" id="field_2_error"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                           <textarea id="field_3"
                                     name="field_3"
                                     placeholder="Enter Option 3"
                                     class="form-control">{{ old('field_3') }}</textarea>
                            <span class="text-red" id="field_3_error"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                           <textarea id="field_4"
                                     name="field_4"
                                     placeholder="Enter Option 4"
                                     class="form-control">{{ old('field_4') }}</textarea>
                            <span class="text-red" id="field_4_error"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <select
                                class="form-control"
                                name="answer"
                                required>
                                <option value="">Select a answer</option>
                                <option value="1">Option 1</option>
                                <option value=2>Option 2</option>
                                <option value=3>Option 3</option>
                                <option value=4>Option 4</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                           <textarea id="explanation"
                                     name="explanation"
                                     placeholder="Explanation"
                                     class="form-control">{{ old('explanation') }}</textarea>
                            <span class="text-red" id="explanation_error"></span>
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
