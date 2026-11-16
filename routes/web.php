<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    $name = match (auth()->user()->role) {
        'admin' => 'admin.dashboard', 'instructor' => 'instructor.dashboard', default => 'student.dashboard'
    };

    return redirect()->route($name);
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/instructor.php';
require __DIR__.'/student.php';
require __DIR__.'/exam.php';
