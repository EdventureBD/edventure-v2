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
                            <h3 class="card-title">Create Course</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="saveCourse">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseTitle"> Course Title <span
                                                    class="must-filled">*</span> </label>
                                            <input type="text" wire:model="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                id="courseTitle" placeholder="Enter your course title">
                                            @error('title')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="exampleInputFile" class="col-form-label">Choose
                                                        Image</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" wire:model="image"
                                                                class="custom-file-input hidden" id="exampleInputFile">
                                                            <label class="custom-file-label"
                                                                for="exampleInputFile">Choose image</label>
                                                        </div>
                                                    </div>
                                                    @error('image')
                                                        <p style="color: red;">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                @if ($tempImage)
                                                    <img class="product-image" src="{{ $tempImage->temporaryUrl() }}"
                                                        alt="">
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
                                            <label class="col-form-label" for="courseprice"> Course Price <span
                                                    class="must-filled">*</span> </label>
                                            <input type="number" wire:model="price"
                                                class="form-control @error('price') is-invalid @enderror"
                                                id="courseCategoryprice" placeholder="Enter your course price">
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
                                            <label class="col-form-label" for="courseName">Category <span
                                                    class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="categoryId">
                                                <option value="" selected>Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('categoryId')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseDuration">Course Duration <span
                                                    class="must-filled">*</span></label>
                                            <input type="text" wire:model="duration"
                                                class="form-control @error('duration') is-invalid @enderror"
                                                id="courseDuration" placeholder="Enter your course duration in month">
                                            <small id="passwordHelpBlock" class="form-text text-secondary">
                                                Enter an aproximate month to finish this course.
                                            </small>
                                            @error('duration')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="courseDescription"> Course Description <span
                                            class="must-filled">*</span>
                                    </label>
                                    <textarea rows="5" type="text" wire:model="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        id="courseDescription" placeholder="Enter your course description"></textarea>
                                    <small id="passwordHelpBlock" class="form-text text-secondary">
                                        Enter some details about this course. Remember not more than 500 characters.
                                    </small>
                                    @error('description')
                                        <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="col-form-label" for="courseurl">Treailer </label> <br>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">https://vimeo.com/</span>
                                        </div>
                                        <input type="text" wire:model="url"
                                            class="form-control @error('url') is-invalid @enderror"
                                            placeholder="Enter your video number as 25753871" />
                                    </div>
                                    @error('url')
                                        <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    @if ($url)
                                        <iframe src="https://player.vimeo.com/video/{{ $url }}" width="640"
                                            height="360" frameborder="0"
                                            allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                                    @endif
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    <a href="javascript:history.back()"><button type="button"
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
