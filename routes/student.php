<?php

use App\Http\Controllers\ModelMcqTagAnalysisController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\PdfController;
use App\Http\Controllers\Student\ExamController;
use App\Http\Controllers\Student\BatchController;
use App\Http\Controllers\Student\CourseController;
use App\Http\Controllers\Student\PaymentController;
use App\Http\Controllers\Student\ProgressController;
use App\Http\Controllers\Student\AccountDetailsController;
use App\Http\Controllers\Student\BundleController;
use App\Http\Controllers\Student\BundlePaymentController;
use App\Utils\Payment;

Route::group(['middleware' => ['auth', 'is_student']], function () {
    Route::get('/profile', [AccountDetailsController::class, 'index'])->name('profile');
    Route::get('/profile/course/pdf_and_video/{tag_id}', [AccountDetailsController::class, 'course_tag_pdf_and_video'])->name('course.tag.pdf_and_video');
    Route::Post('/profile/image/upload', [AccountDetailsController::class, 'uploadImage'])->name('profile.image.upload');

    Route::group([], function(){
        Route::get('/profile/model-test', [AccountDetailsController::class, 'getModelTestInfo'])->name('profile.modelTest');
        Route::get('/model-test/topic/{id}', [AccountDetailsController::class, 'getTopic'])->name('model.test.topic');
        Route::get('/model-test/result', [AccountDetailsController::class, 'getExamResult'])->name('student.model.test.result');
        Route::get('/profile/model-test/tag-details', [ModelMcqTagAnalysisController::class, 'index'])->name('tag.analysis,index');
        Route::get('/model-test/tag-details/{id}', [ModelMcqTagAnalysisController::class, 'getAjaxTagAnalysis'])->name('tag.analysis.ajax');
        Route::get('/profile/model-test/tag-solutions/{tagId}', [ModelMcqTagAnalysisController::class, 'solutions'])->name('tag.solution');
    });

    Route::get('/profile/ajax_get_courses', [AccountDetailsController::class, 'ajax_get_courses'])->name('ajax-get-courses');
    Route::get('/profile/ajax_get_strengths_and_weaknesses', [AccountDetailsController::class, 'ajax_get_strengths_and_weaknesses'])->name('ajax-get-strengths-and-weaknesses');

    Route::get('/profile-data', [AccountDetailsController::class, 'profileData'])->name('profile-data');
    Route::get('/batch-results', [AccountDetailsController::class, 'batchResults'])->name('batch-results'); //getting batch results
    Route::get('/tag-analysis-report/{course}', [AccountDetailsController::class, 'tagAnalysisReport'])->name('tag-analysis-report');

    Route::get('/edit-profile/{user_id}', [AccountDetailsController::class, 'edit'])->name('edit-profile');
    Route::post('/edit-profile/{user_id}', [AccountDetailsController::class, 'update'])->name('edit-profile');

    Route::get('/course/course-preview/{course}/enroll', [CourseController::class, 'enroll'])->name('enroll');
    Route::get('/course/course-preview/{course}/enroll/{payments}', [CourseController::class, 'invoice'])->name('invoice');

    

    // BUNDLE INVOICE(ASK IF NEEDED OR NOT)
    // Route::get('/course/course-preview/{course}/enroll/{payments}', [CourseController::class, 'invoice'])->name('invoice');
    // BUNDLE
    // see the courses for a bundle
    Route::get('bundle/{bundle}/', [BundleController::class, 'bundle_courses'])->name('bundle_courses');
    // BUNDLE Process Payment
    Route::post('bundle/process-payment/{bundle}', [BundleController::class, 'processPayment'])->name('bundle_payment_process');
    //BUNDLE Payment success
    Route::get('bundle/payment-success/{bundle}', [BundlePaymentController::class, 'paymentSuccess'])->name('bundle_payment_success');
    // BUNDLE ISLANDS
    Route::get('bundle/{batch}/', [BatchController::class, 'batchLecture'])->name('batch-lecture');



    // BATCH
    Route::get('batch', [BatchController::class, 'batch'])->name('batch');
    Route::group(['middleware' => 'canAccess'], function () {
        // BATCH
        Route::get('batch/{batch}/', [BatchController::class, 'batchLecture'])->name('batch-lecture');
        Route::get('batch/{batch}/{courseLecture}', [BatchController::class, 'lecture'])->name('topic_lecture')->middleware('proceed_guard');

        // Route::get('batch/ajax/{batch}/', [BatchController::class, 'batchLecture'])->name('batch-lecture');

        Route::get('batch/{batch}/ajax/get/{courseLecture}', [BatchController::class, 'get_lecture_visit_status_ajax'])->name('get_lecture_visit_status_ajax');
        Route::get('batch/{batch}/ajax/confirm/{courseLecture}', [BatchController::class, 'lecture_visit_confirmed_ajax'])->name('lecture_visit_confirmed_ajax');

        // BATCH TEST(For serving tests if a person hasn't attended it already)
        Route::get('batch/tests/{course_topic}/{batch}/{exam_id}/{exam_type}', [ExamController::class, 'batchTest'])->name('batch-test')->middleware('proceed_guard');
        Route::get('batch/tests/reattempt/{course_topic}/{batch}/{exam_id}/{exam_type}', [ExamController::class, 'reattemptBatchTest'])->name('reattempt-batch-test')->middleware('proceed_guard');

        // EXAM
        // Route::get('batch/{batch}/{courseLecture}/{exam}', [ExamController::class, 'question'])->name('question');
        Route::get('batch/{batch}/exam/batch-exam/{exam}', [ExamController::class, 'question'])->name('question');
        // Route::get('batch/{batch}/special-exam/{exam}/question', [ExamController::class, 'specialExamQuestion'])->name('specialExamQuestion');
        Route::post('batch/{batch}/{exam}/result', [ExamController::class, 'submit'])->name('submit');


    });
    Route::get('submission-status', function () {
        return view('student.pages_new.batch.exam.examSubmissionGreeting');
    });
    Route::get('getInvoice/{course}/{payments}', [PdfController::class, 'getInvoice'])->name('getInvoice');

    // PROGRESS
    Route::get('/progress/{user_id}', [ProgressController::class, 'course'])->name('enroll-course');
    Route::get('/progress/{user_id}/{course}/overall', [ProgressController::class, 'tagAnlysis'])->name('analysis');
    Route::get('/progress/{user_id}/{course}/mcq', [ProgressController::class, 'mcqAnalysis'])->name('mcqAnalysis');
    Route::get('/progress/{user_id}/{course}/cq', [ProgressController::class, 'cqAnalysis'])->name('cqAnalysis');

    // PAYMENTS
    Route::get('/payments/{user_id}', [PaymentController::class, 'payments'])->name('payments');

    //Process Payment
    Route::post('/process-payment/{course}', [CourseController::class, 'processPayment'])->name('payment.process');
    //Payment success
    Route::get('/payment-success/{course}', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
});

require __DIR__ . '/auth.php';
