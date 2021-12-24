<div class="col-md-12 p-0">
    <form role="form" wire:submit.prevent="editAccount">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" value="{{ $user->name }}" placeholder="Your name ..." disabled>
                </div>
                <div class="form-group">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" value="{{ $user->email }}" placeholder="Your email address ..." disabled>
                    <small class="form-text text-muted">You can change email once you confirmed it.</small>
                </div>
                <div class="form-group">
                    <label class="form-label">Phone No <span style="color: red;">*</span></label>
                    <input type="tel" class="form-control" wire:model="contact" placeholder="Your phone no ...">
                    @error('contact')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gender">Select Gender <span style="color: red;">*</span></label>
                    <select class="form-control" id="gender" wire:model="gender">
                        <option value="" selected>Select gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    @error('gender')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Class <span style="color: red;">*</span></label>
                    <input type="text" class="form-control"  wire:model="class" placeholder="What class do you read in ...">
                    @error('class')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Institution <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" wire:model="institution" placeholder="Your institution name ..." >
                    @error('institution')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="avatar avatar-xxl avatar-4by3">
                                @if ($image)
                                    <img src="{{ Storage::url($image) }}" alt="Avatar"
                                            class="avatar-img rounded">
                                @elseif($tempImage)
                                    <img src="{{ $tempImage->temporaryUrl() }}" alt="Avatar"
                                            class="avatar-img rounded">
                                @else
                                    <img src="{{ asset('student/public/images/people/256/iconfinder_user-alt_285645.png') }}" alt="Avatar"
                                            class="avatar-img rounded">
                                @endif
                                <div wire:loading wire:target="tempImage">
                                    <p class="text-warning h6">Uploading Image ....</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="file" class="custom-file-label">Choose file</label>
                            <input type="file" id="file" wire:model="tempImage" class="custom-file-input">
                            @error('image')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Guardian Contact No</label>
                    <input type="tel" class="form-control" wire:model="gaurdianContactNo" placeholder="Your guardian contact no ...">
                    @error('gaurdianContactNo')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Realtion with guardian</label>
                    <input type="text" class="form-control" wire:model="relationWithGaurdian" placeholder="Your relation with guardian ...">
                    @error('relationWithGaurdian')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">District</label>
                    <input type="tel" class="form-control" wire:model="district" placeholder="Your district ...">
                    @error('district')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" wire:model="address" placeholder="Your address ...">
                    @error('address')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save changes</button>
        <a href="{{ URL::previous() }}"><button type="button" class="btn btn-danger">Back</button></a>
    </form>
</div>
