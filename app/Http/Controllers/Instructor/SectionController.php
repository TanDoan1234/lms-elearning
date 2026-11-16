<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Instructor\SectionRequest;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Support\Facades\Gate;

class SectionController extends Controller
{
    public function index(Course $course)
    {
        Gate::authorize('view', $course);
        $course->load('sections.lessons');

        return view('instructor.sections.index', compact('course'));
    }

    public function create(Course $course)
    {
        Gate::authorize('update', $course);

        return view('instructor.sections.form', ['course' => $course, 'section' => new Section]);
    }

    public function store(SectionRequest $r, Course $course)
    {
        Gate::authorize('update', $course);
        $d = $r->validated();
        $d['position'] = $d['position'] ?? ($course->sections()->max('position') + 1);
        $course->sections()->create($d);

        return redirect()->route('instructor.courses.show', $course)->with('success', 'Đã thêm chương.');
    }

    public function show(Section $section)
    {
        Gate::authorize('view', $section);
        $section->load('course', 'lessons');

        return view('instructor.sections.show', compact('section'));
    }

    public function edit(Section $section)
    {
        Gate::authorize('update', $section);

        return view('instructor.sections.form', ['course' => $section->course, 'section' => $section]);
    }

    public function update(SectionRequest $r, Section $section)
    {
        Gate::authorize('update', $section);
        $section->update($r->validated());

        return redirect()->route('instructor.courses.show', $section->course)->with('success', 'Đã cập nhật chương.');
    }

    public function destroy(Section $section)
    {
        Gate::authorize('delete', $section);
        $course = $section->course;
        $section->delete();

        return redirect()->route('instructor.courses.show',$course)->with('success','Đã xóa chương.');
    }
}
