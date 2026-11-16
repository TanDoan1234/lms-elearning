<?php

use App\Http\Controllers\Student\CheckoutController;
use App\Http\Controllers\Student\CourseCatalogController;
use App\Http\Controllers\Student\EnrollmentController;
use App\Http\Controllers\Student\HomeController;
use App\Http\Controllers\Student\LearnController;
use App\Http\Controllers\Student\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/courses', [CourseCatalogController::class, 'index'])->name('courses.index');
Route::get('/courses/{course:slug}', [CourseCatalogController::class, 'show'])->name('courses.show');

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::post('/courses/{course:slug}/enroll', EnrollmentController::class)->name('courses.enroll');
    Route::get('/checkout/{course:slug}', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout/{course:slug}/pay', [CheckoutController::class, 'pay'])->name('checkout.pay');
    Route::prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
        Route::get('/courses', [StudentController::class, 'courses'])->name('courses');
        Route::get('/orders', [StudentController::class, 'orders'])->name('orders');
    });
    Route::post('/lessons/{lesson}/complete', [LearnController::class, 'complete'])->name('lessons.complete');
});

Route::get('/learn/{course:slug}/{lesson?}', [LearnController::class, 'show'])
    ->middleware(['auth', 'enrolled'])->name('learn.show');
