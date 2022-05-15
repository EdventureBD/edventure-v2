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
                            <h3 class="card-title">Create Bundle</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="saveBundle">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="bundleName"> Bundle Name <span
                                                    class="must-filled">*</span> </label>
                                            <input type="text" wire:model="bundle_name"
                                                class="form-control @error('bundle_name') is-invalid @enderror"
                                                id="bundleName" placeholder="Enter your bundle name">
                                            @error('bundle_name')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="exampleInputFile" class="col-form-label">Bundle
                                                        Icon</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" wire:model="image"
                                                                class="custom-file-input hidden" id="exampleInputFile">
                                                            <label class="custom-file-label"
                                                                for="exampleInputFile">Bundle icon (240px*240px)</label>
                                                        </div>
                                                    </div>
                                                    @error('image')
                                                        <p style="color: red;">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-4">
                                                @if ($tempImage)
                                                    <img style="width:100px; border-radius: 50%" class="product-image" src="{{ $tempImage->temporaryUrl() }}"
                                                        alt="">
                                                @else
                                                    <img style="width:100px; border-radius: 50%" src="http://placehold.it/240x240" alt="...">
                                                @endif
                                                <div wire:loading wire:target="image">
                                                    <p style="color: indigo">Uploading icon ....</p>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="exampleInputFile" class="col-form-label">Bundle
                                                        Banner</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" wire:model="banner"
                                                                class="custom-file-input hidden" id="exampleInputFile">
                                                            <label class="custom-file-label"
                                                                for="exampleInputFile">Bundle Banner (576px*642px)</label>
                                                        </div>
                                                    </div>
                                                    @error('banner')
                                                        <p style="color: red;">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-4">
                                                @if ($tempBanner)
                                                    <img class="product-image" src="{{ $tempBanner->temporaryUrl() }}"
                                                        alt="">
                                                @else
                                                    <img class="img-fluid" src="http://placehold.it/576x642" alt="...">
                                                @endif
                                                <div wire:loading wire:target="banner">
                                                    <p style="color: indigo">Uploading banner ....</p>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="bundleprice"> Bundle Price <span
                                                    class="must-filled">*</span> </label>
                                            <input type="number" min="0" wire:model="price"
                                                class="form-control @error('price') is-invalid @enderror"
                                                id="bundleCategoryprice" placeholder="Enter your bundle price">
                                            <small id="passwordHelpBlock" class="form-text text-secondary">
                                                Set this as per month price.
                                            </small>
                                        </div>
                                        @error('price')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="Name">Program <span
                                                    class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="intermediaryLevelId">
                                                <option value="" selected>Select Program</option>
                                                @foreach ($intermediary_levels as $intermediary)
                                                    <option value="{{ $intermediary->id }}">{{ $intermediary->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('intermediaryLevelId')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="bundleDuration">Bundle Duration <span
                                                    class="must-filled">*</span></label>
                                            <input type="number" min="1" max="36" wire:model="duration"
                                                class="form-control @error('duration') is-invalid @enderror"
                                                id="bundleDuration" placeholder="Enter your bundle duration (month)">
                                            <small id="passwordHelpBlock" class="form-text text-secondary">
                                                Enter an aproximate month to finish this bundle.
                                            </small>
                                            @error('duration')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
										<div class="form-group">
											<label class="col-form-label" for="status"> Status <span class="must-filled">*</span></label>
											<select class="form-control @error('status') is-invalid @enderror" wire:model="status">
												<option value="" selected disabled>Select Status</option>
												<option value="1">Active</option>
												<option value="0">Inactive</option>
											</select>
											@error('status')
												<p style="color: red;">{{ $message }}</p>
											@enderror
										</div>
									</div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="bundleDescription"> Bundle Description <span
                                            class="must-filled">*</span>
                                    </label>
                                    <textarea rows="5" type="text" wire:model="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        id="bundleDescription" placeholder="Enter your bundle description"></textarea>
                                    <small id="passwordHelpBlock" class="form-text text-secondary">
                                        Enter some details about this bundle. Remember not more than 500 characters.
                                    </small>
                                    @error('description')
                                        <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="col-form-label" for="bundleurl">Trailer </label> <br>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">https://youtube.com/watch?v=</span>
                                        </div>
                                        <input type="text" wire:model="url"
                                            class="form-control @error('url') is-invalid @enderror"
                                            placeholder="Enter your youtube video id" />
                                    </div>
                                    @error('url')
                                        <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    @if ($url)
                                        <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/{{ $url }}"
                                        title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; 
                                        clipboard-write; encrypted-media; gyroscope;
                                        picture-in-picture" allowfullscreen></iframe>
                                        {{-- vimeo player
                                        <iframe src="https://player.vimeo.com/video/{{ $url }}" width="640"
                                            height="360" frameborder="0"
                                            allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe> --}}
                                    @endif
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
