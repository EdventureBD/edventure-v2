<?php

namespace App\Http\Controllers\Student;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Admin\Batch;
use App\Models\Admin\Course;
use App\Models\Admin\LiveClass;
use App\Models\Admin\BatchLecture;
use App\Models\Admin\CourseLecture;
use App\Http\Controllers\Controller;
use App\Models\Admin\BatchStudentEnrollment;
use App\Models\Admin\CompletedLectures;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\Exam;
use DateTime;

class BatchController extends Controller
{
    public function batch()
    {
        $batches = BatchStudentEnrollment::join('payments', 'payments.id', 'batch_student_enrollments.payment_id')
            ->where('batch_student_enrollments.student_id', auth()->user()->id)
            ->where('payments.student_id', auth()->user()->id)
            ->where('payments.accepted', 1)
            ->get();
        return view('student.pages.batch.index', compact('batches'));
    }

    public function batchLecture(Batch $batch)
    {
        // geting data for back url as well as searching data
        $course = Course::where('id', $batch->course_id)
                ->select('id', 'slug', 'course_category_id', 'intermediary_level_id', 'bundle_id')
                ->with([
                        'bundle' => function($query){
                            $query->select('id', 'slug');
                        },
                        'intermediaryLevel' => function($query){
                            $query->select('id', 'course_category_id', 'slug');
                        },
                        'intermediaryLevel.courseCategory' => function($query){
                            $query->select('id', 'slug');
                        },
                    ])
                ->first();
        
        // setting back url
        if($course->bundle != null){
            $back_url = route('bundle_courses' ,[ 'bundle' => $course->bundle->slug]);
        }
        else{
            $back_url = route('course') . "/" . $course->intermediaryLevel->courseCategory->slug . "/" . $course->intermediaryLevel->slug;
        }

        $batchTopics = BatchLecture::select('id', 'topic_id')
        ->with([
        'courseTopic' => function($query){
            return $query->select('id', 'title', 'slug', 'zero_star_island_image', 'one_star_island_image', 'two_star_island_image', 'three_star_island_image', 'disabled_island_image');
        },
        'courseTopic.exams' => function($query){
            return $query->where('exam_type', 'Aptitude Test')->orWhere('exam_type', 'Pop Quiz')->orWhere('exam_type', 'Topic End Exam')->orderBy('exam_type')->orderBy('order')
            ->select('id', 'title', 'slug', 'topic_id', 'exam_type', 'threshold_marks');
        },
        'courseTopic.exams.exam_results' => function($query){
            return $query->where('student_id', auth()->user()->id)
            ->select('id', 'exam_id', 'exam_type', 'gain_marks', 'checked');
        },
        'courseTopic.exams.course_lectures' => function($query){
            return $query->select('id', 'title', 'slug', 'exam_id');
        },
        'courseTopic.exams.course_lectures.completed_lectures' => function($query){
            return $query->where('student_id', auth()->user()->id)
            ->select('id', 'lecture_id');
        },
        'courseTopic.exams.exam_attempts' => function($query){
            return $query->where('student_id', auth()->user()->id)->select('id', 'topic_end_exam_id', 'student_id', 'attempts', 'unlocked');
        },
        ])
        ->where('batch_id', $batch->id)
        ->where('course_id', $course->id)
        ->get();

        // dd($batchTopics);

        // no_courses exist for one of the bundles
        if(count($batchTopics) == 0){
            return redirect($back_url)->withErrors([ 'no_course' => 'No course topics exist for this course. Please Contact System Admin.' ]);
        }

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // if no exams exist for any one of the course topics/islands. Dunno if this is needed.
        // foreach($batchTopics as $batchTopic){
        //     if(count($batchTopic->courseTopic->exams) == 0){
        //         // dd($back_url, $batch, $batchTopics, $batchTopic, $course, $course->intermediaryLevel->courseCategory->slug, $course->intermediaryLevel->slug);
        //         return redirect($back_url)->withErrors([ 'no_exams_exist' => 'Some exams for this course is missing. Please Contact System Admin.' ]);
        //     }
        // }
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // dd($batchTopics);
        // dd(CompletedLectures::where('student_id', auth()->user()->id)->orderBy('created_at', 'desc')->first(), $batchTopics);

        $island_images = [];
        $island_images_disabled = [];

        $previous_aptitude_test_passed = true;
        $previous_topic_end_exam_passed = true;
        $previous_topic_end_exam_attempts_unlocked = true;
        
        foreach($batchTopics as $key => $batchTopic){

            // nodes can be lectures or courses. Counting how many out of total are completed.
            $number_of_nodes = 0;
            $number_of_completed_nodes = 0;

            // $island_images[] = $batchTopic->courseTopic->island_image;
            if($key == 0 && count($batchTopic->courseTopic->exams) == 0){
                return back()->withErrors(['no_exams' => 'The first island doesn\'t have an aptitude test. Please Contact System Admin.']);
            }

            // dd($batchTopic->courseTopic->exams, $aptitude_test_passed, $topic_end_exam_passed);
            
            foreach($batchTopic->courseTopic->exams as $exam){
                $aptitude_test_passed = $previous_aptitude_test_passed;
                $topic_end_exam_passed = $previous_topic_end_exam_passed;
                $topic_end_exam_attempts_unlocked = $previous_topic_end_exam_attempts_unlocked;

                $number_of_nodes++;
                $scored_marks = 0;
                // $exam_results = $exam->exam_results;
                // $details_results = DetailsResult::where('exam_id', $exam->id)->where('exam_type', $exam->exam_type)->where('student_id', auth()->user()->id)->get();

                // if($exam->exam_type === "Aptitude Test" || $exam->exam_type === "Pop Quiz"){
                    if(count($exam->exam_results)){
                        // Remove this if-condition(line 63 to 65) but keep line 64 intact if they want progress to increase when pop quiz is attempted and not passed
                        if($exam->exam_type === "Aptitude Test"){
                            $number_of_completed_nodes++;
                        }
                        $exam->has_been_attempted = true;
                    }
                    else{
                        $exam->has_been_attempted = false;
                    }
                // }

                if($exam->exam_type == "Topic End Exam" && count($exam->exam_attempts) > 0 && $exam->exam_attempts[0]->unlocked == true){
                    $topic_end_exam_attempts_unlocked = true;
                }
                else{
                    $topic_end_exam_attempts_unlocked = false;
                }

                $exam->previous_aptitude_test_passed = $previous_aptitude_test_passed;
                $exam->previous_topic_end_exam_passed = $previous_topic_end_exam_passed;
                $batchTopic->previous_topic_end_exam_attempts_unlocked = $topic_end_exam_attempts_unlocked;

                foreach($exam->exam_results as $exam_result){
                    $scored_marks = $scored_marks + $exam_result->gain_marks;
                }
                
                if($scored_marks >= $exam->threshold_marks){
                    if($exam->exam_type !== "Aptitude Test" ){
                        $number_of_completed_nodes++;
                    }
                    $exam->test_passed = true;
                    if($exam->exam_type === "Topic End Exam"){
                        $topic_end_exam_passed = true;
                    }
                }
                else{
                    if($exam->exam_type === "Aptitude Test"){
                        $aptitude_test_passed = false;
                    }
                    if($exam->exam_type === "Topic End Exam"){
                        $topic_end_exam_passed = false;
                    }
                    $exam->test_passed = false;
                }

                $lectures_in_this_exam = count($exam->course_lectures);
                $completed_lecture_count = 0;
                foreach($exam->course_lectures as $lecture){
                    $number_of_nodes++;
                    // if there is an entry in completed_lectures column for this student
                    if(count($lecture->completed_lectures) > 0){
                        $number_of_completed_nodes++;
                        $lecture->completed = true;
                        $completed_lecture_count++;
                    }
                    else
                        $lecture->completed = false;
                }
                $exam->lecture_count = $lectures_in_this_exam;
                $exam->completed_lecture_count = $completed_lecture_count;
                $exam->scored_marks = $scored_marks;
            }

            // foreach($batchTopic->courseTopic->exams as $exam){
            //     $aptitude_test_passed = $previous_aptitude_test_passed;
            //     $topic_end_exam_passed = $previous_topic_end_exam_passed;

            //     $number_of_nodes++;
            //     $scored_marks = 0;
            //     $exam_results = $exam->details_results->where('exam_type', $exam->exam_type);
            //     // $details_results = DetailsResult::where('exam_id', $exam->id)->where('exam_type', $exam->exam_type)->where('student_id', auth()->user()->id)->get();

            //     if($exam->exam_type === "Aptitude Test" || $exam->exam_type === "Pop Quiz"){
            //         if(count($exam_results)){
            //             // Remove this if-condition(line 63 to 65) but keep line 64 intact if they want progress to increase when pop quiz is attempted and not passed
            //             if($exam->exam_type === "Aptitude Test"){
            //                 $number_of_completed_nodes++;
            //             }
            //             $exam->has_been_attempted = true;
            //         }
            //         else{
            //             $exam->has_been_attempted = false;
            //         }
            //     }
                
            //     $exam->previous_aptitude_test_passed = $previous_aptitude_test_passed;
            //     $exam->previous_topic_end_exam_passed = $previous_topic_end_exam_passed;

            //     foreach($exam_results as $exam_result){
            //         $scored_marks = $scored_marks + $exam_result->gain_marks;
            //     }
                
            //     if($scored_marks >= $exam->threshold_marks){
            //         if($exam->exam_type !== "Aptitude Test" ){
            //             $number_of_completed_nodes++;
            //         }
            //         $exam->test_passed = true;
            //     }
            //     else{
            //         if($exam->exam_type === "Aptitude Test" && $aptitude_test_passed ){
            //             $aptitude_test_passed = false;
            //         }
            //         if($exam->exam_type === "Topic End Exam" && $topic_end_exam_passed){
            //             $topic_end_exam_passed = false;
            //         }
            //         $exam->test_passed = false;
            //     }

            //     $lectures_in_this_exam = count($exam->course_lectures);
            //     $completed_lecture_count = 0;
            //     foreach($exam->course_lectures as $lecture){
            //         $number_of_nodes++;
            //         // if there is an entry in completed_lectures column for this student
            //         if(count($lecture->completed_lectures) > 0){
            //             $number_of_completed_nodes++;
            //             $lecture->completed = true;
            //             $completed_lecture_count++;
            //         }
            //         else
            //             $lecture->completed = false;
            //     }
            //     $exam->lecture_count = $lectures_in_this_exam;
            //     $exam->completed_lecture_count = $completed_lecture_count;
            //     $exam->scored_marks = $scored_marks;
            // }



            // calculate completion percentage using total nodes and completed nodes
            if($number_of_nodes == 0){
                $batchTopic->percentage_completion = 0;
            }
            else{
                $batchTopic->percentage_completion = ($number_of_completed_nodes/$number_of_nodes)*100;
            }

            // if($key == 1){
            //     dd($previous_topic_end_exam_attempts_unlocked, $exam);
            // }

            if($key == 0 || ($previous_topic_end_exam_passed || $previous_topic_end_exam_attempts_unlocked)){

                // dump(1, $previous_topic_end_exam_passed, $previous_topic_end_exam_attempts_unlocked);

                if($batchTopic->percentage_completion >= 100){
                    $island_images[] = $batchTopic->courseTopic->three_star_island_image;
                    $island_images_disabled[] = 0;
                }
                elseif($batchTopic->percentage_completion >= 66){
                    $island_images[] = $batchTopic->courseTopic->two_star_island_image;
                    $island_images_disabled[] = 0;
                }
                elseif($batchTopic->percentage_completion >= 33){
                    $island_images[] = $batchTopic->courseTopic->one_star_island_image;
                    $island_images_disabled[] = 0;
                }
                elseif($batchTopic->percentage_completion >= 0){
                    $island_images[] = $batchTopic->courseTopic->zero_star_island_image;
                    $island_images_disabled[] = 0;
                }
            } else {

                // dump(2, $previous_topic_end_exam_passed, $previous_topic_end_exam_attempts_unlocked);

                $island_images[] = $batchTopic->courseTopic->disabled_island_image;
                $island_images_disabled[] = 1;
            }

            $previous_aptitude_test_passed = $aptitude_test_passed;
            $previous_topic_end_exam_passed = $topic_end_exam_passed;
            $previous_topic_end_exam_attempts_unlocked = $topic_end_exam_attempts_unlocked;
        }

        $accessedDays = BatchStudentEnrollment::where('student_id', auth()->user()->id)
            ->where('batch_id', $batch->id)
            ->where('course_id', $course->id)
            ->first();

        // dd($batchTopics, $island_images, $island_images_disabled);

        return view('student.pages_new.roadmap.new_roadmap_index', compact('batch', 'course', 'batchTopics', 'accessedDays', 'island_images', 'island_images_disabled', 'back_url'));
    }

    public function lecture(Batch $batch, CourseLecture $courseLecture)
    {
        $exam = Exam::find($courseLecture->exam_id);
        //setting next lecture & prev lecture
        $prev_lecture = CourseLecture::where('topic_id', $courseLecture->topic_id)
                                        ->where('id', '<', $courseLecture->id)
                                        ->with(['exam' => function($query){
                                            return $query->select('id', 'slug', 'exam_type');
                                        }])
                                        ->orderBy('created_at', 'desc')
                                        ->first();
        $prev_link = $prev_lecture ? route('topic_lecture', [$batch->slug, $prev_lecture->slug]) : null;
        
        // get the next lecture
        $next_lecture = CourseLecture::where('topic_id', $courseLecture->topic_id)
                                        ->where('exam_id', $exam->id)
                                        ->where('id', '>', $courseLecture->id)
                                        ->with(['exam' => function($query){
                                            return $query->select('id', 'slug', 'exam_type');
                                        }])
                                        ->orderBy('created_at', 'asc')
                                        ->first();

        // if next lecture exists, then generate link for that lecture
        if($next_lecture){
            $next_link = route('topic_lecture', [$batch->slug, $next_lecture->slug]);
            $next_link_btn_text = "Next Lecture";
        }
        // else generate link for that exam
        else{
            $course_topic = CourseTopic::where('id', $courseLecture->topic_id)->select('id', 'slug', 'course_id')->first();
            $next_link = route('batch-test', [$course_topic->slug, $batch->slug, $exam->id, $exam->exam_type]);
            $next_link_btn_text = "Next Exam";
        }

        if($exam->exam_type == "Topic End Exam" && !$next_lecture){
            $next_exam_type_TEE = "Topic End Exam";
        }
        else{
            $next_exam_type_TEE = null;
        }

        // dd($next_link, $courseLecture, $next_lecture, $prev_lecture, $exam);

        $course = Course::where('id', $batch->course_id)->first();
        $liveClass = LiveClass::where('batch_id', $batch->id)
            // ->where('course_id', $batch->course_id)
            ->where('topic_id', $courseLecture->topic_id)
            ->where('status', 1)
            ->latest()->first();
        $start_date = "";
        $start_time = "";
        $timeleft = 3000;
        if (!empty($liveClass->start_date)) {
            $start_date_time = new DateTime($liveClass->start_date . ' ' . $liveClass->start_time);
            $today_time = new DateTime();
            $timeleft_seconds = $start_date_time->format('U') - $today_time->format('U');
            $timeleft = $timeleft_seconds;
        }
        return view('student.pages_new.batch.specific_lecture', compact('batch', 'courseLecture', 'course', 'liveClass', 'start_date', 'start_time', 'timeleft', 'prev_link', 'next_link', 'next_link_btn_text', 'next_exam_type_TEE'));
    }

    public function lecture_visit_confirmed_ajax($batch, $courseLecture){

        $completed = CompletedLectures::where('student_id', auth()->user()->id)->where('lecture_id', $courseLecture)->first();

        if($completed){
            $completed->delete();
            $completion_status = false;
        }
        else{
            $completed = new CompletedLectures();
            $completed->student_id = auth()->user()->id;
            $completed->lecture_id = $courseLecture;
            $completed->save();
            $completion_status = true;
        }

        return ['success' => true, 'completed' => $completion_status];
    }

    public function get_lecture_visit_status_ajax($batch, $courseLecture){
        $completed_lecture = CompletedLectures::where('student_id', auth()->user()->id)->where('lecture_id', $courseLecture)->first();
        if($completed_lecture){
            return true;
        }
        else{
            return false;
        }
    }
}
