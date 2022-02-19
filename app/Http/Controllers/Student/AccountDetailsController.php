<?php

namespace App\Http\Controllers\Student;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

// models
use App\Models\User;
use App\Models\Admin\Batch;
use App\Models\Admin\BatchStudentEnrollment;
use App\Models\Admin\Course;
use App\Models\Admin\CourseTopic;
use App\Models\Student\StudentDetails;

use App\Models\Student\exam\DetailsResult;
use App\Models\Student\exam\ExamResult;
use App\Models\Admin\ContentTag;
use App\Models\Admin\QuestionContentTag;
use App\Models\Student\exam\QuestionContentTagAnalysis;

use App\Models\Admin\PopQuizCQ;
use App\Models\Admin\TopicEndExamCQ;

class AccountDetailsController extends Controller
{
    public function index(){
        $user = auth()->user();

        // Get the of courses via. batch_student_enrollments and all topic end exams associated to those courses
        $batch_student_enrollment = BatchStudentEnrollment::join('payments', 'payments.id', 'batch_student_enrollments.payment_id')
        ->where('batch_student_enrollments.student_id', auth()->user()->id)
        ->where('payments.student_id', auth()->user()->id)
        ->where('payments.accepted', 1)
        ->has('course')
        ->with(['course.Exam' => function($query){
            return $query->where('exam_type', 'Topic End Exam');
        }])
        ->get();

        // Start counting how many courses the user completed
        $enrolled_course_count = 0;
        $completed_course_count = 0;
        foreach($batch_student_enrollment as $enrollment){
            $enrolled_course_count += 1;

            $test_count = 0;
            $completed_tests = 0;
            foreach($enrollment->course->Exam as $exam){
                $test_count += 1;
                $results = ExamResult::where('exam_id', $exam->id)->where('student_id', auth()->user()->id)->where('batch_id', $enrollment->batch_id)->get();
                if($results->count() > 0){
                    $total_scored = 0;
                    foreach($results as $result){
                        $total_scored += $result->gain_marks;
                    }
                    if($total_scored >= $exam->threshold_marks){
                        $completed_tests += 1;
                    }
                }
            }
            if($test_count == $completed_tests){
                $completed_course_count += 1;
            }
        }
        // End counting how many courses the user completed

        // Start Count percentage scored for each MCQ content tag 
        $mcq_content_tags = ContentTag::has('questionContentTagAnalysis')->with(['questionContentTagAnalysis' => function($query){
            return $query->where('student_id', auth()->user()->id)->where(function($query){
                $query->where('exam_type', 'Aptitude Test')->orWhere('exam_type', 'Pop Quiz MCQ')->orWhere('exam_type', 'Topic End Exam MCQ');
            });
        }])->get();

        foreach($mcq_content_tags as $mcq_content_tag){
            $mcq_tag_total_marks = 0;
            $mcq_tag_scored_marks = 0;
            foreach($mcq_content_tag->questionContentTagAnalysis as $analysis){
                $mcq_tag_total_marks += 1;
                $mcq_tag_scored_marks += $analysis->gain_marks;
            }
            $mcq_content_tag->tag_scored_marks = $mcq_tag_scored_marks;
            $mcq_content_tag->tag_total_marks = $mcq_tag_total_marks;
            $mcq_content_tag->percentage_scored = $mcq_tag_total_marks > 0 ? round((($mcq_tag_scored_marks/$mcq_tag_total_marks)*100), 2) : 'no data';
        }
        // End Count percentage scored for each MCQ content tag 

        // Count percentage scored for each CQ content tag 
        $cq_content_tags = ContentTag::has('questionContentTagAnalysis')->with(['questionContentTagAnalysis' => function($query){
            return $query->where('student_id', auth()->user()->id)->where(function($query){
                $query->Where('exam_type', 'Pop Quiz CQ')->orWhere('exam_type', 'Topic End Exam CQ');
            });
        }])->get();

        foreach($cq_content_tags as $cq_content_tag){
            $cq_tag_total_marks = 0;
            $cq_tag_scored_marks = 0;
            foreach($cq_content_tag->questionContentTagAnalysis as $analysis){
                if($analysis->exam_type == 'Pop Quiz CQ'){
                    $cq_question = PopQuizCQ::where('id', $analysis->question_id)->first();
                    $cq_tag_total_marks = $cq_tag_total_marks + $cq_question->marks;

                    $cq_tag_scored_marks += $analysis->gain_marks;
                }
                elseif($analysis->exam_type == 'Topic End Exam CQ'){
                    $cq_question = TopicEndExamCQ::where('id', $analysis->question_id)->first();
                    $cq_tag_total_marks += $cq_question->marks;
                    $cq_tag_scored_marks += $analysis->gain_marks;
                }
            }
            $cq_content_tag->tag_scored_marks = $cq_tag_scored_marks;
            $cq_content_tag->tag_total_marks = $cq_tag_total_marks;
            $cq_content_tag->percentage_scored = $cq_tag_total_marks > 0 ? round((($cq_tag_scored_marks/$cq_tag_total_marks)*100), 2) : 'no data';
        }
        // End Count percentage scored for each CQ content tag

        return view('student.pages_new.user.course', compact('user', 'mcq_content_tags', 'cq_content_tags', 'enrolled_course_count', 'completed_course_count'));
    }

    public function ajax_get_courses(){
        $enrolled_courses = collect();

        $student_enrollments = BatchStudentEnrollment::where( 'student_id', auth()->user()->id )->get();

        foreach($student_enrollments as $student_enrollment){
            $course = Course::where('id', $student_enrollment->course_id)->first();
            $enrolled_courses->push($course);
        }

        return $enrolled_courses;
    }

    public function ajax_get_strengths_and_weaknesses(Request $request){

        $mcq_content_tags = ContentTag::where('course_id', $request->course_id)->has('questionContentTagAnalysis')->with(['questionContentTagAnalysis' => function($query){
            return $query->where('student_id', auth()->user()->id)->where(function($query){
                $query->where('exam_type', 'Aptitude Test')->orWhere('exam_type', 'Pop Quiz MCQ')->orWhere('exam_type', 'Topic End Exam MCQ');
            });
        }])->get();

        foreach($mcq_content_tags as $mcq_content_tag){
            $mcq_tag_total_marks = 0;
            $mcq_tag_scored_marks = 0;
            foreach($mcq_content_tag->questionContentTagAnalysis as $analysis){
                $mcq_tag_total_marks += 1;
                $mcq_tag_scored_marks += $analysis->gain_marks;
            }
            $mcq_content_tag->tag_scored_marks = $mcq_tag_scored_marks;
            $mcq_content_tag->tag_total_marks = $mcq_tag_total_marks;
            $mcq_content_tag->percentage_scored = $mcq_tag_total_marks > 0 ? round((($mcq_tag_scored_marks/$mcq_tag_total_marks)*100), 2) : 'no data';
        }

        $cq_content_tags = ContentTag::where('course_id', $request->course_id)->has('questionContentTagAnalysis')->with(['questionContentTagAnalysis' => function($query){
            return $query->where('student_id', auth()->user()->id)->where(function($query){
                $query->Where('exam_type', 'Pop Quiz CQ')->orWhere('exam_type', 'Topic End Exam CQ');
            });
        }])->get();

        foreach($cq_content_tags as $cq_content_tag){
            $cq_tag_total_marks = 0;
            $cq_tag_scored_marks = 0;
            foreach($cq_content_tag->questionContentTagAnalysis as $analysis){
                // dd($analysis);
                if($analysis->exam_type == 'Pop Quiz CQ'){
                    $cq_question = PopQuizCQ::where('id', $analysis->question_id)->first();
                    $cq_tag_total_marks = $cq_tag_total_marks + $cq_question->marks;
                    $cq_tag_scored_marks += $analysis->gain_marks;

                }
                elseif($analysis->exam_type == 'Topic End Exam CQ'){
                    $cq_question = TopicEndExamCQ::where('id', $analysis->question_id)->first();
                    $cq_tag_total_marks += $cq_question->marks;
                    $cq_tag_scored_marks += $analysis->gain_marks;
                }
            }
            $cq_content_tag->tag_scored_marks = $cq_tag_scored_marks;
            $cq_content_tag->tag_total_marks = $cq_tag_total_marks;
            $cq_content_tag->percentage_scored = $cq_tag_total_marks > 0 ? round((($cq_tag_scored_marks/$cq_tag_total_marks)*100), 2) : 'no data';
        }

        return  [
                    'mcq_content_tags' => $mcq_content_tags,
                    'cq_content_tags' => $cq_content_tags
                ];
    }

    public function profileData()
    {
        $id = auth()->user()->id;
        $studentDetails = StudentDetails::where('user_id', $id)->first();
        if ($studentDetails) {
            $user = User::join('student_details', 'student_details.user_id', 'users.id')
                ->select('users.*', 'student_details.*')
                ->where('users.id', $id)->first();
        } else {
            $user = User::where('id', $id)->first();
        }
        $batchStudentEnrollment = BatchStudentEnrollment::with('course', 'batch')->where('student_id', auth()->user()->id)->get();
        $batchStudentEnroll = $batchStudentEnrollment;
        $batchStudent = $batchStudentEnrollment;
        $course_ids = [];
        $course_cat_ids = [];
        foreach ($batchStudentEnrollment as $enrollment) {
            $course_ids[] = $enrollment->course->id;
            $course_cat_ids[] = $enrollment->course->course_category_id;
        }

        $related_courses = (new Course())->getRelatedCourses($course_cat_ids, $course_ids, true);

        return $this->sendResponse(['user' => $user, 'batchStudentEnrollment' => $batchStudentEnrollment, 'related_courses' => $related_courses]);
    }

    /*
    * batch wise result for dashboard
    */
    public function batchResults()
    {
        if (request()->ajax()) {
            if (request()->active_batch_id) {
                $batch_id = request()->active_batch_id;
                $total_enrolled = BatchStudentEnrollment::where('batch_id', $batch_id)->count();
                $tag_reports = (new QuestionContentTagAnalysis())->getTagAnalysisReport(Auth::user()->id, $batch_id);
                $exam_results = (new ExamResult())->getExamResultsForDashboard(Auth::user()->id, $batch_id);
                return $this->sendResponse(['batch_results' => $exam_results, 'tag_reports' => $tag_reports, 'total_enrolled'=>$total_enrolled]);
            }
            return $this->sendError(['Not found']);
        }
        abort(401);
    }

    /**
     * Tag analysis report
     *
     */

    public function tagAnalysisReport(Course $course)
    {
        // dd($course);
        // $course->topic;
        $course_topics = (new CourseTopic())->where("course_id", $course->id)->get();
        // dd($course_topics);
        $tag_details = (new QuestionContentTagAnalysis())->getTagAnalysisReport(Auth::user()->id, null, $course->id);
        // dd($tag_details);
        return view('student.pages_new.user.analysis', compact('course', 'course_topics', 'tag_details'));
    }

    public function edit($id)
    {
        if (auth()->user()->id == $id) {
            $user = User::where('id', $id)->first();
            $studentDetails = StudentDetails::where('user_id', $id)->first();
            return view('student.pages.user.edit_profile', compact('user', 'studentDetails'));
        } else {
            abort(401);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->id == $id) {
            $validate = $request->validate([
                'image' => 'nullable|image|mimes:jpeg,jpg,png|max:4096',
                'gender' => 'required|string|',
                'contact' => 'required|numeric|',
                'class' => 'required|',
                'institution' => 'required|string',
                'district' => 'nullable|string',
                'address' => 'required|string',
                'gaurdianContactNo' => 'nullable|numeric',
                'relationWithGaurdian' => 'nullable|string',
            ]);
            $save = DB::table('student_details')
                ->updateOrInsert(
                    ['user_id' => $id],
                    [
                        'user_id' => $id,
                        'image' => $request->image,
                        'gender' => $request->gender,
                        'contact' => $request->contact,
                        'class' => $request->class,
                        'institution' => $request->institution,
                        'district' => $request->district,
                        'address' => $request->address,
                        'gaurdian_contact_no' => $request->gaurdianContactNo,
                        'relation_with_gaurdian' => $request->relationWithGaurdian,
                    ],
                );
            return redirect()->route('profile', $id)->with('status', 'Profile updated successfully');
        } else {
            abort(401);
        }
    }
}
