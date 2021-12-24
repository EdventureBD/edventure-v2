<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"> Change Password </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" wire:submit.prevent="updatePassword">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Password">Old password <span class="must-filled">*</span></label>
                                <input type="password" wire:model="Password" class="form-control @error('Password') is_invalid @enderror" id="Password"
                                    placeholder="old password">
                                @error('Password')
                                    <p style="color: red;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="newPassword">New Password <span class="must-filled">*</span></label>
                                <input type="password" wire:model="newPassword" class="form-control @error('newPassword') is_invalid @enderror" id="newPassword"
                                    placeholder="New Password">
                                @error('newPassword')
                                    <p style="color: red;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="confirmNewPassword">Confirm New Password <span class="must-filled">*</span></label>
                                <input type="password" wire:model="confirmNewPassword" class="form-control @error('confirmNewPassword') is_invalid @enderror" id="confirmNewPassword"
                                    placeholder="Confirm New Password">
                                @error('confirmNewPassword')
                                    <p style="color: red;">{{ $message }}</p>
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
                <!-- /.card -->

            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
