<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resources(['users' => UserController::class, 'categories' => CategoryController::class]);
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::patch('/courses/{course}/toggle-status', [CourseController::class, 'toggleStatus'])->middleware('can:update,course')->name('courses.toggle-status');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}/confirm', [OrderController::class, 'confirm'])->name('orders.confirm');
});
