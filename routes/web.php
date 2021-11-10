<?php

use App\Models\User;
use App\Models\Admin\Exam;
use App\Models\Admin\Course;
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
    $courses = Course::where('status', 1)->orderBy('order')->take(8)->get();
    // return view('student.pages.frontend.student', compact('courses'));
    return view('landing.landing', compact('courses'));
})->name('home');

Route::get('/error', function () {
    // abort(404);
    return view('student.pages.frontend.error');
});

Route::view('/dashboard', 'dashboard')->middleware(['auth'])->name('dashboard');

Route::get('/course', [CourseController::class, 'course'])->name('course');
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


// Route::get('/test-payment', function() {
    
    
//     // You can call simply $shurjopay_service->sendPayment(2) without success route
// });



