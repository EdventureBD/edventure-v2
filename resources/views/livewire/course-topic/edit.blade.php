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
                           <h3 class="card-title">Edit Topic </h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                           <form role="form" wire:submit.prevent="updateCourseTopic">
                              <div class="form-group">
                                 <label class="col-form-label" for="Title"> Course Topic Title  <span class="must-filled">*</span></label>
                                 <input type="text" wire:model="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       id="Title" placeholder="Enter your course topic title">
                                 @error('title')
                                       <p style="color: red;">{{ $message }}</p>
                                 @enderror
                              </div>



                              <div class="row">
                                 <div class="col-md-4">
                                       <div class="form-group">
                                          <label class="col-form-label" for="courseCategory"> Category <span class="must-filled">*</span></label>
                                          <select class="form-control" wire:model="courseCategoryId" id="courseCategory">
                                             <option value="" selected>Select course category</option>
                                             @foreach($all_course_categories as $category)
                                                <option wire:key="{{ $loop->index.$category->slug.$category->id }}" value="{{ $category->id }}">
                                                   {{ $category->title }}
                                                </option>
                                             @endforeach
                                          </select>
                                          <div>
                                             @error('courseCategoryId')
                                                   <p style="color: red;">{{ $message }}</p>
                                             @enderror
                                          </div>
                                       </div>
                                 </div>

                                 <div class="col-md-4">
                                       <div class="form-group">
                                          <label class="col-form-label" for="intermediaryLevel"> Intermediary Levels <span class="must-filled">*</span></label>
                                          <select class="form-control" wire:model="intermediaryLevelId" id="intermediaryLevel">
                                             <option value="" selected>Select Intermediary Level</option>
                                                @foreach($all_intermediary_levels as $intermediaryLevel)
                                                   <option wire:key="{{ $loop->index.$intermediaryLevel->slug.$intermediaryLevel->id }}" value="{{ $intermediaryLevel->id }}">
                                                      {{ $intermediaryLevel->title }}
                                                   </option>
                                                @endforeach
                                          </select>
                                          <div>
                                             @error('intermediaryLevelId')
                                                   <p style="color: red;">{{ $message }}</p>
                                             @enderror
                                          </div>
                                       </div>
                                 </div>

                                 <div class="col-md-4">
                                       <div class="form-group">
                                          <label class="col-form-label" for="course"> Course <span class="must-filled">*</span></label>
                                          <select class="form-control" wire:model="courseId" id="course">
                                             <option value="" selected>Select Course</option>
                                                @foreach($all_courses as $course)
                                                   <option wire:key="{{ $course->title.$course->slug.$course->id }}" value="{{ $course->id }}"> 
                                                      {{ $course->title }}
                                                   </option>
                                                @endforeach
                                          </select>
                                          <div>
                                             @error('courseId')
                                                   <p style="color: red;">{{ $message }}</p>
                                             @enderror
                                          </div>
                                       </div>
                                 </div>
                              </div>

                              {{-- <div class="row">
                                 <div class="col-md-12">
                                       <div class="form-group">
                                          <label class="col-form-label" for="courseName">Course</label>
                                          <select class="form-control" wire:model="courseId" disabled>
                                             <option value="" selected>Select Course</option>
                                             @foreach($courses as $course)
                                                   <option value="{{ $course->id }}">{{ $course->title }}
                                                   </option>
                                             @endforeach
                                          </select>
                                          @error('courseId')
                                             <p style="color: red;">{{ $message }}</p>
                                          @enderror
                                       </div>
                                 </div>
                              </div> --}}

                              <div class="col-md-4">
                                 <div class="form-group">
                                       <label class="col-form-label" for="islandImage">Island Image</label>
                                       <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="customFile" wire:model="islandImage">
                                          <label class="custom-file-label" for="customFile">Choose Image</label>
                                       </div>
                                 </div>
                                 <div>
                                    @if ($islandImage)
                                       Preview:
                                       <img src="{{ $islandImage->temporaryUrl() }}">
                                    @endif
                                    @error('islandImage')
                                       <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>

                              <div class="card-footer">
                                 <button type="submit" class="btn btn-primary">Update</button>
                                 <a href="{{ URL::previous() }}"><button type="button" class="btn btn-danger"> Back </button></a>
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
