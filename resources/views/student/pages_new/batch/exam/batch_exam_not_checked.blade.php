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
                  <div class="py-5 ">
                     <h1 class="display-5 text-sm text-dark max-w-38 mx-auto fw-600" style="text-align: center">Your submitted answer is being reviewed. Please wait</h1>
                  </div>
            </div>
         </div>
      </div>
   </div>
</x-landing-layout>
   
   