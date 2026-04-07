<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\TherapistRegisterController;
use App\Http\Controllers\TherapistController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Middleware\TherapistActive;
use App\Http\Controllers\TestController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\TherapistArticleController;
use App\Http\Controllers\PaymentController;

// الصفحة الرئيسية
Route::get('/', [HomeController::class, 'index'])->name('home');

// Google Login / Signup للمريض
Route::get('/auth/google/patient', [GoogleController::class, 'redirectToGooglePatient'])->name('patient.login.google');
Route::get('/auth/google/patient/callback', [GoogleController::class, 'handleGooglePatientCallback']);

// Google Login / Signup للمعالج
Route::get('/auth/google/therapist', [GoogleController::class, 'redirectToGoogleTherapist'])->name('therapist.login.google');
Route::get('/auth/google/therapist/callback', [GoogleController::class, 'handleGoogleTherapistCallback']);

// الراوتات المتعلقة بانشاء حساب وتسجيل دخول المريض
Route::get('/patient/login', [AuthenticatedSessionController::class, 'createPatient'])->name('patient.login');
Route::post('/patient/login', [AuthenticatedSessionController::class, 'storePatient']);
Route::get('/patient/register', [RegisteredUserController::class, 'createPatient'])->name('patient.register');
Route::post('/patient/register', [RegisteredUserController::class, 'storePatient']);


// الراوتات المتعلقة بانشاء حساب وتسجيل دخول المعالج
Route::get('/therapist/login', [AuthenticatedSessionController::class, 'createTherapist'])->name('therapist.login');
Route::post('/therapist/login', [AuthenticatedSessionController::class, 'storeTherapist']);
Route::get('/therapist/register', [RegisteredUserController::class, 'createTherapist'])->name('therapist.register');
Route::post('/therapist/register', [RegisteredUserController::class, 'storeTherapist']);

    
// الراوتات المتعلقة بتسجيل دخول الادمن
Route::get('/admin/login', [AuthenticatedSessionController::class, 'createAdmin'])->name('admin.login');
Route::post('/admin/login', [AuthenticatedSessionController::class, 'storeAdmin'])->name('admin.login.submit');


Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');



Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// *********************

Route::middleware(['role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminDashboardController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/admin/pendingTherapists', [AdminDashboardController::class,'pendingTherapists'])->name('pendingTherapists');
    Route::post('/admin/approveTherapist/{id}', [AdminDashboardController::class, 'approveTherapist'])
    ->name('admin.approve.therapist');

});

// ******************************

Route::middleware(['auth', 'role:patient'])->group(function(){
    Route::get('/patient/dashboard', [PatientController::class,'dashboard'])->name('patient.dashboard');
    Route::get('/test', [TestController::class, 'index'])->name('test');
    Route::post('/test/submit', [TestController::class, 'submit'])->name('test.submit');
});

// ******************************


Route::middleware(['auth', 'role:therapist'])->group(function() {
    Route::get('/therapist/dashboard', [TherapistController::class,'dashboard'])->name('therapist.dashboard');
    Route::get('/therapist/profile/edit', [TherapistController::class, 'editProfile'])->name('therapist.profile.edit');
    Route::put('/therapist/profile/update', [TherapistController::class, 'updateProfile'])->name('therapist.profile.update');
    Route::get('/therapist/articles', [TherapistArticleController::class, 'index'])->name('therapist.articles.index');
    Route::get('/therapist/articles/create', [TherapistArticleController::class, 'create'])->name('therapist.articles.create');
    Route::post('/therapist/articles', [TherapistArticleController::class, 'store'])->name('therapist.articles.store');
});
Route::get('/therapist/articles/{article}', [TherapistArticleController::class, 'show'])->name('articles.show');


// ******************************

Route::get('/pending', function(){
    return view('pages.pending');
})->name('pending.notice');

Route::middleware('auth')->group(function () {
    
});

// // راوت عرض جميع الاخصائيين 
// Route::get('/all',function(){
//     return view('pages.all-therapist');
// });

// الروابط 
// Route::get('/sessions', function () {
//     return view('sessions');
// })->name('sessions');

// Route::get('/contact', function () {
//     return view('contact');
// })->name('contact');






// مجموعة الراوتات الخاصة بالأدمن
// لوحة تحكم الأدمن


// عرض تفاصيل أخصائي
Route::get('/admin/therapists/{id}', [AdminDashboardController::class, 'showTherapist'])
    ->name('admin.therapists.show');

// حذف أخصائي
// Route::delete('/admin/therapist/{id}', [AdminDashboardController::class, 'destroyTherapist'])->name('therapists.destroy');
Route::delete('/admin/therapists/{id}', [AdminDashboardController::class, 'deleteTherapist'])
    ->name('admin.therapists.delete');

// **************************************************

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ***************************
Route::middleware('auth')->group(function () {
   
});
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');



Route::middleware(['auth', 'role:patient'])->group(function(){
    Route::get('/patient/dashboard', [PatientController::class,'dashboard'])->name('patient.dashboard');
    Route::get('/patient/edit', [PatientController::class,'editProfile'])->name('edit-profile');
    Route::put('/patient/update', [PatientController::class,'updateProfile'])->name('patient.update');
    
});









Route::get('/therapists/{id}', [TherapistController::class, 'show'])
->name('therapist.show');





Route::get('/therapists', [TherapistController::class,'index'])
    ->name('therapists.index');
    // صفحة التقييم (صفحة لكتابة مراجعة)
Route::get('/therapist/{therapist}/rating', [App\Http\Controllers\TherapistController::class, 'rating'])
->name('therapist.rating');

// صفحة الحجز
Route::get('/therapist/{therapist}/booking', [App\Http\Controllers\TherapistController::class, 'booking'])
->name('therapist.booking');

Route::get('/appointments/{therapist}',[AppointmentController::class,'index']);

Route::post('/appointments',[AppointmentController::class,'store']);

Route::get('/bookings',[BookingController::class,'index']);

Route::middleware(['auth'])->group(function () {

    // حجز جلسة
    Route::post('/book-session', [BookingController::class, 'store'])
        ->name('book.session');

    // صفحة الجلسة
    Route::get('/session/{id}', [SessionController::class, 'video'])
        ->name('session.video');

});
Route::get('/payment', [PaymentController::class, 'index'])->name('payment-index');

Route::get('/session/{id}', [SessionController::class, 'video'])
    ->name('session.video');
Route::middleware(['auth', 'role:therapist'])->group(function () {
        Route::get('/bookings', [BookingController::class, 'indexForTherapist'])->name('therapist.bookings');
        Route::post('/booking/{id}/approve', [BookingController::class, 'approveBooking'])
        ->name('booking.approve');
});

Route::middleware('auth')->group(function () {
    Route::get('/session/{id}/video', [SessionController::class, 'video'])
     ->name('session.video');
     
});

Route::middleware(['auth'])->group(function () {
    Route::get('/journal', [JournalController::class, 'index'])->name('journal.index');
    Route::post('/journal', [JournalController::class, 'store'])->name('journal.store');
});


Route::middleware('auth')->group(function() {
    Route::get('/mood', [MoodController::class, 'index'])->name('mood.index');
    Route::post('/mood', [MoodController::class, 'store'])->name('mood.store');
});


Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');



Route::middleware(['auth', 'role:therapist', TherapistActive::class])->prefix('therapist')->name('therapist.articles.')->group(function () {
    Route::get('/', [TherapistArticleController::class, 'index'])->name('index');
    Route::get('/create', [TherapistArticleController::class, 'create'])->name('create');
    Route::post('/store', [TherapistArticleController::class, 'store'])->name('store');
});