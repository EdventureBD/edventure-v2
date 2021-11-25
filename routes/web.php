<?php

use App\Http\Controllers\Admin\BlogController;
use App\Models\User;
use App\Models\Admin\Exam;
use App\Models\Admin\Course;
use App\Models\Admin\CourseCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\CourseController;
use App\Utils\Payment;
use smasif\ShurjopayLaravelPackage\ShurjopayService;

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

Route::get('/', function () {
    $categories=CourseCategory::where('status',1)->select('title','id','slug')->orderBy('id', "ASC")->get();
    $selected_category_id=$categories[0]->id;
    $selected_category_slug=$categories[0]->slug;
    $courses = Course::where('status', 1)
                    ->where('course_category_id',$selected_category_id)
                    ->orderBy('order')
                    ->select('title','slug','icon','banner','course_category_id','price')
                    ->take(8)
                    ->get();
    return view('landing.landing', compact('courses','categories','selected_category_slug'));
})->name('home');

Route::get('/ajax-course-request/{category}', [CourseController::class, 'courseByCategory']);


Route::get('/error', function () {
    // abort(404);
    return view('student.pages.frontend.error');
});

Route::view('/dashboard', 'dashboard')->middleware(['auth'])->name('dashboard');

Route::get('/course/{category?}', [CourseController::class, 'course'])->name('course');
Route::get('/course/course-preview/{course}', [CourseController::class, 'coursePreview'])->name('course-preview');
Route::get('/course/course-preview/{course}/enroll', [CourseController::class, 'enroll'])->name('enroll');
// Route::get('/course/course-preview/{course}/enroll/confirm', [CourseController::class, 'confirm'])->name('confirm');


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

Route::get('/contact-us', function(){
    return view('landing.contact_us');
})->name('contact_us');


Route::get('/blog/single/{blog}', [BlogController::class,'readBlog'])->name('read-blog');
Route::get('/blogs', [BlogController::class,'allBlogs'])->name('all-blogs');



Route::get('/test-otp', function() {
    return view('test_otp');
})->name('send_otp');
