<x-landing-layout headerBg="white">
<div class="page-section ">
      {{--  @php 
            $total_marks = 0;
            $total_gain_marks = 0;
            foreach($detailsResult as $result){
                  $total_marks += 1;
                  $total_gain_marks += $result->gain_marks;
            }
         @endphp --}}
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

            {{-- <div class="bg-light-gray">
               <div class="container">
                     <div class="py-5 ">
                        <h1 class="display-5 text-sm text-dark max-w-38 mx-auto fw-600" style="text-align: center">Your submitted answer is being reviewed. Please wait</h1>
                     </div>
               </div>
            </div> --}}
         </div>

         <div class="container">
            @if(session('exam_exists_message'))
               <div class="alert alert-danger mt-3 text-center">
                  <h1> {{ session('exam_exists_message') }} </h1>
               </div>
            @endif

            <h2 class="text-purple text-lg text-center mt-4">Result Sheet</h2>
            <p class="text-center text-sm">Total Marks : <b>{{ ($mcq_marks_scored + $cq_marks_scored) ." out of ". ($mcq_total_marks + $cq_total_marks) }}</b></p>
            <div class="text-right">
                  <a class="btn text-xxsm text-white bg-purple fw-800 px-2 py-2 w-20 mb-3" href="{{route('batch-lecture', $batch->slug)}}">Go to other exams <i class="fas fa-angle-double-right"> </i></a>
            </div>

            {{-- @php
               $total_marks = 0;
               $total_gain_marks = 0;
               foreach($detailsResult as $result){
                     $total_marks += $result->cqQuestion->marks;
                     $total_gain_marks += $result->gain_marks;
               }
            @endphp --}}

            <div class="result-sheet-table overflow-x-scroll">
               @if($mcqs_exist)
                  <div class="">
                     <p class="text-center text-sm">MCQ Marks : <b>{{$mcq_marks_scored." out of ".$mcq_total_marks}}</b></p>
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                                 <th class="bg-purple text-white">Sl</th>
                                 <th class="bg-purple text-white">Question</th>
                                 <th class="bg-purple text-white">Your Answer</th>
                                 <th class="bg-purple text-white">Correct Answer</th>
                                 <th class="bg-purple text-white">Explanation</th>
                                 <th class="bg-purple text-white">% got it right</th>
                           </tr>
                        </thead>
                        <tbody>
                           {{-- @php $n = 1; @endphp
                           @foreach($detailsResult as $result)
                           @php
                                 if ($result->exam_type == 'Aptitude Test') {
                                    $result->question = $result->atQuestion;
                                 }
                                 
                                 $field = 'field'.$result->mcq_ans;
                                 $cfield = 'field'.$result->question->answer;
                                 $cellcolor = $result->mcq_ans == $result->question->answer ? 'bg-green' : 'bg-red';
                           @endphp --}}
                           @foreach ($mcq_details_results as $key => $mcq_details_result)
                              <tr>
                                 <td class="@if($mcq_details_result->gain_marks) bg-green @else bg-red @endif">{{ $key }}</td>
                                 <td class="@if($mcq_details_result->gain_marks) bg-green @else bg-red @endif">{!! $mcq_details_result->topicEndExamMCQ->question !!}</td>
                                 <td class="@if($mcq_details_result->gain_marks) bg-green @else bg-red @endif">{{ $mcq_details_result->mcq_ans }}</td>
                                 <td class="@if($mcq_details_result->gain_marks) bg-green @else bg-red @endif">{!! $mcq_details_result->topicEndExamMCQ->answer !!}</td>
                                 <td class="@if($mcq_details_result->gain_marks) bg-green @else bg-red @endif">{{ $mcq_details_result->topicEndExamMCQ->explanation }}</td>
                                 <td class="@if($mcq_details_result->gain_marks) bg-green @else bg-red @endif">{{ $mcq_details_result->success_percent }}%</td>
                                 {{-- <td class="br-purple2">{{number_format(($result->question->gain_marks * 100 )/ $result->question->number_of_attempt, 2)}}%</td> --}}
                              </tr>
                           @endforeach
                           {{-- @php $n++; @endphp
                           @endforeach --}}
                        </tbody>
                     </table>
                  </div>
               @endif


               @if($cqs_exist)
                  <div class="mt-5">
                     <p class="text-center text-sm mt-3">CQ Marks : <b>{{$cq_marks_scored." out of ".$cq_total_marks}}</b></p>
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                                 <th class="bg-purple text-white text-center">Stem</th>
                                 <th class="bg-purple text-white text-center">Question</th>
                                 <th class="bg-purple text-white text-center">Ave<br/> Score</th>
                                 <th class="bg-purple text-white text-center">Your Answer</th>
                                 <th class="bg-purple text-white text-center">Correct Answer</th>
                           </tr>
                        </thead>
                        <tbody>
                           {{-- @php $n = 1; @endphp
                           @foreach($detailsResult as $result)
                           @php
                                 
                                 $cellcolor = "bg-purple2";
                                 if ($n == 1) $creative = $result->cqQuestion->creativeQuestion->creative_question;
                                 $avg = 0;
                                 
                                 if (!empty($result->question) && $result->question->gain_marks > 0) {
                                    $avg = number_format(($result->question->gain_marks * 100 )/ $result->question->number_of_attempt, 2);
                                 }
                                 
                           @endphp --}}
                           {{-- <tr> --}}
                                 {{-- @if ($n==1 || $creative != $result->cqQuestion->creativeQuestion->creative_question)
                                 <td rowSpan="4" class="{{$cellcolor}} text-white">{!! $result->cqQuestion->creativeQuestion->creative_question !!}</td>
                                 @php $cretive = $result->cqQuestion->creativeQuestion->creative_question; @endphp
                                 @endif
                                 <td class="{{$cellcolor}} text-white">{!! $result->cqQuestion->question !!}</td>
                                 <td class="{{$cellcolor}} text-white text-sm fw-600 bshadow">{{$avg}}%</td>
                                 @if ($n==1)
                                 <td rowSpan="4" class="{{$cellcolor}} v-align-middle">
                                    <a href="" class="btn text-xxsm text-white bg-purple px-3 py-2 " data-toggle="modal" data-target="#yourAnswerModal">View Pdf</a>
                                 </td>
                                 <td rowSpan="4" class="{{$cellcolor}} v-align-middle">
                                    <a href="" class="btn text-xxsm text-white bg-purple px-4 py-2 " data-toggle="modal" data-target="#correctAnswerModal">View Pdf</a>
                                 </td>
                                 @endif --}}
                           {{-- </tr> --}}
                           {{-- @php 
                                 $n++; 
                                 if ($n == 5) {
                                    $n = 1;
                                 }
                           @endphp --}}
                           {{-- @endforeach --}}



                           {{-- <td rowspan="4" class="bg-purple2 text-white">{{ $exam->title }}</td> --}}

                           {{-- <tr>
                              {!! $result->cqQuestion->creativeQuestion->creative_question !!}
                              @foreach ($exam->topicEndExamCreativeQuestion as $creative_question)
                                 {!! $result->cqQuestion->question !!}
                                 <td rowspan="4" class="bg-purple2 text-white">{{ $creative_question->creative_question }}</td>
                                 @foreach ($creative_question->question as $cq)
                                    <td class="bg-purple2 text-white">{{ $cq->question }}</td>
                                 @endforeach
                              @endforeach
                           </tr> --}}

                           @foreach ($exam->topicEndExamCreativeQuestions as $key => $creative_question)
                              @foreach ($creative_question->question as $key2 => $question)
                                 <tr>
                                    @if ($key2 == 0)
                                       <td rowspan="4" class="bg-purple2 text-white">{!! $creative_question->creative_question !!}</td>
                                    @endif

                                    <td class="bg-purple2 text-white">{!! $question->question !!}</td>
                                    <td class="text-center bg-purple2 text-white text-sm fw-600 bshadow">
                                       {{ $question->avg_score }}
                                    </td>
                                    
                                    @if ($key2 == 0)
                                       <td rowspan="4" class="text-center bg-purple2 v-align-middle">
                                          <a href="" class="btn text-xxsm text-white bg-purple px-3 py-2 " data-toggle="modal" data-target="#yourAnswerModal">View Answer</a>
                                       </td>
                                       <td rowspan="4" class="text-center bg-purple2 v-align-middle">
                                          <a href="" class="btn text-xxsm text-white bg-purple px-4 py-2 " data-toggle="modal" data-target="#correctAnswerModal">View Pdf</a>
                                       </td>

                                       <div class="modal fade" id="yourAnswerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-lg" role="document">
                                             <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Your Answer</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                   @if ($creative_question->exam_papers->submitted_text != null)
                                                      <textarea name="" id="" cols="30" rows="10">{!! $creative_question->exam_papers->submitted_text !!}</textarea>
                                                   @endif
                                                   @if ($creative_question->exam_papers->submitted_pdf != null)
                                                      <iframe src="{{ Storage::url($creative_question->exam_paper->submitted_pdf) }}" frameborder="0" width="100%" height="600px"></iframe>
                                                   @endif
                                             </div>
                                             </div>
                                          </div>
                                       </div>
                     
                                       <div class="modal fade" id="correctAnswerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-lg" role="document">
                                             <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Correct Answer</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                   @if ( $creative_question->standard_ans_pdf != null)
                                                      <iframe src="{{ Storage::url($creative_question->standard_ans_pdf) }}" frameborder="0"
                                                         width="100%" height="600px"></iframe>
                                                   @endif
                                             </div>
                                             </div>
                                          </div>
                                       </div>


                                    @endif
                                 </tr>
                              @endforeach
                           @endforeach


                        </tbody>
                     </table>
                  </div>
               @endif
            </div>
         </div>

      
</div>
</x-landing-layout>

