<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Admin\CQController;
use App\Http\Controllers\Admin\CSVController;
use App\Http\Controllers\Admin\MCQController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\BatchExamController;
use App\Http\Controllers\Admin\LiveClassController;
use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Admin\ContentTagController;
use App\Http\Controllers\Admin\SubmissionController;
use App\Http\Controllers\Admin\CourseTopicController;
use App\Http\Controllers\Admin\ImageUploadController;
use App\Http\Controllers\Admin\BatchLectureController;
use App\Http\Controllers\Admin\CourseLectureController;
use App\Http\Controllers\Admin\CourseCategoryController;
use App\Http\Controllers\Admin\QuestionContentTagController;
use App\Http\Controllers\Admin\StudentExamAttemptController;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is_admin']], function () {
    Route::get('/index', [AdminController::class, 'AdminIndex'])->name('admin.index');

    // START OF USER
    Route::resource('/user', UserController::class);
    Route::get('/allAdmin', [UserController::class, 'allAdmin'])->name('allAdmin');
    Route::get('/allTeacher', [UserController::class, 'allTeacher'])->name('allTeacher');
    Route::get('/allStudent', [UserController::class, 'allStudent'])->name('allStudent');

    // START OF USER SETTINGS
    Route::get('/settings', [SettingsController::class, 'settings'])->name('admin.settings');
    Route::get('/changePassword', [SettingsController::class, 'changePassword'])->name('admin.changePassword');

    // START OF COURSE
    Route::resource('/course', CourseController::class, ['except' => ['store', 'update']]);
    Route::get('/changeCourseStatus', [CourseController::class, 'changeCourseStatus']);
    Route::get('course/{course}/add-course-lecture', [CourseController::class, 'addCourseLecture'])->name('addCourseLecture');
    // END OF COURSE

    // START OF COURSE CATEGORY
    Route::resource('/course-category', CourseCategoryController::class, ['except' => ['store', 'update']]);
    Route::get('/changeCoursCategoryStatus', [CourseCategoryController::class, 'changeCourseCategoryStatus']);
    // END OF COURSE CATEGORY

    // START OF COURSE TOPIC
    Route::resource('/course-topic', CourseTopicController::class, ['except' => ['show', 'store', 'update']]);
    Route::get('/changeCourseTopicStatus', [CourseTopicController::class, 'changeCourseTopicStatus']);
    Route::get('/customCourseTopic/{course_category}/{course}', [CourseTopicController::class, 'customCourseTopic'])->name('showcustomcoursetopic');
    // END OF COURSE TOPIC

    // START OF COURSE LECTURE
    Route::resource('/course-lecture', CourseLectureController::class, ['except' => ['store', 'update']]);
    Route::get('/changeCourseLectureStatus', [CourseLectureController::class, 'changeCourseLectureStatus']);
    // END OF COURSE LECTURE

    // START OF BATCH
    Route::resource('/batch', BatchController::class, ['except' => ['store', 'update']]);
    Route::get('/changeBatchStatus', [BatchController::class, 'changeBatchStatus']);
    Route::get('/changeStudentStatus', [BatchController::class, 'changeStudentStatus'])->name('changeStudentStatus');
    Route::get('batch-student', [BatchController::class, 'batchStudent'])->name('batch-student.index');
    Route::post('/add-student-to-batch/{course}/{batch}', [BatchController::class, 'addStudentToBatch'])->name('addStudentToBatch');
    Route::delete('/delete-student-from-batch/{course}/{batch}/{batchStudentEnrollment}', [BatchController::class, 'deleteStudentFromBatch'])->name('deleteStudentFromBatch');
    // END OF BATCH

    // START OF BATCH LECTURE
    Route::resource('/batch-lecture', BatchLectureController::class, ['except' => ['show', 'update']]);
    Route::get('/changeBatchLectureStatus', [BatchLectureController::class, 'changeBatchLectureStatus']);
    // END OF BATCH LECTURE

    // START OF LIVE CLASS
    Route::resource('/live-class', LiveClassController::class, ['except' => ['show', 'store', 'update']]);
    Route::get('/changeLiveClassStatus', [LiveClassController::class, 'changeLiveClassStatus']);
    // END OF LIVE CLASS

    // START OF PAYMENT
    Route::resource('/payment', PaymentController::class, ['except' => ['show', 'store', 'update']]);
    // END OF PAYMENT

    // START OF LIVE CLASS
    Route::resource('/content-tag', ContentTagController::class, ['except' => ['show', 'store', 'update']]);
    Route::get('/changeContentTagStatus', [ContentTagController::class, 'changeContentTagStatus']);
    Route::resource('/question-content-tag', QuestionContentTagController::class, ['except' => ['show', 'store', 'update']]);
    Route::get('/changeQuestionContentTagStatus', [QuestionContentTagController::class, 'changeQuestionContentTagStatus']);
    // END OF LIVE CLASS

    // START OF EXAM
    Route::resource('/exam', ExamController::class, ['except' => ['store', 'update']]);
    Route::get('/exam/{exam}/add-question', [ExamController::class, 'addQuestion'])->name('addQuestion');
    Route::post('/exam/{exam}/excel-add-question', [ExamController::class, 'excelAddQuestion'])->name('excelAddQuestion');
    Route::get('/all-mcq', [ExamController::class, 'allMCQ'])->name('showAllMCQ');
    Route::get('/all-cq', [ExamController::class, 'allCQ'])->name('showAllCQ');
    Route::get('/all-assignment', [ExamController::class, 'allAssignment'])->name('showAllAssignment');
    // END OF EXAM

    // START OF EXAM
    Route::resource('/batch-exam', BatchExamController::class, ['except' => ['show', 'store', 'update']]);
    Route::get('/changeBatchExamStatus', [BatchExamController::class, 'changeBatchExamStatus']);
    // END OF EXAM

    // START OF EXAM
    Route::resource('/student-exam-attempt', StudentExamAttemptController::class, ['except' => ['show', 'store', 'update']]);
    // END OF EXAM

    // START OF CQ EXAM
    // Route::get('{exam}/creative-question/{creative-question}', [CQController::class, 'creativeQuestion'])->name('creative-question');
    Route::resource('{exam}/cq', CQController::class);
    // Route::resource('/exam/cq', CQController::class, ['except' => ['store', 'update']]);
    // END OF CQ EXAM

    // START OF MCQ EXAM
    Route::resource('{exam}/mcq', MCQController::class);
    // Route::resource('/exam/mcq', MCQController::class, ['except' => ['store', 'update']]);
    // END OF MCQ EXAM

    // START OF ASSIGNMENT
    Route::resource('{exam}/assignment', AssignmentController::class, ['except' => ['store', 'update']]);
    // Route::resource('/exam/assignment', AssignmentController::class, ['except' => ['store', 'update']]);
    // END OF ASSIGNMENT

    // START OF ASSIGNMENT
    Route::resource('/request', RequestController::class, ['except' => ['store', 'update']]);
    // END OF ASSIGNMENT

    // START OF BLOG
    Route::resource('/blog', BlogController::class);
    Route::get('/changeBlogStatus', [BlogController::class, 'changeBlogStatus']);
    // END OF BLOG

    // START OF EXAM SUBMISSION
    Route::get('/batch-exam/{batch}/{exam}/{exam_type}/submission', [SubmissionController::class, 'submission'])->name('submission');
    Route::get('/batch-exam/{batch}/{exam}/{exam_type}/submission/{student}/seeDetails', [SubmissionController::class, 'seeDetails'])->name('seeDetails');
    Route::post('/batch-exam/{batch}/{exam}/{exam_type}/submission/{student}/give-marks', [SubmissionController::class, 'giveMarks'])->name('giveMarks');
    Route::post('/batch-exam/{batch}/{exam}/{exam_type}/submission/{student}/{creative_question}/edit-marks', [SubmissionController::class, 'editMarks'])->name('editMarks');
    Route::post('/batch-exam/{batch}/{exam}/{exam_type}/submission/{student}/{assignment}/edit-assignment-marks', [SubmissionController::class, 'editAssignmetnMarks'])->name('editAssignmetnMarks');
    Route::post('/batch-exam/{batch}/{exam}/{exam_type}/submission/{student}/update-give-marks', [SubmissionController::class, 'updateGiveMarks'])->name('updateGiveMarks');
    Route::post('/batch-exam/{batch}/{exam}/{exam_type}/submission/{student}/cq-checkedPaper', [SubmissionController::class, 'checkedPaperOfCQ'])->name('checkedPaperOfCQ');
    Route::post('/batch-exam/{batch}/{exam}/{exam_type}/submission/{student}/assignment-checkedPaper', [SubmissionController::class, 'checkedPaperOfAssignment'])->name('checkedPaperOfAssignment');
    // END OF EXAM SUBMISSION

    Route::get('/activity', [ActivityController::class, 'Index'])->name('admin.activity');

    //custom create
    Route::get('single/user/create', [UserController::class, 'Create'])->name('singleUser.create');
    Route::get('single/course-category/create', [CourseCategoryController::class, 'Create'])->name('singleCourseCategory.create');
    Route::get('single/course/create', [CourseController::class, 'Create'])->name('singleCourse.create');
    Route::get('single/course-topic/create', [CourseTopicController::class, 'Create'])->name('singleCourseTopic.create');
    Route::get('single/course-lecture/create', [CourseLectureController::class, 'Create'])->name('singleCourseLecture.create');
    Route::get('single/exam/create', [ExamController::class, 'Create'])->name('singleExam.create');
    Route::get('single/content-tag/create', [ContentTagController::class, 'Create'])->name('singleContentTag.create');
    Route::get('single/batch/create', [BatchController::class, 'Create'])->name('singleBatch.create');
    Route::get('single/batch-liveclass/create', [LiveClassController::class, 'Create'])->name('singleBatchLiveClass.create');
    Route::get('single/batch-lecture/create', [BatchLectureController::class, 'Create'])->name('singleBatchLecture.create');
    Route::get('single/batch-exam/create', [BatchExamController::class, 'Create'])->name('singleBatchExam.create');

    // CSV
    Route::get('tag-empty-export-csv', [CSVController::class, 'emptyContentTag'])->name('tagEmptyExportCSV');
    Route::get('mcq-empty-export-csv', [CSVController::class, 'emptyMCQ'])->name('emptyMCQ');
    Route::get('cq-empty-export-csv', [CSVController::class, 'emptyCQ'])->name('emptyCQ');
    Route::get('assignment-empty-export-csv', [CSVController::class, 'emptyAssignment'])->name('emptyAssignment');

    Route::get('download-courses-as-csv', [CSVController::class, 'courseCSV'])->name('courseCSV');
    Route::get('download-course-lectures-as-csv', [CSVController::class, 'courseLecturesCSV'])->name('courseLecturesCSV');

    Route::get('download-content-tag-as-csv', [CSVController::class, 'contentTagExportCSV'])->name('contentTagExportCSV');
    Route::post('upload-content-tag-as-csv', [CSVController::class, 'contentTagImportCSV'])->name('contentTagImportCSV');

    Route::get('download-exam-as-csv', [CSVController::class, 'examExportCSV'])->name('examExportCSV');
    Route::get('download-slug', [CSVController::class, 'slugExport'])->name('slugExport');

    // START OF IMAGE UPLOAD
    Route::resource('upload-image', ImageUploadController::class);
});

require __DIR__ . '/auth.php';
