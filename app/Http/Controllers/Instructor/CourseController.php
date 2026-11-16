<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Instructor\CourseRequest;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Course::class);
        $courses = Course::with('category')->withCount('students')->when(! request()->user()->isAdmin(), fn ($q) => $q->where('instructor_id', request()->user()->id))->latest()->paginate(12);

        return view('instructor.courses.index', compact('courses'));
    }

    public function create()
    {
        Gate::authorize('create', Course::class);

        return view('instructor.courses.form', ['course' => new Course, 'categories' => Category::orderBy('name')->get()]);
    }

    public function store(CourseRequest $r)
    {
        Gate::authorize('create', Course::class);
        $d = $r->validated();
        $d['instructor_id'] = $r->user()->id;
        $d['slug'] = $this->slug($d['title']);
        if ($r->hasFile('thumbnail')) {
            $d['thumbnail'] = $r->file('thumbnail')->store('courses/thumbnails', 'public');
        }$c = Course::create($d);

        return redirect()->route('instructor.courses.show', $c)->with('success', 'Đã tạo khóa học.');
    }

    public function show(Course $course)
    {
        Gate::authorize('view', $course);
        $course->load(['category', 'sections.lessons'])->loadCount('students');

        return view('instructor.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        Gate::authorize('update', $course);

        return view('instructor.courses.form', ['course' => $course, 'categories' => Category::orderBy('name')->get()]);
    }

    public function update(CourseRequest $r, Course $course)
    {
        Gate::authorize('update', $course);
        $d = $r->validated();
        $d['slug'] = $this->slug($d['title'], $course->id);
        if ($r->hasFile('thumbnail')) {
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }$d['thumbnail'] = $r->file('thumbnail')->store('courses/thumbnails', 'public');
        }$course->update($d);

        return redirect()->route('instructor.courses.show', $course)->with('success', 'Đã cập nhật khóa học.');
    }

    public function destroy(Course $course)
    {
        Gate::authorize('delete', $course);
        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }$course->delete();

        return redirect()->route('instructor.courses.index')->with('success', 'Đã xóa khóa học.');
    }

    private function slug(string $title, ?int $except = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 2;
        while (Course::where('slug', $slug)->when($except, fn ($q) => $q->whereKeyNot($except))->exists()) {
            $slug = $base.'-'.$i++;
        }

return $slug;
    }
}
