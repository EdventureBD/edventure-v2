<x-landing-layout headerBg="white">
   <div class="page-section course-info bg-gradient-purple py-5">
         <div class="container">
            <div class="row">
               <div class="col-md-7">
                     <h2 class="text-white fw-800">Batch: {{ $batch->title }}</h2>
                     <p class="text-white">{{ $course->description }}</p>
               </div>
               <div class="col-md-5">
                     
                     <p class="text-xsm text-white font-weight-light m-0">
                        Your batch days running : {{ $batch->batch_running_days }} days <br>
                        You have bought : {{ $accessedDays->accessed_days }} days <br>
                        Days remaining :
                        @php
                           echo $accessedDays->accessed_days - $batch->batch_running_days . ' days';
                        @endphp
                     </p>
               </div>
            </div>
         </div>
   </div>

   <div class="border-bottom-2 py-5">
         <div class="container page__container max-w-50 w-100">
            @if(session()->has('payment_success'))
               <div class="alert alert-info text-center ">
                     <p class="mb-0 text-xxsm">{{session()->get('payment_success')}}</p>
               </div>
            @endif

            {{-- <div class="page-separator mt-5">
               <div class="page-separator__text bg-purple-light text-center bradius-10 py-3 d-inline-block w-100 text-gray text-sm"><span class="fw-700">Solution Of The Exams</span>
                     <p class="text-gray text-xxsm fw-200 lh-1">Solution videos and PDFs will appear here after everyone has completed all the exams</p></div>
            </div> --}}
            <div class="row">
               <div class="col-lg-12">
                  <div class="row">
                     @forelse ($batchTopics as $batchTopic)
                        <div class="card col-4 mx-2" data-toggle="modal" data-target="#courseTopicModal-{{ $batchTopic->id }}">
                           <img class="card-img-top" src="https://picsum.photos/seed/{{ rand(1,100) }}/200/200" alt="Card image cap">
                           <div class="card-body">
                              <p class="card-text"> {{ $batchTopic->courseTopic->title }} </p>
                           </div>
                        </div>

                        <div class="modal fade" id="courseTopicModal-{{ $batchTopic->id }}" tabindex="-1" role="dialog" aria-labelledby="courseTopicModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                 <h5 class="modal-title" id="courseTopicModalLabel"> {{ $batchTopic->courseTopic->title }} </h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                                 </div>
                                 <div class="modal-body">
                                    <h3 class="mt-3">Exams {{$batch->slug}}</h3>
                                    <ol>
                                       <li>
                                          <a href="{{ route('batch-test', [$batchTopic->courseTopic->slug, $batch->slug, "Aptitude Test"]) }}"> Aptitude Test </a>
                                       </li>
                                       <li>
                                          <a href=""> Lecture View </a>
                                       </li>
                                       <li>
                                          <a href="{{ route('batch-test', [$batchTopic->courseTopic->slug, $batch->slug, "Pop Quiz"]) }}"> Pop Quiz </a>
                                       </li>
                                       <li>
                                          <a href=""> Lecture Content </a>
                                       </li>
                                       <li>
                                          <a href="{{ route('batch-test', [$batchTopic->courseTopic->slug, $batch->slug, "Topic End Exam"]) }}"> Topic End Exam </a>
                                       </li>
                                    </ol>
                                    {{-- @foreach ($exams as $key=>$exam)
                                       <p>{{ $loop->iteration }}. {{$key}}</p>
                                    @endforeach
                                    <h3 class="mt-4">Special Exams</h3>
                                    @foreach ($specialExams as $key=>$spExam)
                                       <p>{{ $loop->iteration }}. {{$key}}</p>
                                    @endforeach --}}
                                 </div>
                                 <div class="modal-footer">
                                 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     @empty
                        <h1 class="flex">No exams found </h1>
                     @endforelse
                  </div>
                     {{-- <div class="accordion js-accordion accordion--boxed list-group-flush" id="parent">
                        @forelse ($batchTopics as $batchTopic)
                           <div class="accordion__item {{ $loop->iteration == 1 ? 'open' : '' }}  ">
                                 <div class="row no-gutters accordion__toggle bg-light-gray mt-3 py-2 px-3 bradius-15 bshadow text-dark fw-600" data-toggle="collapse" data-target="#course-toc-{{ $batchTopic->id }} " data-parent="#parent">
                                    <div class="col-11 d-inline-flex title align-items-center">
                                       <span class="">{{ $batchTopic->courseTopic->title }} </span>
                                    </div>
                                    <div class="col-1 text-right">
                                       <span class="d-inline-block text-gray text-sm">
                                             <span class="arrow-up text-gray"><i class="fas fa-angle-up"></i></span>
                                             <span class="arrow-down text-gray"><i class="fas fa-angle-down"></i></span>
                                       </span>
                                    </div>
                                 </div>
                                 <div class="accordion__menu collapse {{ $loop->iteration == 1 ? 'show' : '' }} "
                                    id="course-toc-{{ $batchTopic->id }}"> --}}
                                    {{-- @livewire('student.batch.lectures', ['batchTopic' => $batchTopic->id, 'batch' =>
                                    $batch], key($batchTopic->id)) --}}
                                    {{-- <div>
                                       @forelse($batchTopic->courseTopic->CourseLecture as $courseLecture)
                                             <div class="accordion__menu-link d-flex justify-content-between align-items-center bg-light-gray mt-3 py-2 px-3 bradius-15 bshadow text-dark fw-600">
                                                <a class="flex text-dark fw-600" href="">
                                                   {{ $courseLecture->title }}
                                                </a>
                                                <a href="{{ route('topic_lecture', [$batch->slug, $courseLecture->slug]) }}" class="d-inline-block text-dark ml-4 bg-light-gray bradius-15 bshadow px-2 fw-600 py-1">View Lecture</a>
                                             </div>
                                       @empty
                                             <div class="accordion__menu-link">
                                                <span class="icon-holder icon-holder--small icon-holder--dark rounded-circle d-inline-flex icon--left">
                                                   <i class="fad fa-empty-set"></i>
                                                </span>
                                                <a class="flex" href="#">No lectures found </a>
                                             </div>
                                       @endforelse
                                       <p class="h6 pt-3" style="text-align: center;">Exams or Assignment</p>
                                       @forelse($exams as $exam)
                                             @php
                                             $view_result = "View Result";
                                                if ($exam->canAttemp && $exam->exam->exam_type == 'Assignment') {
                                                   $view_result = "Submit Assignment";
                                                } else if ($exam->canAttemp){
                                                   $view_result = "Start Exam";
                                                }
                                             @endphp
                                             @if ($exam->exam->topic_id == $batchTopic->topic_id)
                                             <div class="accordion__menu-link d-flex justify-content-between align-items-center bg-light-gray mt-3 py-2 px-3 bradius-15 bshadow text-dark fw-600">
                                                <a class="flex text-dark" href="#">
                                                   {{ $exam->exam->title }}
                                                </a>
                                                <div>
                                                   <span class="text-dark bg-light-gray bradius-15 bshadow px-2 fw-600 py-1">{{ $exam->exam->exam_type }}</span>
                                                   <a href="{{ route('question', [$batch->slug, $exam->exam->slug]) }}" class="d-inline-block text-dark ml-4 bg-light-gray bradius-15 bshadow px-2 fw-600 py-1">{{$view_result}}</a>
                                                </div>
                                             </div>
                                             @endif
                                       @empty
                                             <div class="accordion__menu-link">
                                                <span class="icon-holder icon-holder--small icon-holder--dark rounded-circle d-inline-flex icon--left">
                                                   <i class="fad fa-empty-set"></i>
                                                </span>
                                                <a class="flex" href="#">No exams found </a>
                                             </div>
                                       @endforelse
                                    </div>
                                 </div>
                           </div>
                        @empty
                           No Topics found
                        @endforelse
                     </div> --}}
               </div>
            </div>
         </div>
   </div>
</x-landing-layout>


