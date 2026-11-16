<?php

use App\Http\Controllers\Instructor\CourseController;
use App\Http\Controllers\Instructor\CourseStudentController;
use App\Http\Controllers\Instructor\DashboardController;
use App\Http\Controllers\Instructor\ExamController;
use App\Http\Controllers\Instructor\ExamResultController;
use App\Http\Controllers\Instructor\LessonController;
use App\Http\Controllers\Instructor\QuestionController;
use App\Http\Controllers\Instructor\QuestionImportController;
use App\Http\Controllers\Instructor\SectionController;
use Illuminate\Support\Facades\Route;

Route::prefix('instructor')->name('instructor.')->middleware(['auth', 'role:instructor,admin'])->group(function () {
    // === W2 === (dashboard, courses, sections, lessons, course students) — only W2 edits this block
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('courses', CourseController::class);
    Route::get('/courses/{course}/students', CourseStudentController::class)->middleware('can:view,course')->name('courses.students');
    Route::resource('courses.sections', SectionController::class)->shallow();
    Route::resource('sections.lessons', LessonController::class)->shallow();
    // === /W2 ===

    // === W4 === (question bank, exams, Excel import/export, results) — only W4 edits this block
    Route::get('/questions/template', [QuestionImportController::class, 'template'])->name('questions.template');
    Route::post('/courses/{course}/questions/import', [QuestionImportController::class, 'store'])->middleware('can:update,course')->name('courses.questions.import');
    Route::get('/courses/{course}/questions/export', [QuestionImportController::class, 'export'])->middleware('can:update,course')->name('courses.questions.export');
    Route::resource('courses.questions', QuestionController::class)->middleware('can:update,course')
        ->middlewareFor(['show', 'edit', 'update', 'destroy'], 'can:view,question');

    Route::get('/exams/{exam}/results', [ExamResultController::class, 'index'])->middleware('can:view,exam')->name('exams.results');
    Route::get('/exams/{exam}/scores/export', [ExamResultController::class, 'export'])->middleware('can:view,exam')->name('exams.scores.export');
    Route::resource('courses.exams', ExamController::class)->middleware('can:update,course')
        ->middlewareFor(['show', 'edit', 'update', 'destroy'], 'can:view,exam');
    // === /W4 ===
});
