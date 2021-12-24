<div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Change Profile picture</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="row">
                            <div class="col-md-4">
                                @if($image)
                                    <img class="product-image" src="{{ $image->temporaryUrl() }}" alt="">
                                @elseif($user_image->image)
                                    <img class="product-image" src="{{ Storage::url($user_image->image) }}" alt="">
                                @else
                                    <img src="http://placehold.it/150x100" alt="...">
                                @endif
                                <div wire:loading wire:target="image">
                                    <p style="color: indigo">Uploading Image ....</p>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <form role="form" wire:submit.prevent="updateUserImage">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Choose Image <span class="must-filled">*</span></label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" wire:model="image" class="custom-file-input hidden" id="exampleInputFile" >
                                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                                        image</label>
                                                </div>
                                            </div>

                                            @error('image')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="{{ URL::previous() }}"><button type="button" class="btn btn-danger">Back</button></a>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
