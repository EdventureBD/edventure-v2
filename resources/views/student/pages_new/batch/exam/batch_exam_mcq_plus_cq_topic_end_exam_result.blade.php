<x-landing-layout headerBg="white">
   <link rel="stylesheet" href="/css/tooltip.css">
   <style>
      .table td.fit,
      .table th.fit {
          white-space: nowrap;
          width: 1%;
          background-color: #6400c8
      }
      thead tr td {
          font-weight: 800;
      }
  </style>
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

         <div class="mx-md-5">
            {{-- @if(session('exam_exists_message'))
               <div class="alert alert-danger mt-3 text-center">
                  <h1> {{ session('exam_exists_message') }} </h1>
               </div>
            @endif --}}

            @error('not_authorized')
               <div class="alert alert-danger mt-3 text-center">
                  <h1> {{ $message }} </h1>
               </div>
            @enderror

            <h4 class="text-left fw-800 mt-4">Total Marks : {{ ($mcq_marks_scored + $cq_marks_scored) ." out of ". ($mcq_total_marks + $cq_total_marks) }}</h4>

            <div class="d-flex justify-content-left">
               <div class="text-right">
                  <a style="background-color: #6400c8" class="btn text-xxsm text-white fw-800 px-3 py-2 w-20 mb-3" href="{{route('batch-lecture', $batch->slug)}}"> Go Back to Journey <i class="fas fa-arrow-up ml-2"> </i></a>
               </div>
               @if( ($mcq_marks_scored + $cq_marks_scored) < $exam->threshold_marks )
                  @if( $topic_end_exam_attempt && $topic_end_exam_attempt->attempts < 3 )
                     <div class="text-right ml-2">
                        <a style="background-color: #6400c8" class="btn text-xxsm text-white fw-800 px-3 py-2 w-20 mb-3" href="{{route('reattempt-batch-test', [$course_topic->slug, $batch->slug, $exam->id, $exam->exam_type ] )}}"> Repeat Exam <i class="fas fa-sync ml-2"></i></a>
                     </div>
                  @endif
               @endif
            </div>

            @if( $topic_end_exam_attempt && $topic_end_exam_attempt->attempts >= 3 && $topic_end_exam_attempt->unlocked == false)
               <div class="alert alert-danger text-center">
                  <h1> Exam locked due to failing 3 attempts. Please contact system admin to unlock. </h1>
               </div>
            @endif

            <div class="result-sheet-table overflow-x-scroll">
               @if($mcqs_exist)
                  <div>
                     <h4 class="text-left fw-800 mt-4">MCQ Marks : {{$mcq_marks_scored." out of ".$mcq_total_marks}}</h4>
                     <table class="table table-responsive table-striped table-bordered max-w-100">
                        <thead>
                           <tr class="text-white text-center">
                                 <td class="fit">Sl</td>
                                 <td class="fit">Question</td>
                                 <td class="fit">Correct Answer</td>
                                 <td class="fit">Your Answer</td>
                                 <td class="fit">Explanation</td>
                                 <td class="fit">Success Rate 
                                    <span style="color: #fa9632"
                                          class=""
                                          data-toggle="tooltip"
                                          data-placement="auto"
                                          title="This value shows the percentage  of students who got this particular question right"><i class="fa fa-info-circle"></i>
                                    </span>
                                 </td>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($mcq_details_results as $key => $mcq_details_result)
                              <tr class="text-center">
                                 <td>{{ $key }}</td>
                                 <td>{!! $mcq_details_result->topicEndExamMCQ->question !!}</td>
                                 <td>{!! $mcq_details_result->topicEndExamMCQ->answer !!}</td>
                                 <td style="@if($mcq_details_result->gain_marks) background-color: #9DCA7B  @else background-color: #DD7575 @endif; color: black; font-weight: 600">{{ $mcq_details_result->mcq_ans }}</td>
                                 <td>{!! $mcq_details_result->topicEndExamMCQ->explanation !!}</td>
                                 <td>{{ $mcq_details_result->success_percent }}%</td>
                              </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               @endif

               @if($cqs_exist)
                  <div class="@if($mcqs_exist) mt-5 @endif">
                     <h4 class="text-left fw-800 mt-4">CQ Marks : {{$cq_marks_scored." out of ".$cq_total_marks}}</h4>
                     <table class="table table-responsive table-striped table-bordered max-w-100">
                        <thead>
                           <tr class="text-white text-center">
                                 <td class="fit">Stem</td>
                                 <td class="fit">Question</td>
                                 <td class="fit">Your Score</td>
                                 <td class="fit">Avg Score</td>
                                 <td class="fit">Your Answer</td>
                                 <td class="fit">Correct Answer</td>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($exam->topicEndExamCreativeQuestions as $key => $creative_question)
                              @foreach ($creative_question->question as $key2 => $question)
                                 @if ($creative_question->exam_papers)
                                    <tr class="text-center">
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
<script>
   $(function () {
       $('[data-toggle="tooltip"]').tooltip()
   })
</script>
