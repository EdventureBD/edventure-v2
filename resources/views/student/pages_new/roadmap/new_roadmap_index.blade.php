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
      <div class="modal fade" id="courseTopicModal-{{ $batchTopic->id }}" tabindex="-1" role="dialog" aria-labelledby="courseTopicModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header border">
                  <h3 class="mt-3"> Batch - {{$batch->title}} </h3>
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
                                    <img src="/img/road_map/wrongSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid" id="mcq-test">
                                 </div>
                                 <a
                                    @if ($disabled) style="pointer-events: none; cursor: default; color: grey;" @endif
                                    href="{{ route('topic_lecture', [$batch->slug, $course_lecture->slug]) }}"
                                    class="fw-800 modal-items text-white d-flex justify-content-center rounded">{{ $course_lecture->title }}</a>
                              </li>
                              @php if (!$disabled && !$course_lecture->completed) $disabled = true; @endphp
                           @endforeach
                        @endif

                        <li>
                           @if($exam->exam_type == "Aptitude Test")
                              <div class="w-25">
                                 <img src="/img/road_map/rightSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid" id="aptitute-test">
                              </div>
                              <a 
                                 @if ($disabled) style="pointer-events: none; cursor: default; color: grey;" @endif
                                 href="{{ route('batch-test', [$batchTopic->courseTopic->slug, $batch->slug, $exam->id, $exam->exam_type]) }}"
                                 class="fw-800 modal-items text-white d-flex justify-content-center rounded">
                                    {{ $exam->title }}
                              </a>
                           @else
                              <div class="w-25">
                                 <img src="/img/road_map/wrongSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid" id="mcq-test">
                              </div>
                              <a
                                 @if($disabled || !($exam->test_passed || $exam->lecture_count == 0 || $exam->lecture_count == $exam->completed_lecture_count)) style="pointer-events: none; cursor: default; color: grey;" @endif
                                 href="{{ route('batch-test', [$batchTopic->courseTopic->slug, $batch->slug, $exam->id, $exam->exam_type]) }}"
                                 class="fw-800 modal-items text-white d-flex justify-content-center rounded">
                                    {{ $exam->title }}
                              </a>
                           @endif
                           @php if (!$disabled && !$exam->test_passed) $disabled = true; @endphp
                        </li>
                     @empty
                        <h1 class="flex">No exams found </h1>
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
   <script src="{{ asset('/js/roadmap.js') }}">
   </script>
   {{-- script part ends  --}}
</x-landing-layout>