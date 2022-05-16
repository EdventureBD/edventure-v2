<div>
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
                                <h3 class="card-title">Update Program</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form role="form" wire:submit.prevent="updateIntermediaryLevel">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-form-label" for="courseTitle"> Course Title <span
                                                        class="must-filled">*</span> </label>
                                                <input type="text" wire:model="title"
                                                    class="form-control @error('title') is-invalid @enderror"
                                                    id="courseTitle" placeholder="Enter your intermediary ievel title">
                                                @error('title')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-form-label" for="courseName"> Course Category <span class="must-filled">*</span></label>
                                                <select class="form-control" wire:model="categoryId">
                                                    <option value="" disabled>Select Course Category</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->title }} </option>
                                                    @endforeach
                                                </select>
                                                @error('categoryId')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-form-label" for="status"> Status <span class="must-filled">*</span></label>
                                                <select class="form-control @error('status') is-invalid @enderror" wire:model="status">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                                @error('status')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">{{-- card-footer --}}
                                        <button type="submit" class="btn btn-primary">Create</button>
                                        <a href="{{ route('intermediary_level.index') }}"><button type="button" 
                                                class="btn btn-danger ml-2">Back</button></a>
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
</div>
