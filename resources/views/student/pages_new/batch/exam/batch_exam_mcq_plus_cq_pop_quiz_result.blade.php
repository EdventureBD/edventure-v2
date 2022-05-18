<x-landing-layout headerBg="white">
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
            @if(session('exam_exists_message'))
               <div class="alert alert-danger mt-3 text-center">
                  <h1> {{ session('exam_exists_message') }} </h1>
               </div>
            @endif

            <h2 class="text-purple text-lg text-center mt-4">Result Sheet</h2>
            <p class="text-center text-sm">Total Marks : <b>{{ ($mcq_marks_scored + $cq_marks_scored) ." out of ". ($mcq_total_marks + $cq_total_marks) }}</b></p>

            <div class="d-flex justify-content-between">
               <div class="d-flex justify-content-left">
                  <div class="text-right">
                     <a style="background-color: #6400c8" class="btn text-xxsm text-white fw-800 px-3 py-2 w-20 mb-3" href="{{route('batch-lecture', $batch->slug)}}"> Go Back <i class="fas fa-arrow-up ml-2"> </i></a>
                  </div>
                  @if( ($mcq_marks_scored + $cq_marks_scored) < $exam->threshold_marks )
                     <div class="text-right ml-2">
                        <a style="background-color: #6400c8" class="btn text-xxsm text-white fw-800 px-3 py-2 w-20 mb-3" href="{{route('reattempt-batch-test', [$course_topic->slug, $batch->slug, $exam->id, $exam->exam_type ] )}}"> Repeat Exam <i class="fas fa-sync ml-2"></i></a>
                     </div>
                  @endif
               </div>

               {{-- If next exam type is TEE generate a confirmation modal with button --}}
               @if(isset($next_exam_type_TEE) && $next_exam_type_TEE)
                  <button type="button" style="background-color: #6400c8" class="btn text-xxsm text-white fw-800 px-3 py-2 w-20 mb-3 mt-3 mx-1" data-toggle="modal" data-target="#exampleModalLong">  {{ $next_link_btn_text }} <i class="fas fa-angle-double-right ml-1"></i> </button>
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
                           <a href="{{ $next_link }}" style="background-color: #6400c8" class="btn text-xxsm text-white fw-800 px-3 py-2 w-20 mb-3 mx-1"> Continue <i class="fas fa-angle-double-right ml-1"></i></a>
                        </div>
                     </div>
                     </div>
                  </div>
               {{-- Else generate a normal btn --}}
               @else
                  @if(!empty($next_link)) <a href="{{ $next_link }}" style="background-color: #6400c8" class="btn text-xxsm text-white fw-800 px-3 py-2 w-20 mb-3 mx-1"> {{ $next_link_btn_text }} <i class="fas fa-angle-double-right ml-1"></i></a> @endif
               @endif

            </div>

            <div class="result-sheet-table overflow-x-scroll">
               @if($mcqs_exist)
                  <div class="">
                     <p class="text-center text-sm">MCQ Marks : <b>{{$mcq_marks_scored." out of ".$mcq_total_marks}}</b></p>
                     <table class="table table-responsive table-striped table-bordered max-w-100">
                        <thead>
                           <tr class="bg-purple text-white text-center">
                                 <th class="fit">Sl</th>
                                 <th class="fit">Question</th>
                                 <th class="fit">Correct Answer</th>
                                 <th class="fit">Your Answer</th>
                                 <th class="fit">Explanation</th>
                                 <th class="fit">Success Rate</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($mcq_details_results as $mcq_details_result)
                              <tr class="text-center">
                                 <td>{{ $loop->iteration }}</td>
                                 <td>{!! $mcq_details_result->popQuizMCQ->question !!}</td>
                                 <td>{!! $mcq_details_result->popQuizMCQ->answer !!}</td>
                                 <td style="@if($mcq_details_result->gain_marks) background-color: #9DCA7B @else background-color : #DD7575 @endif; color: black; font-weight: 600">{{ $mcq_details_result->mcq_ans }}</td>
                                 <td>{!! $mcq_details_result->popQuizMCQ->explanation !!}</td>
                                 <td>{{ $mcq_details_result->success_percent }}%</td>
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
                           <tr class="bg-purple text-white text-center">
                                 <th>Stem</th>
                                 <th>Question</th>
                                 <th>Your<br/> Score</th>
                                 <th>Ave<br/> Score</th>
                                 <th>Your Answer</th>
                                 <th>Correct Answer</th>
                           </tr>
                        </thead>
                        <tbody>

                           @foreach ($exam->popQuizCreativeQuestions as $key => $creative_question)
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

