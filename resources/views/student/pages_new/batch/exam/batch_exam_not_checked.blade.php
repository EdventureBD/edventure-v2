{{-- =======================old code starts================================= --}}

{{-- <x-landing-layout headerBg="white">
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
                  
                  <p class="hero__lead measure-hero-lead text-white-50">Exam : {{ $exam->title }}</p>
            </div>
         </div>
         <div class="" style="background: #75E9AA !important;">
            <div class="container">
                  <div class="py-5" style="display: flex; flex-direction: column;">
                     <h1 class="display-5 text-sm text-purple max-w-38 mx-auto fw-600" style="text-align: center">You have successfully attempted this exam. However, it is yet to be checked. Visit later to see your results.</h1>
                     <div class="d-flex mx-auto">
                        <a href="{{ route('batch-lecture', ['batch' => $batch->slug]) }}" class="btn text-xxsm text-white bg-purple fw-800 px-3 py-2 w-20 mb-3 mt-3 mx-1"> Go Back to Journey <i class="fas fa-arrow-up ml-2"></i></a>
                         --}}
                        {{-- If next exam type is TEE generate a confirmation modal with button --}}
                        {{-- @if(isset($next_exam_type_TEE) && $next_exam_type_TEE)
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
                           </div> --}}
                        {{-- Else generate a normal btn --}}
                        {{-- @else
                           @if(!empty($next_link)) <a href="{{ $next_link }}" class="btn text-xxsm text-white bg-purple fw-800 px-3 py-2 w-20 mb-3 mt-3 mx-1"> {{ $next_link_btn_text }} <i class="fas fa-angle-double-right ml-1"></i></a> @endif
                        @endif

                     </div>
                  </div>
            </div>
         </div>
      </div>
   </div>
</x-landing-layout> --}}
   
   

{{-- ========================old code endss=============================== --}}
<x-landing-layout>
   <style>
         .examBtn{
            border-radius: 25px;
            /*background: #6400c8;*/
            background: white;
            color: #6400c8;
            border-color: #6400c8;
         }
         .examBtn:hover{
            background: #6400c8;
            color: white;
            border-color: #6400c8;
         }
         :root {
            --border-color: #D7DBE3;
            font-family: -apple-system, BlinkMacSystemFont, 'Roboto', 'Open Sans', 'Helvetica Neue', sans-serif;
            --green: #0CD977;
            --red: #FF1C1C;
            --pink: #FF93DE;
            --purple: #5767ED;
            --yellow: #FFC61C;
            --rotation: 0deg;
         }

         body {
            overflow: hidden;
         }

         @keyframes scaleCup {
            0% {
               transform: scale(0.6);
            }

            100% {
               transform: scale(1);
            }
         }

         @keyframes confettiRain {
            0% {
               opacity: 1;
               margin-top: -100vh;
               margin-left: -200px;
            }

            100% {
               opacity: 1;
               margin-top: 100vh;
               margin-left: 200px;
            }
         }

         .confetti {
            opacity: 0;
            position: absolute;
            width: 1rem;
            height: 1.5rem;
            transition: 500ms ease;
            animation: confettiRain 5s infinite;
         }

         #confetti-wrapper {
            overflow: hidden !important;
         }
   </style>
   <div id="confetti-wrapper"></div>
   <div class="container my-5">
      <div class="my-5 py-5 d-flex justify-content-center">
            <div id="successfully_submitted_section">
               <h1 class="text-success"><i class="far fa-check-circle"></i>  Thanks.</h1>
               <div class="d-flex text-purple">
                     <h5>You have successfully attempted this exam. However, your script is yet to be checked. Visit later to see your results.</h5>
               </div>

               <div class="d-flex mx-auto">
                  <a href="{{ route('batch-lecture', ['batch' => $batch->slug]) }}" class="btn text-xxsm text-white fw-800 px-3 py-2 w-20 mb-3 mt-3 mx-1 custom-submit-btn"> Back to Journey <i class="fas fa-arrow-up ml-2"></i></a>
                  
                  {{-- If next exam type is TEE generate a confirmation modal with button --}}
                  @if(isset($next_exam_type_TEE) && $next_exam_type_TEE)
                     <button type="button" class="btn text-xxsm text-white fw-800 px-3 py-2 w-20 mb-3 mt-3 mx-1 custom-submit-btn" data-toggle="modal" data-target="#exampleModalLong">  {{ $next_link_btn_text }} <i class="fas fa-angle-double-right ml-1"></i> </button>
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
                              <a href="{{ $next_link }}" class="btn text-xxsm text-white custom-submit-btn fw-800 px-3 py-2 w-20 mb-3 mt-3 mx-1"> Continue <i class="fas fa-angle-double-right ml-1"></i></a>
                           </div>
                        </div>
                        </div>
                     </div>
                  {{-- Else generate a normal btn --}}
                  @else
                     @if(!empty($next_link)) <a href="{{ $next_link }}" class="btn text-xxsm text-white custom-submit-btn fw-800 px-3 py-2 w-20 mb-3 mt-3 mx-1"> {{ $next_link_btn_text }} <i class="fas fa-angle-double-right ml-1"></i></a> @endif
                  @endif

               </div>

            </div>
      </div>

   </div>
</x-landing-layout>
<script>
   for(i=0; i<100; i++) {
         // Random rotation
         var randomRotation = Math.floor(Math.random() * 360);
         // Random Scale
         var randomScale = Math.random() * 1;
         // Random width & height between 0 and viewport
         var randomWidth = Math.floor(Math.random() * Math.max(document.documentElement.clientWidth, window.innerWidth || 0));
         var randomHeight =  Math.floor(Math.random() * Math.max(document.documentElement.clientHeight, window.innerHeight || 500));

         // Random animation-delay
         var randomAnimationDelay = Math.floor(Math.random() * 15);
         console.log(randomAnimationDelay);

         // Random colors
         var colors = ['#0CD977', '#FF1C1C', '#FF93DE', '#5767ED', '#FFC61C', '#8497B0']
         var randomColor = colors[Math.floor(Math.random() * colors.length)];

         // Create confetti piece
         var confetti = document.createElement('div');
         confetti.className = 'confetti';
         confetti.style.top=randomHeight + 'px';
         confetti.style.right=randomWidth + 'px';
         confetti.style.backgroundColor=randomColor;
         // confetti.style.transform='scale(' + randomScale + ')';
         confetti.style.obacity=randomScale;
         confetti.style.transform='skew(15deg) rotate(' + randomRotation + 'deg)';
         confetti.style.animationDelay=randomAnimationDelay + 's';
         document.getElementById("confetti-wrapper").appendChild(confetti);
   }
</script>
  