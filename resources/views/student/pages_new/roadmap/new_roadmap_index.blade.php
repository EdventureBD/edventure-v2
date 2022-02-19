<x-landing-layout headerBg="white">
   {{-- css linked --}}
   <link rel="stylesheet" href="{{ asset('/css/roadmap.css') }}">
   {{-- css linked part ends  --}}
   <div class="d-flex flex-column position-relative pb-5" id="roadmapParentContainer">
      <div class="d-flex fixed-top" id="roadmap-nav">
         <div class="my-auto pl-3">
            <a href="{{route("home")}}"> <img src="/img/road_map/back.png" alt="getting back button" class="img-fluid" id="roadmap-back-btn"></a>
         </div>
         <div class="my-auto pr-5 mx-auto">
            <h1 class="fw-800" id="roadmap-subject-topic-name">Physics</h1>
         </div>
      </div>
      <div class="d-flex justify-content-center container mt-5 pt-4" id="ilandGrandParentContainer">
         <div class="row row-cols-md-5 row-cols-sm-1 mx-md-0 mt-lg-0 pt-lg-0 pt-sm-3 mt-sm-3" id="ilandsParentContainer">
            
         </div>
      </div>
   </div>

   {{-- Modal part --}}
   {{-- data-toggle="modal" data-target="#exampleModal" --}}
   <!-- Modal -->
   @php $disabled = false; @endphp
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
                                    @if($disabled)
                                       <img src="/img/road_map/wrongSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid">
                                    @else
                                       <img src="/img/road_map/rightSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid">
                                    @endif
                                 </div>
                                 <a
                                    href="{{ route('topic_lecture', [$batch->slug, $course_lecture->slug]) }}"
                                    class="fw-800 modal-items text-white d-flex justify-content-center rounded">
                                    {{ Str::limit($course_lecture->title, 23, '...') }}
                                 </a>
                              </li>
                              @php if (!$disabled && !$course_lecture->completed) $disabled = true; @endphp
                           @endforeach
                        @endif

                        <li>
                           @if($exam->exam_type == "Aptitude Test")
                              <div class="w-25">
                                 @if($disabled)
                                    <img src="/img/road_map/wrongSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid">
                                 @else
                                    <img src="/img/road_map/rightSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid" id="aptitute-test">
                                 @endif
                              </div>
                              <a 
                                 href="{{ route('batch-test', [$batchTopic->courseTopic->slug, $batch->slug, $exam->id, $exam->exam_type]) }}"
                                 class="fw-800 modal-items text-white d-flex justify-content-center rounded">
                                 {{ Str::limit($exam->title, 23, '...') }}
                              </a>
                           @else
                              <div class="w-25">
                                 @if($disabled)
                                    <img src="/img/road_map/wrongSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid">
                                 @else
                                    <img src="/img/road_map/rightSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid" id="aptitute-test">
                                 @endif
                              </div>
                              <a
                                 @if($disabled || !($exam->test_passed || $exam->lecture_count == 0 || $exam->lecture_count == $exam->completed_lecture_count)) style="pointer-events: none; cursor: default; color: grey;" @endif
                                 href="{{ route('batch-test', [$batchTopic->courseTopic->slug, $batch->slug, $exam->id, $exam->exam_type]) }}"
                                 class="fw-800 modal-items text-white d-flex justify-content-center rounded">
                                 {{ Str::limit($exam->title, 23, '...') }}
                              </a>
                           @endif
                           @php if (!$disabled && !$exam->test_passed) $disabled = true; @endphp
                        </li>
                     @empty
                        <h3 class="flex text-center pr-5">No exams found. Please contact administrators.</h3>
                     @endforelse

                     {{-- <li>
                        <div class="w-25">
                              <img src="/img/road_map/rightSign.png" alt="" class=" px-md-4 px-sm-3 pt-md-2 img-fluid" id="model-test">
                        </div>
                        <a href="" class="fw-800 modal-items text-white d-flex justify-content-center rounded">Model Test</a>
                     </li>

                     <li>
                        <div class="w-25">
                           <img src="/img/road_map/rightSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid" id="aptitute-test">
                        </div>
                        <a href="" class="fw-800 modal-items text-white d-flex justify-content-center rounded">Aptitute Test</a>
                     </li>
                     <li>
                        <div class="w-25">
                           <img src="/img/road_map/wrongSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid" id="mcq-test">
                        </div>
                        <a href="" class="fw-800 modal-items text-white d-flex justify-content-center rounded">MCQ Test</a>
                     </li>
                     <li>
                        <div class="w-25">
                           <img src="/img/road_map/rightSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid" id="cq-test">
                        </div>
                        <a href="" class="fw-800 modal-items text-white d-flex justify-content-center rounded" id="cq">CQ Test</a>
                     </li> --}}
                     
                  </ul>
               </div>
               <div class="modal-footer mx-auto">
                  <a class="close" data-dismiss="modal" aria-label="Close"> <img src="/img/road_map/back.png" alt="modal closing button" class="img-fluid" id="roadmap-modal-close-btn"></a>
               </div>
            </div>
         </div>
      </div>
   @empty
   @endforelse
   
   {{-- modal part ends  --}}
   {{-- script part --}}

   {{-- <script src="{{ asset('/js/roadmap.js') }}"></script> --}}

   <script>
      let allLands = JSON.parse(atob('{{ base64_encode(json_encode($batchTopics)) }}'));
      console.log(allLands);

      let landCounter = 0;
      // console.log(landCounter);

      let totalLands = '{{ $batchTopics->count() }}';
      console.log("Land Count", totalLands);

      // console.log(allLands[0].course_topic.id);

      let landsParentDiv = document.getElementById("ilandsParentContainer");
      // let ilandImages = [  "{{ asset('/img/road_map/landl1.png') }}",
      //                      "{{ asset('/img/road_map/landr4.png') }}",
      //                      "{{ asset('/img/road_map/Frame 46.png') }}", 
      //                      "{{ asset('/img/road_map/landl5.png') }}",
      //                      "{{ asset('/img/road_map/landl6.png') }}",
      //                      "{{ asset('/img/road_map/landl2.png') }}",
      //                   ];

      let ilandImages = JSON.parse(atob('{{ base64_encode(json_encode($island_images)) }}'));
      // console.log(ilandImages);

      // let totalLands = ilandImages.length;
      // console.log("Land Count", totalLands);
      // let ilandImageIndex = 0;

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
                     divIland.innerHTML = `<img src="${ilandImages[landCounter]}" alt="Iland image" class="img-fluid">`;
                     // modal part 
                     divIland.setAttribute("data-toggle","modal");
                     divIland.setAttribute("data-target", "#courseTopicModal-" + allLands[landCounter].course_topic.id);
                     div.appendChild(divIland);
                     // Iland down star's part 
                     let divstars = document.createElement("div");
                     divstars.classList.add("row","row-cols-3","w-md-75","mx-auto","w-sm-100");
                     divstars.innerHTML = `<img src="/img/road_map/starFill.png" alt="Iland image" class="img-fluid">
                     <img src="/img/road_map/starFill.png" alt="Iland image" class="img-fluid">
                     <img src="/img/road_map/starFill.png" alt="Iland image" class="img-fluid">
                     `;
                     div.appendChild(divstars);
                     landsParentDiv.appendChild(div);
                     // console.log("henlo", ilandImageIndex);
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
                        divIland.innerHTML = `<img src="${ilandImages[landCounter]}" alt="Iland image" class="img-fluid">`;
                        // modal part 
                        divIland.setAttribute("data-toggle","modal");
                        divIland.setAttribute("data-target", "#courseTopicModal-" + allLands[landCounter].course_topic.id);
                        div.appendChild(divIland);
                        // Iland down star's part 
                        let divstars = document.createElement("div");
                        divstars.classList.add("row","row-cols-3","w-md-75","mx-auto","w-sm-100");
                        divstars.innerHTML = `<img src="/img/road_map/starFill.png" alt="Iland image" class="img-fluid">
                        <img src="/img/road_map/starFill.png" alt="Iland image" class="img-fluid">
                        <img src="/img/road_map/starFill.png" alt="Iland image" class="img-fluid">
                        `;
                        div.appendChild(divstars);
                        landsParentDiv.appendChild(div);
                        // ilandImageIndex++;
                        // console.log("henlo", ilandImageIndex);
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