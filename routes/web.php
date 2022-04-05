<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ModelExamController;
use App\Http\Controllers\SinglePaymentController;
use App\Models\User;
use App\Models\Admin\Exam;
use App\Models\Admin\Course;
use App\Models\Admin\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\CourseController;
use App\Http\Controllers\Student\BundleController;
use App\Utils\Payment;
use Illuminate\Support\Facades\Session;
use smasif\ShurjopayLaravelPackage\ShurjopayService;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Medical olympiad 2022 route
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->middleware('is_admin');
Route::get('/medical-olympiad/medical-olympiad', function() {
    return view('landing.medi-olympiad');
})->name('medi-olympiad');

// Medical olympiad 2022 route ends

Route::get('/', function () {
    $social_group = \App\Models\SocialGroup::query()->get();
    return view('landing.landing',compact('social_group'));
})->name('home');

Route::get('/ajax-course-request/{category}', [CourseController::class, 'courseByCategory']);


Route::get('/error', function () {
    // abort(404);
    return view('student.pages_new.error');
});

Route::view('/dashboard', 'dashboard')->middleware(['auth'])->name('dashboard');

Route::get('/course/course-preview/{course}', [CourseController::class, 'coursePreview'])->name('course-preview');
// Courses Page
Route::get('/course/{category?}/{intermediary_level?}', [CourseController::class, 'course'])->name('course');
// Preview Course
Route::get('/course/course-preview/{course}/enroll', [CourseController::class, 'enroll'])->name('enroll');

// BUNDLE PREVIEW
Route::get('/bundle/bundle-preview/{bundle_slug}', [BundleController::class, 'bundlePreview'])->name('bundle-preview');
// BUNDLE ENROLL
Route::get('/bundle/bundle-preview/{bundle}/enroll', [BundleController::class, 'bundle_enroll'])->name('bundle_enroll');

// Roadmap Page-> should be-> Route::get('/course/course-preview/{course}/roadmap', [CourseController::class, 'roadmap'])->name('roadmap')
// Route::get('/roadmap', [CourseController::class, 'roadmap'])->name('roadmap');
// Route::get('/new_roadmap', [CourseController::class, 'new_roadmap'])->name('new_roadmap');


require __DIR__ . '/auth.php';


Route::get('/about-us', function(){
    return view('landing.about_us');
})->name('about_us');

Route::get('/privacy-policy', function(){
    return view('landing.privacypolicy');
})->name('privacy_policy');

Route::get('/refund-return-policy', function(){
    return view('landing.refundandreturnpolicy');
})->name('refund_return_policy');

Route::get('/terms-condition', function(){
    return view('landing.termsandcondition');
})->name('terms_condition');

Route::get('/contact-us', [ContactUsController::class,'index'])->name('contact_us');
Route::post('/contact-us', [ContactUsController::class,'store'])->name('store.contact.us');

//Model Exam landing page
Route::get('/model-exam', [ModelExamController::class,'getModelExams'])->name('model.exam');
Route::get('/model-exam/{id}', [ModelExamController::class,'getMcqExamPaper'])->name('model.exam.paper.mcq')->middleware('auth');
Route::post('/model-exam/submit/{id}', [ModelExamController::class,'submitMcq'])->name('model.exam.mcq.submit')->middleware('auth');

//single payment api
Route::get('/single-payment/{examId}', [SinglePaymentController::class,'initialize'])->name('single.payment.initialize')->middleware('auth');
Route::get('/single-payment-success/{examId}', [SinglePaymentController::class,'paymentSuccess'])->name('single.payment.success')->middleware('auth');
Route::get('/single-payment-category/{categoryId}', [SinglePaymentController::class,'initializeCategoryPayment'])->name('category.single.payment.initialize')->middleware('auth');
Route::get('/single-payment-category-success/{categoryId}', [SinglePaymentController::class,'CategoryPaymentSuccess'])->name('category.single.payment.success')->middleware('auth');


Route::get('/blog/single/{blog}', [BlogController::class,'readBlog'])->name('read-blog');
Route::get('/blogs', [BlogController::class,'allBlogs'])->name('all-blogs');

//language Switch route

Route::get('/language/{lang}', function ($lang) {

    if (array_key_exists($lang, Config::get('language'))) {
        Session::put('appLocale', $lang);
    }
    return redirect()->back();
})->name('lang.switch');


Route::get('/test', function() {
//    Role::create(['name' => 'Documentation']);
    $role = Role::query()->where('name','Documentation')->first();
    $permission = Permission::create(['name' => 'test']);
    $role->givePermissionTo($permission);
    return view('slider');
});
