<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\User;

class HomeController extends Controller
{
    public function __invoke()
    {
        $featured = Course::published()->with(['category', 'instructor'])->withCount('students')->orderByDesc('students_count')->limit(6)->get();
        $newest = Course::published()->whereNotIn('id', $featured->pluck('id'))->with(['category', 'instructor'])->withCount('students')->latest()->limit(6)->get();
        $categories = Category::withCount(['courses' => fn ($query) => $query->published()])->orderBy('name')->get();
        $numbers = [
            'students' => User::where('role', 'student')->count(),
            'courses' => Course::published()->count(),
            'certificates' => Certificate::count(),
        ];

        return view('home', compact('featured', 'newest', 'categories', 'numbers'));
    }
}
