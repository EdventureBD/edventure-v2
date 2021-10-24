<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admin\Batch;
use App\Models\Admin\BatchStudentEnrollment;
use App\Models\Admin\Course;
use App\Models\Admin\CourseTopic;
use App\Models\Student\exam\ExamResult;
use App\Models\Student\exam\QuestionContentTagAnalysis;
use App\Models\Student\StudentDetails;
use Illuminate\Support\Facades\Auth;

class AccountDetailsController extends Controller
{
    public function index($id)
    {
        if (auth()->user()->id == $id) {
            if (request()->ajax()) {
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
            } else {
                return view('student.pages_new.user.profile');
            }
        } else {
            abort(401);
        }
    }

    /*
    * batch wise result for dashboard
    */
    public function batchResults()
    {
        if (request()->ajax()) {
            if (request()->active_batch_id) {
                $batch_id = request()->active_batch_id;
                $tag_reports = (new QuestionContentTagAnalysis())->getTagAnalysisReport(Auth::user()->id, $batch_id);
                $exam_results = (new ExamResult())->getExamResultsForDashboard(Auth::user()->id, $batch_id);
                return $this->sendResponse(['batch_results' => $exam_results, 'tag_reports' => $tag_reports]);
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
