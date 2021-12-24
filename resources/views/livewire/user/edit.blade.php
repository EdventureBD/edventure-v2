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
                            <h3 class="card-title">Edit User </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="saveUser">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="userName"> User Name <span
                                                    style="color: red">*</span></label>
                                            <input type="text" wire:model="name"
                                                class="form-control @error('name') is-invalid @enderror" id="userName"
                                                placeholder="Enter user name">
                                            @error('name')
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
                                                @if ($image)
                                                    <img class="product-image" src="{{ Storage::url($image) }}"
                                                        alt="">
                                                    @if ($tempImage)
                                                        <img class="product-image"
                                                            src="{{ $tempImage->temporaryUrl() }}" alt="">
                                                    @endif
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
                                            <label class="col-form-label" for="userEmail"> Email <span
                                                    style="color: red">*</span></label>
                                            <input type="email" wire:model="email"
                                                class="form-control @error('email') is-invalid @enderror" id="userEmail"
                                                placeholder="Enter email">
                                        </div>
                                        @error('email')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="userPhone"> Phone <span
                                                    style="color: red">*</span></label>
                                            <input type="tel" wire:model="phone"
                                                class="form-control @error('phone') is-invalid @enderror" id="userPhone"
                                                placeholder="Enter phone number">
                                        </div>
                                        @error('phone')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="userType">User Type <span
                                                    style="color: red">*</span></label>
                                            <select class="form-control" wire:model="user_type">
                                                @foreach ($user_types as $user_type)
                                                    <option value="{{ $user_type->id }}">{{ $user_type->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('user_type')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
