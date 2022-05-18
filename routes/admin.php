<?php

use App\Http\Controllers\CouponController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ModelMcqTagAnalysisController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SinglePaymentController;
use App\Http\Controllers\SocialGroupController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ExamCategoryController;
use App\Http\Controllers\ExamTagsController;
use App\Http\Controllers\ExamTopicController;
use App\Http\Controllers\McqQuestionController;
use App\Http\Controllers\ModelExamController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Admin\CSVController;

use App\Http\Controllers\Admin\BundleController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\MCQController;
use App\Http\Controllers\Admin\CQController;
use App\Http\Controllers\Admin\AptitudeTestMCQController;
use App\Http\Controllers\Admin\PopQuizMCQController;
use App\Http\Controllers\Admin\PopQuizCQController;
use App\Http\Controllers\Admin\TopicEndExamMCQController;
use App\Http\Controllers\Admin\TopicEndExamCQController;

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\IntermediaryLevelController;
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
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is_admin']], function () {
    Route::get('/index', [AdminController::class, 'AdminIndex'])->name('admin.index');

    // START OF USER
    Route::group(['middleware' => ['permission:user']], function () {
        Route::resource('/user', UserController::class);
        Route::get('/allAdmin', [UserController::class, 'allAdmin'])->name('allAdmin');
        Route::get('/allTeacher', [UserController::class, 'allTeacher'])->name('allTeacher');
        Route::get('/allStudent', [UserController::class, 'allStudent'])->name('allStudent');
    });
    Route::get('/lockedStudents', [UserController::class, 'locked_students'])->name('locked_students');
    Route::get('/unlockStudent/{student_tee_attempt_id}', [UserController::class, 'unlock_student'])->name('unlock_student');

    // START OF USER SETTINGS
    Route::get('/settings', [SettingsController::class, 'settings'])->name('admin.settings');
    Route::get('/changePassword', [SettingsController::class, 'changePassword'])->name('admin.changePassword');

    Route::group([], function () {

        Route::group(['middleware' => ['permission:course']], function () {
            // START OF COURSE
            Route::resource('/course', CourseController::class, ['except' => ['store', 'update']]);
            Route::get('/changeCourseStatus', [CourseController::class, 'changeCourseStatus']);
            Route::get('course/{course}/add-course-lecture', [CourseController::class, 'addCourseLecture'])->name('addCourseLecture');
            // END OF COURSE
        });

        Route::group(['middleware' => ['permission:course_program']], function () {
            // START OF INTERMEDIARY LEVEL
            Route::resource('/intermediary_level', IntermediaryLevelController::class, ['except' => ['show', 'store', 'update']]);
            Route::get('/changeIntermediaryLevelStatus', [IntermediaryLevelController::class, 'changeIntermediaryLevelStatus'])->name('changeIntermediaryLevelStatus');
            // END OF INTERMEDIARY LEVEL
        });


        Route::group(['middleware' => ['permission:course_category']], function () {
            // START OF COURSE CATEGORY
            Route::resource('/course-category', CourseCategoryController::class, ['except' => ['store', 'update']]);
            Route::get('/changeCoursCategoryStatus', [CourseCategoryController::class, 'changeCourseCategoryStatus']);
            // END OF COURSE CATEGORY
        });

        Route::group(['middleware' => ['permission:course_island']], function () {
            // START OF COURSE TOPIC or COURSE ISLAND
            Route::resource('/course-topic', CourseTopicController::class, ['except' => ['show', 'store', 'update']]);
            Route::get('/changeCourseTopicStatus', [CourseTopicController::class, 'changeCourseTopicStatus']);
            Route::get('/customCourseTopic/{course_category}/{course}', [CourseTopicController::class, 'customCourseTopic'])->name('showcustomcoursetopic');
            // END OF COURSE TOPIC or COURSE ISLAND
        });

        Route::group(['middleware' => ['permission:course_lecture']], function () {
            // START OF COURSE LECTURE
            Route::resource('/course-lecture', CourseLectureController::class, ['except' => ['store', 'update']]);
            Route::get('/changeCourseLectureStatus', [CourseLectureController::class, 'changeCourseLectureStatus']);
            // END OF COURSE LECTURE
        });


        Route::group(['middleware' => ['permission:course_batch']], function () {
            // START OF BATCH
            Route::resource('/batch', BatchController::class, ['except' => ['store', 'update']]);
            Route::get('/changeBatchStatus', [BatchController::class, 'changeBatchStatus']);
            Route::get('/changeStudentStatus', [BatchController::class, 'changeStudentStatus'])->name('changeStudentStatus');
            Route::get('batch-student', [BatchController::class, 'batchStudent'])->name('batch-student.index');
            Route::post('/add-student-to-batch/{course}/{batch}', [BatchController::class, 'addStudentToBatch'])->name('addStudentToBatch');
            Route::delete('/delete-student-from-batch/{course}/{batch}/{batchStudentEnrollment}', [BatchController::class, 'deleteStudentFromBatch'])->name('deleteStudentFromBatch');
            Route::get('/batch-rank-update', function () {
                Artisan::call("update:batch-rank");
                Session::put('status', 'Batch rank updated successful!');
                return redirect()->back();
            })->name('batch-rank');
            // END OF BATCH
        });


        Route::group(['middleware' => ['permission:course_add_batch_to_island']], function () {
            // START OF BATCH LECTURE or ADD BATCH TO ISLAND
            Route::resource('/batch-lecture', BatchLectureController::class, ['except' => ['show', 'update']]);
            Route::get('/changeBatchLectureStatus', [BatchLectureController::class, 'changeBatchLectureStatus']);
            // END OF BATCH LECTURE or ADD BATCH TO ISLAND
        });

        // START OF LIVE CLASS
        Route::resource('/live-class', LiveClassController::class, ['except' => ['show', 'store', 'update']]);
        Route::get('/changeLiveClassStatus', [LiveClassController::class, 'changeLiveClassStatus']);
        // END OF LIVE CLASS

        Route::group(['middleware' => ['permission:course_content_tag']], function () {
            // START OF CONTENT TAG
            Route::resource('/content-tag', ContentTagController::class, ['except' => ['show', 'store', 'update']]);
            Route::get('/changeContentTagStatus', [ContentTagController::class, 'changeContentTagStatus']);
            Route::resource('/question-content-tag', QuestionContentTagController::class, ['except' => ['show', 'store', 'update']]);
            Route::get('/changeQuestionContentTagStatus', [QuestionContentTagController::class, 'changeQuestionContentTagStatus']);
            // END OF CONTENT TAG
        });

        Route::group(['middleware' => ['permission:course_bundle']], function () {
            // START OF BUNDLES
            Route::resource('/bundle', BundleController::class, ['except' => ['show', 'store', 'update']]);
            Route::get('/changeBundleStatus', [BundleController::class, 'changeBundleStatus']);
            // END OF BUNDLES
        });
    });

    // START OF PAYMENT
    Route::resource('/payment', PaymentController::class, ['except' => ['show', 'store', 'update']])->middleware(['permission:payment']);
    // END OF PAYMENT

    Route::group(['middleware' => ['permission:course_exam']], function () {
        // START OF EXAM
        Route::resource('/exam', ExamController::class, ['except' => ['store', 'update']]);
        Route::get('/exam/{exam}/add-question', [ExamController::class, 'addQuestion'])->name('addQuestion');
        // Add MCQ and CQ for POP QUIZ and TOPIC END EXAM
        Route::get('/exam/{exam}/add-question-CQ-only', [ExamController::class, 'addQuestion_CQ_only'])->name('addQuestion_CQ_only');
        Route::get('/exam/{exam}/add-question-MCQ-only', [ExamController::class, 'addQuestion_MCQ_only'])->name('addQuestion_MCQ_only');
        Route::post('/exam/{exam}/excel-add-question', [ExamController::class, 'excelAddQuestion'])->name('excelAddQuestion');
        Route::get('/all-mcq', [ExamController::class, 'allMCQ'])->name('showAllMCQ');
        Route::get('/all-cq', [ExamController::class, 'allCQ'])->name('showAllCQ');
        Route::get('/all-assignment', [ExamController::class, 'allAssignment'])->name('showAllAssignment');
        Route::get('/all-aptitude-test', [ExamController::class, 'allAT'])->name('showAllAT');
        Route::get('/all-pop-quiz', [ExamController::class, 'allPQ'])->name('showAllPQ');
        Route::get('/all-topic-end-exam', [ExamController::class, 'allTEE'])->name('showAllTEE');
        // END OF EXAM
    });

    Route::group(['middleware' => ['permission:course_batch_exam']], function () {
        // START OF BATCH EXAM
        Route::resource('/batch-exam', BatchExamController::class, ['except' => ['show', 'store', 'update']]);
        Route::get('/changeBatchExamStatus', [BatchExamController::class, 'changeBatchExamStatus']);
        // END OF  BATCH EXAM
    });


        // START OF EXAM ATTEMPT
        Route::resource('/student-exam-attempt', StudentExamAttemptController::class, ['except' => ['show', 'store', 'update']]);
        // END OF EXAM ATTEMPT

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

        // START OF APTITUDE TEST MCQ EXAM
        Route::resource('{exam}/aptitude-test-mcqs', AptitudeTestMCQController::class);
        // END OF Aptitude Test MCQ EXAM

        // START OF POP QUIZ MCQ EXAM
        Route::resource('{exam}/pop-quiz-mcq', PopQuizMCQController::class)->except(['index']);
        Route::get('{exam}/pop-quiz-all-questions', [PopQuizMCQController::class, 'all'])->name('pop-quiz-all');
        // END OF POP QUIZ MCQ EXAM

        // START OF POP QUIZ CQ EXAM
        Route::resource('{exam}/pop-quiz-cq', PopQuizCQController::class)->except(['index']);
        // END OF POP QUIZ CQ EXAM

        // START OF TOPIC END EXAM MCQ EXAM
        Route::resource('{exam}/topic-end-exam-mcq', TopicEndExamMCQController::class)->except(['index']);
        Route::get('{exam}/topic-end-exam-all-questions', [TopicEndExamMCQController::class, 'all'])->name('topic-end-exam-all');
        // END OF TOPIC END EXAM MCQ EXAM

        // START OF TOPIC END EXAM CQ EXAM
        Route::resource('{exam}/topic-end-exam-cq', TopicEndExamCQController::class)->except(['index']);
        // END OF TOPIC END EXAM CQ EXAM

        // START OF ASSIGNMENT
        Route::resource('/request', RequestController::class, ['except' => ['store', 'update']]);
        // END OF ASSIGNMENT


    // START OF BLOG
    Route::resource('/blog', BlogController::class)->middleware(['permission:other']);
    Route::get('/changeBlogStatus', [BlogController::class, 'changeBlogStatus'])->middleware(['permission:other']);
    // END OF BLOG

    // START OF EXAM SUBMISSION
    Route::get('/batch-exam/{batch}/{exam}/{exam_type}/submission', [SubmissionController::class, 'submission'])->name('submission');
    Route::get('/batch-exam/{batch}/{exam}/{exam_type}/submission/{student}/seeDetails', [SubmissionController::class, 'seeDetails'])->name('seeDetails');
    Route::get('/batch-exam/{batch}/{exam}/{exam_type}/submission/{student}/seeDetailsCqOnly', [SubmissionController::class, 'seeDetailsCqOnly'])->name('seeDetailsCqOnly');
    Route::get('/batch-exam/{batch}/{exam}/{exam_type}/submission/{student}/seeDetailsMcqOnly', [SubmissionController::class, 'seeDetailsMcqOnly'])->name('seeDetailsMcqOnly');
    Route::post('/batch-exam/{batch}/{exam}/{exam_type}/submission/{student}/give-marks', [SubmissionController::class, 'giveMarks'])->name('giveMarks');
    Route::post('/batch-exam/{batch}/{exam}/{exam_type}/submission/{student}/{creative_question}/edit-marks', [SubmissionController::class, 'editMarks'])->name('editMarks');
    Route::post('/batch-exam/{batch}/{exam}/{exam_type}/submission/{student}/{assignment}/edit-assignment-marks', [SubmissionController::class, 'editAssignmetnMarks'])->name('editAssignmetnMarks');
    Route::post('/batch-exam/{batch}/{exam}/{exam_type}/submission/{student}/update-give-marks', [SubmissionController::class, 'updateGiveMarks'])->name('updateGiveMarks');
    Route::post('/batch-exam/{batch}/{exam}/{exam_type}/submission/{student}/cq-checkedPaper', [SubmissionController::class, 'checkedPaperOfCQ'])->name('checkedPaperOfCQ');
    Route::post('/batch-exam/{batch}/{exam}/{exam_type}/submission/{student}/assignment-checkedPaper', [SubmissionController::class, 'checkedPaperOfAssignment'])->name('checkedPaperOfAssignment');
    // END OF EXAM SUBMISSION

    // Route::get('/activity', [ActivityController::class, 'Index'])->name('admin.activity');

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
    Route::get('download-users-as-csv', [CSVController::class, 'usersExportCSV'])->name('usersExportCSV');

    Route::get('download-content-tag-as-csv', [CSVController::class, 'contentTagExportCSV'])->name('contentTagExportCSV');
    Route::post('upload-content-tag-as-csv', [CSVController::class, 'contentTagImportCSV'])->name('contentTagImportCSV');
    Route::post('upload-user-as-csv', [CSVController::class, 'userImportCSV'])->name('userImportCSV');

    Route::get('download-exam-as-csv', [CSVController::class, 'examExportCSV'])->name('examExportCSV');
    Route::get('download-slug', [CSVController::class, 'slugExport'])->name('slugExport');

    // START OF IMAGE UPLOAD
    Route::resource('upload-image', ImageUploadController::class)->middleware(['permission:other']);

    /**************************************** Model Exam ****************************************/

    //Exam Category
    Route::group(['middleware' => ['permission:model_exam_category']], function () {
        Route::get('/exam-category',[ExamCategoryController::class,'index'])->name('exam.category.index');
        Route::post('/exam-category',[ExamCategoryController::class,'store'])->name('exam.category.store');
        Route::put('/exam-category/{id}',[ExamCategoryController::class,'update'])->name('exam.category.update');
        Route::delete('/exam-category/{id}',[ExamCategoryController::class,'destroy'])->name('exam.category.destroy');
        Route::get('/exam-category/visibility/{id}',[ExamCategoryController::class,'updateCategoryVisibility'])->name('exam.category.visibility');
    });

    //Exam Topic
    Route::group(['middleware' => ['permission:model_exam_topics']], function () {
        Route::get('/exam-topic',[ExamTopicController::class,'index'])->name('exam.topic.index');
        Route::get('/exam-topic/{id}',[ExamTopicController::class,'show'])->name('exam.topic.show');
        Route::post('/exam-topic',[ExamTopicController::class,'store'])->name('exam.topic.store');
        Route::put('/exam-topic/{id}',[ExamTopicController::class,'update'])->name('exam.topic.update');
        Route::delete('/exam-topic/{id}',[ExamTopicController::class,'destroy'])->name('exam.topic.destroy');
    });


    //Exam Tags
    Route::group(['middleware' => ['permission:model_exam_tags']], function () {
        Route::get('/exam-tags',[ExamTagsController::class,'index'])->name('exam.tags.index');
        Route::get('/exam-tags/{id}',[ExamTagsController::class,'show'])->name('exam.tags.show');
        Route::post('/exam-tags',[ExamTagsController::class,'store'])->name('exam.tags.store');
        Route::put('/exam-tags/{id}',[ExamTagsController::class,'update'])->name('exam.tags.update');
        Route::delete('/exam-tags/{id}',[ExamTagsController::class,'destroy'])->name('exam.tags.destroy');
    });


    //Model Exam
    Route::group(['middleware' => ['permission:model_exam']], function () {
        Route::get('/model-exam',[ModelExamController::class,'index'])->name('model.exam.index');
        Route::get('/model-exam/visibility/{id}',[ModelExamController::class,'updateExamVisibility'])->name('model.exam.visibility');
        Route::get('/model-exam/topics/{id}',[ModelExamController::class,'getTopicsByCategory'])->name('model.exam.topics');
        Route::get('/model-exam/list/{categoryId}/{topicId}',[ModelExamController::class,'getExamByCategoryAndTopic'])->name('model.exam.list');
        Route::get('/model-exam/downloadPdf/{id}',[ModelExamController::class,'downloadSolutionPdf'])->name('model.exam.pdf');
        Route::get('/model-exam/{id}',[ModelExamController::class,'edit'])->name('model.exam.edit');
    });

    Route::post('/model-exam',[ModelExamController::class,'store'])->name('model.exam.store');
    Route::put('/model-exam/{id}',[ModelExamController::class,'update'])->name('model.exam.update');
    Route::delete('/model-exam/{id}',[ModelExamController::class,'destroy'])->name('model.exam.destroy');
    Route::get('/model-exam/result/list',[ModelExamController::class,'modelExamResult'])->name('model.exam.result')->middleware(['permission:model_exam_result']);

    //Model Exam Question
    Route::group(['middleware' => ['permission:model_exam']], function () {
        Route::get('/model-exam/question/{id}',[McqQuestionController::class,'index'])->name('model.exam.question.index');
        Route::get('/model-exam/question/edit/{slug}',[McqQuestionController::class,'edit'])->name('model.exam.question.edit');
        Route::put('/model-exam/question/{id}',[McqQuestionController::class,'update'])->name('model.exam.question.update');
        Route::post('/model-exam/question/{id}',[McqQuestionController::class,'store'])->name('model.exam.question.store');
        Route::delete('/model-exam/question/{slug}',[McqQuestionController::class,'destroy'])->name('model.exam.question.destroy');
    });


    //Model Exam Tag analysis
    Route::group(['middleware' => ['permission:model_exam_tag_analysis']], function () {
        Route::get('/model-exam/tag/analysis',[ModelMcqTagAnalysisController::class,'tagAnalysisForAdmin'])->name('model.exam.tag.analysis');
    });

    //Payments
    Route::group(['middleware' => ['permission:model_exam_payment']], function () {
        Route::get('/model-exam/payment/category',[SinglePaymentController::class,'getCategoryPayment'])->name('model.exam.payment.category');
        Route::get('/model-exam/payment/exam',[SinglePaymentController::class,'getExamPayment'])->name('model.exam.payment.exam');
    });



    //Export from admin side
    Route::get('download-as-csv', [CSVController::class, 'exportFromModelExam'])->name('model.exam.csv');


    /**************************************** Model Exam ****************************************/

    /**************************************** Social Group ****************************************/
    Route::group(['middleware' => ['permission:other']], function () {
        Route::get('/social-group',[SocialGroupController::class,'index'])->name('social.group.index');
        Route::post('/social-group',[SocialGroupController::class,'store'])->name('social.group.store');
        Route::delete('/social-group/{id}',[SocialGroupController::class,'destroy'])->name('social.group.delete');
        Route::put('/social-group/{id}',[SocialGroupController::class,'update'])->name('social.group.update');
    });


    /**************************************** Social Group ****************************************/



    /**************************************** Role & permission ****************************************/
    Route::group(['middleware' => ['permission:role_permission']], function () {
        Route::get('/role', [RolePermissionController::class, 'index'])->name('role.index');
        Route::post('/role', [RolePermissionController::class, 'store'])->name('role.create');
        Route::Put('/role/{id}', [RolePermissionController::class, 'update'])->name('role.update');
        Route::delete('/role/{id}', [RolePermissionController::class, 'destroy'])->name('role.delete');
        Route::get('/role/assign', [RolePermissionController::class, 'assignRoleIndex'])->name('role.assign.index');
        Route::post('/role/assign', [RolePermissionController::class, 'assignRoleStore'])->name('role.assign.create');
        Route::delete('/role/assign/{user}', [RolePermissionController::class, 'assignRoleDestroy'])->name('role.assign.delete');
    });

    /**************************************** Role & permission ****************************************/

    /**************************************** Role & permission ****************************************/
    Route::group(['middleware' => ['permission:contact_us']], function () {
        Route::get('/contact-us', [ContactUsController::class, 'adminIndex'])->name('contact.us.index');
    });

    /**************************************** Role & permission ****************************************/

    /**************************************** Free Category Access ****************************************/
    Route::group(['middleware' => ['permission:free_category_access']], function () {
        Route::get('/category-access',[ExamCategoryController::class,'categoryAccessIndex'])->name('category.access.index');
        Route::post('/category-access',[ExamCategoryController::class,'confirmCategoryAccess'])->name('category.access.confirm');
    });

    /**************************************** Role & permission ****************************************/

    /**************************************** Coupons ****************************************/

    Route::group(['middleware' => ['permission:coupon']], function () {
        Route::get('/coupon',[CouponController::class,'index'])->name('coupon.index');
        Route::post('/coupon',[CouponController::class,'store'])->name('coupon.store');
        Route::delete('/coupon/{id}',[CouponController::class,'destroy'])->name('coupon.destroy');
    });
});

require __DIR__ . '/auth.php';
