<div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Create MCQ</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="saveMCQ">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="question" class="col-form-label">Question <span class="must-filled">*</span></label>
                                            <input type="text" class="form-control" wire:model="question" placeholder="Enter question">
                                            @error('question')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="exampleInputFile" class="col-form-label">Choose Image</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" wire:model="image" class="custom-file-input hidden" id="exampleInputFile" >
                                                            <label class="custom-file-label" for="exampleInputFile">Choose image</label>
                                                        </div>
                                                    </div>
                                                    @error('image')
                                                        <p style="color: red;">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                @if($image)
                                                    <img class="product-image" src="{{ $image->temporaryUrl() }}" alt="">
                                                @else
                                                    <img src="http://placehold.it/150x100" alt="...">
                                                @endif
                                                <div wire:loading wire:target="image">
                                                    <p style="color: indigo">Uploading Image ....</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="field1" class="col-form-label">Option 1 <span class="must-filled">*</span></label>
                                            <input type="text" class="form-control" wire:model="field1" placeholder="Option 1">
                                            @if($answer)
                                                <img class="product-image" src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fen.m.wikipedia.org%2Fwiki%2FFile%3APDF_file_icon.svg&psig=AOvVaw1ss3yY9qLtjbQuU48a0frd&ust=1613030613138000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCNiX4bft3u4CFQAAAAAdAAAAABAD" alt="">
                                            @endif
                                            <div wire:loading wire:target="image">
                                                <p style="color: indigo">Uploading Image ....</p>
                                            </div>
                                            @error('field1')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="field2" class="col-form-label">Option 2 <span class="must-filled">*</span></label>
                                            <input type="text" class="form-control" wire:model="field2" placeholder="Option 2">
                                            @error('field2')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="field3" class="col-form-label">Option 3 <span class="must-filled">*</span></label>
                                            <input type="text" class="form-control" wire:model="field3" placeholder="Option 3">
                                            @error('field3')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="field4" class="col-form-label">Option 4 <span class="must-filled">*</span></label>
                                            <input type="text" class="form-control" wire:model="field4" placeholder="Option 4">
                                            @error('field4')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="examId">Answer <span class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="answer">
                                                <option value="" selected>Select Answer</option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                                <option value="3">Option 3</option>
                                                <option value="4">Option 4</option>
                                            </select>
                                            @error('answer')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="examId">Exam <span class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="examId" disabled>
                                                <option>{{ $exam->title }}</option>
                                            </select>
                                            @error('examId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="examId">Content Tag <span class="must-filled">*</span></label>
                                        <div class="select2-purple">
                                            <select class="select2" multiple wire:model="contentTagIds" data-placeholder="Select a Content Tag" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                @foreach ($contentTags as $contentTag)
                                                    <option value="{{ $contentTag->id }}">{{ $contentTag->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('contentTagIds')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    <a href="{{ URL::previous() }}"><button type="button" class="btn btn-danger">Back</button></a>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>


