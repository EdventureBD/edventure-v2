<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\PdfController;
use App\Http\Controllers\Student\ExamController;
use App\Http\Controllers\Student\BatchController;
use App\Http\Controllers\Student\CourseController;
use App\Http\Controllers\Student\PaymentController;
use App\Http\Controllers\Student\ProgressController;
use App\Http\Controllers\Student\AccountDetailsController;
use App\Utils\Payment;

Route::group(['middleware' => ['auth', 'is_student']], function () {
    Route::get('/profile', [AccountDetailsController::class, 'index'])->name('profile');
    Route::get('/profile-data', [AccountDetailsController::class, 'profileData'])->name('profile-data');
    Route::get('/batch-results', [AccountDetailsController::class, 'batchResults'])->name('batch-results'); //getting batch results
    Route::get('/tag-analysis-report/{course}', [AccountDetailsController::class, 'tagAnalysisReport'])->name('tag-analysis-report');

    Route::get('/edit-profile/{user_id}', [AccountDetailsController::class, 'edit'])->name('edit-profile');
    Route::post('/edit-profile/{user_id}', [AccountDetailsController::class, 'update'])->name('edit-profile');

    Route::get('/course/course-preview/{course}/enroll', [CourseController::class, 'enroll'])->name('enroll');
    Route::get('/course/course-preview/{course}/enroll/{payments}', [CourseController::class, 'invoice'])->name('invoice');

    // Route::get('/course/course-preview/{course}/enroll', [CourseController::class, 'enroll'])->name('enroll');

    // BATCH
    Route::get('batch', [BatchController::class, 'batch'])->name('batch');
    Route::group(['middleware' => 'canAccess'], function () {
        // BATCH
        Route::get('batch/{batch}/', [BatchController::class, 'batchLecture'])->name('batch-lecture');
        Route::get('batch/{batch}/{courseLecture}', [BatchController::class, 'lecture'])->name('topic_lecture');



        // BATCH TEST
        Route::get('batch/tests/{batch}/{exam_type}]', [BatchController::class, 'batchTest'])->name('batch-test');



        // EXAM
        // Route::get('batch/{batch}/{courseLecture}/{exam}', [ExamController::class, 'question'])->name('question');
        Route::get('batch/{batch}/exam/batch-exam/{exam}', [ExamController::class, 'question'])->name('question');
        // Route::get('batch/{batch}/special-exam/{exam}/question', [ExamController::class, 'specialExamQuestion'])->name('specialExamQuestion');
        Route::post('batch/{batch}/{exam}/result', [ExamController::class, 'submit'])->name('submit');
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
