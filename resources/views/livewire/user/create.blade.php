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
                            <h3 class="card-title">Create User <br> Password <span style="color: red">12345678</span>
                                By default</h3>
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
                                                        Image <span style="color: red">*</span></label>
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
                                                    <img class="product-image" src="{{ $image->temporaryUrl() }}"
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
                                            <select wire:click="changeEvent($event.target.value)" id="user_type" class="form-control" wire:model="user_type">
                                                <option value="" selected>Select user type</option>
                                                @foreach ($user_types as $user_type)
                                                    <option value="{{ $user_type->id }}">{{ $user_type->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('user_type')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                @if($show)
                                <div class="row" id="teacher_div">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="education"> Teacher Education <span
                                                    style="color: red">*</span></label>
                                            <input type="text" wire:model="education"
                                                   class="form-control @error('education') is-invalid @enderror" id="education"
                                                   placeholder="Educated from">
                                        </div>
                                        @error('education')
                                        <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="year_of_experience"> Teacher experience in year <span
                                                    style="color: red">*</span></label>
                                            <input type="number" wire:model="year_of_experience"
                                                   class="form-control @error('year_of_experience') is-invalid @enderror" id="year_of_experience"
                                                   placeholder="Experience in year">
                                        </div>
                                        @error('year_of_experience')
                                        <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="education"> Teacher Expertise In <span
                                                    style="color: red">*</span></label>
                                            <input type="text" wire:model="expertise"
                                                   class="form-control @error('expertise') is-invalid @enderror" id="expertise"
                                                   placeholder="physics, math,">
                                        </div>
                                        @error('expertise')
                                        <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                @endif

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
