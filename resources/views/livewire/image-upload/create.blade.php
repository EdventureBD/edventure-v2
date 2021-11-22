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
                            <h3 class="card-title">Upload Images</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="saveImages" enctype="multipart/form-data" />
                                <div class="col-12">
                                    <div class="card card-primary">
                                        <div class="custom-file">
                                            <input type="file" wire:model="images" class="custom-file-input" id="validatedCustomFile" multiple required>
                                            <label class="custom-file-label" for="validatedCustomFile">Choose Image to upload...</label>
                                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                                        </div>
                                        @if ($images)
                                            <div class="card-body">
                                                @foreach ($images as $index => $image)
                                                    <div class="row border border-success mb-2 p-2">
                                                        <div class="col-sm-4">
                                                            <a href="{{ $image->temporaryUrl() }}"
                                                                data-toggle="lightbox" data-title="sample 1 - white"
                                                                data-gallery="gallery">
                                                                <img src="{{ $image->temporaryUrl() }}"
                                                                    class="img-fluid mb-2 rounded" alt="{{ $image->temporaryUrl() }}" width="50%" height="50%" />
                                                            </a>
                                                            @error('image') <span class="error">{{ $message }}</span> @enderror
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input class="form-control form-control-lg" type="text" wire:model="title.{{ $index }}" id="text">
                                                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <a class="btn btn-app" wire:click.prevent="removeImage({{ $index }})">
                                                                <i class="fas fa-minus"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    <a href="{{ URL::previous() }}"><button type="button"
                                            class="btn btn-danger">Back</button></a>
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
