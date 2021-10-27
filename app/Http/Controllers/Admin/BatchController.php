<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin\Batch;
use App\Models\Admin\Course;
use Illuminate\Http\Request;
use App\Models\Admin\Payment;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\BatchLecture;
use App\Http\Controllers\Controller;
use App\Models\Admin\BatchStudentEnrollment;

class BatchController extends Controller
{
    public function index()
    {
        $batches = Batch::join('users', 'batches.teacher_id', 'users.id')
            ->join('courses', 'batches.course_id', 'courses.id')
            ->select('batches.*', 'courses.title as courseName', 'users.name as userName')
            ->orderBy('batches.created_at', 'DESC')
            ->get();
        return view('admin.pages.batch.index', compact('batches'));
    }

    public function create()
    {
        return view('admin.pages.batch.create');
    }

    public function show(Batch $batch)
    {
        $studentId = [];
        $batch_lectures = BatchLecture::join('course_topics', 'batch_lectures.topic_id', 'course_topics.id')
            ->join('courses', 'batch_lectures.course_id', 'courses.id')
            ->select('batch_lectures.*', 'courses.title as courseTitle', 'course_topics.title as courseTopicsTitle')
            ->where('batch_id', $batch->id)->get();
        $students = BatchStudentEnrollment::where('batch_id', $batch->id)->get();
        foreach ($students as $student) {
            array_push($studentId, $student->student_id);
        }

        $studentsToAdd = User::where('user_type', 3)->whereNotIn('id', $studentId)->get();

        $previousTopicID = BatchLecture::where('batch_id', $batch->id)->pluck('topic_id')->toArray();
        $topics = CourseTopic::where('course_id', $batch->course->id)->whereNotIn('id', $previousTopicID)->get();

        return view('admin.pages.batch.details', compact('batch', 'batch_lectures', 'students', 'studentsToAdd', 'topics'));
    }

    public function edit(Batch $batch)
    {
        return view('admin.pages.batch.edit', compact('batch'));
    }

    public function destroy(Batch $batch)
    {
        $delete = $batch->delete();
        if ($delete) {
            return redirect()->route('batch.index')->with('status', 'Batch successfully deleted!');
        } else {
            return redirect()->route('batch.index')->with('failed', 'Batch deletion failed!');
        }
    }

    public function changeBatchStatus(Request $request)
    {
        $obj = Batch::find($request->id);
        $obj->status = $request->status;
        $obj->save();

        return response()->json(['success' => 'Batch changed successfully.']);
    }

    public function changeStudentStatus(Request $request)
    {
        $obj = BatchStudentEnrollment::find($request->id);
        $obj->status = $request->status;
        $obj->save();

        return response()->json(['success' => 'Student status changed successfully.']);
    }

    public function addStudentToBatch(Request $request, Course $course, Batch $batch)
    {
        // dd($request, $course, $batch);
        $validateDate = $request->validate([
            'studentId' => 'numeric|required',
            'accesddedDays' => 'numeric|required',
            'trx_id' => 'string|required',
            'paymentType' => 'string|required',
            'amount' => 'numeric|required',
            'note' => 'string|nullable'
        ]);

        $student = User::where('id', $request->studentId)->first();

        $payment = new Payment();
        $payment->student_id = $request->studentId;
        $payment->course_id = $course->id;
        $payment->name = $student->name;
        $payment->email = $student->email;
        $payment->contact = $student->phone;
        $payment->trx_id =  $request->trx_id;
        $payment->payment_type =  $request->paymentType;
        $payment->amount =  $request->amount;
        $payment->payment_account_number = $student->phone;
        $payment->days_for = $request->accesddedDays;
        $payment->accepted = 1;
        $payment->save();
        $lastPayment = Payment::latest()->first();

        $batchStudentEnrollment = BatchStudentEnrollment::updateOrCreate(
            [
                'course_id' => $course->id,
                'student_id' => $request->studentId,
                'course_id' => $course->id
            ],
            [
                'batch_id' => $batch->id,
                'payment_id' => $lastPayment->id,
                'course_id' => $course->id,
                'note_list' => $request->note,
                'student_id' => $request->studentId,
                'individual_batch_days' => 0,
                'accessed_days' =>  $request->accesddedDays,
                'status' => 1,
            ]
        );
        return redirect()->route('batch.show', $batch)->with('status', 'Course category successfully deleted!');
    }

    public function batchStudent()
    {
        return view('admin.pages.batch.batch_student');
    }

    public function deleteStudentFromBatch(Course $course, Batch $batch, BatchStudentEnrollment $batchStudentEnrollment)
    {
        $paymentId = $batchStudentEnrollment->payment_id;
        $deleteBatchStudent = $batchStudentEnrollment->delete();
        $deletePayment = Payment::find($paymentId);
        $deletePayment->delete();
        return back();
    }
}
