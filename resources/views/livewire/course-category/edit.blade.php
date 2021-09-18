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
                            <h3 class="card-title">Edit Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="updateCourseCategory">
                                <!-- input states -->
                                <div class="form-group">
                                    <label class="col-form-label" for="categoryTitle"> Course Category Title <span class="must-filled">*</span> </label>
                                    <input type="text" wire:model="title" class="form-control @error('title') is-invalid @enderror" id="categoryTitle"
                                        placeholder="Enter your course category title">
                                </div>
                                @error('title')
                                    <p style="color: red;">{{ $message }}</p>
                                @enderror
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="javascript:history.back()"><button type="button" class="btn btn-danger">Back</button></a>
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
