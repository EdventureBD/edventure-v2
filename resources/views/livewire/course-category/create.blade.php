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
                            <h3 class="card-title">Create Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="saveCategory">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- input states -->
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseCategoryTitle"> Course Category Title <span class="must-filled">*</span> </label>
                                            <input type="text" wire:model="title" class="form-control @error('title') is-invalid @enderror" id="courseCategoryTitle"
                                                placeholder="Enter your course category title">
                                            @error('title')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        {{-- @if($message)
                                            <p style="color: yellow;">{{ $message }}</p>
                                        @endif --}}
                                    </div>
                                    <div class="col-md-6">
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
