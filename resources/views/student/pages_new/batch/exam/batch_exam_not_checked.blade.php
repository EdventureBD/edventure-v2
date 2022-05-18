<x-landing-layout headerBg="white">
   <div class="page-section ">
      <div>
         <div class="course-info bg-gradient-purple py-5">
            <div class="container">
                  <div class="row">
                     <div class="col-7">
                        <h3 class="text-white flex m-0">Course : {{ $batch->course->title }}</h3>
                     </div>
                  </div>
                  <p class="hero__lead measure-hero-lead text-white-50">Batch : {{ $batch->title }}</p>
                  {{-- <p class="hero__lead measure-hero-lead text-white-50">Topic : {{ $courseLecture->title }}</p> --}}
                  <p class="hero__lead measure-hero-lead text-white-50">Exam : {{ $exam->title }}</p>
            </div>
         </div>
         <div class="" style="background: #75E9AA !important;">
            <div class="container">
                  <div class="py-5" style="display: flex; flex-direction: column;">
                     <h1 class="display-5 text-sm text-purple max-w-38 mx-auto fw-600" style="text-align: center">You have successfully attempted this exam. However, it is yet to be checked. Visit later to see your results.</h1>
                     <div class="d-flex mx-auto">
                        <a href="{{ route('batch-lecture', ['batch' => $batch->slug]) }}" class="btn text-xxsm text-white bg-purple fw-800 px-3 py-2 w-20 mb-3 mt-3 mx-1"> Go Back to Journey <i class="fas fa-arrow-up ml-2"></i></a>
                        
                        {{-- If next exam type is TEE generate a confirmation modal with button --}}
                        @if(isset($next_exam_type_TEE) && $next_exam_type_TEE)
                           <button type="button" class="btn text-xxsm text-white bg-purple fw-800 px-3 py-2 w-20 mb-3 mt-3 mx-1" data-toggle="modal" data-target="#exampleModalLong">  {{ $next_link_btn_text }} <i class="fas fa-angle-double-right ml-1"></i> </button>
                           <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title text-center" id="exampleModalLongTitle"> Confirm continue </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true" style="font-size: 3rem; font-weight:600; color:#8c00ff !important;">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    You are about to attempt a Topic End Exam. Are you sure you wish to continue ?
                                 </div>
                                 <div class="modal-footer d-flex justify-content-between">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                    <a href="{{ $next_link }}" class="btn text-xxsm text-white bg-purple fw-800 px-3 py-2 w-20 mb-3 mt-3 mx-1"> Continue <i class="fas fa-angle-double-right ml-1"></i></a>
                                 </div>
                              </div>
                              </div>
                           </div>
                        {{-- Else generate a normal btn --}}
                        @else
                           @if(!empty($next_link)) <a href="{{ $next_link }}" class="btn text-xxsm text-white bg-purple fw-800 px-3 py-2 w-20 mb-3 mt-3 mx-1"> {{ $next_link_btn_text }} <i class="fas fa-angle-double-right ml-1"></i></a> @endif
                        @endif

                     </div>
                  </div>
            </div>
         </div>
      </div>
   </div>
</x-landing-layout>
   
   