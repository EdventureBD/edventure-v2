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
                     <p class="hero__lead measure-hero-lead text-white-50">Exam : {{ $exam->title }}</p>
               </div>
            </div>
         </div>

         <div class="container">
            @if(session('exam_exists_message'))
               <div class="alert alert-danger mt-3 text-center">
                  <h1> {{ session('exam_exists_message') }} </h1>
               </div>
            @endif

            @error('not_authorized')
               <div class="alert alert-danger mt-3 text-center">
                  <h1> {{ $message }} </h1>
               </div>
            @enderror

            <h2 class="text-purple text-lg text-center mt-4">Result Sheet</h2>
            <p class="text-center text-sm">Total Marks : <b>{{ ($mcq_marks_scored + $cq_marks_scored) ." out of ". ($mcq_total_marks + $cq_total_marks) }}</b></p>

            <div class="d-flex justify-content-left">
               <div class="text-right">
                  <a class="btn text-xxsm text-white bg-purple fw-800 px-3 py-2 w-20 mb-3" href="{{route('batch-lecture', $batch->slug)}}"> Go Back to Journey <i class="fas fa-arrow-up ml-2"> </i></a>
               </div>
               @if( ($mcq_marks_scored + $cq_marks_scored) < $exam->threshold_marks )
                  @if( $topic_end_exam_attempt && $topic_end_exam_attempt->unlocked )
                     <div class="text-right ml-2">
                        <a class="btn text-xxsm text-white bg-purple fw-800 px-3 py-2 w-20 mb-3" href="{{route('reattempt-batch-test', [$course_topic->slug, $batch->slug, $exam->id, $exam->exam_type ] )}}"> Repeat Exam <i class="fas fa-sync ml-2"></i></a>
                     </div>
                  @endif
               @endif
            </div>

            @if( $topic_end_exam_attempt && !$topic_end_exam_attempt->unlocked )
               <div class="alert alert-danger text-center">
                  <h1> Exam locked due to failing 3 attempts. Please contact system admin to unlock. </h1>
               </div>
            @endif

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
                           @foreach ($mcq_details_results as $key => $mcq_details_result)
                              <tr>
                                 <td class="@if($mcq_details_result->gain_marks) bg-green @else bg-red @endif">{{ $key }}</td>
                                 <td class="@if($mcq_details_result->gain_marks) bg-green @else bg-red @endif">{!! $mcq_details_result->topicEndExamMCQ->question !!}</td>
                                 <td class="@if($mcq_details_result->gain_marks) bg-green @else bg-red @endif">{{ $mcq_details_result->mcq_ans }}</td>
                                 <td class="@if($mcq_details_result->gain_marks) bg-green @else bg-red @endif">{!! $mcq_details_result->topicEndExamMCQ->answer !!}</td>
                                 <td class="@if($mcq_details_result->gain_marks) bg-green @else bg-red @endif">{!! $mcq_details_result->topicEndExamMCQ->explanation !!}</td>
                                 <td class="@if($mcq_details_result->gain_marks) bg-green @else bg-red @endif">{{ $mcq_details_result->success_percent }}%</td>
                              </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               @endif

               @if($cqs_exist)
                  <div class="@if($mcqs_exist) mt-5 @endif">
                     <p class="text-center text-sm mt-3">CQ Marks : <b>{{$cq_marks_scored." out of ".$cq_total_marks}}</b></p>
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                                 <th class="bg-purple text-white text-center">Stem</th>
                                 <th class="bg-purple text-white text-center">Question</th>
                                 <th class="bg-purple text-white text-center">Your<br/> Score</th>
                                 <th class="bg-purple text-white text-center">Ave<br/> Score</th>
                                 <th class="bg-purple text-white text-center">Your Answer</th>
                                 <th class="bg-purple text-white text-center">Correct Answer</th>
                           </tr>
                        </thead>
                        <tbody>

                           @foreach ($exam->topicEndExamCreativeQuestions as $key => $creative_question)
                              @foreach ($creative_question->question as $key2 => $question)
                                 @if ($creative_question->exam_papers)
                                    <tr>
                                       @if ($key2 == 0)
                                          <td rowspan="4" class="bg-purple2 text-white">{!! $creative_question->creative_question !!}</td>
                                       @endif

                                       <td class="bg-purple2 text-white">{!! $question->question !!}</td>
                                       <td class="text-center bg-purple2 text-white text-sm fw-600 bshadow">
                                          {{ $question->detailsResult->gain_marks }}
                                       </td>
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
                                                      @if ($creative_question->exam_papers->submitted_pdf != null && Storage::disk('local')->exists($creative_question->exam_papers->submitted_pdf))
                                                         <iframe src="{{ Storage::url($creative_question->exam_papers->submitted_pdf) }}" frameborder="0" width="100%" height="600px"></iframe>
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
                                                      @if ($creative_question->standard_ans_pdf != null && Storage::disk('local')->exists($creative_question->standard_ans_pdf))
                                                         <iframe src="{{ Storage::url($creative_question->standard_ans_pdf) }}" frameborder="0"
                                                            width="100%" height="600px"></iframe>
                                                      @endif
                                                </div>
                                                </div>
                                             </div>
                                          </div>

                                       @endif
                                    </tr>
                                 @endif
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

