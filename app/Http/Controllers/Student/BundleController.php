<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Admin\BatchStudentEnrollment;
use Illuminate\Http\Request;
use smasif\ShurjopayLaravelPackage\ShurjopayService;
use Illuminate\Support\Facades\Auth;

// models
use App\Models\Admin\Bundle;
use App\Models\BundleStudentEnrollment;
use App\Models\BundlePayment;

class BundleController extends Controller
{
   public function bundlePreview($bundle_slug){

      $bundle = Bundle::where('slug', $bundle_slug)
      ->with('courses.courseTopic')
      ->firstOrFail();
      $bundle['teacher_lists'] = null;
      $bundle['video_lecture'] = 0;
      $bundle['given_notes'] = 0;
      $bundle['quiz'] = 0;
      $bundle['time_allotted'] = 0;
      $bundle['mind_map'] = 0;

      if(Auth::check()){
         $enrolled = BundleStudentEnrollment::join('bundle_payments', 'bundle_payments.id', 'bundle_student_enrollments.payment_id')
         ->where('bundle_student_enrollments.bundle_id', $bundle->id)
         ->where('bundle_student_enrollments.student_id', auth()->user()->id)
         ->where('bundle_payments.student_id', auth()->user()->id)
         ->first();

         // if already enrolled, go to courses page
         if($enrolled){
            return redirect()->route('bundle_courses', $bundle->slug);
         }
      }

      if(count($bundle->courses) > 0) {
          foreach ($bundle->courses as $course) {
//              $teachers = $course->teacher_lists;
//              foreach ($teachers as $teacher) {
//                  $teacher_list[] = $teacher;
//              }

              $bundle['video_lecture'] += $course->video_lecture;
              $bundle['given_notes'] += $course->given_notes;
              $bundle['quiz'] += $course->quiz;
              $bundle['time_allotted'] += $course->time_allotted;
              $bundle['mind_map'] += $course->mind_map;
          }

          $bundle['teacher_lists'] = $bundle->teachersList() ?? [];
      }

      // else, go to preview page
//       return $bundle;
      return view('student.pages_new.bundle.preview_guest', compact('bundle'));
   }

   public function bundle_enroll($bundle)
   {
      $bundle = Bundle::where('slug', $bundle)->with(['courses.Batch'])->first();

      if(Auth::check()){
         $enrolled = BundleStudentEnrollment::join('bundle_payments', 'bundle_payments.id', 'bundle_student_enrollments.payment_id')
               ->where('bundle_student_enrollments.bundle_id', $bundle->id)
               ->where('bundle_student_enrollments.student_id', auth()->user()->id)
               ->where('bundle_payments.student_id', auth()->user()->id)
               ->first();

         // if a student is enrolled and status is 0
         if ($enrolled && $enrolled->status == 0) {
            return redirect()->route('bundle-preview', $bundle->slug)->withErrors(['enrollment_incomplete' => 'Your enrollment is pending. Please wait or contact system admin.']);
         }

         $student = auth()->user();

         // if course is free, enroll and take to course island page
         if($bundle->price <= 0){

            $bundle_payment = new BundlePayment();
            $bundle_payment->student_id = $student->id;
            $bundle_payment->bundle_id = $bundle->id;
            $bundle_payment->name = $student->name;
            $bundle_payment->email = $student->email;
            $bundle_payment->contact = $student->phone;
            $bundle_payment->trx_id =  "FREE";
            $bundle_payment->payment_type =  "FREE";
            $bundle_payment->amount =  0;
            $bundle_payment->payment_account_number = 000;
            $bundle_payment->days_for = 365;
            $bundle_payment->accepted = 1;
            $save = $bundle_payment->save();

            if($save){
               $bundleStudentEnrollment = BundleStudentEnrollment::updateOrCreate(
               [
                  'bundle_id' => $bundle->id,
                  'student_id' => $student->id
               ],
               [
                  'payment_id' => $bundle_payment->id,
                  'note_list' => "Free enrolment",
                  'student_id' => $student->id,
                  'individual_bundle_days' => 0,
                  'accessed_days' =>  365,
                  'status' => 1,
               ]
            );

               foreach($bundle->courses as $course){
                  foreach($course->Batch as $batch){
                     $batch_enrollment = new BatchStudentEnrollment();
                     $batch_enrollment->batch_id = $batch->id;
                     $batch_enrollment->payment_id = null;
                     $batch_enrollment->course_id = $course->id;
                     $batch_enrollment->student_id = auth()->user()->id;
                     $batch_enrollment->batch_rank = null;
                     $batch_enrollment->note_list = 'Enrollment for bundle id '.$bundle->id;
                     $batch_enrollment->individual_batch_days = 0;
                     $batch_enrollment->accessed_days = 365;
                     $batch_enrollment->status = 1;
                     $batch_enrollment->save();
                  }
               }
            }

            return redirect()->route('bundle_courses', $bundle->slug);
         }
         // if not free, go to payment page
         else {
            return view('student.pages_new.bundle.confirm_enroll', compact('bundle', 'student'));
         }
      }

      //if not logged in
      return redirect()->route('bundle-preview', $bundle->slug)->withErrors(['not_logged_in' => 'Please login/register to access this bundle.']);
   }

   public function bundle_courses(Bundle $bundle){
      $bundle = Bundle::where('slug', $bundle->slug)
            ->select('id', 'intermediary_level_id', 'bundle_name', 'slug')
            ->with([
            'courses' => function($query){
               $query->select('id', 'slug', 'island_image', 'course_category_id', 'intermediary_level_id', 'bundle_id');
            },
            'courses.Batch' => function($query){
               $query->select('id', 'slug', 'course_id');
            },
            'intermediary_level' => function($query){
               $query->select('id', 'course_category_id', 'slug');
            },
            'intermediary_level.courseCategory' => function($query){
               $query->select('id', 'slug');
            },
         ])->firstOrFail();

         $back_url = route('course') . "/" . $bundle->intermediary_level->courseCategory->slug . "/" . $bundle->intermediary_level->slug;


         if(count($bundle->courses) == 0){
            return redirect($back_url)->withErrors([ 'no_course_exist' => 'No courses have been added to this bundle. Please Contact System Admin.' ]);
         }

      return view('student.pages_new.bundle.bundle_courses', compact('bundle', 'back_url'));
   }

   public function processPayment($bundle_slug, Request $request){
      $bundle = Bundle::where('slug', $bundle_slug)->with([
            'courses' => function($query){
               return $query->select('id', 'title', 'slug', 'course_category_id', 'intermediary_level_id', 'bundle_id');
            },
            'courses.Batch' => function($query){
               return $query->select('id', 'title', 'slug', 'course_id');
            }])->first();

      $price = $request->bundle_price;
      $shurjopay_service = new ShurjopayService();
      $trx_id = $shurjopay_service->generateTxId();

      $user = auth()->user();

      $bundle_payment = new BundlePayment();
      $bundle_payment->student_id = auth()->user()->id;
      $bundle_payment->bundle_id = $bundle->id;
      $bundle_payment->name = $user->name;
      $bundle_payment->email = $user->email;
      $bundle_payment->contact = $user->phone;
      $bundle_payment->trx_id = $trx_id;
      $bundle_payment->payment_type = 'SHURJO_PAY';
      $bundle_payment->amount = $bundle->price;
      $bundle_payment->payment_account_number = '000';
      $bundle_payment->days_for = 365;
      $bundle_payment->accepted = 0;
      $save = $bundle_payment->save();

      if($save){
            foreach($bundle->courses as $course){
               foreach($course->Batch as $batch){
                  $batch_enrollment = new BatchStudentEnrollment();
                  $batch_enrollment->batch_id = $batch->id;
                  $batch_enrollment->payment_id = null;
                  $batch_enrollment->course_id = $course->id;
                  $batch_enrollment->student_id = auth()->user()->id;
                  $batch_enrollment->batch_rank = null;
                  $batch_enrollment->note_list = 'Enrollment for bundle id '.$bundle->id;
                  $batch_enrollment->individual_batch_days = 0;
                  $batch_enrollment->accessed_days = 365;
                  $batch_enrollment->status = 1;
                  $batch_enrollment->save();
               }
            }
      }

      $success_url = route('bundle_payment_success', $bundle->slug);
      $shurjopay_service->sendPayment($price, $success_url);
   }
}
