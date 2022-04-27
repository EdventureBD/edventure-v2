<x-landing-layout headerBg="white">
   {{-- css linked --}}
   <link rel="stylesheet" href="{{ asset('/css/roadmap.css') }}">
   {{-- css linked part ends  --}}
   <div class="d-flex flex-column position-relative pb-5" id="roadmapParentContainer">
      <div class="d-flex fixed-top" id="roadmap-nav">
         <div class="my-auto pl-3">
            <a href="{{ $back_url }}"> <img src="/img/road_map/back.png" alt="getting back button" class="img-fluid" id="roadmap-back-btn"></a>
         </div>
         <div class="my-auto pr-5 mx-auto">
            <h1 class="fw-800" id="roadmap-subject-topic-name">{{ $course->title }}</h1>
         </div>
      </div>

      <div style="" class="mt-5 mx-5">
         <div class="mt-5 mx-3">
            @foreach($errors->all() as $error)
               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong> Error !</strong> {{ $error }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">×</span>
                  </button>
               </div>
            @endforeach

            @if(session()->get('no_courses'))
               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong> Error !</strong> {{ session()->get('no_courses') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">×</span>
                  </button>
               </div>
            @endif
         </div>
      </div>
      <div class="@if(count($batchTopics) > 1) d-flex @endif justify-content-center container mt-5 pt-4" id="ilandGrandParentContainer">
         <div class="row row-cols-md-5 row-cols-sm-1 mx-md-0 mt-lg-0 pt-lg-0 pt-sm-3 mt-sm-3" id="ilandsParentContainer">

         </div>
      </div>
   </div>

   {{-- Modal part --}}
   <!-- Modal -->
   @php
      $disabled = false;
      $disabled2 = false;
      $previous_island_topic_end_exam_passed = true;
   @endphp
   @foreach ($batchTopics as $batchTopic)
      @php if ($disabled && !$disabled2) $disabled = false; @endphp
      @if(($previous_island_topic_end_exam_passed || $batchTopic->previous_topic_end_exam_attempts_unlocked) && count($batchTopic->courseTopic->exams) != 0)
         <div class="modal fade" id="courseTopicModal-{{ $batchTopic->courseTopic->id }}" tabindex="-1" role="dialog" aria-labelledby="courseTopicModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header border" style="display: flex;align-items: center;">
                     <h5 class="modal-title mx-auto fw-800" id="exampleModalLabel"> Exams for {{ $batchTopic->courseTopic->title }}</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-bottom: -0.5rem; opacity: 1 !important;">
                        <span aria-hidden="true" style="font-size: 3rem; font-weight:600; color:#8c00ff !important;">&times;</span>
                     </button>
                  </div> 
                  <div class="modal-body" style="padding-top: 25px; padding-bottom: 25px;">
                     {{-- @if($batchTopic->courseTopic->exams->last()->exam_attempts->count() > 0 && $batchTopic->courseTopic->exams->last()->exam_attempts->last()->attempts < 3) --}}
                        <ul class="remove_padding">
                           @forelse ($batchTopic->courseTopic->exams as $exam)
                              @if (count($exam->course_lectures))
                                 @foreach ($exam->course_lectures as $course_lecture)
                                    <li>
                                          <a
                                             data-toggle="tooltip" data-placement="top" title="{{ $course_lecture->title }}"
                                             @if($disabled2) style="pointer-events: none; cursor: default; color: grey;" @endif
                                             href="{{ route('topic_lecture', [$batch->slug, $course_lecture->slug]) }}"
                                             class="reduce_padding fw-800 @if($disabled2) modal-items-disabled @elseif (($disabled && !$disabled2) || !$course_lecture->completed) modal-items-next @else modal-items @endif text-white d-flex justify-content-center rounded ml-5 p-1">
                                             <span data-tooltip="{{ $course_lecture->title }}" class="top tooltip_center"> {{ Str::limit($course_lecture->title, 23, '...') }} </span>
                                          </a>
                                       <div class="w-25">

                                          @if($disabled2)
                                             <div style="height:50px;"></div>
                                          @elseif (($disabled && !$disabled2) || !$course_lecture->completed)
                                             <div style="height:50px;"></div>
                                          @else
                                             <img src="/img/road_map/rightSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid">
                                          @endif

                                          {{-- @if($disabled2)
                                             <img src="/img/road_map/wrongSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid">
                                          @else
                                             <img src="/img/road_map/rightSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid">
                                          @endif --}}
                                       </div>
                                    </li>
                                    @php
                                       if ($disabled && !$disabled2 && !$course_lecture->completed) $disabled2 = true;
                                    @endphp
                                 @endforeach
                              @endif

                              <li>
                                 @if($exam->exam_type == "Aptitude Test")
                                    <a 
                                       data-toggle="tooltip" data-placement="top" title="{{ $exam->title }}"
                                       @if($disabled2) style="pointer-events: none; cursor: default; color: grey; height: 20px;" @endif
                                       href="{{ route('batch-test', [$batchTopic->courseTopic->slug, $batch->slug, $exam->id, $exam->exam_type]) }}"
                                       class="reduce_padding fw-800 @if ($exam->exam_type == "Aptitude Test" && !$exam->has_been_attempted) modal-items-next @else modal-items @endif text-white d-flex justify-content-center rounded ml-5 p-1">
                                       <span data-tooltip="{{ $exam->title }}" class="top tooltip_center"> {{ Str::limit($exam->title, 23, '...') }} </span>
                                    </a>
                                    <div class="w-25">

                                       @if ($exam->exam_type == "Aptitude Test" && !$exam->has_been_attempted)
                                          <div style="height:50px;"></div>
                                       @else 
                                          <img src="/img/road_map/rightSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid" id="aptitute-test">
                                       @endif

                                       {{-- @if($disabled2)
                                          <img src="/img/road_map/wrongSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid">
                                       @else
                                          <img src="/img/road_map/rightSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid" id="aptitute-test">
                                       @endif --}}
                                    </div>
                                 @else
                                    <a
                                       data-toggle="tooltip" data-placement="top" title="{{ $exam->title }}"
                                       @if($disabled2) style="pointer-events: none; cursor: default; color: grey;" @endif
                                       href="{{ route('batch-test', [$batchTopic->courseTopic->slug, $batch->slug, $exam->id, $exam->exam_type]) }}"
                                       class="reduce_padding fw-800 @if ((!$disabled2 && $exam->exam_type == "Topic End Exam" && !$exam->has_been_attempted) || (!$disabled2 && $exam->exam_type == 'Pop Quiz' && !$exam->has_been_attempted)) modal-items-next @elseif (!$disabled2) modal-items @else modal-items-disabled @endif text-white d-flex justify-content-center rounded ml-5 p-1">
                                       <span data-tooltip="{{ $exam->title }}" class="top tooltip_center"> {{ Str::limit($exam->title, 23, '...') }} </span>
                                    </a>
                                    <div class="w-25">

                                       @if ((!$disabled2 && $exam->exam_type == "Topic End Exam" && !$exam->has_been_attempted) || (!$disabled2 && $exam->exam_type == 'Pop Quiz' && !$exam->has_been_attempted))
                                          <div style="height:50px;"></div>
                                       @elseif (!$disabled2)
                                          <img src="/img/road_map/rightSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid" id="aptitute-test">
                                       @else
                                          <div style="height:50px;"></div>
                                       @endif

                                       {{-- @if($disabled2)
                                          <img src="/img/road_map/wrongSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid">
                                       @else
                                          <img src="/img/road_map/rightSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid" id="aptitute-test">
                                       @endif --}}
                                    </div>
                                 @endif
                                 @php
                                    // set previous island TEE passed to false if not passed. WIll generate modal based on that.

                                    if($exam->exam_type == "Topic End Exam" && $exam->test_passed == false && !$batchTopic->previous_topic_end_exam_attempts_unlocked){
                                       $previous_island_topic_end_exam_passed = false;
                                    }

                                    // keep count of previous island TEE attempted. Lock or unlock next island based on that
                                    // if($exam->exam_type == "Topic End Exam" && $exam->exam_attempts->count() > 0){
                                    //    $previous_island_topic_end_exam_attempts = $exam->exam_attempts[0]->attempts;
                                    // }

                                    if ($exam->exam_type == "Aptitude Test" && !$exam->has_been_attempted) {
                                       $disabled = true;
                                       $disabled2 = true;
                                    } elseif ($exam->exam_type == "Aptitude Test" && !$disabled && !$exam->test_passed) $disabled = true;
                                    elseif (!$disabled2 && $exam->exam_type == "Topic End Exam" && (!$exam->test_passed && (count($exam->exam_attempts) == 0 || $exam->exam_attempts[0]->unlocked == false))) $disabled2 = true;
                                    elseif ($disabled && !$disabled2 && (($exam->exam_type == 'Aptitude Test' && !$exam->test_passed) || ($exam->exam_type == 'Topic End Exam' && (!$exam->test_passed && (count($exam->exam_attempts) == 0 || $exam->exam_attempts[0]->unlocked == false))) || ($exam->exam_type == 'Pop Quiz' && !$exam->has_been_attempted))) $disabled2 = true;
                                 @endphp
                              </li>

                           @empty
                              <h3 class="flex text-center pr-5">No exams found. Please contact administrators.</h3>
                           @endforelse

                        </ul>
                     {{-- @else
                        <h3 class="flex text-center pr-5">You have already attempted the topic end exam 3 times. Please contact administrators to unlock the next module.</h3>
                     @endif --}}
                  </div>
                  {{-- <div class="modal-footer mx-auto">
                     <a class="close" data-dismiss="modal" aria-label="Close"> <img src="/img/road_map/back.png" alt="modal closing button" class="img-fluid" id="roadmap-modal-close-btn"></a>
                  </div> --}}
               </div>
            </div>
         </div>
      @endif

   @endforeach

   {{-- @php
      $disabled = false; // Last Aptitude exam passed
      $disabled2 = true; // last Aptitude exam attempted
      $disabled3 = true; // Last Lecture/Other Exam completed
      $disabled4 = true; // Last TEE completed
   @endphp
   @forelse ($batchTopics as $batchTopic)
      <div class="modal fade" id="courseTopicModal-{{ $batchTopic->courseTopic->id }}" tabindex="-1" role="dialog" aria-labelledby="courseTopicModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header border">
                  <h5 class="modal-title mx-auto fw-800" id="exampleModalLabel"> Exams for {{ $batchTopic->courseTopic->title }}</h5>
                  </button>
               </div> 
               <div class="modal-body">
                  <ul>
                     @forelse ($batchTopic->courseTopic->exams as $exam)
                        @if (count($exam->course_lectures))
                           @foreach ($exam->course_lectures as $course_lecture)
                              <li>
                                 <div class="w-25">
                                    @if($disabled || ($disabled2 && $disabled3 && $disabled4))
                                       <img src="/img/road_map/rightSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid">
                                    @else
                                       <img src="/img/road_map/wrongSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid">
                                    @endif
                                 </div>
                                 <a
                                    @if(!($disabled || ($disabled2 && $disabled3 && $disabled4))) style="pointer-events: none; cursor: default; color: grey;" @endif
                                    href="{{ route('topic_lecture', [$batch->slug, $course_lecture->slug]) }}"
                                    class="fw-800 modal-items text-white d-flex justify-content-center rounded">
                                    {{ Str::limit($course_lecture->title, 23, '...') }}
                                 </a>
                                 @php
                                    if($course_lecture->completed == false){
                                       $disabled3 = false;
                                    }
                                 @endphp
                              </li>
                           @endforeach
                        @endif

                        <li>
                           <div class="w-25">
                              @if($disabled || ($disabled2 && $disabled3 && $disabled4))
                                 <img src="/img/road_map/rightSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid" id="aptitute-test">
                              @else
                                 <img src="/img/road_map/wrongSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid">
                              @endif
                           </div>
                           <a @if(!($disabled || ($disabled2 && $disabled3 && $disabled4))) style="pointer-events: none; cursor: default; color: grey;" @endif
                              href="{{ route('batch-test', [$batchTopic->courseTopic->slug, $batch->slug, $exam->id, $exam->exam_type]) }}"
                              class="fw-800 modal-items text-white d-flex justify-content-center rounded">
                              {{ Str::limit($exam->title, 23, '...') }}
                           </a>
                           @php
                              if($exam->exam_type == "Aptitude Test"){
                                 if($exam->previous_aptitude_test_passed == false){
                                    $disabled1 = false;
                                 }
                                 if($exam->has_been_attempted == false){
                                    $disabled2 = false;
                                 }
                              }
                              elseif($exam->exam_type == "Pop Quiz"){
                                 if($exam->test_passed == false){
                                    $disabled3 = false;
                                 }
                              }
                              elseif($exam->exam_type == "Topic End Exam") {
                                 if($exam->previous_topic_end_exam_passed == false){
                                    $disabled4 = false;
                                 }
                              }
                           @endphp
                        </li>
                     @empty
                        <h3 class="flex text-center pr-5">No exams found. Please contact administrators.</h3>
                     @endforelse

                  </ul>
               </div>
               <div class="modal-footer mx-auto">
                  <a class="close" data-dismiss="modal" aria-label="Close"> <img src="/img/road_map/back.png" alt="modal closing button" class="img-fluid" id="roadmap-modal-close-btn"></a>
               </div>
            </div>
         </div>
      </div>
   @empty
   @endforelse --}}

   
   {{-- modal part ends  --}}
   {{-- script part --}}

   {{-- <script src="{{ asset('/js/roadmap.js') }}"></script> --}}
   <script>

      let allLands = @json($batchTopics);

      let landCounter = 0;

      let totalLands = '{{ $batchTopics->count() }}';

      let landsParentDiv = document.getElementById("ilandsParentContainer");

      let ilandImages = @json($island_images);

      let ilandImageDisabled = @json($island_images_disabled);

      while(totalLands){
         // onStream design
         for(let i = 0; i  <5; i++){
            for(let j = 0; j < 5; j++){
               if(i===j){
                  if(j%2==0){
                     let div = document.createElement("div");
                     div.classList.add("px-lg-5","px-sm-0");
                     // Iland image part 
                     let divIland = document.createElement("div");
                     if(ilandImageDisabled[landCounter])
                        divIland.innerHTML = `<span data-tooltip="Please go through the previous content to unlock this island" class="top tooltip_center"> <img src="${ilandImages[landCounter]}" alt="Iland image" class="img-fluid"> </span>`;
                     else
                        divIland.innerHTML = `<img src="${ilandImages[landCounter]}" alt="Iland image" class="img-fluid" style="cursor: pointer;">`;
                     // modal part
                     divIland.setAttribute("data-toggle","modal");
                     divIland.setAttribute("data-target", "#courseTopicModal-" + allLands[landCounter].course_topic.id);
                     div.appendChild(divIland);
                     // Iland down star's part 
                     let divstars = document.createElement("div");
                     divstars.classList.add("row","row-cols-3","w-md-75","mx-auto","w-sm-100");
                     divstars.innerHTML = ``;
                     // <img src="/img/road_map/starFill.png" alt="Iland image" class="img-fluid">
                     // <img src="/img/road_map/starFill.png" alt="Iland image" class="img-fluid">
                     // <img src="/img/road_map/starFill.png" alt="Iland image" class="img-fluid">
                     div.appendChild(divstars);
                     landsParentDiv.appendChild(div);
                     if(landCounter == ilandImages.length){
                        landCounter = 0;
                     }
                     else{
                        landCounter++;
                     }
                     totalLands--;
                  }
                  else{
                     if(j % 3 !== 0) {
                        let div = document.createElement("div");
                        div.innerHTML  = `<img src="/img/road_map/onStreamStair.png" alt="Stair image" class="img-fluid onStreamStair">`;
                        div.classList.add("px-lg-5","w-lg-50","px-sm-0","w-sm-100");
                        landsParentDiv.appendChild(div);
                     }
                     else{
                        let div = document.createElement("div");
                        div.innerHTML  = `<img src="/img/road_map/onStreamStair.png" alt="Stair image" class="img-fluid reverseStreamStair">`;
                        div.classList.add("px-lg-5","w-lg-50","px-sm-0","w-sm-100");
                        landsParentDiv.appendChild(div);
                     }
                  }
               }
               else{
                  let div = document.createElement("div");
                  div.innerText  = "0";
                  div.classList.add("invisible");
                  landsParentDiv.appendChild(div);
               }
               if(!totalLands){
                  break;
               }
            }
            if(!totalLands){
               break;
            }
         }
         // onStream design ends 
         
         // reverseStream design starts
         for(let i = 0; i < 5; i++){
            for(let j = 0; j < 5; j++){
               if((i+j)===(5-1)){
                  let div = document.createElement("div");
                  if((i===4) || (i===0)){
                     div.classList.add("invisible");
                     landsParentDiv.appendChild(div);
                  }
                  else{
                     if(i===j){
                        div.classList.add("px-lg-5","px-sm-0","mx-sm-0");
                        // Iland image part 
                        let divIland = document.createElement("div");
                        if(ilandImageDisabled[landCounter])
                           // divIland.innerHTML = `<img src="${ilandImages[landCounter]}" alt="Iland image" class="img-fluid" style="cursor: pointer;">`;
                           divIland.innerHTML = `<span data-tooltip="Please go through the previous content to unlock this island" class="top tooltip_center"> <img src="${ilandImages[landCounter]}" alt="Iland image" class="img-fluid"> </span>`;
                        else
                           divIland.innerHTML = `<img src="${ilandImages[landCounter]}" alt="Iland image" class="img-fluid" style="cursor: pointer;">`;
                        // modal part
                        divIland.setAttribute("data-toggle","modal");
                        divIland.setAttribute("data-target", "#courseTopicModal-" + allLands[landCounter].course_topic.id);
                        div.appendChild(divIland);
                        // Iland down star's part 
                        let divstars = document.createElement("div");
                        divstars.classList.add("row","row-cols-3","w-md-75","mx-auto","w-sm-100");
                        divstars.innerHTML = ``;
                        // <img src="/img/road_map/starFill.png" alt="Iland image" class="img-fluid">
                        // <img src="/img/road_map/starFill.png" alt="Iland image" class="img-fluid">
                        // <img src="/img/road_map/starFill.png" alt="Iland image" class="img-fluid">
                        div.appendChild(divstars);
                        landsParentDiv.appendChild(div);
                        if(landCounter == ilandImages.length){
                           landCounter = 0;
                        }
                        else{
                           landCounter++;
                        }
                        totalLands--;
                     }
                     else{
                        if(j % 3 !== 0){
                           div.innerHTML  = `<img src="/img/road_map/reverseStair.png" alt="Stair image" class="img-fluid reverseStreamStair" >`;
                           div.classList.add("px-lg-5","w-lg-50","px-sm-0","w-sm-100");
                           landsParentDiv.appendChild(div);
                        }
                        else{
                           div.innerHTML  = `<img src="/img/road_map/reverseStair.png" alt="Stair image" class="img-fluid onStreamStair" >`;
                           div.classList.add("px-lg-5","w-lg-50","px-sm-0","w-sm-100");
                           landsParentDiv.appendChild(div);
                        }
                     }
                  }
               }
               else{
                  let div = document.createElement("div");
                  div.innerText  = "0";
                  div.classList.add("invisible");
                  landsParentDiv.appendChild(div);
               }
               if(!totalLands){
                  break;
               }
            }
            if(!totalLands){
               break;
            }
         }
         // reverseStream design ends 
      }
   </script>
   {{-- script part ends  --}}

</x-landing-layout>