<?php

use App\Http\Controllers\AttemptController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ExamController;
use Illuminate\Support\Facades\Route;

Route::get('/certificates/verify/{code}', [CertificateController::class, 'verify'])->name('certificates.verify');

Route::middleware('auth')->group(function () {
    Route::get('/exams/{exam}', [ExamController::class, 'show'])->name('exams.show');
    Route::post('/exams/{exam}/start', [ExamController::class, 'start'])->middleware('throttle:10,1')->name('exams.start');
    Route::get('/attempts/{attempt}/take', [AttemptController::class, 'take'])->middleware('can:update,attempt')->name('attempts.take');
    Route::get('/attempts/{attempt}/result', [AttemptController::class, 'result'])->middleware('can:view,attempt')->name('attempts.result');
    Route::get('/student/attempts', [AttemptController::class, 'index'])->name('student.attempts');
    Route::get('/student/certificates', [CertificateController::class, 'index'])->name('certificates.index');
    Route::get('/certificates/{certificate}/download', [CertificateController::class, 'download'])->middleware('can:view,certificate')->name('certificates.download');
});
