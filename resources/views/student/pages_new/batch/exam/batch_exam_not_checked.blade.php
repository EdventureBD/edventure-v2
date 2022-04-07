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
         <div class="bg-light-gray">
            <div class="container">
                  <div class="py-5" style="display: flex; flex-direction: column;">
                     <h1 class="display-5 text-sm text-dark max-w-38 mx-auto fw-600" style="text-align: center">Your submitted answer is being reviewed. Please wait</h1>
                     <div class="d-flex mx-auto">
                        <a href="{{ route('batch-lecture', ['batch' => $batch->slug]) }}" class="btn text-xxsm text-white bg-purple fw-800 px-3 py-2 w-20 mb-3 mt-3 mx-1"> Go Back to Journey <i class="fas fa-arrow-up ml-2"></i></a>
                        @if(!empty($next_link)) <a href="{{ $next_link }}" class="btn text-xxsm text-white bg-purple fw-800 px-3 py-2 w-20 mb-3 mt-3 mx-1">Next <i class="fas fa-angle-double-right ml-1"></i></a> @endif
                     </div>
                  </div>
            </div>
         </div>
      </div>
   </div>
</x-landing-layout>
   
   