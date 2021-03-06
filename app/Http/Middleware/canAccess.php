<?php

namespace App\Http\Middleware;

use App\Models\Admin\Batch;
use Closure;
use App\Models\Admin\Course;
use Illuminate\Http\Request;
use App\Models\Admin\BatchStudentEnrollment;

class canAccess
{
    public function handle(Request $request, Closure $next)
    {
        $batch = $request->route('batch');
        if(is_string($batch)) $batch = Batch::findOrFail($batch);

        $course = Course::where('id', $batch->course_id)->first();

        $batch_student_enrollment = BatchStudentEnrollment::where('batch_id', $batch->id)
            ->where('student_id', auth()->user()->id)
            ->where('status', 1)
            ->latest()
            ->first();
        // dd($batch_student_enrollment);
        if ($batch_student_enrollment) {
            if ($batch->batch_running_days <= $batch_student_enrollment->accessed_days) {
                
                return $next($request);
            }
        }
        return redirect()->route('course-preview', $course->slug);
    }
}
