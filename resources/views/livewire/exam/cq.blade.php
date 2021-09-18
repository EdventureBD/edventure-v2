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
                            <h3 class="card-title">Create CQ</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="saveCQ">
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="marks">Marks <span class="must-filled">*</span></label>
                                            <input type="text" id="marks" class="form-control" wire:model="marks" placeholder="Enter marks">
                                            @error('marks')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputFile" class="col-form-label">Choose anser pdf file <span class="must-filled">*</span></label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" wire:model="answer" class="custom-file-input hidden" id="exampleInputFile" >
                                                    <label class="custom-file-label" for="exampleInputFile">Choose answer pdf</label>
                                                </div>
                                            </div>
                                            @error('answer')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                            <div wire:loading wire:target="answer">
                                                <p style="color: indigo">Wait. Uploading pdf....</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
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

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    <a href="javascript:history.back()"><button type="button" class="btn btn-danger">Back</button></a>

                                    <div wire:loading wire:target="saveCQ">
                                        <p style="color: indigo">Creating....</p>
                                    </div>
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
