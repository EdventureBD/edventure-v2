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
										<div class="col-md-12">
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
								</div>
								<div class="row">
									<div class="col-md-4">
											<div class="form-group">
											<label for="exampleInputFile" class="col-form-label">Course
												Icon</label>
											<div class="input-group">
												<div class="custom-file">
														<input type="file" wire:model="image"
														class="custom-file-input hidden" id="exampleInputFile">
														<label class="custom-file-label"
														for="exampleInputFile">Course icon (240px*240px)</label>
												</div>
											</div>
											@if ($image)
												<img style="width: 200px;" src="{{ $image->temporaryUrl() }}">
											@endif
											@error('image')
												<p style="color: red;">{{ $message }}</p>
											@enderror
											</div>
											{{-- <div class="col-md-4">
													@if ($tempImage)
													<img style="width:100px; border-radius: 50%" class="product-image" src="{{ $tempImage->temporaryUrl() }}"
														alt="">
													@endif
													<div wire:loading wire:target="image">
													<p style="color: indigo">Uploading icon ....</p>
													</div>
											</div> --}}
									</div>
									<div class="col-md-4">
											<div class="form-group">
											<label for="exampleInputFile" class="col-form-label">Course
												Banner</label>
											<div class="input-group">
												<div class="custom-file">
														<input type="file" wire:model="banner"
														class="custom-file-input hidden" id="exampleInputFile">
														<label class="custom-file-label"
														for="exampleInputFile">Course Banner (576px*642px)</label>
												</div>
											</div>
											@error('banner')
												<p style="color: red;">{{ $message }}</p>
											@enderror
											</div>
											@if ($banner)
												<img style="width: 200px;" src="{{ $banner->temporaryUrl() }}">
											@endif
											{{-- <div class="col-md-4">
													@if ($tempBanner)
													<img class="product-image" src="{{ $tempBanner->temporaryUrl() }}"
														alt="">
													@endif
													<div wire:loading wire:target="banner">
													<p style="color: indigo">Uploading banner ....</p>
													</div>
											</div> --}}
									</div>

									@if($show_island_image)
										<div class="col-md-4">
												<div class="form-group">
												<label for="exampleInputFile" class="col-form-label">Course
													Island Image<span class="must-filled">*</span></label>
												<div class="input-group">
													<div class="custom-file">
															<input type="file" wire:model="island_image"
															class="custom-file-input hidden" id="exampleInputFile">
															<label class="custom-file-label"
															for="exampleInputFile">Course Island Image (576px*642px)</label>
													</div>
												</div>
												@if ($island_image)
													<img style="width: 200px;" src="{{ $island_image->temporaryUrl() }}">
												@endif
												@error('island_image')
													<p style="color: red;">{{ $message }}</p>
												@enderror
												</div>
												{{-- <div class="col-md-4">
														@if ($tempBanner)
														<img class="product-image" src="{{ $tempBanner->temporaryUrl() }}"
															alt="">
														@endif
														<div wire:loading wire:target="banner">
														<p style="color: indigo">Uploading banner ....</p>
														</div>
												</div> --}}
										</div>
									@endif
								</div>

								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="col-form-label" for="intermediaryLevels">Intermediary Level <span
													class="must-filled">*</span></label>
											<select class="form-control" wire:model="intermediaryLevelId">
												<option value="" selected>Select Intermediary Level</option>
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
											<label class="col-form-label" for="bundles"> Bundle </label>
											<select class="form-control" wire:model="bundleId">
													<option value="" selected>Select Bundle</option>
													@foreach ($bundles as $bundle)
													<option value="{{ $bundle->id }}">{{ $bundle->bundle_name }}</option>
													@endforeach
											</select>
											<small id="passwordHelpBlock" class="form-text text-secondary">
													If nothing is selected, then course will not be considered part of a bundle.
											</small>
										</div>
										@error('bundleId')
											<p style="color: red;">{{ $message }}</p>
										@enderror
									</div>

									@if($show_teachers)
										<div class="col-md-4" wire:key="teachers">
											<div class="form-group">
												<label class="col-form-label" for="teachers">Teacher<span
														class="must-filled">*</span></label>
												<select class="form-control" wire:model="teacherId">
													<option value="" selected>Select Teacher</option>
													@foreach ($teachers as $teacher)
														<option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
													@endforeach
												</select>
											</div>
											@error('teacherId')
												<p style="color: red;">{{ $message }}</p>
											@enderror
										</div>
									@endif

									@if($show_price)
										<div class="col-md-4" wire:key="price">
											<div class="form-group">
												<label class="col-form-label" for="coursePrice"> Course Price <span
														class="must-filled">*</span> </label>
												<input type="number" min="0" wire:model="price"
													class="form-control @error('price') is-invalid @enderror"
													id="coursePrice" placeholder="Enter your course price">
												<small id="passwordHelpBlock" class="form-text text-secondary">
													Set this as per month price.
												</small>
											</div>
											@error('price')
												<p style="color: red;">{{ $message }}</p>
											@enderror
										</div>
									@endif

									<div class="col-md-4">
										<div class="form-group">
											<label class="col-form-label" for="courseDuration">Course Duration <span
													class="must-filled">*</span></label>
											<input type="number" min="1" max="36" wire:model="duration"
													class="form-control @error('duration') is-invalid @enderror"
													id="courseDuration" placeholder="Enter your course duration (month)">
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
										<label class="col-form-label" for="courseurl">Trailer </label> <br>
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
